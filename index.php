<?php
session_start();
include 'simple-html-dom.php';
if(isset($_POST['submit'])){
	$plink = $_POST['link'];
	if(!empty($plink)){
		if(strpos($plink, 'instagram.com/tv/')){
			$api_url = 'https://bigbangram.com/ing-post-api.php';
			$data = 'url='.$plink.'&dowload=igtv';
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $api_url);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$server_output = curl_exec($ch);
			if(strpos($server_output, 'private account')){
				$_SESSION['alert'] = '<div class="alert alert-danger alert-white rounded"><div class="icon"><i class="fa fa-times-circle"></i></div><strong>Privete Account or Invalid url.</strong></div><br>';
			}else{
				$_SESSION['alert'] = '<div class="alert alert-success alert-white rounded"><div class="icon"><i class="fa fa-check"></i></div><strong>Success!</strong></div><br>';
				$_SESSION['success'] = 'success.';
				$html = str_get_html($server_output);
				$imgs = $html->find('div[class=for-img] video, div[class=for-img] img');
				$dlink = $html->find('a[rel=noopener noreferrer]');
			}
		}else{
			$api_url = 'https://bigbangram.com/ing-post-api.php';
			$data = 'url='.$plink.'&dowload=post';
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $api_url);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$server_output = curl_exec($ch);
			if(strpos($server_output, 'private account')){
				$_SESSION['alert'] = '<div class="alert alert-danger alert-white rounded"><div class="icon"><i class="fa fa-times-circle"></i></div><strong>Privete Account or Invalid url.</strong></div><br>';
			}else{
				$_SESSION['alert'] = '<div class="alert alert-success alert-white rounded"><div class="icon"><i class="fa fa-check"></i></div><strong>Success!</strong></div><br>';
				$_SESSION['success'] = 'success.';
				$html = str_get_html($server_output);
				$imgs = $html->find('div[class=for-img] video, div[class=for-img] img');
				$dlink = $html->find('a[rel=noopener noreferrer]');
			}
		}
	}else{
		$_SESSION['alert'] = '<div class="alert alert-danger alert-white rounded"><div class="icon"><i class="fa fa-times-circle"></i></div><strong>Url cannot be empty.</strong></div><br>';
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>INSTAGRAM DOWNLOADER!</title>
	<meta name="viewport" content="width=device-width, user-scalable=no"/>
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
	<link rel="shortcut icon" type="image/x-icon" href="https://i.ibb.co/C8zmhhx/instagram-astar.png"/>
	<style>
		*{
			padding: 0;
			margin: 0;
		}
		body{
			background:linear-gradient(90deg, #405de6, #5851db, #833ab4, #c13584, #e1306c, #fd1d1d);
		}
		img {
			border: 1px solid #ddd;
			border-radius: 4px;
			padding: 5px;
			width: 250px;
		}
		video {
			border: 1px solid #ddd;
			border-radius: 4px;
			padding: 5px;
			width: 250px;
		}
		.dlsection a{
			color: #ffffff;
			background-color: rgb(92, 184, 92);
			text-decoration: none;
			font-size: 13px;
			font-family: sans-serif;
			padding: 5px;
		}
		.dlsection a:hover{
			background-color: #364956;
			color: #ffffff;
		}
		.container{
			max-width: 290px;
			padding: 50px 30px;
			background: #ffffff;
			margin: 10% auto;
			text-align: center;
			box-shadow: 0 2px 26px 0 #6F6F6F, 0 2px 26px 0 #6f6f6f;
		}
		input[type=text]{
			width: 90%;
			height: 20px;
			display: inline-block;
			outline: 0;
			border: 0;
			padding: 5px;
			border-bottom: 3px solid #8134af;
		}
		input:focus[type=text]{
			border-bottom: 3px solid #d9534f;
			transition: .5s;
		}
		.button {
			height: 35px;
			width: 95%;
			background: linear-gradient(90deg, #405de6, #5851db, #833ab4, #c13584, #e1306c, #fd1d1d);
			border: 0;
			color: #FFFFFF;
			font-weight: bold;
			padding: 7px 13px;
			outline: 0;
			text-decoration: none;
		}
		.button:hover{
			background: linear-gradient(90deg, #fd1d1d, #e1306c, #c13584, #833ab4, #5851db, #405de6);
			outline: 0;
		}
		.bless{
			font-size: 13px;
			color: #FF0081;
			font-family: "Times new Roman";
		}
		h2{
			color: #8134af;
			font-family: "Times new Roman";
		}
		.close {
		    float: right;
		    font-size: 21px;
		    font-weight: bold;
		    line-height: 1;
		    color: #000;
		    text-shadow: 0 1px 0 #fff;
		    opacity: .2;
		}

		.close:hover,.close:focus {
		    color: #000;
		    text-decoration: none;
		    cursor: pointer;
		    opacity: .5;
		}

		button.close {
		    padding: 0;
		    cursor: pointer;
		    background: transparent;
		    border: 0;
		    -webkit-appearance: none;
		}

		.alert {
		    padding: 15px;
		    width: 67%;
		    margin: auto;
		    border: 1px solid transparent;
		    border-radius: 4px;
		}

		.alert h4 {
		    margin-top: 0;
		    color: inherit;
		}

		.alert .alert-link {
		    font-weight: bold;
		}

		.alert>p,.alert>ul {
		    margin-bottom: 0;
		}

		.alert>p+p {
		    margin-top: 5px;
		}

		.alert-dismissable {
		    padding-right: 35px;
		}

		.alert-dismissable .close {
		    position: relative;
		    top: -2px;
		    right: -21px;
		    color: inherit;
		}

		.alert-success {
		    background-color: #dff0d8;
		    border-color: #d6e9c6;
		    color: #3c763d;
		}

		.alert-success hr {
		    border-top-color: #c9e2b3;
		}

		.alert-success .alert-link {
		    color: #2b542c;
		}

		.alert-info {
		    background-color: #d9edf7;
		    border-color: #bce8f1;
		    color: #31708f;
		}

		.alert-info hr {
		    border-top-color: #a6e1ec;
		}

		.alert-info .alert-link {
		    color: #245269;
		}

		.alert-warning {
		    background-color: #fcf8e3;
		    border-color: #faebcc;
		    color: #8a6d3b;
		}

		.alert-warning hr {
		    border-top-color: #f7e1b5;
		}

		.alert-warning .alert-link {
		    color: #66512c;
		}

		.alert-danger {
		    background-color: #f2dede;
		    border-color: #ebccd1;
		    color: #a94442;
		}

		.alert-danger hr {
		    border-top-color: #e4b9c0;
		}

		.alert-danger .alert-link {
		    color: #843534;
		}

		.alert {
		    border-radius: 0;
		    -webkit-border-radius: 0;
		    box-shadow: 0 1px 2px rgba(0,0,0,0.11);
		}

		.alert .sign {
		    font-size: 20px;
		    vertical-align: middle;
		    margin-right: 5px;
		    text-align: center;
		    width: 25px;
		    display: inline-block;
		}

		.alert-success {
		    background-color: #dbf6d3;
		    border-color: #aed4a5;
		    color: #569745;
		}

		.alert-info {
		    background-color: #d9edf7;
		    border-color: #98cce6;
		    color: #3a87ad;
		}

		.alert-warning {
		    background-color: #fcf8e3;
		    border-color: #f1daab;
		    color: #c09853;
		}

		.alert-danger {
		    background-color: #f2dede;
		    border-color: #e0b1b8;
		    color: #b94a48;
		}

		.alert-white {
		    background-image: linear-gradient(to bottom,#FFFFFF,#F9F9F9);
		    border-top-color: #d8d8d8;
		    border-bottom-color: #bdbdbd;
		    border-left-color: #cacaca;
		    border-right-color: #cacaca;
		    color: #404040;
		    padding-left: 61px;
		    position: relative;
		}

		.alert-white .icon {
		    text-align: center;
		    width: 45px;
		    height: 100%;
		    position: absolute;
		    top: -1px;
		    left: -1px;
		    border: 1px solid #bdbdbd;
		}

		.alert-white .icon:after {
		    -webkit-transform: rotate(45deg);
		    -moz-transform: rotate(45deg);
		    -ms-transform: rotate(45deg);
		    -o-transform: rotate(45deg);
		    -webkit-transform: rotate(45deg);
		    display: block;
		    content: '';
		    width: 10px;
		    height: 10px;
		    border: 1px solid #bdbdbd;
		    position: absolute;
		    border-left: 0;
		    border-bottom: 0;
		    top: 50%;
		    right: -6px;
		    margin-top: -5px;
		    background: #fff;
		}

		.alert-white.rounded {
		    border-radius: 3px;
		    -webkit-border-radius: 3px;
		}

		.alert-white.rounded .icon {
		    border-radius: 3px 0 0 3px;
		    -webkit-border-radius: 3px 0 0 3px;
		}

		.alert-white .icon i {
		    font-size: 20px;
		    color: #FFF;
		    left: 12px;
		    margin-top: -10px;
		    position: absolute;
		    top: 50%;
		}

		.alert-white.alert-danger .icon,.alert-white.alert-danger .icon:after {
		    border-color: #ca452e;
		    background: #da4932;
		}

		.alert-white.alert-info .icon,.alert-white.alert-info .icon:after {
		    border-color: #3a8ace;
		    background: #4d90fd;
		}

		.alert-white.alert-warning .icon,.alert-white.alert-warning .icon:after {
		    border-color: #d68000;
		    background: #fc9700;
		}

		.alert-white.alert-success .icon,.alert-white.alert-success .icon:after {
		    border-color: #54a754;
		    background: #60c060;
		}
		.dlsection{
			padding-bottom: 30px;
		}
	</style>
</head>
<body>
	<div class="container">
		<form method="POST">
			<h2><a href="index.php" style="text-decoration: none;">INSTAGRAM DOWNLOADER!</a></h2>
			<br>
			<?php
			if(isset($_SESSION['alert'])){
				echo $_SESSION['alert'];
			}
			if(!isset($_SESSION['alert'])){
			?>
			<input type="text" name="link" placeholder="Post or IGTV Url" autocomplete="off">
			<br><br>
			<input type="submit" name="submit" value="DOWNLOAD" class="button">
			<?php
				}else{
					if(isset($_SESSION['success'])){
						echo "<div class='dlsection'>";
								for ($i=0; $i < count($imgs); $i++) { 
									echo $imgs[$i]."<br>".$dlink[$i]."<br><br>";
								}
							echo "</div>";
					}
			?>
			<a href="index.php" class="button">TRY AGAIN!</a>
			<?php
		}
			$_SESSION['alert'] = null;
			$_SESSION['success'] = null;
		?>
		</form>
	</div>
	<!-- Design & Developed By: Al Sayeed(https://fb.me/AlSayeedOfficial) -->
</body>
</html>
