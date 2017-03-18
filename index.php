<?php 
    require_once("config.php"); 
    require_once("struct.php");
    html_head("");
    html_menu();
    if (isset($_GET['title']))
    {
        print_text(str_replace("-", " ", $_GET['title']));
    } else {
        print_text("Inicio");
        print("\n\n");
        last_five();
    }
    if (isset($_GET['type']))
    {
        print($_GET['type']);
    }
    html_footer();
?>
