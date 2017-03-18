<?php

//Conection to the database
$server = "host";
$user = "user";
$pass = "pass";
$db = "db";

$conn = new mysqli($server, $user, $pass, $db);
$conn->set_charset("utf8");

if ($conn->connect_error) { 
    die();
}

//Obtain full url paht http or https
if ($_SERVER['HTTPS'])
{
    $web = "https://".htmlentities($_SERVER['HTTP_HOST']);
} else
{
    $web = "http://".htmlentities($_SERVER['HTTP_HOST']);
}


/*
#########################################
#############PRINT FUNCTIONS#############
#########################################
*/
function print_line($text)
{
    print("|".htmlentities($text));
    print(str_repeat(" ", (78 - mb_strlen($text))));
    print("|\n");
}

function print_title($title, $txt)
{
    print("+");
    print(str_repeat("=", 78));
    print("+\n||$title");
    if ($txt != "")
    {
        print(str_repeat(" ", (74 - mb_strlen($title))));
        print("<a href=\"$web/".htmlentities(str_replace(" ", "-", $title)).".txt\" target=\"_blank\"><b>txt</b></a>");
    } else {
        print(str_repeat(" ", (77 - mb_strlen($title))));
    }
    print("||\n+");
    print(str_repeat("=", 78));
    print("+\n");
}

function print_final()
{
    print("+");
    print(str_repeat("-", 78));
    print("+\n");
}
/*
#############################################
#############END PRINT FUNCTIONS#############
#############################################
*/

//Print article method get title
function print_text($title)
{
    global $conn;
    global $web;

    $title = mysqli_real_escape_string($conn, $title);
    $sql = "SELECT * FROM texts WHERE title='$title'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    if (count($row) != 4)
    {
        header("Location: $web/page/404");
        die();
    }

    print_title($title, "1");    

    $data = explode("\r\n", $row['text']);
    for($i = 0;$i < sizeof($data);$i++)
    {
        print_line($data[$i]);
    }

    print_final();

}

//Print raw text
function print_raw($title)
{   
    global $conn;
        
    $title = mysqli_real_escape_string($conn, $title);
    $sql = "SELECT * FROM texts WHERE title='$title'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    if (count($row) != 4)
    {
        header("Location: $web/page/404");
        die();
    }
    print($row['text']);
}

//Print last five text posted
function last_five()
{
    global $conn;
    global $web;

    print("<pre>");
    $text = "-Últimos 5:";
    print("$text");
    print(str_repeat(" ", (79 - mb_strlen($text))));
    print("\n\n");
    $sql = "SELECT * FROM texts ORDER BY id DESC LIMIT 5";
    $result = $conn->query($sql);
    $i = 1;
    while ($row = $result->fetch_assoc())
    {
        print("$i. ");
        print("<a href=\"$web/");
        print(htmlentities(str_replace(" ", "-",$row['title'])));
        print("\">");
        print(htmlentities($row['title']));
        print("</a>");
        print(str_repeat(" ", 79 - mb_strlen($row['title']) - 22 - mb_strlen($i)));
        $datetxt = "(".htmlentities($row['date']).")   <a href=\"$web/".htmlentities(str_replace(" ", "-",$row['title'])).".txt\" target=\"_blank\" >(txt)</a>";
        print($datetxt);
        print("\n");
        $i++;
    }
    print ("</pre>");
}

function print_all_text()
{
    global $conn;
    global $web;

    print("<pre>");
    print_title("Textos", "");
    $sql = "SELECT * FROM texts ORDER BY id DESC";
    $result = $conn->query($sql);
    $i = 1;
    while ($row = $result->fetch_assoc())
    {
        print("|$i. ");
        print("<a href=\"$web/");
        print(htmlentities(str_replace(" ", "-",$row['title'])));
        print("\">");
        print(htmlentities($row['title']));
        print("</a>");
        print(str_repeat(" ", 79 - mb_strlen($row['title']) - 23 - mb_strlen($i)));
        $datetxt = "(".htmlentities($row['date']).")   <a href=\"$web/".htmlentities(str_replace(" ", "-",$row['title'])).".txt\" target=\"_blank\" >(txt)</a>|";
        print($datetxt);
        print("\n");
        $i++;
    }
    print_final();
    print ("</pre>");
}

function print_contact()
{
    global $conn;
    global $web;

    print("<pre>");
    print("+");
    print(str_repeat("=", 78));
    print("+\n");
    print("||");
    $text = "Contactar";
    print("<b>$text</b>");
    print(str_repeat(" ", (77 - strlen($text))));
    print("||\n");
    print("+");
    print(str_repeat("=", 78));
    print("+\n");
    
    print("|Mails:");
    print(str_repeat(" ", 72));
    print("|\n");
    print("|\t<a href=\"mailto:a@v4char.com\">a@v4char.com</a>");
    print(str_repeat(" ", 59));
    print("|\n");
    print("|\t<a href=\"mailto:v4char@gmail.com\">v4char@gmail.com</a>");
    print(str_repeat(" ", 55));
    print("|\n");
    print("|".str_repeat(" ", 78)."|\n");
    print("|".str_repeat(" ", 78)."|\n");
    print("|Redes:".str_repeat(" ", 72)."|\n");
    print("|\t<a href=\"https://github.com/v4char\" target=\"_blank\">GitHub</a> ");
    print(str_repeat("  ", 32)."|\n");
    print("|\t<a href=\"https://www.facebook.com/v4char\" target=\"_blank\">Facebook</a> ");
    print(str_repeat("  ", 31)."|\n");
    print("|\t<a href=\"https://www.instagram.com/v4char/\" target=\"_blank\">Instagram</a>  ");
    print(str_repeat("  ", 30)."|\n");
    print("|\t<a href=\"https://twitter.com/v4char\" target=\"_blank\">Twitter</a>");
    print(str_repeat("  ", 32)."|\n"); 
    print("+");
    print(str_repeat("-", 78));
    print("+\n");
}
?>
