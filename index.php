<?php
// ini_set('display_errors', 'On');

$id = $_GET['id'];

if (is_numeric($id)) {
  $db = new SQLite3('notaris.db');
  $guid = $db->querySingle("SELECT guid from notaris where id=$id");

  if ($guid) {
    header("Location: https://hetutrechtsarchief.nl/collectie/$guid");
  }
}
?>