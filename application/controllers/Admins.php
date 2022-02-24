<?php
    class Admins extends CI_Controller
    {
        /*  DOCU: This function is triggered when the user clicks the login button and proceeds to user dashboard. */
        public function index() 
        {
              $this->load->view('templates/header');
              $this->load->view('templates/navlogout');
              $this->load->view('admin/dashboard');
        }

        /*  DOCU: This function is triggered when the user clicks the create new product button. */
        public function create()
        {
            $this->load->view('templates/header');
            $this->load->view('templates/navlogout');
            $this->load->view('admin/create');
        }

        /*  DOCU: This function is triggered when the user clicks the edit button */
        public function edit($id = null)
        {
            $this->load->view('templates/header');
            $this->load->view('templates/navlogout');
            $this->load->view('admin/edit');
        }

       
    }
?>