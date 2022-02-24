--><div class="account-area">
        <p>Login</p>
    </div>
</nav>

<div class="container login">
    <h1>Register</h1>
    <form class="form-info" action="register/validate" method="post">

        <label for="email">Email Address:</label>
        <input type="text" name="email">

        <label for="first_name">First Name: </label>
        <input type="text" name="first_name">

        <label for="last_name">Last Name: </label>
        <input type="text" name="last_name">

        <label for="password">Password:</label>
        <input type="password" name="password">

        <label for="confirm_password">Confirm Password</label>
        <input type="password" name="confirm_password">

        <div>
            <p><?= $this->session->flashdata('input_errors'); ?></p>
            <input type="submit" value="Register">
            <a href="login">Already have an account? Login</a>
        </div>
    </form>
</div>

</body>

</html>