<?php
session_start();
require 'backend/db.php';

$sql = "SELECT * FROM items";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Bingusz Shop</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/images/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="assets/css/styles.css" rel="stylesheet" />
    </head>
    <body>
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="index.php">Bingusz PC Alkatrészek</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link" aria-current="page" href="index.php">Főoldal</a></li>
                        <li class="nav-item"><a class="nav-link active" href="items.php">Termékek</a></li>
                        <li class="nav-item"><a class="nav-link" aria-current="page" href="contact.php">Kapcsolat</a></li>
                    </ul>
                    <a href="cart.php">
                        <button class="btn btn-outline-dark">
                            <i class="bi-cart-fill me-1"></i>
                            Kosár 
                            <span class="badge bg-dark text-white ms-1 rounded-pill">
                                <?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?>
                            </span>
                        </button>
                    </a>
                </div>
            </div>
        </nav>
        </nav>        
        <section class="py-5 bg-light">
            <div class="container px-4 px-lg-5 mt-5">
                <h2 class="fw-bolder mb-4 text-center">Termékek</h2>
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                <?php if ($result && $result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <?php if ($row['discount'] > 0): ?>
                            <div class="col mb-5" style="cursor: pointer;" onclick="window.location.href='item.php?id=<?= $row['id']; ?>'">
                        <div class="card h-100">
                            <!-- Sale badge-->
                            <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem"><a data-toggle="tooltip" data-placement="top" title="<?= htmlspecialchars($row['discount']) ?>%">Akció!</a></div>
                            <!-- Product image-->
                            <img class="card-img-top" src="<?= htmlspecialchars($row['picture']) ?>" alt="..." />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder"><?= htmlspecialchars($row['name']) ?></h5>
                                    <!-- Product reviews-->
                                    <div class="d-flex justify-content-center small text-warning mb-2">
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                    </div>
                                    <!-- Product price-->
                                    <span class="text-muted text-decoration-line-through"><?= htmlspecialchars($row['price']) ?></span>
                                    <?php $discountedPrice = $row['price'] - ($row['price'] * ($row['discount'] / 100)); ?>
                                    <?= htmlspecialchars($discountedPrice) ?> Ft
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <form action="backend/addcart.php" method="POST">
                                <input type="hidden" name="product_id" value="<?= $row['id'] ?>">
                                <input type="hidden" name="product_name" value="<?= htmlspecialchars($row['name']) ?>">
                                <input type="hidden" name="product_price" value="<?= htmlspecialchars($discountedPrice) ?>">
                                <input type="number" name="quantity" value="1" min="1" style="max-width: 5rem;" class="form-control text-center me-3">
                                <button type="submit" class="btn btn-outline-dark mt-auto">Kosárhoz adom!</button>
                            </form>
                            </div>
                        </div>
                    </div>
                        <?php else: ?>
                            <div class="col mb-5" style="cursor: pointer;" onclick="window.location.href='item.php?id=<?= $row['id']; ?>'">
                                <div class="card h-100">
                                <!-- Product image-->
                                <img class="card-img-top" src="<?= htmlspecialchars($row['picture']) ?>" alt="..." />
                                <!-- Product details-->
                                <div class="card-body p-4">
                                    <div class="text-center">
                                        <!-- Product name-->
                                        <h5 class="fw-bolder"><?= htmlspecialchars($row['name']) ?></h5>
                                        <!-- Product price-->
                                        <?= htmlspecialchars($row['price']) ?> Ft
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <form action="backend/addcart.php" method="POST">
                                <input type="hidden" name="product_id" value="<?= $row['id'] ?>">
                                <input type="hidden" name="product_name" value="<?= htmlspecialchars($row['name']) ?>">
                                <input type="hidden" name="product_price" value="<?= htmlspecialchars($row['price']) ?>">
                                <input type="number" name="quantity" value="1" min="1" style="max-width: 5rem;" class="form-control text-center me-3">
                                <button type="submit" class="btn btn-outline-dark mt-auto">Kosárhoz adom!</button>
                            </form>
                            </div>
                        </div>
                    </div>
                        <?php endif; ?>
                     <?php endwhile; ?>
                <?php else: ?>
                    <p>Nincs megjeleníthető termék.</p>
                <?php endif; ?>

                <?php $conn->close(); ?>
                </div>
            </div>
        </section>
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Bingusz Shop!</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
        <script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
});
</script>
    </body>
</html>
