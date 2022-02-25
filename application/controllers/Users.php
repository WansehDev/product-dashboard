<?php
    class Users extends CI_Controller 
    {
        /*  
        DOCU: This function is triggered by default which displays the default page. 
        */
        public function index() 
        {
            $this->load->view('templates/header');
            $this->load->view('templates/navlogin');
            $this->load->view('users/login');
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
        public function profile()
        {
            $data['user_profile'] = $this->user->get_user_info($this->session->userdata('user_id'));
            $this->load->view('templates/header');
            $this->load->view('templates/navlogout');
            $this->load->view('users/profile', $data);
        }

        public function update_profile()
        {
            $result = $this->user->validate_updated_profile();

            if($result != 'success')
            {
                $this->session->set_flashdata('input_errors', $result);
                redirect('/profile');
            }
            else
            {
                if($this->user->update_profile($this->input->post()))
                {
                    $this->session->set_flashdata('success', 'Profile updated successfully');
                    redirect('/profile');
                }
            }
        }

        public function update_password_profile()
        {
            $result = $this->user->validate_updated_password();
            if($result != 'success')
            {
                $this->session->set_flashdata('input_errors', $result);
                redirect('/profile');
            }
            else
            {
                if($this->user->update_password($this->input->post()) != FALSE)
                {
                    $this->session->set_flashdata('success', 'Profile updated successfully');
                    redirect('/profile');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Old Password does not match with new password');
                    redirect('/profile');
                }
            }
        }



         /*  
         DOCU: This function is triggered when the user clicks the product. 
         */
        public function item($product_id)
        {
            $user_posts = $this->message->get_messages($product_id);
            $replies = array();
            foreach($user_posts as &$user_post) 
            {
                $comments = $this->comment->get_comments_from_message_id($user_post['post_id']); 

                foreach($comments as &$comment)
                {
                    $comment['comment_date'] = $this->getDateTimeDiff( $comment['comment_date']);
                 }
                $replies[] = $comments;  
                $user_post['post_date'] = $this->getDateTimeDiff($user_post['post_date']);
            }

         
            
            $data['posts'] = $user_posts;
            $data['comments'] = $replies;
            $data['products'] = $this->product->get_product_info($product_id);
            $this->load->view('templates/header');
            $this->load->view('templates/navlogout');
            $this->load->view('users/item', $data);
        }


    

        /*  
        DOCU: This function is triggered when a non admin
        user clicks the login button and proceeds to user dashboard. 
        */
        public function dashboard()
        {
            $data['products'] = $this->product->get_all_products();
            $this->load->view('templates/header');
            $this->load->view('templates/navlogout');
            $this->load->view('users/dashboard', $data);
        }

             /*  
        DOCU: This function is triggered when an admin
        user clicks the login button and proceeds to admin user dashboard. 
        */
        public function admin_dashboard()
        {
            $data['products']= $this->product->get_products_by_user($this->session->userdata('user_id'));
            $this->load->view('templates/header');
            $this->load->view('templates/navlogout');
            $this->load->view('admin/dashboard', $data);
        }

        /*  
        DOCU: This function is triggered when the sign in button is clicked. 
        This validates the required form inputs and if user password matches in the database by given email.If no problem occured, user will be routed to the dashboard page.
        */
        public function process_login()
        {
            $result = $this->user->validate_login_form();

            if($result != 'success')
            {
                $this->session->set_flashdata('input_errors', $result);
                redirect('login');
            }
            else
            {
                $email = $this->input->post('email');
                $user = $this->user->get_user_by_email($email);
                
                $result = $this->user->validate_signin_match($user, $this->input->post('password'));

                if($result == "success") 
                {
                    $userdata = array(
                        'user_id'=>$user['id'], 
                        'first_name'=>$user['first_name'],
                        'is_admin'=>$user['is_admin'],
                        'is_logged_in'=>true
                    );
                    $this->session->set_userdata($userdata);

                    // Check whether the user is admin or not
                    $user['is_admin'] == 1 ? redirect('/admin_dashboard') : redirect('/dashboard');
                   
                }
                else 
                {
                    $this->session->set_flashdata('input_errors', $result);
                    redirect("/");
                }
            }
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
                redirect("/register");
            }
            else
            {
                $form_data = $this->input->post();
                $this->user->create_user($form_data);

                $new_user = $this->user->get_user_by_email($form_data['email']);
                $userdata = array(
                    'user_id'=>$new_user['id'], 
                    'first_name'=>$new_user['first_name'],
                    'is_logged_in'=>true
                );
                
                $this->session->set_userdata($userdata);
                redirect('/dashboard');
            }
        }

          /*  
        DOCU: This function is responsible to validate and add the message from any user to the database.
        */
        public function add_post($product_id) 
        {
            $result = $this->message->validate_post();
            
            if($result != 'success') {
                $this->session->set_flashdata('input_errors', $result);
            } 
            else {
                $this->message->add_post(
                    $this->input->post('review'), 
                    $product_id
                );
            }
        
            redirect("products/show/".$product_id);
        }

        /*  
        DOCU: This function is responsible to validate and add the comment from any user to the database.
        */
        public function add_comment($product_id) 
        {
            $result = $this->comment->validate_comment();

            if($result != 'success') {
                $this->session->set_flashdata('input_errors', validation_errors());
            }
            else {
                $this->comment->add_comment(
                    $this->input->post(), 
                );
            }

            redirect("products/show/".$product_id);;
        }



        // Utility Function
        public function getDateTimeDiff($date){
            $now_timestamp = strtotime(date('Y-m-d H:i:s'));
            $diff_timestamp = $now_timestamp - strtotime($date);
            
            if($diff_timestamp < 60){
             return 'few seconds ago';
            }
            else if($diff_timestamp>=60 && $diff_timestamp<3600){
             return round($diff_timestamp/60).' mins ago';
            }
            else if($diff_timestamp>=3600 && $diff_timestamp<86400){
             return round($diff_timestamp/3600).' hours ago';
            }
            else if($diff_timestamp>=86400 && $diff_timestamp<(86400*30)){
             return round($diff_timestamp/(86400)).' days ago';
            }
            else if($diff_timestamp>=(86400*30) && $diff_timestamp<(86400*365)){
             return round($diff_timestamp/(86400*30)).' months ago';
            }
            else{
             return round($diff_timestamp/(86400*365)).' years ago';
            }
        }

    }
?>