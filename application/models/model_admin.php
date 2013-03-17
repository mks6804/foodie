<?php 
class Model_admin extends CI_Model
{    	 
    function __construct()
    {
        parent::__construct();		
    }
    
    //product methods:
    public function get_all_products($limit, $start)
    {		
        $this->db->limit($limit, $start);
        $query = $this->db->get('products'); 
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }    
    public function product_count() {
        return $this->db->count_all('products');
    }
    public function get_product($id)
    {
        return $this->db->get_where('products', array('id' => $id));
    }
    public function insert_product(array $array)
    {
        $slug = $this->_toAscii($array['name']);
        $array['slug'] = $this->_checkSlug($slug, 'products');
        $this->db->insert('products', $array);
        return true;
    }
    public function update_product(array $array)
    {   
        $slug = $this->_toAscii($array['name']);
        $data = array(
                'name' => $array['name'], 
                'slug' => $this->_checkSlug($slug, 'products'), 
                'description' => $array['description'],
                'price' => $array['price'],
                'image' => $array['image'],
                'cat_id' => $array['cat_id']
        );		
        $this->db->where('id', $array['id']);		
        $updated = $this->db->update('products', $data);			
        return $updated ? true : false;
    }
    
    //category methods    
    
    public function get_all_categories($limit, $start)
    {
        $this->db->limit($limit, $start);
        $query = $this->db->get('categories'); 
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;    
    }
    public function category_count() {
        return $this->db->count_all('categories');
    }
    
    public function get_categories($asArray = TRUE, $id = '')
    {
        if($asArray == FALSE){
            return $this->db->get('categories');
        }elseif($id != ''){
            return $this->db->get_where('categories', array('id' => $id));
        }else{
            return $this->db->get('categories')->result_array();
        }		
    }
    public function update_category($array)
    {
        $slug = $this->_toAscii($array['name']);
        $data = array(
                'name' => $array['name'], 
                'description' => $array['description'],
                'image' => $array['image'],
                'slug' => $this->_checkSlug($slug, 'categories')
        );		
        $this->db->where('id', $array['id']);		
        $updated = $this->db->update('categories', $data);			
        return $updated ? true : false;
    }
    
    public function insert_category($array)
    {
        $slug = $this->_toAscii($array['name']);
        $array['slug'] = $this->_checkSlug($slug, 'categories');
        $this->db->insert('categories', $array);
        return true;
    }
    
    public function get_orders($limit, $start)
    {
        $this->db->limit($limit, $start);
        $this->db->order_by('date', 'desc');
        $this->db->select('*');
        $query = $this->db->get('orders');        
        return $query; 
        
    }
    public function order_count() {
        return $this->db->count_all("orders");
    }
    public function get_order($id)
    {
        if(!is_numeric($id)){           
            return false;
        }
        $order = array(); 
        $this->db->select('email, phone, instructions, total, date');
        $this->db->where('id',$id);
        $main = $this->db->get('orders', 1)->result();
        //build the array:
        if(empty($main)){
            return false;
        }
        $order['email'] = $main[0]->email;
        $order['phone'] = $main[0]->phone; 
        $order['instructions'] = $main[0]->instructions; 
        $order['total'] = $main[0]->total; 
        $order['date'] = $main[0]->date;          
        //details
        $this->db->select('product_id, qty, price');
        $this->db->where('order_id',$id);        
        $details = $this->db->get('orders_details')->result();  
        if(empty($details)){
            return false;
        }
        $order_details = array();
        for($i=0; $i<count($details); $i++){
            $this->db->select('name');
            $this->db->where('id',$details[$i]->product_id);
            $name = $this->db->get('products')->result();  
            $productName = !empty($name) ? (string)$name[0]->name : '';
            $order_details[$i]['name'] = $productName; 
            $order_details[$i]['qty'] = $details[$i]->qty;
            $order_details[$i]['price'] = $details[$i]->price;
        }           
        $order['details'] = $order_details ;        
        return $order; 
    }
    
    
    public function delete_record($table, $id){
        $this->db->delete($table, array('id' => $id));
        if ($this->db->affected_rows() > 0){
            return TRUE;
        }else{
            return FALSE;
        }   
    }  
    
    public function check_login($username, $password)
    {
        
        $sql = 'SELECT id FROM users WHERE username = ? AND password = ?';
        $result = $this->db->query($sql, array($username, $password));             
        if($result->num_rows() == 1){
                return $result->row(0)->id; 
        }else{
                return false;
        }		
    }  
    
    private function _checkSlug($slug, $table)
    {
       $sql = 'SELECT slug FROM ' . $table . ' WHERE slug =\'' . $slug . '\''; 
       $result = $this->db->query($sql); 
       $count = $result->num_rows();
       if($count > 0){
           return $slug . '-' . $count;
       }else{
           return $slug;
       }
    }
    
    private function _toAscii($str, $replace=array(), $delimiter='-') {    
        $str = trim($str);
        setlocale(LC_ALL, 'en_US.UTF8');
        if( !empty($replace) ) {
            $str = str_replace((array)$replace, ' ', $str);
        }
        $clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
        $clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
        $clean = strtolower(trim($clean, '-'));
        $clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);

        return $clean;
    }
    
    public function get_last_id()
    {
        return $this->db->insert_id();
    }
        
}