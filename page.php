<?php 

    session_start();
    require "config.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kakai</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>

    <!-- Container Start -->
    <div class="container">
        <!-- Nav start -->
        <?php include('nav.php'); ?>
        <!-- Nav End -->

        <!-- Products Grid Start -->
        <div class="album py-5">
            <div class="container">
                <div class="row">

                    <?php 

                        if (isset($_GET['id'])) {
                            $prod_id = $_GET['id'];
                            $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
                            $stmt->execute([$prod_id]);
                            $row = $stmt->fetch(PDO::FETCH_ASSOC);
                         }
                    ?>
                    <div class="col-md-6">
                        <div class="card shadow-sm">
                            <img height="500" src="uploads/<?= $row['prod_img'] ?>" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <?php if ($row['prod_status'] == 1): ?>
                                    <span class="mb-3 badge text-bg-success">Available</span>
                                <?php else: ?>
                                    <span class="mb-3 badge text-bg-danger">Not Available</span>
                                <?php endif; ?>

                                <h3><?= $row['prod_name'] ?></h3>
                                <p class="card-text"><?= $row['prod_desc'] ?></p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="my-3 fs-3">Price <?= number_format($row['prod_price'], 2) ?></div>
                                    <a href="<?= $row['prod_contact'] ?>" target="_blank" class="btn btn-primary">Contact</a>
                                </div>
                            </div>
                        </div>
                        <a href="index.php" class="btn btn-primary mt-3">Go back</a>
                    </div>
                </div>

               
            </div>
        </div>
        <!-- Products Grid End -->

        <!--  Footer Start -->
        <?php include('footer.php'); ?>
        <!-- Footer End -->

    </div>
    <!-- Container End -->


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    
</body>

</html>