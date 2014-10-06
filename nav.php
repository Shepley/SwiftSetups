<?php
//var_dump($_SESSION);
?>
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Lato:100,300,400' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="resources/css/main.css">
<style>
.container{
	width:80%;
	margin: 0 auto;
}
body{
	background:#1570B7;
	margin:0;
	width:100%;
	min-height:100%;
}
header{
	width:100%;
	height:50px;
	background:white;
}
</style>
<?php
include 'countsetups.php';
$setup_nav_badge = $countsetups;
?>
<header>
<body>
<div class="container">
	<div class="logocontainer">
		<a href="/index"><img draggable="false" src="resources/img/swiftlogocasual.png" class="logo"></img></a>
	</div>
	<div class="mainmenu">
		<?php if($_SESSION['permissionStaff']){
		echo '
		<a href="/index" class="text"><li class="menuitem">Dashboard</li></a>
		<a href="/setups" class="text"><li class="menuitem">Setups <span class="badge">'.$setup_nav_badge.'</span></li></a>
		<a href="/logout" class="gamea"><li class="menubtn"><span class="glyphicon glyphicon-off"></span></li></a>';
	} elseif($_SESSION['permissionAdmin']){
		echo '
		<a href="/index" class="text"><li class="menuitem">Dashboard</li></a>
		<a href="/setups" class="text"><li class="menuitem">Setups  <span class="badge">'.$setup_nav_badge.'</span></li></a>
		<a href="/analytics" class="text"><li class="menuitem">Analytics</li></a>
		<a href="/sponsorships" class="text"><li class="menuitem">Sponsorships</li></a>
		<a href="/staff" class="text"><li class="menuitem">Staff management</li></a>
		<a href="/logout" class="gamea"><li class="menubtn"><span class="glyphicon glyphicon-off"></span></li></a>';
	} else {
		echo '<a href="/sponsorships" class="text"><li class="menuitem">Apply for a sponsorship</li></a>';
		echo '<a href="/login" class="text"><li class="menuitem">Login</li></a>';
	}
	?>
	</div>
</div>
</body>
</header>
