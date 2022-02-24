<div class="container profile">
    <h2 class="title-container">Edit Profile</h2>
    <div>
        
        <form class="form-profile" action="" method="post">
            <fieldset>
                <legend>Edit Information</legend>

                <label for="email">Email Address: </label>
                <input type="email" name="email">

                <label for="first_name">First Name: </label>
                <input type="text" name="first_name">

                <label for="last_name">Last Name: </label>
                <input type="text" name="last_name">

            
                <div>
                    <input type="submit" value="Save">
                </div>
            </fieldset>
            
        </form>

        <form class="form-profile" action="" method="post">
            <fieldset>
                <legend>Change Information</legend>

                <label for="old_password">Old Password: </label>
                <input type="password" name="old_password">

                <label for="new_password">New Password: </label>
                <input type="password" name="new_password">

                <label for="confirm_password" >Confirm Password: </label>
                <input type="password" name="confirm_password">

                <div>
                    <input type="submit" value="Save">
                </div>
            </fieldset>
        </form>
    </div>
</div>