<?php 

    session_start();
    require "config.php";

    $targetDir = "uploads/";

    if (isset($_POST['edit_product'])) {
        $prod_id = $_POST['prod_id'];
        $prod_name = $_POST['prod_name'];
        $prod_img = $_FILES['prod_img']['name'];
        $prod_price = $_POST['prod_price'];
        $prod_desc = $_POST['prod_desc'];
        $prod_contact = $_POST['prod_contact'];
        $prod_status = $_POST['prod_status'];
        $def_prod_img = $_POST['def_prod_img'];

        if ($prod_img) {
            $targetFilePath = $targetDir . $prod_img;
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
            $allowTypes = array("jpg", "png", "jpeg");
            $newPic = $_FILES['prod_img']['name'];

            if (in_array($fileType, $allowTypes)) {
                move_uploaded_file($_FILES['prod_img']['tmp_name'], $targetFilePath);
            } else {
                $_SESSION['error'] = "Sorry, only JPG, PNG, JPEG files are allowed to upload.";
                header("Location: dashboard.php");
            }
        } else {
            $newPic = $def_prod_img;
        }

        $sql = "UPDATE products SET
                prod_name = ?,
                prod_img = ?,
                prod_price = ?,
                prod_desc = ?,
                prod_contact = ?,
                prod_status = ?
                WHERE id = ?        
        ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$prod_name, $newPic, $prod_price, $prod_desc, $prod_contact, $prod_status, $prod_id]);
        
        if ($stmt) {
            $_SESSION['success'] = "Product updated successfully.";
            header("Location: dashboard.php");
        } else {
            $_SESSION['error'] = "Failed to update your product.";
            header("Location: dashboard.php");
        }
    }


?>