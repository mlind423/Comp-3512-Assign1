<?php
session_start();
if(!empty($_GET["AddID"])){
    $_SESSION["Song" . $_GET['AddID']] = $_GET["AddID"];
}
header("Location: Favorites.php?curr=f");
exit();
?>