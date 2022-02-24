<?php
    if(($this->session->userdata('is_logged_in') != null && $this->session->userdata('is_logged_in') == true)) 
    {
        if($this->session->userdata('is_admin') == 1)
        {
            redirect('admin_dashboard');
        }
        else
        {
            redirect('/');
        }
    }
   
?>
--><div class="account-area">
        <p>Login</p>
    </div>
</nav>

<div class="container login">
    <h2 class="title-container">Login</h2>
    <form class="form-info" action="/users/validate" method="post">
        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
        <label for="email">Email Address:</label>
        <input type="text" name="email" >
        <label for="password">Password:</label>
        <input type="password" name="password">
        <div class="choice-container">
            <p><?= $this->session->flashdata('input_errors'); ?></p>
            <input type="submit" value="Login">
            <a href="register">Don't have an account? Register</a>
        </div>
    </form>
</div>

</body>
</html>

