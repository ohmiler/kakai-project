<?php

session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kakai</title>

    <link rel="stylesheet" href="sign-in.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>

    <div class="container">
        <!-- Nav start -->
        <?php include('nav.php'); ?>
        <!-- Nav End -->
    </div>

    <main class="form-signin w-100 m-auto">
        <form action="register_db.php" method="POST">
            <h1 class="h3 mb-3 fw-normal">Sign Up</h1>

            <?php if (isset($_SESSION['success'])) { ?>
                <div class="alert alert-success" role="alert">
                    <?php
                    echo $_SESSION['success'];
                    unset($_SESSION['success']);
                    ?>
                </div>
            <?php } ?>

            <?php if (isset($_SESSION['error'])) { ?>
                <div class="alert alert-danger" role="alert">
                    <?php
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                    ?>
                </div>
            <?php } ?>

            <div class="form-floating">
                <input type="text" class="form-control my-2" name="username" placeholder="Enter your username...">
                <label for="username">Username</label>
            </div>

            <div class="form-floating">
                <input type="email" class="form-control my-2" name="email" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Email address</label>
            </div>

            <div class="form-floating">
                <input type="password" class="form-control my-2" name="password" id="floatingPassword" placeholder="Password">
                <label for="floatingPassword">Password</label>
            </div>

            <div class="form-floating">
                <input type="password" class="form-control my-2" name="confirm_password" id="floatingPassword" placeholder="Confirm Password">
                <label for="floatingPassword">Confirm Password</label>
            </div>

            <button class="btn btn-primary w-100 py-2" name="register" type="submit">Sign Up</button>
            <p class="mt-5 mb-3 text-body-secondary">Already have an account? <a href="login.php">Click here</a> to sign in</p>
        </form>
    </main>

    <div class="container">
        <!--  Footer Start -->
        <?php include('footer.php'); ?>
        <!-- Footer End -->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>