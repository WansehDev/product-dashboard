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
        public function edit($id)
        {
            $data['product'] = $this->product->get_product_info($id);
            $this->load->view('templates/header');
            $this->load->view('templates/navlogout');
            $this->load->view('admin/edit', $data);
        }

        /*  DOCU: This function is triggered when the user clicks the save button */
        public function update($id)
        {
            $product_data = $this->input->post();
            if($this->product->update_product($product_data))
            {
                $this->session->set_flashdata('success', "<p class='success'>Product updated successfully!</p>");
                redirect('products/edit/'.$id);
            }
        }

        /*  DOCU: This function is triggered when the user clicks the edit button */
        public function confirm_delete($id)
        {
            $data['product'] = $this->product->get_product_info($id);
            $this->load->view('templates/header');
            $this->load->view('templates/navlogout');
            $this->load->view('admin/confirm_delete', $data);
        }


        /*  DOCU: This function is triggered when the user clicks the delete button */
        public function delete($id)
        {
            $this->product->remove_product($id);
            redirect('admin_dashboard');
        }


        /*  DOCU: This function is for processing product info to database */
        public function process_product()
        {
            $result = $this->product->validate_product();

            if($result != 'success')
            {
                $this->session->set_flashdata('input_errors', $result);
                redirect('create');
            }
            else
            {
                $product_data = $this->input->post();
                $product_data['user_id'] = $this->session->userdata('user_id');
                if($this->product->add_product($product_data))
                {
                    $this->session->set_flashdata('success', "<p class='success'>Product added successfully!</p>");
                    redirect('create');
                }
            }
            
        }
       
    }
?>