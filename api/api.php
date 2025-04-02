<?php header( 'Content-Type: text/html; charset=utf-8'); ?>
<?php 
//echo $_SERVER['REQUEST_METHOD'];
if($_SERVER['REQUEST_METHOD'] == "POST") {
    echo "POST request received<br>";
    
    if (isset($_POST["value"])&&isset($_POST["name"])&&isset($_POST["time"])) {
        file_put_contents("files/".$_POST["name"]."/value.txt", $_POST["value"]);
        file_put_contents("files/".$_POST["name"]."/time.txt", $_POST["time"]);
        file_put_contents("files/".$_POST["name"]."/name.txt", $_POST["name"]);
        file_put_contents("files/".$_POST["name"]."/log.txt", $_POST["time"].";".$_POST["value"].PHP_EOL, FILE_APPEND);
        print_r($_POST);
    }
    else
    {
        http_response_code(403);
        echo('{"error":"Missing parameters"}');
    }
  
}elseif($_SERVER['REQUEST_METHOD'] == "GET") {
    echo "GET request received<br>";
    if(isset($_GET["name"])) {
        $val=file_get_contents("files/".$_GET["name"]."/value.txt");
        print_r($val);
    } 
    else http_response_code(400);   
}else{
    http_response_code(403);
    echo "Method not allowed <br>";
}
?>
