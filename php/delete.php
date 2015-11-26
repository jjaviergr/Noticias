<?php

include("connect.php");
echo $_POST['info'];
if ($_POST['info']) {
    $id = $_POST['info'];
    $sql = $con->exec("delete from noticias where id=" . $id);
}