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

        

        <!-- Hero Start -->
        <div class="px-4 py-5 my-5 text-center">
            <h1 class="display-5 fw-bold text-body-emphasis">Search Results:</h1>
            <div class="col-lg-6 mx-auto">
                <div class="row mt-3">
                    <div class="col-md-12 mx-auto">
                        <form action="search.php" method="POST">
                            <div class="input-group mb-3">
                                <input type="text" name="search_term" class="form-control" placeholder="Search products... e.g. iphone 15, macbook pro m1">
                                <button type="submit" name="search_submit" class="btn btn-primary">Search</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Hero End -->

        <!-- Products Grid Start -->
        <div class="album py-5">
            <div class="container">
                <div class="row g-3">

                    <?php 

                        if (isset($_POST['search_submit'])) {
                            $searchTerm = $_POST['search_term'];
                            $searchData = "%$searchTerm%";
                        }
                        
                        $stmt = $pdo->prepare("SELECT * FROM products WHERE prod_name LIKE ?");
                        $stmt->execute([$searchData]);

                        if ($rowCount = $stmt->rowCount()) {
                        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                    <div class="col">
                        <div class="card shadow-sm">
                            <img height="300" src="uploads/<?= $row['prod_img'] ?>" />
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
                    </div>
                    <?php 
                            }
                        } else {
                            echo "<div class='text-center'>No products was found!</div>";
                        }                    
                    ?>
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