<?php
require 'backend/db.php';
session_start();

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    $id = $conn->real_escape_string($id);

    $sql = "SELECT * FROM items WHERE id = $id";
    $result = $conn->query($sql);

    function convertMarkupToHTML($text) {
        $text = htmlspecialchars($text);
        $text = nl2br($text);
        $text = preg_replace('/\[b\](.*?)\[\/b\]/is', '<strong>$1</strong>', $text);
        $text = preg_replace('/\[i\](.*?)\[\/i\]/is', '<em>$1</em>', $text);
        $text = preg_replace('/\[u\](.*?)\[\/u\]/is', '<u>$1</u>', $text);
        $text = preg_replace('/\[code\](.*?)\[\/code\]/is', '<code>$1</code>', $text);
        return $text;
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
            <?php if ($result && $result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <?php if ($row['discount'] > 0): ?>
                            <section class="py-5">
                            <div class="container px-4 px-lg-5 my-5">
                                <div class="row gx-4 gx-lg-5 align-items-center">
                                    <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="<?= htmlspecialchars($row['picture']) ?>" alt="..." /></div>
                                    <div class="col-md-6">
                                        <div class="small mb-1">Azonosító: <?=htmlspecialchars($row['id'])?></div>
                                        <h1 class="display-5 fw-bolder"><?=htmlspecialchars($row['name'])?></h1>
                                        <p class="lead"><u>Kedvezmény:</u> <?= htmlspecialchars($row['discount']) ?>%</p>
                                    
                                        <div class="fs-5 mb-5 lead">
                                            <span class="text-decoration-line-through"><?=htmlspecialchars($row['price'])?> Ft</span>
                                            <?php $discountedPrice = $row['price'] - ($row['price'] * ($row['discount'] / 100)); ?>
                                            <span><?= htmlspecialchars(round($discountedPrice)) ?> Ft</span>
                                        </div>
                                        <div class="lead">
                                            <p><u>Termék leírása:</u></p>
                                            <div>
                                                <?php echo convertMarkupToHTML($row['description']); ?>
                                            </div>
                                        </div>
                                        <div class="d-flex">
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
                            </div>
                        </section>
                        <?php else: ?>
                            <section class="py-5">
                            <div class="container px-4 px-lg-5 my-5">
                                <div class="row gx-4 gx-lg-5 align-items-center">
                                    <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="<?= htmlspecialchars($row['picture']) ?>" alt="..." /></div>
                                    <div class="col-md-6">
                                        <div class="small mb-1">Azonosító: <?=htmlspecialchars($row['id'])?></div>
                                        <h1 class="display-5 fw-bolder"><?=htmlspecialchars($row['name'])?></h1>
                                        <div class="fs-5 mb-5">
                                            <span><?= htmlspecialchars($row['price']) ?> Ft</span>
                                        </div>
                                        <div class="lead">
                                            <p><u>Termék leírása:</u></p>
                                            <div>
                                                <?php echo convertMarkupToHTML($row['description']); ?>
                                            </div>
                                        </div>
                                        <div class="d-flex">
                                        <form action="backend/addcart.php" method="POST">
                                            <input type="hidden" name="product_id" value="<?= $row['id'] ?>">
                                            <input type="hidden" name="product_name" value="<?= htmlspecialchars($row['name']) ?>">
                                            <input type="hidden" name="product_price" value="<?= htmlspecialchars($row['price']) ?>">
                                            <div class="justify-content-center text-center align-items-center d-flex">
                                                <input type="number" name="quantity" value="1" min="1" style="max-width: 3rem;" class="form-control text-center me-3">
                                                <button type="submit" class="btn btn-outline-dark mt-auto">Kosárhoz adom!</button>
                                            </div>
                                        </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <?php endif; ?>
                     <?php endwhile; ?>
                <?php else: ?>
                    <p>Nincs megjeleníthető termék!!</p>
                <?php endif; ?>

                <?php $conn->close(); ?>
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Bingusz Shop!</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="assets/js/script.js"></script>
    </body>
</html>


