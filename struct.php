<?php

function html_head($title)
{
    global $web;

    print("<!DOCTYPE html>");
    print("<html>");
    print("<head>");
    print("<meta charset=\"utf-8\">");
    print("<meta name=\"description\" content=\"Web orientada a la sefuridad infomática, programación y tecnología.\">");
    print("<link rel=\"shortcut icon\" href=\"$web/favicon.ico\" />");
    print("<title>v4char - ");
    if($title != "")
    {
        print($title);
    } else
    {
        if (isset($_GET['title']) || $_GET['title'] != "") {
            print(htmlentities(str_replace("-", " ", $_GET['title'])));
        } else {
            print("Inicio");
        }
    }
    print("</title>");
    print("<link rel=\"stylesheet\" type=\"text/css\" href=\"$web/main.css\">");
    print("</head>");
    print("<body>");
    print("<section>");
    print("<pre>\n");
    print("       _  _        _                \n");
    print("__   _| || |   ___| |__   __ _ _ __ \n");
    print("\ \ / / || |_ / __| '_ \ / _` | '__|\n");
    print(" \ V /|__   _| (__| | | | (_| | |   \n");
    print("  \_/    |_|  \___|_| |_|\__,_|_|   \n");
}

function html_menu()
{
    global $web;

    print("\n\n");
    print("[ <a href=\"$web\">Inicio</a> ]");
    print("<p>[ <a href=\"$web/page/texts\">Textos</a> ]</p>");
    print("<p>[ <a href=\"$web/page/contact\">Contacto</a> ]</p>");
    print("\n\n\n\n");
}

function html_footer()
{
    print("\n\n\n<footer>");
    print("[ Desing by <a href=\"mailto:v4char@gmail.com\">v4char</a> ]");
    print("</footer>\n");
    print("</pre>");
    print("</section>");
    print("</body>");
    print("</html>");
}
?>
