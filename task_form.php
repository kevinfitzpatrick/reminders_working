<html>

<?php
include_once 'dbconfig.php';
include_once 'stylesheets.html';
?>



<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script>
$(document).ready (function() {
  $("#categorylist").change(function() {
    if ($("#categorylist").val() == 'NEW CATEGORY') {
      $("#newcatlabel").show();
      $("#newcattxt").show();
    }
    else {
      $("#newcatlabel").hide();
      $("#newcattxt").hide();
    }
    $("#category").val(function(n, c){
      return $("#categorylist").val();
    });
  });

  $('#repeating').click(function(){
    if (this.checked) {
        $("#repeatfreqrow").show();
        $("#repeatintervalrow").show();
        $("#enddaterow").show();
    }
    else {
      $("#repeatfreqrow").hide();
      $("#repeatintervalrow").hide();
      $("#enddaterow").hide();
    }
  })

  $('#reminder').click(function(){
    if(this.checked){
      $('#notificationtimerow').show();
    }
    else {
      $('#notificationtimerow').hide();
    }
  });

  $("#newcattxt").change(function(){
    $("#category").val(function(n, c){
      return $("#newcattxt").val();
    });
  });
});


</script>
</head>


<p><H2>TASK</H2></p>



<form method = 'post' action = 'enter_task.php'>
<input type = 'text' name = 'id' id = 'id' style = 'display: none' value = ''>
<input type = 'text' name = 'formtype' id = 'formtype' style = 'display: none'>
<table class = "w3-table w3-striped w3-border w3-bordered">
  <tr id = 'descriptionrow'>
    <td>Description:</td>
    <td>
      <input type = 'text' size = '100' name = 'description' id = 'description' value = '' style = 'font-weight:bold'>
    </td>
  </tr>
  <tr id='duedaterow'>
    <td>Due Date:</td>
    <td>
      <input type = 'date' name = 'duedate' id = 'duedate' value = ''>
    </td>
  </tr>
  <tr id = 'repeatingrow'>
    <td>Repeating</td>
    <td>
      <input class = "w3-check" type = 'checkbox' name = 'repeating' id = 'repeating' Value = 'YES'>
    </td>
  </tr>

  <tr id = 'repeatfreqrow'>
    <td>Repeat Frequency</td>
    <td>
      <input type = 'text' name = 'repeatfreq' size = '3' id = 'repeatfreq'>
    </td>
  </tr>

  <tr id = "repeatintervalrow">
    <td>Repeat Interval</td>
    <td>
      <select name = 'repeatinterval' class = 'w3-select' style = 'width: 100' id = 'repeatinterval'>
        <option value = '' disable selected>Choose</option>
        <option value = 'Days'>Days</option>
        <option value = 'Weeks'>Weeks</option>
        <option value = 'Months'>Months</option>
        <option value = 'Years'>Years</option>
      </select>
    </td>
  </tr>

  <tr id = "enddaterow">
    <td>Stop Repeating After:</td>
    <td>
      <input type = 'date' name = 'enddate' id = 'enddate' value = ''>
    </td>
  </tr>

  <tr id = 'reminderdaysrow'>
    <td>Reminder Days</td>
    <td>
      <input type = 'text' name = 'reminderdays' size = '3' id = 'reminderdays'>
    </td>
  </tr>

  <tr id ='linkrow'>
    <td>Link</td>
    <td>
      <input type = 'text' name = 'link' id = 'link' >
    </td>
  </tr>

  <tr id='lastcompletedrow'>
    <td>Task Last Completed on:</td>
    <td>
      <input type = 'date' name = 'lastcompleted' id = 'lastcompleted' value = ''>
    </td>
  </tr>

  <tr id='categoryrow'>
    <td>Category</td>
    <td>
      <select name = 'categorylist' style = 'width: 100' id = 'categorylist'>
        <option value = ''> </option>
        <option value = 'NEW CATEGORY' id = 'newcat'>NEW CATEGORY</option>
        <?php
          $sql = "SELECT category FROM categories";
          $result = mysqli_query($conn, $sql);
          while ($row = mysqli_fetch_array($result)) {
            echo "<option value = '" . $row['category'] . "'>" . $row['category'] . "</option>";
          }
         ?>
      </select>
      <label id='newcatlabel' style='display: none'>New Category:</label>
      <input type='text' name='newcat' id='newcattxt' style='display:none'>
      <input type = 'text' name = 'category' id = 'category' style='display:none'>
    </td>
  </tr>

  <tr id='tagsrow'>
    <td>Tags</td>
    <td>
      <input type = 'text' name = 'tags' id = 'tags'>
    </td>
  </tr>

  <tr>
    <td>Reminder</td>
    <td><input class = "w3-check" type = 'checkbox' name = 'event' id = 'reminder' Value = 'YES'></td>
  </tr>

    <tr style='display:none' id='notificationtimerow'>
    <td>Reminder Event Start Time</td>
    <td><input type='datetime-local' name='notificationtime' id='notificationtime'></td>
  </tr>

  <tr style='display:none'>
    <td>EventID</td>
    <td><input type='number' name='eventID' id='eventID'></td>
  </tr>


</table>

<input type = 'submit' name = 'Submit' value = 'Submit' class = 'w3-btn w3-green'>

<input type = 'submit' name = 'Delete' value = 'Delete' class = 'w3-btn w3-red'>
</form>



</html>
