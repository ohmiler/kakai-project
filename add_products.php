<?php 

    session_start();
    require 'config.php';

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

    <link rel="stylesheet" href="sign-in.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>

    <div class="container">
        <!-- Nav start -->
        <?php include('nav.php'); ?>
        <!-- Nav End -->

    <main>
        <h3>Add Products</h3>
        <form action="add_products_db.php" class="col-md-6" method="POST" enctype="multipart/form-data">


            <div class="mb-3">
                <label for="product-name" class="form-label">Product Name</label>
                <input type="text" class="form-control" name="prod_name" placeholder="e.g. iphone15" required>
            </div>

            <div class="mb-3">
                <label for="product-img" class="form-label">Product Image</label>
                <input type="file" class="form-control" name="prod_img" required>
            </div>

            <div class="mb-3">
                <label for="product-price" class="form-label">Product Price</label>
                <input type="number" class="form-control" name="prod_price" placeholder="e.g. 10,000" required>
            </div>

            <div class="mb-3">
                <label for="product-desc" class="form-label">Product Description</label>
                <textarea class="form-control" name="prod_desc" placeholder="e.g. The best ihpone in the world" rows="5" required></textarea>
            </div>

            <div class="mb-3">
                <label for="product-contact" class="form-label">Contact</label>
                <input type="text" class="form-control" name="prod_contact" placeholder="e.g. https://facebook.com/user1" required>
            </div>

            <div class="mb-3">
                <label for="product-status" class="form-label">Product Status</label>
                <select name="prod_status" class="form-select">
                    <option selected>Select Product Status</option>
                    <option value="0">Not Available</option>
                    <option value="1">Available</option>
                </select>
            </div>

            <input type="hidden" value="<?= $_SESSION['user_id']; ?>" name="user_id">

            <button class="btn btn-success my-3" name="add_product" type="submit">Submit</button>
        </form>
    </main>

    </div>
    <!-- End Container -->

    <div class="container">
        <!--  Footer Start -->
        <?php include('footer.php'); ?>
        <!-- Footer End -->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>