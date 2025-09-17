<?php
session_start();
include "db_connect.php";

$error = "";

if (isset($_POST['login'])) {
    $username = trim(mysqli_real_escape_string($conn, $_POST['username']));
    $password = trim($_POST['password']);

    $result = mysqli_query($conn, "SELECT * FROM user WHERE username='$username' LIMIT 1");
    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        if ($password === $user['password']) { 
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            header("Location: index.php");
            exit;
        } else {
            $error = "Username atau Password salah!";
        }
    } else {
        $error = "Username atau Password salah!";
    }
}
?>
<?php include "templates/style_login.php"; ?>

</html>