<html>

<?php
include_once 'dbconfig.php';
include_once 'sidebar.php';
include_once 'stylesheets.html';
$id = $_GET['id'];
$sql = "SELECT * FROM reminders WHERE ID = " . $id;
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

$starttm = "";
$endtm = "";
$minsbefore = "";

if ($row['event'] == 1)
{
  $sql_b = "SELECT * FROM events WHERE reminderID = " . $id;
  $result_b = mysqli_query($conn, $sql_b);
  $row_b = mysqli_fetch_array($result_b);
  $starttm = substr($row_b['notificationtime'], 0, 16);
}
?>

<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script>

$(document).ready (function() {
  $('#id').val("<?php echo $id; ?>");
  $("#description").val("<?php echo $row['description']; ?>");
  $("#duedate").val("<?php echo $row['duedate']; ?>");
  var rpt = '<?php echo $row['repeating'];?>';
	if (rpt != 0)
  {
    $("#repeating").attr('checked', true);
    $("#repeatfreq").val("<?php echo $row['repeatfreq']; ?>");
    $("#repeatinterval").val("<?php echo $row['repeatinterval']; ?>");
    $("#enddate").val("<?php echo $row['enddate']; ?>");
  }
  else {
    $("#repeatfreqrow").hide();
    $("#repeatintervalrow").hide();
    $("#enddaterow").hide();
  }
  var evt = '<?php echo $row['event'];?>';
  if (evt == 1)
  {
    $("#reminder").attr('checked', true);
    $("#notificationtime").val("<?php  echo $starttm; ?>");
    $("#notificationtimerow").show();
  }
  $("#formtype").val("EDIT");
  $("#id").val("<?php echo $row['ID']; ?>");
  $("#reminderdays").val("<?php echo $row['reminderdays']; ?>");
  $("#categorylist").val("<?php echo $row['category'] ?>");
  if ('<?php echo $row['enddate']; ?>' != '0000-00-00')
  {$("#enddate").val("<?php echo $row['enddate']; ?>");}
  $("#link").val("<?php echo $row['link']; ?>");
  if ('<?php echo $row['lastcompleted']; ?>' != '0000-00-00')
  { $("#lastcompleted").val("<?php echo $row['lastcompleted']; ?>"); }
  $("#tags").val("<?php echo $row['tags']; ?>");
  $("#eventID").val("<?php echo $row['eventID']; ?>");
});

</script>


</head>


<h2>EDIT TASK</h2>
<label>ID: <?php echo $id; ?></label>

<?php include 'task_form.php'; ?>




</html>
