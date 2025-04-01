<?php
session_start(); //tells the browser to use session variables;  

session_unset();    // remove all session variables ;

session_destroy();  // destroy the session;
header( "refresh:0;url=index.php" ); 
?>