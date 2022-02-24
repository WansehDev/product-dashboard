<?php
    class Comment extends CI_Model
    {
            
        /*  
        DOCU: This function returns all user comments depending on passed message id value.
        */
        public function get_comments_from_message_id($message_id) 
        {
            $safe_message_id = $this->security->xss_clean($message_id);
            $query = "SELECT comments.message_id, 
                        CONCAT(first_name,' ',last_name) AS comment_sender_name, 
                        comment AS comment_content, 
                        comments.created_at AS comment_date 
                      FROM 
                        comments 
                      LEFT JOIN
                        users on comments.user_id=users.id 
                            WHERE comments.message_id= ?";
            
            return $this->db->query($query, array($safe_message_id))->result_array();
        }

        /*  
        DOCU: This function validates the required comment input.
        */
        public function validate_comment() 
        {
            $this->form_validation->set_error_delimiters("<p class='error'>",'</p>');

            $this->form_validation->set_rules('reply', 'Comment', 'required');

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
            $query = 'INSERT INTO 
                        comments(user_id, message_id, comment) 
                       VALUES 
                         (?, ?, ?)';
            $values = array(
                    $this->security->xss_clean($this->session->userdata('user_id')),
                    $this->security->xss_clean($post['message_id']), 
                    $this->security->xss_clean($post['reply'])
            ); 
            
            $this->db->query($query, $values);
        }   
    }
?>