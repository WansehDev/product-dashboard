<?php
    class Users extends CI_Controller 
    {
        /*  
        DOCU: This function is triggered by default which displays the default page. 
        */
        public function index() 
        {
            $current_user_id = $this->session->userdata('user_id');
            
            if(!$current_user_id) { 
                $this->load->view('templates/header');
                $this->load->view('templates/navlogin');
                $this->load->view('users/login');
            } 
           
        }

         /*  
         DOCU: This function is triggered by default which displays the log in/product page. 
         */
        public function login() 
        {
             $current_user_id = $this->session->userdata('user_id');
             
             if(!$current_user_id) { 
                 $this->load->view('templates/header');
                 $this->load->view('templates/navlogin');
                 $this->load->view('users/login');
             } 
            
        }

         /*
         DOCU: This function is triggered when the user click logout
         */
        public function logout() 
        {
            $this->session->sess_destroy();
            redirect('/');
        }

        /*  
        DOCU: This function is triggered when the user clicks the register button. 
        */
        public function register() 
        {
            $this->load->view('templates/header');
            $this->load->view('templates/navlogin');
            $this->load->view('users/register');
        }

        /*  
        DOCU: This function is triggered when the user clicks the profile 
        */
        public function profile($id = null)
        {
            $this->load->view('templates/header');
            $this->load->view('templates/navlogout');
            $this->load->view('users/profile');
        }

         /*  
         DOCU: This function is triggered when the user clicks the product. 
         */
        public function item()
        {
            $this->load->view('templates/header');
            $this->load->view('templates/navlogout');
            $this->load->view('users/item');
        }

        /*  
        DOCU: This function is triggered when a non admin
        user clicks the login button and proceeds to user dashboard. 
        */
        public function dashboard()
        {
            $this->load->view('templates/header');
            $this->load->view('templates/navlogout');
            $this->load->view('users/dashboard');
        }

             /*  
        DOCU: This function is triggered when an admin
        user clicks the login button and proceeds to admin user dashboard. 
        */
        public function admin_dashboard()
        {
            $this->load->view('templates/header');
            $this->load->view('templates/navlogout');
            $this->load->view('admin/dashboard');
        }



        /*  
        DOCU: This function is triggered when the sign in button is clicked. 
        This validates the required form inputs and if user password matches in the database by given email.If no problem occured, user will be routed to the dashboard page.
        */
        public function process_login()
        {
            $result = 'success';
            // $result = $this->user->validate_login_form(); UNCOMMENT LATER
            if($result != 'success')
            {
                $this->session->set_flashdata('input_errors', $result);

                redirect('login');
            }
            else
            {
                $email = $this->input->post('email');
                // $user = $this->user->get_user_by_email($email);
                
                // $result = $this->user->validate_signin_match($user, $this->input->post('password'));

                // if($result == "success") 
                // {
                //     $userdata = array(
                //         'user_id'=>$user['id'], 
                //         'first_name'=>$user['first_name']
                //     );
                //     $this->session->set_userdata($userdata);

                //     redirect("dashboard");
                // }
                // else 
                // {
                //     $this->session->set_flashdata('input_errors', $result);
                //     redirect("signin");
                // }

                // DELETE LATER
                $is_admin = TRUE;
                if($email == '2')
                {
                    redirect('dashboard');
                }
                else if($email == '1' && $is_admin)
                {
                    redirect('admin_dashboard');
                }

            }
            // redirect('login'); //delete later
        }

        /* 
        DOCU: This function is triggered when the register button is clicked. 
        This validates the required form inputs then checks if the email is already taken. If no problem occured, user information will be stored in database 
        and said user will be routed to the Dashboard page.
        */
        public function process_register()
        {
            $email = $this->input->post('email');
            $result = $this->user->validate_registration($email);
    
            if($result!=null)
            {
                $this->session->set_flashdata('input_errors', $result);
                redirect("register");
            }
            else
            {
                // $form_data = $this->input->post();
                // $this->user->create_user($form_data);
    
                // $new_user = $this->user->get_user_by_email($form_data['email']);
                // $this->session->set_userdata(array('user_id' => $new_user["id"], 'first_name'=>$new_user['first_name']));
                
                // redirect('dashboard');
            }
            redirect('register'); //delete later
        }


    }
?>