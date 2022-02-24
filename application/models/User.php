<?php
    class User extends CI_Model
    {
        /*  
        DOCU: This function retrieves user information.
        */ 
        public function get_user_info($user_id)
        {
            $query = "SELECT * FROM users WHERE id = ?";
            $values = array($user_id);
            return $this->db->query($query, $values)->result_array()[0];
        }

        /*  
        DOCU: This function retrieves user information filtered by email.
        */
        function get_user_by_email($email)
        { 
            $query = "SELECT * FROM 
                        users 
                      WHERE 
                        email = ?";

            return $this->db->query($query, $this->security->xss_clean($email))->result_array()[0];
        }

        /* 
        DOCU: This function inserts new user info upon registration.
        */
        function create_user($user)
        {
            $salt = bin2hex(openssl_random_pseudo_bytes(22));
            $hash_password = $this->encrypt_password($user['password'], $salt);

            $query = "INSERT INTO 
                        users (first_name, last_name, email, is_admin, salt, password) 
                      VALUES 
                        (?,?,?,?,?,?)";

            // The first person is registered automatically as an admin
            if($this->db->query("SELECT * FROM users")->row_array() == null)
            {
                $user_level = 1;
            }
            else
            {
                $user_level = 0;
            }

            $values = array(
                $this->security->xss_clean($user['first_name']), 
                $this->security->xss_clean($user['last_name']), 
                $this->security->xss_clean($user['email']),
                $user_level,  
                $this->security->xss_clean($salt),
                $this->security->xss_clean($hash_password),

            ); 

            return $this->db->query($query, $values);
        }


        public function update_profile($post)
        {
            $query = "UPDATE users SET first_name = ?, last_name = ?, email = ? WHERE id = ?";
            $values = array(
                $this->security->xss_clean($post['first_name']),
                $this->security->xss_clean($post['last_name']),
                $this->security->xss_clean($post['email']),
                $this->session->userdata('user_id')
            );

            return $this->db->query($query, $values);
        }

        public function get_old_password()
        {
            $query = "SELECT salt, password FROM users WHERE id = ?";
            $values = array($this->session->userdata('user_id'));
            return $this->db->query($query, $values)->result_array()[0];
        }

        public function update_password($post)
        {
            $user_info = $this->get_old_password();
            if($this->encrypt_password($post['old_password'], $user_info['salt']) == $user_info['password'])
            {
                $salt = bin2hex(openssl_random_pseudo_bytes(22));
                $hash_password = $this->encrypt_password($post['new_password'], $salt);

                $query = "UPDATE users SET salt = ?, password = ? WHERE id = ?";
                $values = array(
                    $this->security->xss_clean($salt),
                    $this->security->xss_clean($hash_password),
                    $this->session->userdata('user_id')
                );

                return $this->db->query($query, $values);
            }
            else
            {
                return FALSE;
            }
        }       

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
        public function validate_signin_match($user, $password) 
        {
            $hash_password = $this->security->xss_clean($password);
            if($user && $user['password'] == $this->encrypt_password($hash_password, $user['salt'])) 
            {
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
        public function validate_registration($email) 
        {
            $this->form_validation->set_error_delimiters("<p class='error'>",'</p>');

            $this->form_validation->set_rules('first_name', 'First Name', 'required|min_length[3]');

            $this->form_validation->set_rules('last_name', 'Last Name', 'required|min_length[3]'); 

            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

            $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');

            $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');
            
            if(!$this->form_validation->run()) {
                return validation_errors();
            }
            else if($this->get_user_by_email($email)) 
            {
                return "Email already taken.";
            }
        }

        public function validate_updated_profile()
        {
            $this->form_validation->set_error_delimiters("<p class='error'>",'</p>');

            $this->form_validation->set_rules('first_name', 'First Name', 'required|min_length[3]');

            $this->form_validation->set_rules('last_name', 'Last Name', 'required|min_length[3]'); 

            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

 
            if(!$this->form_validation->run()) {
                return validation_errors();
            }
            else
            {
                return "success";
            }
        }

        //valdiate passwords
        public function validate_updated_password()
        {
            $this->form_validation->set_error_delimiters("<p class='
            error'>",'</p>');

            $this->form_validation->set_rules('old_password', 'Old Password', 'required|min_length[8]');

            $this->form_validation->set_rules('new_password', 'Password', 'required|min_length[8]');

            $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[new_password]');

            if(!$this->form_validation->run()) {
                return validation_errors();
            }
            else
            {
                return "success";
            }
        }
       

       
        /* Utility Functions */

        private function encrypt_password($pass, $salt) 
        {
            return md5($pass. '' . $salt);
        }

    }
?>