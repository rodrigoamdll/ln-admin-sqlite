<?php
session_start();
session_destroy();
header("Location: login.php"); // o: header("Location: ./login.php");
exit;
