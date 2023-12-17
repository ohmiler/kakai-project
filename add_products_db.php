<?php 

    session_start();
    require "config.php";

    $targetDir = "uploads/";

    if (isset($_POST['add_product'])) {
        $prod_name = $_POST['prod_name'];
        $prod_img = $_FILES['prod_img']['name'];
        $prod_price = $_POST['prod_price'];
        $prod_desc = $_POST['prod_desc'];
        $prod_contact = $_POST['prod_contact'];
        $prod_status = $_POST['prod_status'];
        $user_id = $_POST['user_id'];

        $targetFilePath = $targetDir . $prod_img; // uploads/img.jpg
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
        $allowTypes = array("jpg", "png", "jpeg");
        if (in_array($fileType, $allowTypes)) {
            if (move_uploaded_file($_FILES['prod_img']['tmp_name'], $targetFilePath)) {
                $stmt = $pdo->prepare("INSERT INTO products(prod_name, prod_img, prod_price, prod_desc, prod_contact, prod_status, user_id) VALUES(?, ?, ?, ?, ?, ?, ?)");
                $stmt->execute([$prod_name, $prod_img, $prod_price, $prod_desc, $prod_contact, $prod_status, $user_id]);

                if ($stmt) {
                    $_SESSION['success'] = "Product inserted successfully.";
                    header("Location: dashboard.php");
                } else {
                    $_SESSION['error'] = "Failed to upload your product.";
                    header("Location: dashboard.php");
                }
            } else {
                $_SESSION['error'] = "Sorry, there was an error uploading your file.";
                header("Location: dashboard.php");
            }
        } else {
            $_SESSION['error'] = "Sorry, only JPG, PNG, JPEG files are allowed to upload.";
            header("Location: dashboard.php");
        }
    }


?>