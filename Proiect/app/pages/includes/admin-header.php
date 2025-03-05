<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Biblioteca Muzicala</title>
	<link rel = "stylesheet" type = "text/css" href="<?=ROOT?>/assets/css/style.css?48">
</head>
<body>
	<style>
		header a{
			color: white;
		}

		.dropdown-list{
			background-color: #2C0203;
		}
	</style>
	
	<header style="background-color: #2C0203;color: white;">
		<div class="logo-holder"> 
		<a href = "<?=ROOT?>"><img class= "logo" src ="<?=ROOT?>/assets/images/logo.png"></a>
		</div>
		<div class = "header-div">
			<div class="main-title" > ADMIN PANEL </div>
			<div class="main-nav">
				<div class= "nav-item"><a href ="<?=ROOT?>/admin/dashboard"> Dashboard </a> </div>
				<div class= "nav-item"><a href ="<?=ROOT?>/admin/songs"> Songs </a> </div>
				<div class= "nav-item"><a href ="<?=ROOT?>/admin/users"> Users </a> </div>
				<div class= "nav-item"><a href ="<?=ROOT?>/admin/categories"> Categories </a> </div>
				<div class= "nav-item"><a href ="<?=ROOT?>/admin/bands"> Bands </a> </div>
				<div class= "nav-item"><a href ="<?=ROOT?>/admin/albums"> Albums</a> </div>
				<div class= "nav-item"><a href ="<?=ROOT?>/admin/artists"> Artists</a> </div>
				
				<div class= "nav-item dropdown">
					<a href ="#"> Hi, <?=user('username')?></a>
						<div class = "dropdown-list">
						<div class = "nav-item"><a href="<?=ROOT?>/admin/users/edit/<?=user('id')?>">Profile</a> </div>
						<div class = "nav-item"><a href="<?=ROOT?>">Website</a> </div>
						<div class = "nav-item"><a href="<?=ROOT?>/logout">Logout</a> </div>
					</div>
				 </div>
			</div> 
		</div>
	</header>	

	<?php if (message()):?>
			<div class = "alert"><?=message('', true)?></div>
		<?php endif;?>