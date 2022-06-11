<?php 
include('connection.php');
include('header.php');
include('menu.php');
include('sessionadmin.php');
if(empty($_GET['p']))
{
    $page   = 'admin';
}
else
{
    $page   = $_GET['p'];
    if($page=='logout')
    {
        session_unset();
        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=login.php">';
    }    
}
if(isset($_GET['t']))
{
	$tab   = $_GET['t'];
}
if(isset($_GET['a']))
{
    $action = $_GET['a'];
}
if(isset($_GET['id']))
{
    $id     = $_GET['id'];
}
if(isset($_GET['sa']))
{
    $subact = $_GET['sa'];
}
if(isset($_GET['sty']))
{
    $subtyp = $_GET['sty'];
}
if(isset($_GET['sid']))
{
    $sid 	= $_GET['sid'];
}   
include($page.'.php');    
include('footer.php');
?>