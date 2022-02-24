<?php
    class Message extends CI_Model
    {
        /*  
        DOCU: This function validates the required message input.
        */
        public function validate_post() 
        {
            $this->form_validation->set_error_delimiters("<p class='error'>",'</div>');

            $this->form_validation->set_rules('message_input', 'Message', 'required');

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