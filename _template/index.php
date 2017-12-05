<?php
$title = "Template Dashboard";
?><!doctype html>
<html>
<head>
	<title><?php echo $title; ?></title>
	<link type="image/ico" href="" rel="shortcut icon"></link>
	<style>
	*{
		padding: 0;
		margin: 0;
	}
	body {
		font: 14px arial;
		background: #EEEEEE;
		border-top: 10px solid #333333;
	}
	@media (min-width: 530px){
		.container{
			width: 500px;
		}
	}
	.container{
		padding: 0 15px;
		margin: 80px auto 50px
	}
	.container .dir,
	.container .file{
		background: #FFFFFF;
		padding: 20px;
		margin-bottom: 20px;
	}
	.container .dir .title,
	.container .file .title{
		font-size: 20px;
		color: #333333;
	}
	.container ul{
		list-style: none;
		margin-top: 10px;
	}
	.container ul li{
		position: relative;
		height: 26px;
		margin-bottom: 1px;
	}
	.container ul li .bg2{
		width: 0%;
		height: 26px;
		background: #F3F6F3;
		float: left;
		transition: all 0.25s linear 0s;
	}
	.container ul li:hover .bg2{
		width: 100%;
	}
	.container ul li a{
		text-decoration: none;
		color: #5e5e5e;
		transition: all 0.15s linear 0s;
	}
	.container ul li a .link{
		padding: 5px 10px;
		position: absolute;
		width: 96%;
	}
	</style>
</head>
<body>
<div class="container">
	<div class="dir">
		<span class="title"><?php echo $title; ?></span>
		<ul>
			<?php
			if ($handle = opendir('./')) {

				while (false !== ($dir = readdir($handle))) {
					if($dir != "." and $dir != ".." and !is_dir($dir) and !in_array($dir, [
							'index.php',
							'notes.md'
						])){
						echo '
						<li>
							<div class="bg2"></div>
							<a href="'.urlencode($dir).'"><div class="link">'.explode(".", $dir)[0].'</div></a>
						</li>';
					}
				}
				closedir($handle);
			}
			?>
		</ul>
	</div>
</div>
</body>
</html>
