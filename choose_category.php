<html>
<?php include_once 'dbconfig.php'; ?>
<?php include_once 'sidebar.php'; ?>
<?php include_once 'stylesheets.html'; ?>

<table>
  <?php
  $i = 1;
  $sql_categories = "SELECT category, colorID FROM categories";
  $result_categories = mysqli_query($conn, $sql_categories);
  while ($row_categories = mysqli_fetch_array($result_categories)) {
    if (fmod($i, 3) == 1) {
      echo "<tr>";
    }
    $sql_col = "SELECT color FROM w3_colors WHERE ID = " . $row_categories['colorID'];
    $result_col = mysqli_query($conn, $sql_col);
    $row_col = mysqli_fetch_array($result_col);
    $color = $row_col[0];
    echo "<td> <a href = 'category_tasks.php?category=" . $row_categories['category'] . "' class='w3-button w3-round-large " . $color ."'>";
      echo $row_categories['category'];
    echo "</a></td>";
    if (fmod($i, 3) == 0){
      echo "</tr>";
    }
    $i=$i+1;
  }

   ?>

</table>




</html>
