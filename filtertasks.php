<?php

include_once 'dbconfig.php';

$sql = "SELECT * FROM reminders";
if($_GET['category'] !== "all")
{
    $sql .= " WHERE category = '" . $_GET['category'] . "'";
}
//if(!is_null($_GET['stopdate']) && strlen($_GET['stopdate']) > 4)
if (new DateTime($_GET['stopdate']) > new DateTime())
{
    if(strpos($sql, "WHERE") !== false )
    { $sql .= " AND duedate <= '" . $_GET['stopdate'] . "'"; }
    else { $sql .= " WHERE duedate <= '" . $_GET['stopdate'] . "'"; }
    $sql .= " AND duedate <> '0000-00-00'";
}

$ct = 1;
if ($_GET['category'] !== 'all')
{
  $sql_dt = "SELECT COUNT(ID) FROM reminders WHERE category  = '" . $_GET['category'] . "' AND duedate <> '0000-00-00'";
  $result_dt = mysqli_query($conn, $sql_dt);
  $row_dt = mysqli_fetch_array($result_dt);
  $ct = $row_dt[0];
}

if ($ct > 0)
{
  if(strpos($sql, "WHERE") !== false )
  { $sql .= " AND duedate > lastcompleted"; }
  else { $sql .= " WHERE duedate > lastcompleted"; }
}


$sql .= " ORDER BY duedate ASC";

$result = mysqli_query($conn, $sql);

echo "<thead>";
    echo "<th class='datecol'>Due Date</th>";
    echo "<th>Task</th>";
    echo "<th>Link</th>";
    echo "<th>Done</th>";
    echo "<th>Edit</th>";
  echo "</tr>";
echo "</thead>";
echo "<tbody>";


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
echo "</tbody>";

?>
