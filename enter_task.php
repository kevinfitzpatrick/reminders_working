<html>

<?php
include_once 'dbconfig.php';
include_once 'php_functions.php';

$table_schema = "mvrma_reminders";
$table_name = "reminders";

if (isset($_REQUEST['repeating']))
{$repeating = 'YES';} else {$repeating = 'NO';}

if ($_REQUEST['Delete'] == 'Delete')
{
  $sql_rem = "SELECT * FROM reminders WHERE ID = " . $_REQUEST['id'];
  $result_rem = mysqli_query($conn, $sql_rem);
  $row_rem = mysqli_fetch_array($result_rem);
  $evt = $row_rem['event'];
  $sql_del = "DELETE FROM reminders WHERE ID = " . $_REQUEST['id'];
  mysqli_query($conn, $sql_del);
  if ($evt == '1')
  {
    delete_event($_REQUEST['id']);
    $sql_delevt = "DELETE FROM events WHERE reminderID = "  . $_REQUEST['id'];
    mysqli_query($conn, $sql_delevt);
    header('location: homepage2.php'); exit();
  }
  else
  { header('location: homepage2.php'); exit();}
}


if ($_REQUEST['formtype'] == 'EDIT')
{
  $sql_cols = "SELECT * FROM  information_schema.columns WHERE TABLE_SCHEMA = '" . $table_schema . "' AND TABLE_NAME = '" . $table_name . "' AND COLUMN_KEY <> 'PRI'";
  $result_cols = mysqli_query($conn, $sql_cols);
  $numcols = mysqli_num_rows($result_cols);

  $sql = "UPDATE reminders SET ";
  $i=0;
  while ($row_cols = mysqli_fetch_array($result_cols))
  {
    //echo "COLUMN_NAME = " . $row_cols['COLUMN_NAME'] . ", REQUEST[COLUMN_NAME] = " . $_REQUEST[$row_cols['COLUMN_NAME']] . "<br>";
    $sql .= $row_cols['COLUMN_NAME'] . "= ";
    if ($row_cols['DATA_TYPE'] == 'tinyint')
    {
      if (isset($_REQUEST[$row_cols['COLUMN_NAME']]))
      { $sql .= "1"; }
      else {$sql .= "0";}
    }
    else
    {
      if ($row_cols['CHARACTER_SET_NAME'] == 'utf8' || $row_cols['DATA_TYPE'] == 'date')
      {$sql .= "'" . $_REQUEST[$row_cols['COLUMN_NAME']] . "'";}
      else
      {
        if ($_REQUEST[$row_cols['COLUMN_NAME']] != null)
        {$sql .= $_REQUEST[$row_cols['COLUMN_NAME']];}
        else {$sql .= "0";}
      }
    }
    if ($i != $numcols - 1)
    { $sql .= ", "; }
    $i++;
  }
  $sql .= " WHERE ID = " . $_REQUEST['id'];

  mysqli_query($conn, $sql);
  //echo $sql;
}


if ($_REQUEST['formtype'] == 'NEW') {
  $sql = "INSERT INTO reminders ( ";
  $sql_cols = "SELECT * FROM  information_schema.columns WHERE TABLE_SCHEMA = '" . $table_schema . "' AND TABLE_NAME = '" . $table_name . "' AND COLUMN_KEY <> 'PRI'";
  $result_cols = mysqli_query($conn, $sql_cols);
  $numcols = mysqli_num_rows($result_cols);
  $i=0;
  while ($row_cols = mysqli_fetch_array($result_cols))
  {
    $sql .= $row_cols['COLUMN_NAME'];
    if ($i < $numcols - 1)
    {$sql .= ", ";}
    $i++;
  }
  $sql .= " ) VALUES ( ";
  $i=0;
  $result_cols = mysqli_query($conn, $sql_cols);
  while ($row_cols = mysqli_fetch_array($result_cols))
  {
    if ($row_cols['DATA_TYPE'] == 'tinyint')
    {
      if (isset($_REQUEST[$row_cols['COLUMN_NAME']]))
      { $sql .= "1"; }
      else {$sql .= "0";}
    }
    else
    {
      if ($row_cols['CHARACTER_SET_NAME'] == 'utf8' || $row_cols['DATA_TYPE'] == 'date' || $row_cols['DATA_TYPE'] == 'datetime')
      {$sql .= "'" . $_REQUEST[$row_cols['COLUMN_NAME']] . "'";}
      else
      {
        if ($_REQUEST[$row_cols['COLUMN_NAME']] != null)
        {$sql .= $_REQUEST[$row_cols['COLUMN_NAME']];}
        else {$sql .= "0";}
      }
    }
    if ($i < $numcols - 1)
    { $sql .= ", "; }
    $i++;
  }
  $sql .= " ) ";

  mysqli_query($conn, $sql);
  //echo $sql;
}

if (strlen($_REQUEST['category']) > 1)
{
  $sql = "SELECT COUNT(ID) FROM categories WHERE category = '" . $_REQUEST['category'] . "'";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_array($result);
  if ($row[0] == 0)
  {
    $sql_ins = "INSERT INTO categories ( category, colorID ) VALUES ( '" . $_REQUEST['category'] . "', (SELECT ID FROM w3_colors ORDER BY RAND() LIMIT 1) )";
    //echo $sql_ins;
    mysqli_query($conn, $sql_ins);
  }
}

if ($_REQUEST['event'] == 'YES')
{
  if($_REQUEST['formtype'] == 'EDIT')
  {
    $sql_x = "DELETE FROM events WHERE reminderID = " . $_REQUEST['id'];
    mysqli_query($conn, $sql_x);
    delete_event($_REQUEST['id']);
  }

  $start = date_format(date_create($_REQUEST['notificationtime']), DATE_ATOM);
  $start = str_replace("+00", "-05", $start);

  $eguid = insert_event($_REQUEST['description'], $start);

  $sql_event = "INSERT INTO events ( summary, notificationtime, reminderID, evernote_guid ) VALUES ( ";
  $sql_event .= "'" . $_REQUEST['description'] . "', ";
  $sql_event .= "'" . $start . "', ";
  if (strlen($_REQUEST['id']) > 1)
  { $sql_event .= $_REQUEST['id']; }
  else { $sql_event .= "(SELECT MAX(ID) FROM reminders)"; }
  $sql_event .= ", '" . $eguid . "'";
  $sql_event .= " ) ";
  mysqli_query($conn, $sql_event);

  $sql_upd_rem = "UPDATE reminders SET eventID = (SELECT MAX(ID) FROM events) WHERE ID = ";
  if ($_REQUEST['formtype'] == 'EDIT')
  { $sql_upd_rem .= $_REQUEST['id']; }
  else { $sql_upd_rem .= "(SELECT MAX(ID) FROM reminders)"; }
  mysqli_query($conn, $sql_upd_rem);

  header('location: homepage2.php');
}
else
{
  header('location: homepage2.php');
}



?>




</html>
