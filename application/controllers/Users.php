<?php
    class Users extends CI_Controller 
    {
        /*  DOCU: This function is triggered by default which displays the sign in/product page. */
        public function index() 
        {
            $current_user_id = $this->session->userdata('user_id');
            
            if(!$current_user_id) { 
                $this->load->view('templates/header');
                $this->load->view('templates/navlogin');
                $this->load->view('users/signin');
            } 
           
        }

        /*  DOCU: This function is triggered when the user clicks the register button. */
        public function register() 
        {
            $this->load->view('templates/header');
            $this->load->view('templates/navlogin');
            $this->load->view('users/register');
        }

        /*  DOCU: This function is triggered when the user clicks the profile */
        public function profile($id = null)
        {
            $this->load->view('templates/header');
            $this->load->view('templates/navlogout');
            $this->load->view('users/profile');
        }

         /*  DOCU: This function is triggered when the user clicks the product. */
        public function item()
        {
            $this->load->view('templates/header');
            $this->load->view('templates/navlogout');
            $this->load->view('users/item');
        }

           /*  DOCU: This function is triggered when the non admin
               user clicks the login button and proceeds to user dashboard. */
        public function dashboard()
        {
            $this->load->view('templates/header');
            $this->load->view('templates/navlogout');
            $this->load->view('users/dashboard');
        }

    }
?>