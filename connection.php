<?php
//connection to database
$mysqli=new mysqli('localhost','root',
''
,
'camping');
// server Name, User Name, PassWord,Database Name
if($mysqli -> connect_error)
{
die('Connection Error ('.$mysqli -> connect_errno . ')'. $mysqli
-> connect_error );
}


?>