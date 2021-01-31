<html>

<head><title>Tasks Currently Due</title></head>

<?php
include_once 'dbconfig.php';
include_once 'stylesheets.html';
include_once 'sidebar.php';

$sql = "SELECT * FROM remindersduenow ORDER BY duedate ASC";
$result = mysqli_query($conn, $sql);
include_once 'tasklistheader.php';
include_once 'tasklisttable.php';
?>


</html>
