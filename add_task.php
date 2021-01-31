<html>



<?php
include_once 'dbconfig.php';
include_once 'sidebar.php';
include_once 'stylesheets.html';
?>

<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script>

$(document).ready (function() {
  $("#formtype").val("NEW");
});

</script>


</head>


<h2>ADD TASK</h2>

<?php include 'task_form.php'; ?>




</html>
