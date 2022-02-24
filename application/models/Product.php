<?php
    class Product extends CI_Model
    {
        /* 
        DOCU: Gets all the products 
        */
        public function get_all_products()
        {
            $query = "SELECT * FROM products";
            return $this->db->query($query)->result_array();
        }


         /* 
        DOCU: Gets all the products by the supplied user id.
        */
        public function get_products_by_user($user_id)
        {
            $query = "SELECT * FROM products WHERE user_id = ?";
            $values = array($user_id);
            return $this->db->query($query, $values)->result_array();
        }

        public function get_product_info($product_id)
        {
            $query = "SELECT * FROM products WHERE id = ?";
            $values = array($product_id);
            return $this->db->query($query, $values)->result_array()[0];
        }

        /* 
        DOCU: This adds the product to the database
        */
        public function add_product($product_data)
        {
            $query = "INSERT INTO 
                        products (user_id, product_name, product_description, product_price, product_inventory, product_qty_sold) 
                       VALUES (?,?,?,?,?,?)";
            
            $values = array(
                $this->session->userdata('user_id'),
                $this->security->xss_clean($product_data['product_name']),
                $this->security->xss_clean($product_data['product_description']),
                $this->security->xss_clean($product_data['product_price']),
                $this->security->xss_clean($product_data['product_inventory']),
                (rand(1,10) * 10)
            );

            return $this->db->query($query, $values);
        }

        /*
        DOCU: This function removes a product form the database
        */
        public function remove_product($product_id)
        {
            $query = "DELETE FROM products WHERE id = ?";
            $values = array($product_id);
            return $this->db->query($query, $values);
        }



        public function update_product($product_data)
        {
            $query = "UPDATE products SET 
                        product_name = ?, 
                        product_description = ?, 
                        product_price = ?, 
                        product_inventory = ? 
                      WHERE 
                        id = ?";

            $values = array(
                $this->security->xss_clean($product_data['product_name']),
                $this->security->xss_clean($product_data['product_description']),
                $this->security->xss_clean($product_data['product_price']),
                $this->security->xss_clean($product_data['product_inventory']),
                $this->security->xss_clean($product_data['id'])
            );

            return $this->db->query($query, $values);
        }

          /*  
        DOCU: This function checks required input fields for the product.
        */
        public function validate_product() 
        {
            $this->form_validation->set_error_delimiters("<p class='error'>",'</p>');

            $this->form_validation->set_rules('product_name', 'Product Name', 'required');

            $this->form_validation->set_rules('product_description', 'Product Description', 'required'); 

            $this->form_validation->set_rules('product_price', 'Product Price', 'required');

            if(!$this->form_validation->run()) 
            {
                return validation_errors();
            }
            else 
            {
                return "success";
            }

        }
    }
?>