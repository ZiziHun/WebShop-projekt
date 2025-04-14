<?php
session_start();
require 'backend/db.php';

$sql = "SELECT * FROM items";
$result = $conn->query($sql);

$sql2 = "SELECT * FROM categories";
$result2 = $conn->query($sql2);

if (isset($_GET['category'])) {
    $categoryParam = $_GET['category'];

    $categoryIds = explode(',', $categoryParam);
    $categoryIds = array_filter($categoryIds, function($id) {
        return is_numeric($id);
    });

    if (!empty($categoryIds)) {
        $escapedIds = array_map(function($id) use ($conn) {
            return (int) $conn->real_escape_string($id);
        }, $categoryIds);
        $inList = implode(',', $escapedIds);
        $sql = "SELECT * FROM items WHERE category IN ($inList)";
        $result = $conn->query($sql);
    } else {
        $result = false;
    }
}   

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
        <div class="container-fluid">
    <div class="row flex-nowrap">
        <div class="col-auto px-0">
            <div id="sidebar" class="collapse collapse-horizontal show border-end">
                <div id="sidebar-nav" class="list-group border-0 rounded-0 text-sm-start min-vh-100">
                    <h4 class=" mb-4 text-center">Szűrő</h4>             
                    <?php if ($result2 && $result2->num_rows > 0): ?>
                    <?php while ($row2 = $result2->fetch_assoc()): ?>                       
                    <div class="list-group-item border-end-0 d-inline-block text-truncate" data-bs-parent="#sidebar">
                        <input class="form-check-input category-checkbox" type="checkbox" value="<?= htmlspecialchars($row2['id']) ?>" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            <?= htmlspecialchars($row2['name']) ?>
                        </label>
                    </div>
                    <?php endwhile; ?>
                    <?php else: ?>
                        <p>Nincs megjeleníthető kateógira.</p>
                    <?php endif; ?>  
                    <div class="list-group-item border-end-0 d-inline-block text-truncate" data-bs-parent="#sidebar">
                        <button type="button" id="filterBtn" class="btn btn-primary w-100 mt-3">Szűrés</button>
                    </div>           
                </div>
            </div>
        </div>    
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
                            <img class="card-img-top" src="<?= htmlspecialchars($row['picture']) ?>" alt="..."  style="min-height: 290px"/>
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
                                    <?= htmlspecialchars(round($discountedPrice)) ?> Ft
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <form action="backend/addcart.php" method="POST">
                                <input type="hidden" name="product_id" value="<?= $row['id'] ?>">
                                <input type="hidden" name="product_name" value="<?= htmlspecialchars($row['name']) ?>">
                                <input type="hidden" name="product_price" value="<?= htmlspecialchars(round($discountedPrice)) ?>">
                                <input type="hidden" name="product_picture" value="<?= htmlspecialchars($row['picture']) ?>">
                                <div class="justify-content-center text-center align-items-center d-flex">
                                    <input type="number" name="quantity" value="1" min="1" style="max-width: 3rem;" class="form-control text-center me-3">
                                    <button type="submit" class="btn btn-outline-dark mt-auto">Kosárhoz adom!</button>
                                </div>                                
                            </form>
                            </div>
                        </div>
                    </div>
                        <?php else: ?>
                            <div class="col mb-5" style="cursor: pointer;" onclick="window.location.href='item.php?id=<?= $row['id']; ?>'">
                                <div class="card h-100">
                                <!-- Product image-->
                                <img class="card-img-top" src="<?= htmlspecialchars($row['picture']) ?>" alt="..." style="min-height: 290px"/>
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
                                <input type="hidden" name="product_picture" value="<?= htmlspecialchars($row['picture']) ?>">
                                <div class="justify-content-center text-center align-items-center d-flex">
                                    <input type="number" name="quantity" value="1" min="1" style="max-width: 3rem;" class="form-control text-center me-3">
                                    <button type="submit" class="btn btn-outline-dark mt-auto">Kosárhoz adom!</button>
                                </div>
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
        </div>
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
<script>
document.addEventListener('DOMContentLoaded', function () {
    const urlParams = new URLSearchParams(window.location.search);
    const categories = urlParams.get('category');

    if (categories) {
        const selectedCategories = categories.split(',');
        selectedCategories.forEach(cat => {
            const checkbox = document.querySelector(`.category-checkbox[value="${cat}"]`);
            if (checkbox) {
                checkbox.checked = true;
            }
        });
    }
    
    document.getElementById('filterBtn').addEventListener('click', function () {
        const selected = [];
        const checkboxes = document.querySelectorAll('.category-checkbox:checked');

        checkboxes.forEach(cb => selected.push(cb.value));

        if (selected.length > 0) {
            const query = selected.join(',');
            window.location.href = 'items.php?category=' + encodeURIComponent(query);
        } else {
            window.location.href = 'items.php';
        }
    });
});
</script>

    </body>
</html>
