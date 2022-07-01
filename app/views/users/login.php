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
        <h2>Sing in</h2>
        <form action="<?php echo URLROOT;?>users/login" method="POST">
            <input type="text" placeholder="Email *" name="email">
            <span class="invalidFeedback">
                <?php echo $data['emailError']; ?>
            </span>
            <input type="password" placeholder="Password *" name="password">
            <span class="invalidFeedback">
                <?php echo $data['passwordError']; ?>
                <br>

            </span>

            <button type="submit" id="submit" value="submit">Submit</button>

            <p class="options">Not registered yet? <a href="<?php echo URLROOT;?>users/register">Create an account!</a></p>
        </form>
    </div>
    

</div>
