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
                <a class="navbar-brand" href="#">Bingusz PC Alkatrészek</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="#">Főoldal</a></li>
                        <li class="nav-item"><a class="nav-link" href="items.php">Termékek</a></li>
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
        <!-- Product section-->
        <section class="py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="row gx-4 gx-lg-5 align-items-center">
                    <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/5c3c93af-f81c-4f6c-bb66-c6616ce4dc61.png" alt="dummy pic" /></div>
                    <div class="col-md-6">
                        <div class="small mb-1">PC Alkatrészek kellenek?</div>
                        <h1 class="display-5 fw-bolder">Nálunk összeépítheted álmaid gépét!</h1>
                        <p class="lead">Már 2025 óta piacon, töretlenül!<br>Készült egy IKT Projekt keretein belül.</p>
                        <ul class="list-unstyled">
                            <li><strong>Minőségi alkatrészek</strong> - Csak a legjobb gyártóktól.</li>
                            <li><strong>Gyors szállítás</strong> - Akár másnapra kézhez kapod.</li>
                            <li><strong>Ügyfélszolgálat</strong> - Segítünk minden kérdésben.</li>
                            <li><strong>Garancia</strong> - Minden termékre a jogszabályokban határozott ár alapján kapod a garanciát.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
       
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Bingusz Shop!</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="assets/js/script.js"></script>
    </body>
</html>