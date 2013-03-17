<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
	
    public $itemsPerPage = 10;    
    function __construct()
    {
        parent::__construct();
        $this->load->model('model_admin', '', TRUE);
        $this->load->library('form_validation');
    }	
    public function index()
    {   
        $this->_isLoggedIn();
        $data['title']= 'Welcome';
        $this->load->view('admin/home', $data);
    }

    //PRODUCT METHODS:

    public function products()
    { 
        $this->_isLoggedIn();
        $this->_clear_session_data();
        $data['title']= 'Viewing All Products';
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        if(!is_numeric($page)){
            $this->_showError();
            redirect('admin/');
        }        
        $data['products'] = $this->model_admin->get_all_products($this->itemsPerPage, $page);
        $this->_set_pagination_config(base_url() . "admin/products", $this->model_admin->product_count());         
        $data["links"] = $this->pagination->create_links();
        $this->load->view('admin/products', $data); 
    }

    public function product()
    {   
        $this->_isLoggedIn();
        $param = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        if($param == 'new'){ // add new product                
            $this->_load_product_form('new');                 
        }elseif(is_numeric($param)){ //edit product           
            $query = $this->model_admin->get_product($param)->result(); 
            if(!isset($query[0])){
                $this->_showError();
                redirect('admin/products/');
            }
            $this->session->set_userdata(array('product' => $query));
            $this->_load_product_form('edit');               
        }else{ 
            $this->_showError(); 
            redirect('admin/products/');
        }
    }
    public function edit_product() 
    {	
        $this->_isLoggedIn();
        if(!$this->input->post('name')){         
            $this->_load_product_form('edit');     
        }else{
            $data = $this->_set_product_post_data('edit'); 
            $success = $this->model_admin->update_product($data);
            if($success){
                $this->_clear_session_data();
                $id = $this->_showSuccess('Product', $data['id']);
                redirect('admin/product/' . $data['id']);
            }else{
                $this->_showError(); 
                redirect('admin/products/');
            } 
        }
    }               
    public function add_product()
    {	
        $this->_isLoggedIn();
        if(!$this->input->post('name') || !$this->input->post('price') || 
                !$this->form_validation->is_decimal($this->input->post('price')) ){ 
            $this->_load_product_form('new'); 
        }else{
            $data = $this->_set_product_post_data('new');
            $insert = $this->model_admin->insert_product($data);
            if($insert){
                $id = $this->_showSuccess('Product');
                redirect('admin/product/' . $id); 
            }else{
                $this->_showError(); 
                redirect('admin/product/new');
            }
        }
    }
    public function delete_product()
    {            
        $this->_isLoggedIn();
        $id = $this->input->post('id');
        $table = $this->input->post('table');
        $deleted = $this->model_admin->delete_record($table, $id);
        if($deleted){
            $flashData = array(
                'message' => 'Product has been deleted successfully', 
                'type' => 'success'
            );
            $this->session->set_flashdata($flashData); 
            redirect('admin/products');
        }else{
            $this->_showError(); 
            redirect('admin/products');
        }
    }           
    protected function _load_product_form($mode)
    {
        $this->form_validation->set_error_delimiters('<div class="alert-box alert">', '</div>');
        $this->form_validation->set_rules('name', 'Product Name', 'required');
        $this->form_validation->set_rules('price', 'Price', 'required|is_decimal');	         
        $this->form_validation->run();      

        if($mode == 'new'){   
            $data['mode'] = 'new';
            $data['action'] =  base_url() . "admin/add_product";
            $data['title'] = 'insert new product';
            $data['upload_mode'] = 'prod_new';             
            if(isset( $this->session->userdata['upload_data']['file_name'])){
                $data['img'] = base_url() . 'httpdocs/uploads/product_images/' . 
                       $this->session->userdata['upload_data']['file_name'];
            }else{
                $data['img'] = '';
            }
        }elseif($mode == 'edit'){                
            $query = $this->session->userdata['product']; //grabs product fr session     
            $data['mode'] = 'edit';
            $data['action'] = base_url() . "admin/edit_product";
            $data['title']=  'Edit Product Id ' . $this->session->userdata['product'][0]->id;
            $data['product'] = $query;
            $data['upload_mode'] = 'prod_edit'; 
            if(isset( $this->session->userdata['upload_data']['file_name'])){
                $data['img'] = base_url() . 'httpdocs/uploads/product_images/' . 
                        $this->session->userdata['upload_data']['file_name'];
            }else{
                $data['img'] = $query[0]->image; 
            }
            
        }
        $data['categories'] = $this->model_admin->get_categories();                
        $this->load->view('admin/product', $data);

    }        
    protected function _set_product_post_data($mode)
    {
       
        $data = array();
        $data['name'] = $this->input->post('name', TRUE);
        $data['description'] = $this->input->post('description', TRUE);
        $data['price'] = $this->input->post('price', TRUE);				 
        $data['cat_id'] = $this->input->post('cat_id', TRUE);
        $data['image'] = $this->input->post('image', TRUE);
        if($mode=='edit'){
            $data['id'] = $this->input->post('id', TRUE);
        }
        return $data;
    }

    //CATEGORY METHODS

    public function categories()
    {	
        $this->_isLoggedIn();      
        $this->_clear_session_data();        
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $results = $this->model_admin->get_all_categories($this->itemsPerPage, $page); 
        $data['title']= 'All Categories';
        $data['categories'] = $results; 
        $this->_set_pagination_config(base_url() . "admin/categories", $this->model_admin->category_count());
        $data['links'] = $this->pagination->create_links();
        $this->load->view('admin/categories', $data);     
        
        
    }

    public function category()
    {   
        $this->_isLoggedIn();
        $param = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;            
        if($param == null || $param == ''){
            $this->_showError(); 
            redirect('admin/categories/');
        }elseif($param == 'new'){
           $this->_load_category_form(FALSE);
        }elseif(is_numeric($param)){
            $query = $this->model_admin->get_categories(TRUE, $param)->result();
            if(count($query) < 1){
                $this->_showError(); 
                redirect('admin/categories/');
            }
            $this->session->set_userdata(array('category' => $query));
            $this->_load_category_form();
        }            	
    }
    public function edit_category()
    {
        $this->_isLoggedIn();
        if(!$this->input->post('name')){
             $this->_load_category_form(TRUE);
        }else{
            $data = $this->_set_category_post_data(); 
            $data['title'] = '';
            $data['id'] = $this->input->post('id', TRUE);
            $success = $this->model_admin->update_category($data);
            if($success){       
                $this->_clear_session_data();
                $this->_showSuccess('Category', $data['id']); 
                redirect('admin/category/' . $data['id']);
            }else{
                $this->_showError();
                redirect('admin/categories');
            }
        }
    }
    public function add_category()
    {
        $this->_isLoggedIn();             
        if(!$this->input->post('name')){ 
            $this->_load_category_form(FALSE);
        }else{ 
            $data = $this->_set_category_post_data();
            $success = $this->model_admin->insert_category($data);	
            if($success){                
                $id = $this->_showSuccess('Category');
                redirect('admin/category/' . $id);
            }else{
                $this->_showError();
                redirect('admin/categories');
            } 
        }

    }
    
    public function delete_category()
    {
        $this->_isLoggedIn();
        $id = $this->input->post('id');
        $table = $this->input->post('table');
        $deleted = $this->model_admin->delete_record($table, $id);
        if($deleted){
            $flashData = array(
                'message' => 'Category has been deleted', 
                'type' => 'success'
            );
            $this->session->set_flashdata($flashData); 
            redirect('admin/categories');
        }else{
            $this->_showError(); 
            redirect('admin/categories');
        }	
    }
    
    protected function _set_category_post_data()
    {
        $data = array(); 
        $data['name'] = $this->input->post('name', TRUE);
        $data['description'] = $this->input->post('description', TRUE);
        $data['image'] = $this->input->post('image', TRUE);				 
        $data['slug'] = $this->input->post('slug', TRUE);	
        return $data;
    }
    protected function _load_category_form($edit = TRUE)
    {
        $this->form_validation->set_rules('name', 'Category Name', 'required');
        $this->form_validation->set_error_delimiters('<div class="alert-box alert">', '</div>');
        $this->form_validation->run();
        $data['edit'] = $edit;            
        if($edit){
            $data['title'] = 'Edit Category';
            $data['action'] = 'admin/edit_category';  
            $data['upload_mode'] = 'cat_edit'; 
            $query = $this->session->userdata['category'];
            $data['category'] = $query[0];
            if(isset( $this->session->userdata['upload_data']['file_name'])){
                $data['img'] = base_url() . 'httpdocs/uploads/category_images/' . 
                        $this->session->userdata['upload_data']['file_name'];
            }else{
                $data['img'] = $query[0]->image; 
            }
        }else{
            $data['title'] = 'New Category';
            $data['action'] = 'admin/add_category';
            $data['upload_mode'] = 'cat_new'; 
            if(isset( $this->session->userdata['upload_data']['file_name'])){
                $data['img'] = base_url() . 'httpdocs/uploads/category_images/' . 
                       $this->session->userdata['upload_data']['file_name'];
            }else{
                $data['img'] = '';
            }
        }
        $this->load->view('admin/category', $data);
    }

    protected function _set_pagination_config($url, $rows)
    {
        $config = array();
        $config["base_url"] = $url;
        $config["total_rows"] = $rows;
        $config["per_page"] = $this->itemsPerPage;
        $config["uri_segment"] = 3;
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = round($choice);
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li>'; 
        $config['num_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="current">';
        $config['cur_tag_close'] = '</li>';
        $this->pagination->initialize($config);
    }

    protected function _clear_session_data()
    {
        $this->session->unset_userdata('product');
        $this->session->unset_userdata('category');
        $this->session->unset_userdata('upload_data');  
    } 


    public function confirm($delete = '', $id = '')
    {
        $this->_isLoggedIn();
        
        switch ($delete){
        case 'product' : 
            $data['action'] =  base_url() . 'admin/delete_product'; 
            $data['table'] = 'products';
            $data['array'] = $this->model_admin->get_product($id)->num_rows > 0 ? $this->model_admin->get_product($id)->result() : FALSE; 
            break;
        case 'category' : 
            $data['action'] =  base_url() . 'admin/delete_category';
            $data['table'] = 'categories';
            $data['array'] = $this->model_admin->get_categories(TRUE, $id)->num_rows > 0 ? $this->model_admin->get_categories(TRUE, $id)->result() : FALSE;
            break; 
        }
        $data['id'] = $id;							
        $this->load->view('admin/confirm_delete', $data);		
    }

   
    public function login()
    {  
        $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
        $this->form_validation->set_error_delimiters('<div class="alert-box alert">', '</div>');
        if($this->form_validation->run() == FALSE)
        {
            $this->load->view('public/login');
            return;
        }else{
            $username = $this->input->post('username');
            $password = md5($this->input->post('password'));			
            //process the login
            $user_id = $this->model_admin->check_login($username, $password);					

            if ($user_id == FALSE) {
                $this->session->set_flashdata('login_error', 'You entered incorrect credentials');
                redirect('admin/login');
            }else{
                    $newdata = array(
                               'username'  => $username,
                               'id'     => $user_id,
                               'logged_in' => TRUE
                       );
                    $this->session->set_userdata($newdata);
                    redirect('admin/');

                }//end else
            }
    }
    public function logout()
    {
            $items = array('username' => '', 'id' => '', 'logged_in' => FALSE);
            $this->session->unset_userdata($items);
            $this->session->sess_destroy();             
            redirect('admin/login'); 
    }

    private function _isLoggedIn()
    {  
        if(!$this->session->userdata('logged_in')){
            $this->session->set_flashdata('login_error', 'You have to be logged in to see this page');
            redirect('admin/login');
        }              
    }

    /**************UPLOADER****************/

    public function upload()
    {
        $mode = ($this->uri->segment(3)) ? $this->uri->segment(3) : '';
        $data['error'] = '';
        $data['mode'] = $mode;
        $this->load->view('admin/upload_image', $data);
    }
    public function do_upload()
    {      
        $mode = $this->input->post('mode'); 
        
        switch($mode){
            case 'cat_edit': 
            $id = $this->session->userdata['category'][0]->id;
            $config['upload_path'] = './httpdocs/uploads/category_images';
            $path = 'admin/category/' . $id;
            break; 
            case 'cat_new': 
            $config['upload_path'] = './httpdocs/uploads/category_images';
            $path = 'admin/category/new'; 
            break; 
            case 'prod_new': 
            $config['upload_path'] = './httpdocs/uploads/product_images';
            $path = 'admin/product/new'; 
            break;
            case 'prod_edit': 
            $id = $this->session->userdata['product'][0]->id;
            $config['upload_path'] = './httpdocs/uploads/product_images';
            $path = 'admin/product/' . $id; 
            break; 
        }

        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']	= '6000';
        $config['max_width']  = '3600';
        $config['max_height']  = '3600';

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload())
        { 
            $data['error'] = $this->upload->display_errors();
            $data['mode'] = $this->input->post('mode'); 
            $this->load->view('admin/upload_image', $data);
        }
        else
        {  
            $upload_data = $this->upload->data();
            $this->session->set_userdata(array('upload_data' => $upload_data));              
            redirect($path);  
        }
    }
    
    protected function _showError()
    {
        $flashData = array(
                    'message' => 'There was a problem with your request', 
                    'type' => 'error'
                ); 
        $this->session->set_flashdata($flashData);
    }
    protected function _showSuccess($type, $id=NULL)
    {        
        $text = 'edited';
        if($id==NULL){
            $id = $this->model_admin->get_last_id();
            $text = 'inserted';
        }        
        $message = $type . ' Id: ' . $id . ' has been ' . $text . ' successfully';
        $flashData = array(
            'message' => $message, 
            'type' => 'success'
        ); 
        $this->session->set_flashdata($flashData);
        return $id;
    }
    
    //ORDER METHODS
    
    public function orders()
    {
        $this->_isLoggedIn();
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        if(!is_numeric($page)){
            $this->_showError();
        }
        $this->_set_pagination_config(base_url() . "admin/orders", $this->model_admin->order_count());   
        $result = $this->model_admin->get_orders($this->itemsPerPage, $page);        
        if(!empty($result)){
            $data['title'] = 'View All Orders';
            $data['links'] = $this->pagination->create_links();
            $data['orders'] = $result->result();
            $this->load->view('admin/orders', $data);
        }else{
            $this->session->set_flashdata('message', 'No Orders');
            echo 'set flash data';
        }
    }
    
    public function order()
    {
        $orderId = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        if(!is_numeric($orderId)){
            $this->_showError();
            return false;
        }
        $order = $this->model_admin->get_order($orderId); 
        if(!$order){
            echo '<div class="alert-box alert">There was a problem with your request</div>';
            return false;
        }                  
        $data['orderId'] = $orderId;
        $data['order'] = $order;
        $this->load->view('admin/order', $data);
    }
    
}   