<title> Log Out Page </title>
<?php

session_start();
$_SESSION=array();
session_destroy() ;
header("refresh : 3 ; url :login form.php") ;

?>
