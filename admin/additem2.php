<?php
require 'db.php';

$sql = "SELECT * FROM categories";
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
    <section class="py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="row gx-4 gx-lg-5 align-items-center">
                    <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="https://preview.redd.it/h%C3%ADz%C3%B3-olcs%C3%B3n-v0-tu89nd5uk1ib1.png?auto=webp&s=61754f46b54baacd102644c2be9c619c5302f300" alt="dummy pic" /></div>
                    <div class="col-md-6">
                    <form action="upload.php" method="post">
                        <input type="text" name="name" placeholder="Termék neve" required><br><br>
                        <input type="text" name="description" placeholder="Termék leírása" required><br><br>
                        <input type="number" name="price" placeholder="Termék ára" required><br><br>
                        <input type="text" name="picture" placeholder="Termék képe (direct link)"><br><br>
                        <input type="number" name="discount" placeholder="Leárazás (%)" min="0" max="99" required style="min-width: 7rem;"><br><br>
                        <label for="category">Kategória: </label>
                        <select id="category" name="category">
                        <?php if ($result && $result->num_rows > 0): ?>
                                    <?php while ($row = $result->fetch_assoc()): ?>                       
                                    <option value="<?=$row['id']?>"><?=$row['name']?></option>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <p>Nincs megjeleníthető kateógira.</p>
                                <?php endif; ?>

                                <?php $conn->close(); ?>
                        </select><br><hr>
                        <button type="submit">Küldés</button>
                    </form>
                    </div>
                </div>
            </div>
        </section>        
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Bingusz Shop - Admin site!</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>