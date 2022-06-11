<?php
require('connection.php');
$now 		= date('Y-m-d H:i:s');
$user		= $_SESSION['username'];
$query		= mysqli_query($con,"SELECT * from admin WHERE username='$user'");
$sum_query	= mysqli_num_rows($query);
if($sum_query>0)
{
	$data_query	= mysqli_fetch_array($query);
	$username	= $data_query['username'];
	$access		= $data_query['access'];
	$access_admin= explode("/", $access);
	$visible	= $data_query['visible'];
}
else
{
	session_unset();
    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=login.php">';
}
?>