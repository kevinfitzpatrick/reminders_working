<html>

<head><title>All Tasks</title></head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<?php
include_once 'dbconfig.php';
include_once 'stylesheets.html';
?>


<?php
$sql_reminders = "SELECT * FROM reminders ORDER BY duedate ASC";
$result_reminders = mysqli_query($conn, $sql_reminders);
?>

<body>

<?php include_once 'sidebar.php'; ?>

<h2>All Tasks</h2>

<?php include_once 'task_list_template.php'; ?>


</body>


</html>
