<?php

class Order extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Model_public');
        $this->load->library('email');
    }

    public function index() {
        $data['cart'] = $this->cart->contents();
        $data['title'] = 'Your Order';
        $data['checkout'] = FALSE;
        $this->load->view('public/order', $data);
    }

    public function add() {
        $productId = ($this->uri->segment(3)) ? $this->uri->segment(3) : null;
        $qty = ($this->uri->segment(4)) ? $this->uri->segment(4) : 1;
        if ($productId == null || $productId == '' || !is_numeric($productId)) {
            redirect(base_url());
        } else {
            $product = $this->Model_public->get_product_by_id($productId);
            $data = array(
                'id' => $product[0]['id'],
                'qty' => $qty,
                'price' => $product[0]['price'],
                'name' => $product[0]['name'],
                'image' => $product[0]['image']
            );
            $this->cart->insert($data);
            redirect(base_url() . 'order');
        }
    }

    public function update() {
        $this->form_validation->set_error_delimiters('<div class="alert-box alert">', '</div>');
        for ($i = 0; $i < count($this->input->post(NULL, TRUE)); $i++) {
            $this->form_validation->set_rules($i . '[qty]', 'Quantity', 'trim|required|is_natural');
        }
        if ($this->form_validation->run() == FALSE) {
            $this->_set_order_data(FALSE);
        } else {
            $this->cart->update($this->input->post(NULL, TRUE));
            redirect(base_url() . 'order');
        }
    }

    public function checkout() {
        $this->_set_order_data();
    }

    public function clear() {
        $this->cart->destroy();
        redirect(base_url() . 'order');
    }

    public function submit() {
        $this->form_validation->set_error_delimiters('<div class="alert-box alert">', '</div>');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('phone', 'Phone', 'trim|required|valid_phone');
        $this->form_validation->set_rules('instructions', 'Instructions', 'alpha_dash_space');
        if ($this->form_validation->run() == FALSE) {
            $this->_set_order_data();
        } else {
            $order = $this->Model_public->insert_order($this->input->post(NULL, TRUE));
            //email
//            $this->email->from('$fromEmail', '$name');
//            $this->email->to('tes');
//            $this->email->subject('A new order has been placed!');
//            $this->email->message($this->input->post(NULL, TRUE));
            
//            echo '<pre>';
//            print_r($this->input->post(NULL, TRUE));
//            echo '<hr>';
//            
//            print_r($this->email);exit;
            
            //   $this->email->send();

            if ($order) {
                $this->cart->destroy();
                redirect('order/thankyou');
            } else {
                $this->session->set_flashdata(array('message' => 'Something went wrong with your order. Please try again later', 'type' => 'error'));
                redirect('order/');
            }
        }
    }

    protected function _set_order_data($checkout = TRUE) {
        $session = $this->session->userdata('cart_contents');
        if (!empty($session)) {
            $data['cart'] = $session;
            $data['title'] = 'Your Order';
            $data['checkout'] = $checkout;
            $this->load->view('public/order', $data);
        } else {
            redirect(base_url() . 'order');
        }
        return;
    }

    public function thankyou() {
        $data['title'] = 'Thank you';
        $this->load->view('public/thank_you', $data);
    }

}

?>
