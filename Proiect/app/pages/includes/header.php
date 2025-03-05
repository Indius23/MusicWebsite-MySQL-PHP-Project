<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>MUSIC LIBRARY</title>
	<link rel = "stylesheet" type = "text/css" href="<?=ROOT?>/assets/css/style.css">
</head>
<body>
	<style>

	</style>
	
	<header style="background-color: white;color: white;">
		<div class="logo-holder"> 
		<a href = "<?=ROOT?>"><img class= "logo" src ="<?=ROOT?>/assets/images/logo.png" style="height: 100%;"></a>
		</div>
		<div class = "header-div">
			<div class="main-title" style="color:#2C0203;" > MUSIC LIBRARY</div>
			<div class="main-nav">
				<div class= "nav-item"><a href ="<?=ROOT?>"> Home </a> </div>
				<div class= "nav-item dropdown">
					<a href ="#"> Categories </a>

					<?php
  			$query = "select * from categories";
  			$banduri = db_query($query);
  		?>
  				
					<div class = "dropdown-list">
						<?php if(!empty($banduri)):?>
  					<?php foreach($banduri as $bnd):?>
				<div class = "nav-item"><a href=""><?=$bnd['categorie']?></a> </div>
  				  			<?php endforeach;?>
  			<?php endif;?>	

					</div>
					 </div>
				
				<div class= "nav-item"><a href ="<?=ROOT?>/bands"> Bands </a> </div>
				<div class= "nav-item"><a href ="<?=ROOT?>/albums"> Albums</a> </div>
				<div class= "nav-item"><a href ="<?=ROOT?>/about"> About us </a> </div>
				<?php if (logged_in()):?>
				<div class= "nav-item dropdown">
					<a href ="#"> Hi, <?=user('username')?></a>
						<div class = "dropdown-list">
						<div class = "nav-item"><a href="<?=ROOT?>/admin/users/edit/<?=user('id')?>">Profile</a> </div>
						<div class = "nav-item"><a href="<?=ROOT?>/admin">Admin</a> </div>
						<div class = "nav-item"><a href="<?=ROOT?>/logout">Logout</a> </div>
					</div>
				 </div>
				<?php endif;?>
			</div> 
		</div>
	</header>	