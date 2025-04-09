<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Tegyük fel, hogy a form mezői: nev, email
    $name = $conn->real_escape_string($_POST['name']);
    $description = $conn->real_escape_string($_POST['description']);
    $price = $conn->real_escape_string($_POST['price']);
    $picture = isset($_POST['picture']) && !empty($_POST['picture']) ? $conn->real_escape_string($_POST['picture']) : 'https://dummyimage.com/450x300/dee2e6/6c757d.jpg';
    $discount = $conn->real_escape_string($_POST['discount']);
    $category = $conn->real_escape_string($_POST['category']);

    $sql = "INSERT INTO items (name, description, price, picture, discount, category) VALUES ('$name', '$description', '$price', '$picture', '$discount', '$category')";

    /*if ($conn->query($sql) === TRUE) {
        echo "Sikeres mentés!";
    } else {
        echo "Hiba: " . $conn->error;
    }

    $conn->close();*/
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
        <section class="py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="row gx-4 gx-lg-5 align-items-center">
                    <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="https://preview.redd.it/h%C3%ADz%C3%B3-olcs%C3%B3n-v0-tu89nd5uk1ib1.png?auto=webp&s=61754f46b54baacd102644c2be9c619c5302f300" alt="dummy pic" /></div>
                    <div class="col-md-6">
                        <?php if ($conn->query($sql) === TRUE): ?>
                            <h1 class="display-5 fw-bolder">Bingusz!</h1>
                            <p class="lead">Sikeres hozzáadás!</p>
                        <?php else: ?>
                            <h1 class="display-5 fw-bolder">Bingusz!</h1>
                            <p class="lead">Sikertelen hozzáadás! --> <?=$conn->error;?></p>
                        <?php endif; ?>
                        <?php $conn->close(); ?>
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
        <script src="js/scripts.js"></script>
    </body>
</html>
?>
