<?php
session_start();
session_unset();
session_destroy();
header('Location: road_to_admin.php');
exit;
?>
