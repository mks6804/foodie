<?php 
class Model_public extends CI_Model
{
	public $catName = '';
	public $catDesc = '';
	public $catImg = ''; 
        public $catSlug = '';
	public $productsCount = 0; 
        
    public function __construct()
    {
        parent::__construct();
    }	
    public function get_categories()
    {
        $query = $this->db->get('categories');
        return $query->result_array();
    }
    public function get_category_details($slug)
    {
        $query = $this->db->get_where('categories', array('slug' => $slug));
        if($query->num_rows > 0){
            $array = $query->row_array();		
            $this->catName = $array['name']; 
            $this->catDesc = $array['description'];
            $this->catImg = $array['image'];
            $this->catSlug = $array['slug'];
            return true;
        }else{
            return false;
        }
    } 
    /*
     * gets all products from category slug
     * returns an array 
     */
    public function get_products($slug, $limit, $start)
    {   
        $this->productsCount  =  $this->_query_products($slug)->db->count_all_results(); //for pagination
        $this->_query_products($slug);                 
        $this->db->limit($limit, $start);        
        $query = $this->db->get();         
        return $query->result_array();
    }
    
    private function _query_products($slug)
    {
        $this->db->select('products.name, products.image, products.slug, products.price');
        $this->db->from('products');
        $this->db->join('categories', 'products.cat_id = categories.id');
        $this->db->where('categories.slug', $slug);
        return $this;
    }
    
    
    /*
     * gets product from product slug
     * returns array
     */
    public function get_product($slug)
    {
        $sql = "SELECT 
                products.id,
                products.name, 
                products.description, 
                products.price, 
                products.image
                FROM products 
                WHERE products.slug = ?";
        $query = $this->db->query($sql, array($slug));
        return $query->result_array();
    }
    public function get_product_by_id($id)
    {
        $sql = "SELECT 
                products.id,
                products.name, 
                products.description, 
                products.price, 
                products.image
                FROM products 
                WHERE products.id = ?";
        $query = $this->db->query($sql, $id);
        return $query->result_array();
    }
    
    /*cart methods*/
    
    public function insert_order($data)
    {
        $success = TRUE;
        $order=array();
        $order['email'] = $data['email'];
        $order['phone'] = $data['phone'];        
        $order['total'] = $data['total'];
        $order['date'] = date("Y-m-d H:i:s");
        $order['instructions'] = $data['instructions'];
        $this->db->insert('orders', $order);
        $orderId = $this->db->insert_id();
        if(!$orderId){
            $success = FALSE;
        }
        $orderDetails=array();
        for($i=0; $i<$data['count']; $i++)
        {
            $orderDetails['order_id'] = $orderId;
            $orderDetails['product_id'] =  $data['details'.$i]['id'];
            $orderDetails['qty'] =  $data['details'.$i]['qty'];
            $orderDetails['price'] =  $data['details'.$i]['price'];
            $od = $this->db->insert('orders_details', $orderDetails);
            if(!$od){
                $success = FALSE;
            }
        }           
        return $success;
    }
 
}