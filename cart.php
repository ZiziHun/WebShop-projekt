<?php
session_start();
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
                        <li class="nav-item"><a class="nav-link" href="items.php">Termékek</a></li>
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="contact.php">Kapcsolat</a></li>
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
        <!-- Product section-->
        <section class="py-5">
    <div class="container px-4 px-lg-5 my-5">
        <h2 class="mb-4">Kosár tartalma</h2>
        <ul class="list-group mb-4">
            <?php
            $total = 0;

            if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])):
                foreach ($_SESSION['cart'] as $product_id => $product) {
                    $subtotal = $product['price'] * $product['quantity'];
                    $total += $subtotal;

                    echo '<li class="list-group-item">';
                    echo '<div class="d-flex align-items-start">';

                    echo '<img src="' . htmlspecialchars($product['picture']) . '" alt="' . htmlspecialchars($product['name']) . '" class="me-3 rounded" style="width: 80px; height: auto;">';

                    echo '<div>';
                    echo '<strong>Termék:</strong> ' . htmlspecialchars($product['name']) . '<br>';
                    echo '<strong>Ár:</strong> ' . htmlspecialchars($product['price']) . ' Ft<br>';                    
                    echo '<strong>Mennyiség:</strong> ' . htmlspecialchars($product['quantity']) . '<br>';
                    echo '<strong>Összesen:</strong> ' . $subtotal . ' Ft<br>';

                    echo '<form action="backend/removecart.php" method="POST" style="display:inline;">';
                    echo '<input type="hidden" name="product_id" value="' . $product_id . '">';
                    echo '<button type="submit" class="btn btn-sm btn-danger mt-2">Törlés</button>';
                    echo '</form>';

                    echo '</div>';
                    echo '</div>';
                    echo '</li>';
                }
            else:
                echo '<li class="list-group-item">A kosár üres</li>';
            endif;
            ?>
        </ul>

        <?php if ($total > 0): ?>
            <div class="text-end">
                <h4>Végösszeg: <strong><?= $total ?> Ft</strong></h4>
                <a href="#" class="btn btn-success mt-3">Tovább a fizetéshez</a>
            </div>
        <?php else: ?> 
            <div class="text-end">
                <h4>Végösszeg: <strong>0 Ft</strong></h4>
                <a href="#" class="btn btn-success mt-3" disabled>Tovább a fizetéshez</a>
            </div>
        <?php endif; ?>
    </div>
</section>

        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Bingusz Shop!</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
