<?php
header("Content-Type: text/plain");
require_once("config.php");
if (isset($_GET['title']))
{
    print_raw(str_replace("-", " ", $_GET['title']));
} else {
    header("Location: $web/page/404");
    die();
}
?>
