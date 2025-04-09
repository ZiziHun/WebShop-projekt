<?php
require 'db.php';

$sql = "SELECT * FROM categories";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feltöltés</title>
</head>
<body>
    <form action="upload.php" method="post">
        <input type="text" name="name" placeholder="Termék neve" required><br><br>
        <input type="text" name="description" placeholder="Termék leírása" required><br><br>
        <input type="number" name="price" placeholder="Termék ára" required><br><br>
        <input type="text" name="picture" placeholder="Termék képe"><br><br>
        <input type="number" name="discount" placeholder="Leárazás (%)" max="99" required><br><br>
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
</body>
</html>