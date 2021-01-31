<html>


<?php
include_once 'dbconfig.php';
include_once 'stylesheets.html';
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script>
  $(document).ready(function(){
    $('#colorcodebutton').click(function(){
      <?php
        $sql_cats = "SELECT * FROM categories a JOIN w3_colors b ON a.colorID = b.ID";
        $result_cats = mysqli_query($conn, $sql_cats);
        while ($row_cats = mysqli_fetch_array($result_cats))
        {
          echo "$('." . $row_cats['category'] . "').addClass('" . $row_cats['color'] . "');";
        }
      ?>
    });
  });
</script>

<table class='w3-centered'>
  <tbody>
    <tr>
      <th><button class='w3-button w3-light-grey w3-rounded w3-large' id='alltasksbutton' onclick='filtertasks("all")'>Show All Tasks</button></th>
      <th><button class='w3-button w3-pale-green w3-rounded w3-large' id='filterbyduedatebutton' onclick='toggleelement("stopdaterow");showelement("gobuttonrow");'>Filter by Duedate</button></th>
      <th><button class='w3-button w3-pale-red w3-rounded w3-large' id='filterbycategory' onclick='toggleelement("categoryrow");showelement("gobuttonrow");'>Filter by Category</button></th>
    </tr>
    <tr>
      <td><button class='w3-button w3-yellow w3-rounded w3-large' id='completedtasksbutton' onclick='showcompletedorpendingtasks("comp");'>Show Completed Tasks</button></td>
      <td><button class='w3-button w3-blue w3-rounded w3-large' id='pendingtasksbutton' onclick='showcompletedorpendingtasks("pend");'>Show Pending Tasks</button></td>
      <td><button class='w3-button w3-khaki w3-rounded w3-large' id='colorcodebutton'>Color Categories</button></td>
      <td></td>
    </tr>
    <tr style='display:none' id='stopdaterow'>
      <td>Due on or before:
        <input type='date' id='stopdateinput'></td>
    </tr>
    <tr style='display:none' id='categoryrow'>
      <td>Category:</td>
      <td>
        <select class='w3-select' id='categoryselect'>
          <option value=''></option>
          <?php
          $sql_cat = "SELECT category FROM categories";
          $result_cat = mysqli_query($conn, $sql_cat);
          while ($row_cat = mysqli_fetch_array($result_cat))
          {
            echo "<option value='" . $row_cat['category'] . "'>" . $row_cat['category'] . "</option>";
          }
          ?>
        </select>
      </td>
    </tr>
    <tr style='display:none' id='gobuttonrow'><td><button class='w3-button w3-green w3-rounded w3-large' onclick='filtertasks()'>GO</button></td></tr>
  </tbody>
</table>


<script>
function filtertasks(str) {
  var xhttp;
  var category = "";
  if(document.getElementById("categoryselect").value.length > 2)
  {category = document.getElementById("categoryselect").value;}
  else{category = "all";}
  var stopdate = document.getElementById("stopdateinput").value;
  if(str === "all")
  {category="all"; stopdate="";}

  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("tasklisttable").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "filtertasks.php?category=".concat(category, "&stopdate=", stopdate), true);
  xhttp.send();
}

function showelement(id){
  var x = document.getElementById(id);
  x.style.display = "block";
}

function toggleelement(id){
  var x = document.getElementById(id);
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}

function showcompletedorpendingtasks(completed){
  var xhttp;
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("tasklisttable").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "showcompletedorpendingtasks.php?completed=".concat(completed), true);
  xhttp.send();
}
</script>


</html>
