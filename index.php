<?php
session_start();
if (isset($_GET["unset"]))
{
	session_unset();
	session_destroy();
}
require_once("includes/All.php");
echo <<<START
<html>
	<head>
	<title>Awesome Battleships Battles</title>
	<style>
	body { background-color:black; }
	</style>
	</head>

<body>
<center>
<object width="1750" height="900">
    <param name="movie" value="WARHAMMER.swf">
</object>
</center>
</body>
<footer>
<center><a href ="?unset">Click here to clear cookie for new game !</a></center>
</footer>
</html>
START;
?>