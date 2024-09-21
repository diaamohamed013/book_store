<?php


require_once ROOT_PATH . 'inc/website/header.php';
require_once ROOT_PATH . 'inc/website/navbar.php';
?>


    <h2>Set New Password</h2>
    <form action="<?php echo url('update-password'); ?>" method="post">
        <label for="new_password">New Password:</label>
        <input type="password" id="new_password" name="new_password" required>
        <input type="submit" value="Update Password">
    </form>



    <?php unset($_SESSION['error']); ?>
<?php unset($_SESSION['success']); ?>
<?php
require_once ROOT_PATH . 'inc/website/footer.php'; ?>