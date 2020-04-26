<?php
function doDB() {
    global $mysqli;

    //$mysqli = mysqli_connect("localhost", "root", "", "theSuperForum");
    $mysqli = mysqli_connect("localhost", "lisabalbach_wingd", "CIT19020022", "lisabalbach_wingd");

    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }
}
?>