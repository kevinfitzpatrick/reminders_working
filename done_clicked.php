<html>

<?php
include_once 'dbconfig.php';
include_once 'php_functions.php';

$id = $_GET['id'];

$sql = "INSERT INTO completed_tasks ( TaskID, datecompleted ) VALUES ( " . $id . ", CURDATE() ) ";
mysqli_query($conn, $sql);

$sql = "UPDATE reminders SET lastcompleted = CURDATE() WHERE ID = " . $id;
mysqli_query($conn, $sql);

$sql_rem = "SELECT * FROM reminders a LEFT JOIN events b on b.ID = a.eventID WHERE a.ID = " . $id;
$result_rem = mysqli_query($conn, $sql_rem);
$row_rem = mysqli_fetch_array($result_rem);

$interval = "";
if ($row_rem['repeating'] == 1)
{

  $olddate = $row_rem['duedate'];

  switch($row_rem['repeatinterval'])
  {
    case 'Days':
      $interval = 'DAY';
      break;
    case 'Weeks':
      $interval = 'WEEK';
      break;
    case 'Months':
      $interval = 'MONTH';
      break;
    case 'Years':
      $interval = 'YEAR';
      break;
  }

  $sql_upd = "UPDATE reminders SET duedate = DATE_ADD('" . $olddate ."', INTERVAL " . $row_rem['repeatfreq'] . " " . $interval . ") WHERE ID = " . $id;
  mysqli_query($conn, $sql_upd);

  if($row_rem['event'] == 1)
  {
    delete_event($id);
    $olddate = $row_rem['start'];
    $newdate = date_add(date_create(substr($olddate, 0, 10)), date_interval_create_from_date_string($row_rem['repeatfreq'] . " " . $row_rem['repeatinterval']));
    echo insert_event($row_rem['description'], date_format($newdate, "Y-m-d") . substr($olddate, 10));
    header("location: homepage2.php");
  }
  else { header('location: homepage2.php'); }

}
else
{
  if ($row_rem['event'] == 1)
  { delete_event($id); }
  header('location: homepage2.php');
}



?>

</html>
