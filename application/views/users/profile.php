<?php
    if($this->session->userdata('is_logged_in') != null && $this->session->userdata('is_logged_in') == true)
    {
        $is_admin = $this->session->userdata('is_admin');
    }
    else 
    {
        redirect('/');
    }
?>
<div class="container profile">
    <h2 class="title-container">Edit Profile</h2>
    <div>
        
        <form class="form-profile" action="profile/edit" method="post">
            <fieldset>
                <legend>Edit Information</legend>

                <label for="email">Email Address: </label>
                <input type="email" name="email" value="<?= $user_profile['email']; ?>">

                <label for="first_name">First Name: </label>
                <input type="text" name="first_name" value="<?= $user_profile['first_name']; ?>">

                <label for="last_name">Last Name: </label>
                <input type="text" name="last_name" value="<?= $user_profile['last_name']; ?>">
               <p class="success"><?= $this->session->flashdata('success'); ?></p>
                <div>
                    <input type="submit" value="Save">
                </div>
            </fieldset>
            
        </form>

        <form class="form-profile" action="profile/password" method="post">
            <fieldset>
                <legend>Change Information</legend>

                <label for="old_password">Old Password: </label>
                <input type="password" name="old_password">

                <label for="new_password">New Password: </label>
                <input type="password" name="new_password">

                <label for="confirm_password" >Confirm Password: </label>
                <input type="password" name="confirm_password">
                <p class="success"><?= $this->session->flashdata('success'); ?></p>
                <p class="error"><?= $this->session->flashdata('error'); ?></p>
<?php
        if($this->session->flashdata('input_errors'))
        {
            echo $this->session->flashdata('input_errors');
        }
?>
                <div>
                    <input type="submit" value="Save">
                </div>
            </fieldset>
        </form>
    </div>
</div>