<html><head><link rel="stylesheet" type="text/css" href="stile.css"></head>
<body>
<a href='index.php?p=calendario'><div id="logo"></div></a>
<center><div id="titolo"><h1>Dungeons and Diary</h1></div></center><br>
<div id="wrapper">
<div id="content">
<?php
			if(isset($_GET["p"])){
				$pagina=$_GET["p"];
				include($pagina.".php");
			}
?>

</div>
</div>
</body>
</html>