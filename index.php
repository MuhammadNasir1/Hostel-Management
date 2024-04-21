<?php
include("./includes/dbconn.php");
if (@!$_SESSION['login']) {
    header("Location: login.php");
}

$title = "HOME";
include("./includes/header.php");
?>



<?php
include("./includes/footer.php")
?>