<?php

include('./includes/dbconn.php');

session_destroy();

header('location: ./login.php');
