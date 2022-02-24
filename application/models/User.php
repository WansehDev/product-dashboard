<?php
    class User extends CI_Model
    {
        /*  
        DOCU: This function checks if all required fields were filled up. 
        */
        public function validate_login_form() 
        {
            $this->form_validation->set_error_delimiters("<p class='error'>",'</p>');

            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

            $this->form_validation->set_rules('password', 'Password', 'required');

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
        DOCU: This function contains simple condition to match database record and user input in password.
        */
        function validate_signin_match($user, $password) 
        {
            $hash_password = $this->security->xss_clean($password);
    
            if($user && $user['password'] == md5($hash_password)) {
                return "success";
            }
            else 
            {
                return "Incorrect email/password.";
            }
        }

        /*  
        DOCU: This function checks required input fields and if unique email.
        */
        function validate_registration($email) 
        {
            $this->form_validation->set_error_delimiters("<p class='error'>",'</p>');

            $this->form_validation->set_rules('first_name', 'First Name', 'required|min_length[3]');

            $this->form_validation->set_rules('last_name', 'Last Name', 'required|min_length[3]'); 

            $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');

            $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');
            
            if(!$this->form_validation->run()) {
                return validation_errors();
            }
            // else if($this->get_user_by_email($email)) {
            //     return "Email already taken.";
            // }
        }
    }
?>