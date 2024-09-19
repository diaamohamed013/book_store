<?php 
require_once ROOT_PATH . 'src/functions.php';
require_once ROOT_PATH . 'src/validation.php';



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['email']) && !empty($_POST['email'])) {
        $email = $conn->real_escape_string($_POST['email']);
        
        // Check if email exists in the database
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            // Email exists, show password reset form
            $_SESSION['reset_email'] = $email;
             redirect('resetpassword'); 
            
        } else {
            $_SESSION['message'] = "Email not found in our records.";
            redirect('resetpassword');
            exit();
        }
    } elseif (isset($_POST['new_password']) && !empty($_POST['new_password'])) {
        // Process the new password
        if (isset($_SESSION['reset_email'])) {
            $email = $_SESSION['reset_email'];
            $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
            
            // Update the password in the database
            $sql = "UPDATE users SET password = '$new_password' WHERE email = '$email'";
            if ($conn->query($sql) === TRUE) {
                $_SESSION['message'] = "Password updated successfully.";
                unset($_SESSION['reset_email']);
            } else {
                $_SESSION['message'] = "Error updating password: " . $conn->error;
            }
        } else {
            $_SESSION['message'] = "Invalid request.";
        }
        redirect('resetpassword');
        exit();
    }
} else {
    redirect('resetpassword');
}
