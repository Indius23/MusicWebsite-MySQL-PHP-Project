<?php

if($action == 'add'){



	if($_SERVER['REQUEST_METHOD'] == "POST")
	{	
		$errors = [];

		if(empty($_POST['titlu']))
		{
			$errors['titlu'] = "a name is required";
		}else
		if(!preg_match("/^[a-zA-Z \&\-]+$/", $_POST['titlu']))
		{
			$errors['titlu'] = "a name can only have letters & spaces";
		}


		if(empty($errors))
		{	
			$values = [];
			$values['titlu'] = trim($_POST['titlu']);
			$values['durata_melodie'] = trim($_POST['durata_melodie']);
			$values['id_categorie'] = trim($_POST['id_categorie']);
			$values['id_album'] = trim($_POST['id_album']);
			$query = "insert into songs (titlu,durata_melodie,id_categorie,id_album) values (:titlu,:duratadurata_melodie,:id_categorie,:id_album)";
			db_query($query, $values);

			message("Song created successfully!!!");
			redirect('admin/songs');
		}

		
		
	}
}else

if($action == 'edit'){

	$query = "select * from songs where id = :id limit 1";
  		$row = db_query_one($query,['id'=>$id]);

	if($_SERVER['REQUEST_METHOD'] == "POST" && $row)
	{	
		$errors = [];
 	
		if(empty($_POST['titlu']))
		{
			$errors['titlu'] = "a titlu is required";
		}else
		if(!preg_match("/^[a-zA-Z \&\-]+$/", $_POST['titlu']))
		{
			$errors['titlu'] = "a title can only have letters";
		}


		if(empty($errors))
		{	
			$values = [];
			$values['titlu'] = trim($_POST['titlu']);
			$values['durata_melodie'] = trim($_POST['durata_melodie']);
			$values['id'] = $id; 

			$query = "update songs set titlu= :titlu, durata_melodie = :durata_melodie where id= :id limit 1";
			db_query($query, $values);

			message("song edited successfully!!!");
			redirect('admin/songs');
		}

		
		
	}
}else 
	if($action == 'delete'){

	$query = "select * from songs where id = :id limit 1";
  		$row = db_query_one($query,['id'=>$id]);

	if($_SERVER['REQUEST_METHOD'] == "POST" && $row)
	{	
		$errors = [];


		if(empty($errors))
		{	
			$values = [];
			$values['id'] = $id; 

			$query = "delete from songs where id = :id limit 1";
			
			db_query($query, $values);

			message("category deleted successfully!!!");
			redirect('admin/songs');
		}

		
		
	}
}

?>
<?php require page('includes/admin-header')?>

	<section class = "admin-content" style = "min-height: 200px;">


  <?php if($action == 'add'):?>
  	<div style ="max-width: 500px;margin: auto;">
  		<form method="post">
  			
  			<h3>Add New Song</h3>

  			<input class="form-control my-1"  value="<?=set_value('titlu')?>" type="text" name="titlu" placeholder="Title">
  			<?php if(!empty($errors['titlu'])):?>		
  			<small class="error"><?=$errors['titlu']?></small>
  		<?php endif;?>

  			<input class="form-control my-1"  value="<?=set_value('durata_melodie')?>" type="text" name="durata_melodie" placeholder="Duration">
  			<?php if(!empty($errors['durata_melodie'])):?>		
  			<small class="error"><?=$errors['durata_melodie']?></small>durata_melodie
  		<?php endif;?>
  

  		<?php
  			$query = "select * from categories";
  			$banduri = db_query($query);
  		?>
  			<select name="id_categorie" class = "form-control my-1">
  				<option value="">--Category--</option>
  				<?php if(!empty($banduri)):?>
  					<?php foreach($banduri as $bnd):?>
  				<option <?=set_select('id_categorie', $bnd['id'] )?> value="<?=$bnd['id']?>"><?=$bnd['categorie']?></option>
  				  			<?php endforeach;?>
  			<?php endif;?>	
  			</select>
  			<?php if(!empty($errors['id_categorie'])):?>		
  			<small class="error"><?=$errors['id_categorie']?></small>
  		<?php endif;?>

  		<?php
  			$query = "select * from albums";
  			$banduri = db_query($query);
  		?>
  			<select name="id_album" class = "form-control my-1">
  				<option value="">--Album--</option>
  				<?php if(!empty($banduri)):?>
  					<?php foreach($banduri as $bnd):?>
  				<option <?=set_select('id_album', $bnd['id'] )?> value="<?=$bnd['id']?>"><?=$bnd['titlu']?></option>
  				  			<?php endforeach;?>
  			<?php endif;?>	
  			</select>
  			<?php if(!empty($errors['id_album'])):?>		
  			<small class="error"><?=$errors['id_album']?></small>
  		<?php endif;?>

  			<button class ="btn bg-purple">Save</button>
  			<a href="<?ROOT?>/admin/songs">
  			<button type="button" class="float-end btn">Back</button>
  		</a>
  		</form>
  	</div>
  <?php elseif($action == 'edit'):?>



  		<div style ="max-width: 500px;margin: auto;">
  		<form method="post">
  			
  			<h3>Edit Song</h3>

  			<?php if(!empty($row)):?>
  			<input class="form-control my-1"  value="<?=set_value('titlu', $row['titlu'])?>" type="text" name="titlu" placeholder=" Title">
  			<?php if(!empty($errors['titlu'])):?>		
  			<small class="error"><?=$errors['titlu']?></small>
  		<?php endif;?>

  			<?php if(!empty($row)):?>
  			<input class="form-control my-1"  value="<?=set_value('durata_melodie', $row['durata_melodie'])?>" type="text" name="durata_melodie" placeholder="Duration">
  			<?php if(!empty($errors['durata_melodie'])):?>		
  			<small class="error"><?=$errors['durata_melodie']?></small>
  		<?php endif;?>

  			
  			<?php endif;?>
  			<button class ="btn bg-purple">Save</button>
  			<a href="<?=ROOT?>/admin/songs">
  			<button type="button" class="float-end btn">Back</button>
  		</a>
  		<?php else:?>
  			<div class = "alert">That record was not found</div>
  			<a href="<?=ROOT?>/admin/songs">
  			<button type="button" class="float-end btn">Back</button>
  		</a>
  		<?php endif;?>
  		</form>
  	</div>
  <?php elseif($action == 'delete'):?>
  		<div style ="max-width: 500px;margin: auto;">
  		<form method="post">
  			
  			<h3>Delete Song</h3>

  			<?php if(!empty($row)):?>
  			<div class="form-control my-1" ><?=set_value('titlu', $row['titlu'])?></div>
  			<?php if(!empty($errors['titlu'])):?>		
  			<small class="error"><?=$errors['titlu']?></small>
  		<?php endif;?>
  			

  			
  			

  			<button class ="btn bg-purple">Delete</button>
  			<a href="<?=ROOT?>/admin/songs">
  			<button type="button" class="float-end btn">Back</button>
  		</a>
  		<?php else:?>
  			<div class = "alert">That record was not found</div>
  			<a href="<?=ROOT?>/admin/songs">
  			<button type="button" class="float-end btn">Back</button>
  		</a>
  		<?php endif;?>
  		</form>
  	</div>
  <?php else:?>

  <?php
  	$query = "select * from songs order by id desc limit 20";
  	$rows = db_query($query);
  ?>
  	 <h3>Albums
  	 	<a href="<?=ROOT?>/admin/songs/add">
  	  <button class="float-end btn bg-purple">Add New </button>
  	</a>
  	</h3>

  	 <table class = "table">
  	 		<tr>

  	 			<th>ID</th>
  	 			<th>Title</th>
  	 			<th>Category</th>
  	 			<th>Album</th>
  	 			<th>Duration</th>
  	 			<th>Action</th>

  	 		</tr>
  	 		<?php if (!empty($rows)):?>
  	 				<?php foreach($rows as $row):?>
  	 		 	 		<tr>
  	 			<td><?=$row["id"]?></td>
  	 			<td><?=$row["titlu"]?></td>
  	 			<td><?=get_category($row["id_categorie"])?></td>
  	 			<td><?=get_album($row["id_album"])?></td>
  	 			<td><?=$row["durata_melodie"]?></td>
  	 			<td>
  	 				<a href="<?=ROOT?>/admin/songs/edit/<?=$row['id']?>">
  	 				<img class= "bi"src ="<?=ROOT?>/assets/icons/pencil-square.svg">
  	 			</a>
  	 			<a href="<?=ROOT?>/admin/songs/delete/<?=$row['id']?>">
  	 				<img class= "bi"src ="<?=ROOT?>/assets/icons/trash3.svg">
  	 			</a>
  	 			</td>
  	 		</tr>

		<?php endforeach;?>
		<?php endif;?>
  	 </table>

  <?php endif;?>


	</section>

<?php require page('includes/admin-footer')?>
