<?php
    class Comment extends CI_Model
    {
            
        /*  
        DOCU: This function validates the required comment input.
        */
        public function validate_comment() 
        {
            $this->form_validation->set_error_delimiters("<p class='error'>",'</div>');

            $this->form_validation->set_rules('comment_input', 'Comment', 'required');

            if(!$this->form_validation->run()) 
            {
                return validation_errors();
            } 
            else 
            {
                return "success";
            }
        }

        /* 
        DOCU: This function inserts new comment to the database that depends on a message id.
        */
        public function add_comment($post) 
        {
            $query = 'INSERT INTO comments(user_id, message_id, comment, created_at, updated_at) VALUES (?, ?, ?, ?, ?)';
            $values = array($this->security->xss_clean($this->session->userdata('user_id')),
                        $this->security->xss_clean($post['message_id']), 
                        $this->security->xss_clean($post['comment_input']),
                        date('Y-m-d H:i:s'),
                        date('Y-m-d H:i:s')
                    ); 
            
            $this->db->query($query, $values);
        }   
    }
?>