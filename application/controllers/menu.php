<?php
class Menu extends CI_Controller
{
    private $productsPerPage = 9;
     
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_public');
    }
    public function index()	
    {	
        $data['title'] = 'Menu';
        $categories = array(); 
        $categories = $this->Model_public->get_categories();
        if(count($categories)<1){
            $this->session->set_flashdata('type', 'error');
            $this->session->set_flashdata('message', 'No Categories Found');
            redirect(base_url()); 
        } 
        $data['categories'] = $categories;
        $this->load->view('public/menu', $data);		
    }
 
     public function category()
    {	
            
            $categorySlug = ($this->uri->segment(3)) ? htmlspecialchars($this->uri->segment(3)) : false;    
            $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
            $result = $this->Model_public->get_category_details($categorySlug);
            if(!$result){
                $this->session->set_flashdata('type', 'error');
                $this->session->set_flashdata('message', 'No Categories Found');
                redirect(base_url() . 'menu');
            }
           
            $data['categoryName'] = $this->Model_public->catName;	
            $data['categoryDesc'] = $this->Model_public->catDesc;
            $data['categoryImg'] = $this->Model_public->catImg;
            $data['categorySlug'] = $this->Model_public->catSlug; 
            $data['title'] = $data['categoryName'] ;
           
            $data['products'] = $this->Model_public->get_products($categorySlug, $this->productsPerPage, $page);
             
            $this->load->library('pagination');
            $config['base_url'] = base_url() . 'menu/category/' . $categorySlug;
            $config['total_rows'] = $this->Model_public->productsCount;
            $config['per_page'] = $this->productsPerPage;
            $config["uri_segment"] = 4;
            $this->pagination->initialize($config);
            $data['links'] = $this->pagination->create_links();
                        
            $this->load->view('public/products', $data); 
         
     
    
    }
    
    public function product()
    {
        $productSlug = ($this->uri->segment(3)) ? htmlspecialchars($this->uri->segment(3)) : false;
        if(!$this->input->is_ajax_request()){ //check if not ajax
                $this->session->set_flashdata(array('type' => 'error', 'message' => 'Cannot process your request'));                
                redirect(base_url() . 'menu');
            }             
        $result = $this->Model_public->get_product($productSlug);
        if(!$result){
            //not using flash message due to inside lightbox
            echo '<div class="alert-box">No Product Found. Please Try Again</div>';
            exit; 
        }
        $data['title'] = 'Product Detail';
        $data['product'] = $result;  
        $this->load->view('public/product', $data);
    }
    
    
    
    
}