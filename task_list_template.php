<html>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<?php
include_once 'dbconfig.php';
include_once 'stylesheets.html';
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


<script>
$(document).ready(function() {
$(document).on("click", "#colorbutton", function(){
  $("p").show();
  <?php

  $sql_cats = "SELECT category FROM categories";
  $result_cats = mysqli_query($conn, $sql_cats);
  while ($row_cats = mysqli_fetch_array($result_cats))
  {
    echo "$('." . $row_cats[0] ."').addClass('";
    $sql_col = "SELECT b.color FROM categories a JOIN w3_colors b ON a.colorID = b.ID WHERE a.category = '" . $row_cats['category'] ."'";
    $result_col = mysqli_query($conn, $sql_col);
    $row_col = mysqli_fetch_array($result_col);
    echo $row_col[0];
    echo "');";
  }
  ?>
});
});
</script>


<p id = 'buttonparagraph'>
<a id='colorbutton' class='w3-button w3-blue'>Categories</a>
</p>

<p id='cattable' style='display: none'>
<?php  include_once 'choose_category.php'; ?>
</p>

<table class = "w3-table w3-striped w3-border w3-bordered">

  <thead>
    <tr>
      <th class='datecol'>Due Date</th>
      <th>Task</th>
      <th>Link</th>
      <th>Done</th>
      <th>Edit</th>
    </tr>
  </thead>
  <tbody>

<?php
  while($row_reminders = mysqli_fetch_array($result_reminders)) {
    $id = $row_reminders['ID'];
    echo "<tr class = '" . $row_reminders['category'] . "'>";
    echo "<td class='datecol'>";
    echo date_format(date_create($row_reminders['duedate']), "m/d/Y");
    echo "</td>";
    echo "<td>";
    echo $row_reminders['description'];
    echo "</td>";
    echo "<td>";
    echo "<a class = 'w3-btn w3-green' href = '" . $row_reminders['link'] . "' target = '_blank'>LINK</a>";
    echo "</td>";
    echo "<td>";
    echo "<a href = 'done_clicked.php?id=$id'><img src = 'greencheckmark_small.jpg'></a>";
    echo "</td>";
    echo "<form method = 'get'><td>";
    echo "<a class = 'w3-btn w3-blue' href = 'edit_task.php?id=$id'>EDIT</a>";
    echo "</td></form>";
    echo "</tr>";
  }
?>


  </tbody>
</table>











</html>
