<?php
$connection =  mysqli_connect('localhost','root','','school');

if (!$connection) {
    die("Sorry we failed to connect: ". mysqli_connect_error());
}

?> 