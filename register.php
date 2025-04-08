<?php if ($result && $result->num_rows > 0): ?>
<?php while ($row = $result->fetch_assoc()): ?>
<tr>
  <td>
    <?= htmlspecialchars($row['id']) ?>
  </td>
  <td>
    <?= htmlspecialchars($row['name']) ?>
  </td>
  <td>
    <?= htmlspecialchars($row['price']) ?>
  </td>
</tr>
<?php endwhile; ?>
</table>
<?php else: ?>
<p>Nincs megjeleníthető adat.</p>
<?php endif; ?>

<?php $conn->close(); ?>