<?php 

    session_start();
    require "config.php";

    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kakai</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
</head>

<body>

    <!-- Container Start -->
    <div class="container">
        <!-- Nav start -->
        <?php include('nav.php'); ?>
        <!-- Nav End -->

        <!-- Hero Start -->
        <div class="px-4 py-5 my-5 text-center">
            <?php 
                if (isset($_SESSION['user_id'])) {
                    $user_id = $_SESSION['user_id'];
                }

                try {

                    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
                    $stmt->execute([$user_id]);
                    $userData = $stmt->fetch();

                } catch (PDOException $e) {
                    echo "Error: " . $e->getMessage();
                }
            ?>
            <h1 class="display-5 fw-bold text-body-emphasis">Welcome, <?php echo $userData['username'] ?></h1>
            <div class="col-lg-6 mx-auto">
                <p class="lead mb-4">Email : <?php echo $userData['email'] ?></p>
            </div>
        </div>
        <!-- Hero End -->

        <a href="add_products.php" class="btn btn-success">Add Products</a>

        <?php if (isset($_SESSION['success'])): ?>
                <div class="alert alert-success" role="alert">
                    <?php 
                        echo $_SESSION['success'];
                        unset($_SESSION['success']);
                    ?>
                </div>
        <?php endif; ?>
        
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger" role="alert">
                <?php 
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                ?>
            </div>
        <?php endif; ?>
       
        <table id="dataTable" class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Product Name</th>
                    <th>Product Image</th>
                    <th>Product Price</th>
                    <th>Product Description</th>
                    <th>Product Contact</th>
                    <th>Product Status</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                <?php 
                    if (isset($_SESSION['user_id'])) {
                        $user_id = $_SESSION['user_id'];
                        $fetchData = $pdo->prepare("SELECT * FROM products WHERE user_id = ?");
                        $fetchData->execute([$user_id]);

                        if ($rowCount = $fetchData->rowCount()) {
                        while($row = $fetchData->fetch(PDO::FETCH_ASSOC)) {
                        
                ?>
                <tr>
                    <td><?= $row['id']; ?></td>
                    <td><?= $row['prod_name']; ?></td>
                    <td><img width="100" height="100" src="uploads/<?= $row['prod_img']; ?>" alt=""></td>
                    <td><?= number_format($row['prod_price'], 2); ?></td>
                    <td><?= $row['prod_desc']; ?></td>
                    <td><?= $row['prod_contact']; ?></td>
                    <td><?= $row['prod_status']; ?></td>
                    <td>
                        <a href="edit.php?id=<?= $row['id']; ?>" class="btn btn-primary">Edit</a>
                        <a href="delete.php?id=<?= $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this product?');" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
                <?php 
                            } 
                        } else {
                            echo "<td style='text-align: center' colspan='8'>No data was found!</td>";
                        }
                    }
                ?>
            </tbody>
        </table>
        
        <!--  Footer Start -->
        <?php include('footer.php'); ?>
        <!-- Footer End -->

    </div>
    <!-- Container End -->


    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script>
        let table = new DataTable('#dataTable');
    </script>

</body>

</html>