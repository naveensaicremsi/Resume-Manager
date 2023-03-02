<?php
require_once('connection.php');

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM login_details WHERE email = '$email' and password = '$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo "Login Successful";
    } else {
        echo "Invalid Email or Password";
    }
}
?>
