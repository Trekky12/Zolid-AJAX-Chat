<?php

$index_url = './index.php';
$request = $_POST['request'];

if(isset($request)) {
    
$dbhost = 'localhost'; //Database Name, use localhost if hosted on the same machine
$dbname = ''; //Database Name
$dbuser = ''; //Database User
$dbpass = ''; //Database Password

$con = mysql_connect($dbhost,$dbuser,$dbpass) or die("MYSQL CONNECTION ERROR: " . mysql_error());

mysql_select_db($dbname);
    
if($request == 'clear_data_all') {
    
    $query = mysql_query("DELETE FROM `chat`");
    
    if($query) {
        
        $reply = "REQUEST $request COMPLETED";
        
        } else {
            
            $reply = "REQUEST $request FAILED";
            
            }

    } else if ($request == 'clear_data_user') {
        
        $by = $_REQUEST['user'];
        
           $query = mysql_query("DELETE FROM `chat` WHERE `by` = '$by'");
    
    if($query) {
        
        $reply = "REQUEST $request COMPLETED";
        
        } else {
            
            $reply = "REQUEST $request FAILED";
            
            }
            
        } else if ($request == 'clear_data_last') {
            
            $n = $_REQUEST['n'];
             
            $query = mysql_query("DELETE FROM `chat` LIMIT $n");
    
    if($query) {
        
        $reply = "REQUEST $request COMPLETED. CLEARED $n RECORDS";
        
        } else {
            
            $reply = "REQUEST $request FAILED";
            
            }
            
        } else {
            
             $reply = "UNKNOWN ACTION: $request";
             
             } 
             
             
    
    
    mysql_close($con);
            
       
        } else {
            
            $reply = "REQUEST NOT RECEIVED";
            }
            
     echo "<center><br><br><br><p>You will be redirected in about 2 seconds. If not, click this link: <a href='http://fvybyhuj.fluctis.com/admin/index.php?reply_chat=$reply'>Back</a></p></center>";
            
        ?>
        <html>
        <head>
        <meta http-equiv="refresh" content="2;url=<?php echo "$index_url"; ?>?reply_chat=<?php echo "$reply"; ?>" />
         <link rel="shortcut icon" href="https://italiansystemhosting.com/en/img/favicon.ico" type="image/x-icon" />
<link rel="apple-touch-icon" href="https://italiansystemhosting.com/en/img/apple-touch-icon.png" />
<link rel="apple-touch-icon" sizes="57x57" href="https://italiansystemhosting.com/en/img/apple-touch-icon-57x57.png" />
<link rel="apple-touch-icon" sizes="72x72" href="https://italiansystemhosting.com/en/img/apple-touch-icon-72x72.png" />
<link rel="apple-touch-icon" sizes="76x76" href="https://italiansystemhosting.com/en/img/apple-touch-icon-76x76.png" />
<link rel="apple-touch-icon" sizes="114x114" href="https://italiansystemhosting.com/en/img/apple-touch-icon-114x114.png" />
<link rel="apple-touch-icon" sizes="120x120" href="https://italiansystemhosting.com/en/img/apple-touch-icon-120x120.png" />
<link rel="apple-touch-icon" sizes="144x144" href="https://italiansystemhosting.com/en/img/apple-touch-icon-144x144.png" />
<link rel="apple-touch-icon" sizes="152x152" href="https://italiansystemhosting.com/en/img/apple-touch-icon-152x152.png" />
    <title>Zolid-Ajax-Chat-Admin-Extension</title>
        </head>
        </html>
