<?php


    require_once("php/DBConn.php");
    require_once("php/define.php");
    $dbconn = new dbconn($db_dbname);

    if($_POST['user'] != "")
    {
        $user = $_POST['user']; 
    }else{
        $user = "匿名"; 
    }

    $name = $_GET['type'];
    $message = $_POST['message'];
   
    $dbconn = new dbconn($db_dbname);

    $SQLcmd = "INSERT INTO message (user,name,msg) VALUES (:USER,:NAME,:MSG)";
    $var = array( ':USER'=>$user,':NAME'=>$name,':MSG'=>$message);
    $dbconn->insertData( $SQLcmd, $var );

    echo "<script type='text/javascript'>alert('新增成功!');</script>";

    $url = "index.php";
    echo "<script type='text/javascript'>";
    echo "window.location.href='$url'";
    echo "</script>"; 


?>