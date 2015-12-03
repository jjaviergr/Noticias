<?php

include("connect.php");
if ($_POST['info']) {
    $id = $_POST['info'];
    $sql = $con->exec("delete from noticias where id=" . $id);
}