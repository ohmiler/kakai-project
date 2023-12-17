<?php 

    session_start();
    require "config.php";

    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
    }

    if (empty($email)) {
        $_SESSION['error'] = "Please enter your email";
        header("Location: login.php");
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Please enter a valid email address";
        header("Location: login.php");
    } else if (empty($password)) {
        $_SESSION['error'] = "Please enter your password";
        header("Location: login.php");
    } else {
        try {

            $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
            $stmt->execute([$email]);
            $userData = $stmt->fetch();

            if ($userData && password_verify($password, $userData['password'])) {
                $_SESSION['user_id'] = $userData['id'];
                header("Location: dashboard.php");
            } else {
                $_SESSION['error'] = "Invalid email or password";
                header("Location: login.php");
            }

        } catch(PDOException $e) {
            $_SESSION['error'] = "Something went wrong, please try again.";
            header("Location: login.php");
        }
    }


?>