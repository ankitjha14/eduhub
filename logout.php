<?php
session_start();
echo "<script> window.top.location='index.php'</script>";
session_destroy();
?>