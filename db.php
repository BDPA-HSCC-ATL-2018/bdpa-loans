<?php

$dbh = new mysqli('localhost','root','','bankloan');

if(!$dbh->error){
//    echo "it worked";
} else {
    echo "it didn't work.";
}
?>