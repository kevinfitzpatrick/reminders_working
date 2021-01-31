<html>

<table class = "w3-table w3-striped w3-border w3-bordered" id='tasklisttable'>

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
  while($row = mysqli_fetch_array($result)) {
    $id = $row['ID'];
    echo "<tr class = '" . $row['category'] . "'>";
    echo "<td class='datecol'>";
    echo date_format(date_create($row['duedate']), "m/d/Y");
    echo "</td>";
    echo "<td>";
    echo $row['description'];
    echo "</td>";
    echo "<td>";
    echo "<a class = 'w3-btn w3-green' href = '" . $row['link'] . "' target = '_blank'>LINK</a>";
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
