<?php 

    require "config.php";

    if (isset($_GET['id'])) {
        $get_id = $_GET['id'];
        $stmt = $pdo->prepare("DELETE FROM products WHERE id = ?");
        $stmt->execute([$get_id]);
        header("Location: dashboard.php");
    }


?>