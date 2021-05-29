<?php
session_start();
//include('./mysqli_connect.php');

/*
if (!$_SESSION['username']) {
    //echo'<h1>connected</h1>';
    header('Location: ../login.php');
}
*/


if (!$_SESSION['username']|| $_SESSION['user_levels']==3) {
    //echo'<h1>connected</h1>';
    header('Location: ../login.php');


    //  $_SESSION['user_levels']
}


















/*
else {
    header('Location: ./mysqli_connect.php');
}*/
/*
if (!$_SESSION['username']) {
    header('Location: login.php');

}

*/

?>