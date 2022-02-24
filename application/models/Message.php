<?php
    class Message extends CI_Model
    {
        /*  
        DOCU: This function inserts new message from a user to the database.
        */
        public function add_post($user_message, $product_id) {
            $query = 'INSERT INTO 
                        messages(user_id, product_id, message)
                      VALUES 
                        (?, ?, ?)';
            $values = array(
                $this->security->xss_clean($this->session->userdata('user_id')), 
                $this->security->xss_clean($product_id),
                $this->security->xss_clean($user_message),
            ); 
            $this->db->query($query, $values);
        }

        /*  
        DOCU: This function returns all user messages.
        */
        public function get_messages($product_id) {
            $query = 'SELECT messages.id AS post_id, 
                             message AS post_content, 
                             messages.created_at AS post_date, 
                             CONCAT(first_name," ",last_name) AS message_sender_name,
                             products.id as product_id
                       FROM 
                            messages 
                       LEFT JOIN 
                            users on messages.user_id=users.id 
                       LEFT JOIN
                            products on messages.product_id=products.id
                       WHERE 
                            messages.product_id=?
                       ORDER BY messages.created_at DESC';

            return $this->db->query($query, array($product_id))->result_array();
        }

        /*  
        DOCU: This function validates the required message input.
        */
        public function validate_post() 
        {
            $this->form_validation->set_error_delimiters("<p class='error'>",'</p>');

            $this->form_validation->set_rules('review', 'Message', 'required');

            if(!$this->form_validation->run()) 
            {
                return validation_errors();
            }
            else 
            {
                return 'success';
            }
        }
    }
?>