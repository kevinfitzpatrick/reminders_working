<html>

<?php include_once 'stylesheets.html'; ?>

<!-- Sidebar -->
<div class="w3-sidebar w3-bar-block w3-border-right" style="display:none" id="mySidebar">
  <button onclick="w3_close()" class="w3-bar-item w3-large">Close &times;</button>
  <a href="homepage2.php" class="w3-bar-item w3-button">Home</a>
  <a href="add_task.php" class="w3-bar-item w3-button">Add Task</a>
  <a href='all_tasks.php' class="w3-bar-item w3-button">All Tasks</a>
  <a href="choose_category.php" class="w3-bar-item w3-button">Categories</a>
  <a href="add_book.php" class="w3-bar-item w3-button">Add Book</a>
  <a href="add_movie.php" class="w3-bar-item w3-button">Add Movie</a>
  <a href="add_tvshow.php" class="w3-bar-item w3-button">Add TV Show</a>
</div>

<!-- hamburger button -->
<div>
  <button class="w3-button w3-gray w3-xlarge" onclick="w3_open()">☰</button>
</div>

<script>
function w3_open() {
  document.getElementById("mySidebar").style.display = "block";
}

function w3_close() {
  document.getElementById("mySidebar").style.display = "none";
}
</script>


</html>
