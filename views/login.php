<?php
View('header');
?>

<div class='container'>
    <div class='<?php echo $data['page_message_type']; ?>'><?php echo $data['page_message']; ?></div>
<div class='jumbotron login-box'>
    <h3>Login Here</h3><hr>
        <form action='' method='post'>
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" value='<?php echo $_COOKIE['nalco_inventory_email']; ?>' required='required' class="form-control" name="user_email" aria-describedby="emailHelp" placeholder="Enter email">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" value='<?php echo $_COOKIE['nalco_inventory_password']; ?>' required='required' class="form-control" name="user_password" placeholder="Password">
            <small id="emailHelp" class="form-text text-muted">Don't share your credentials with anyone.</small>
        </div>
        <div class="form-group form-check">
            <input type="checkbox" <?php echo ($_COOKIE['nalco_credential_cookie'])?"checked='checked'":""; ?> class="form-check-input" id="remember_me" name="remember_me" value="yes">
            <label class="form-check-label" for="remember_me">Remember Me</label>
        </div>
        <button name='login_sub' type="submit" class="btn btn-primary float-right">Submit</button>
        </form>
</div>
</div>

<?php
View('footer'); 
?>