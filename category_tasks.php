<html>

<head>
  <title>Tasks in Category <?php echo $_GET['category']; ?></title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<?php
include_once 'dbconfig.php';
include_once 'stylesheets.html';
?>


<?php
$sql_reminders = "SELECT * FROM reminders WHERE category = '" . $_GET['category'] . "' ORDER BY duedate ASC";
$result_reminders = mysqli_query($conn, $sql_reminders);

$sql_dates = "SELECT COUNT(ID) FROM reminders WHERE category = '" . $_GET['category'] . "' AND duedate <> '0000-00-00'";
$result_dates = mysqli_query($conn, $sql_dates);
$row_dates = mysqli_fetch_array($result_dates);
if ($row_dates[0] == 0)
{
  echo "<script>";
  echo "$(document).ready(function(){ ";
  echo "$('.datecol').hide();";
  echo "});";
  echo "</script>";
}
?>

<body>

<?php include_once 'sidebar.php'; ?>

<h2>Tasks in Category <?php echo $_GET['category']; ?></h2>

<?php include_once 'task_list_template.php'; ?>


</body>



</html>
