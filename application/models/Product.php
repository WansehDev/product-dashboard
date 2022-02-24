<?php
    class Product extends CI_Model
    {
        /*  
        DOCU: This function is responsible to validate and add the message from any user to the database.
        */
        public function add_post() 
        {
            $result = $this->message->validate_post();
            
            if($result != 'success') {
                $this->session->set_flashdata('input_errors', $result);
            } 
            else {
                $this->message->add_post($this->input->post('message_input'));
            }
        
            redirect("item");
        }

        /*  
        DOCU: This function is responsible to validate and add the comment from any user to the database.
        */
        public function add_comment() 
        {
            $result = $this->comment->validate_comment();

            if($result != 'success') {
                $this->session->set_flashdata('input_errors', validation_errors());
            }
            else {
                $this->comment->add_comment($this->input->post());
            }
            redirect("wall");
        }
    }
?>