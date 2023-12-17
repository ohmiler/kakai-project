<?php 

    session_start();
    require "config.php";

    function limitString($str, $maxLength, $ellipsis = '...') {
        if (strlen($str) > $maxLength) {
            $str = substr($str, 0, $maxLength - strlen($ellipsis)) . $ellipsis;
        }

        return $str;
    }

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
            <h1 class="display-5 fw-bold text-body-emphasis">Centered hero</h1>
            <div class="col-lg-6 mx-auto">
                <p class="lead mb-4">Quickly design and customize responsive mobile-first sites with Bootstrap, the world’s most popular front-end open source toolkit, featuring Sass variables and mixins, responsive grid system, extensive prebuilt components, and powerful JavaScript plugins.</p>
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
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">

                    <?php 
                        
                        if (isset($_GET['page'])) {
                            $page = $_GET['page'];
                        } else {
                            $page = 1;
                        }

                        $limit = 6;
                        $offset = ($page - 1) * $limit; // (1 - 1) * 6
                        $next = $page + 1;
                        $previous = $page - 1;

                        $totalQuery = "SELECT COUNT(*) FROM products";
                        $totalStmt = $pdo->query($totalQuery);
                        $totalItems = $totalStmt->fetchColumn();
                        $totalPages = ceil($totalItems / $limit);
               
                        $stmt = $pdo->prepare("SELECT * FROM products WHERE prod_status = 1 LIMIT $offset, $limit ");
                        $stmt->execute();
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

                                <h3><a href="page.php?id=<?= $row['id']; ?>"><?= $row['prod_name'] ?></a></h3>
                                <p class="card-text"><?= limitString($row['prod_desc'], 50) ?></p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="my-3 fs-3">Price <?= number_format($row['prod_price'], 2) ?></div>
                                    <a href="<?= $row['prod_contact'] ?>" target="_blank" class="btn btn-primary">Contact</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>

                <div class="d-flex justify-content-center">
                    <nav class="mt-3" aria-label="Page navigation example">
                        <ul class="pagination">
                            <li class="page-item"><a class="page-link" href="index.php?page=1">First</a></li>
                            <li class="page-item"><a class="page-link" href="index.php?page=<?= $previous == 0 ? 1 : $previous; ?>">Previous</a></li>
                            <?php for($i = 1; $i <= $totalPages; $i++) { 
                                $currentPage = $page;
                                $previous2 = $currentPage - 2;
                                $next2 = $currentPage + 2;
                            ?>
                            <?php if ($i >= $previous2 && $i <= $next2) { ?>
                            <li class="page-item <?= ($i == $page) ? 'active' : ''; ?> "><a class="page-link" href="index.php?page=<?= $i ?>"><?= $i ?></a></li>
                            <?php } ?>
                            <?php } ?>
                            <li class="page-item"><a class="page-link" href="index.php?page=<?= $next > $totalPages ? $totalPages : $next; ?>">Next</a></li>
                            <li class="page-item"><a class="page-link" href="index.php?page=<?= $totalPages; ?>">Last</a></li>
                        </ul>
                    </nav>
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