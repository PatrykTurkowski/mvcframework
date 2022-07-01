<?php
require_once APPROOT . '/views/includes/head.php';
?>

<div class="navbar">
    <?php
        require APPROOT . '/views/includes/navigation.php';
    ?>
</div>

<div class="container-login">
    <div class="wrapper-login">
        <h2>Register</h2>
        <form action="<?php echo URLROOT;?>users/register" method="POST">
            <input type="text" placeholder="Username *" name="username" value=<?php if(empty($data['usernameError'])) : echo $data['username']; endif ?>>
            <span class="invalidFeedback">
                <?php echo $data['usernameError']; ?>
            </span>
            <input type="email" placeholder="Email *" name="email" value=<?php if(empty($data['emailError'])) : echo $data['email']; endif ?>>
            <span class="invalidFeedback">
                <?php echo $data['emailError']; ?>
            </span>
            <input type="password" placeholder="Password *" name="password" value=<?php if(empty($data['passwordError'])) : echo $data['password']; endif ?>>
            <span class="invalidFeedback">
                <?php echo $data['passwordError']; ?>
            </span>
            <input type="password" placeholder="Confirm Password *" name="confirmPassword" value=<?php if(empty($data['confirmPasswordError'])) : echo $data['confirmPassword']; endif ?>>
            <span class="invalidFeedback">
                <?php echo $data['confirmPasswordError']; ?>
                <br>
            </span>

            <button type="submit" id="submit" value="submit">Submit</button>

            
        </form>
    </div>
    

</div>
