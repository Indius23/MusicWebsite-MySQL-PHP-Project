<?php

if($action == 'add'){



	if($_SERVER['REQUEST_METHOD'] == "POST")
	{	
		$errors = [];

		if(empty($_POST['nume_artist']))
		{
			$errors['nume_artist'] = "a name is required";
		}else
		if(!preg_match("/^[a-zA-Z \&\-]+$/", $_POST['nume_artist']))
		{
			$errors['nume_artist'] = "a name can only have letters & spaces";
		}


		if(empty($errors))
		{	
			$values = [];
			$values['nume_artist'] = trim($_POST['nume_artist']);
			$values['prenume_artist'] = trim($_POST['prenume_artist']);
			$values['tara_origine'] = trim($_POST['tara_origine']);
			$values['data_nasterii'] = trim($_POST['data_nasterii']);
			$values['id_band'] = trim($_POST['id_band']);
			$query = "insert into artists (nume_artist,prenume_artist,tara_origine,data_nasterii,id_band) values (:nume_artist,:prenume_artist,:tara_origine,:data_nasterii,:id_band)";
			db_query($query, $values);

			message("Artist created successfully!!!");
			redirect('admin/artists');
		}

		
		
	}
}else

if($action == 'edit'){

	$query = "select * from artists where id = :id limit 1";
  		$row = db_query_one($query,['id'=>$id]);

	if($_SERVER['REQUEST_METHOD'] == "POST" && $row)
	{	
		$errors = [];
 	
		if(empty($_POST['nume_artist']))
		{
			$errors['nume_artist'] = "a nume_artist is required";
		}else
		if(!preg_match("/^[a-zA-Z \&\-]+$/", $_POST['nume_artist']))
		{
			$errors['nume_artist'] = "a nume_artist can only have letters";
		}


		if(empty($errors))
		{	
			$values = [];
			$values['nume_artist'] = trim($_POST['nume_artist']);
			$values['prenume_artist'] = trim($_POST['prenume_artist']);
			$values['data_nasterii'] = trim($_POST['data_nasterii']);
			$values['tara_origine'] = trim($_POST['tara_origine']);
			$values['id'] = $id; 

			$query = "update artists set nume_artist= :nume_artist, prenume_artist = :prenume_artist , data_nasterii= :data_nasterii, tara_origine=:tara_origine  where id= :id limit 1";


		
			db_query($query, $values);

			message("artist edited successfully!!!");
			redirect('admin/artists');
		}

		
		
	}
}else 
	if($action == 'delete'){

	$query = "select * from artists where id = :id limit 1";
  		$row = db_query_one($query,['id'=>$id]);

	if($_SERVER['REQUEST_METHOD'] == "POST" && $row)
	{	
		$errors = [];


		if(empty($errors))
		{	
			$values = [];
			$values['id'] = $id; 

			$query = "delete from artists where id = :id limit 1";
			
			db_query($query, $values);

			message("category deleted successfully!!!");
			redirect('admin/artists');
		}

		
		
	}
}

?>
<?php require page('includes/admin-header')?>

	<section class = "admin-content" style = "min-height: 200px;">


  <?php if($action == 'add'):?>
  	<div style ="max-width: 500px;margin: auto;">
  		<form method="post">
  			
  			<h3>Add New Artist</h3>

  			<input class="form-control my-1"  value="<?=set_value('nume_artist')?>" type="text" name="nume_artist" placeholder="Last Name">
  			<?php if(!empty($errors['nume_artist'])):?>		
  			<small class="error"><?=$errors['nume_artist']?></small>
  		<?php endif;?>

  			<input class="form-control my-1"  value="<?=set_value('prenume_artist')?>" type="text" name="prenume_artist" placeholder="First Name">
  			<?php if(!empty($errors['prenume_artist'])):?>		prenume_artist
  			<small class="error"><?=$errors['prenume_artist']?></small>
  		<?php endif;?>
  
  			<input class="form-control my-1"  value="<?=set_value('data_nasterii')?>" type="text" name="data_nasterii" placeholder="Birthdate">
  			<?php if(!empty($errors['data_nasterii'])):?>		
  			<small class="error"><?=$errors['data_nasterii']?></small>
  		<?php endif;?>
  			
  			<input class="form-control my-1"  value="<?=set_value('tara_origine')?>" type="text" name="tara_origine" placeholder="Origin">
  			<?php if(!empty($errors['tara_origine'])):?>		
  			<small class="error"><?=$errors['tara_origine']?></small>
  		<?php endif;?>

  		<?php
  			$query = "select * from bands";
  			$banduri = db_query($query);
  		?>
  			<select name="id_band" class = "form-control my-1">
  				<option value="">--Band--</option>
  				<?php if(!empty($banduri)):?>
  					<?php foreach($banduri as $bnd):?>
  				<option <?=set_select('id_band', $bnd['id'] )?> value="<?=$bnd['id']?>"><?=$bnd['nume']?></option>
  				  			<?php endforeach;?>
  			<?php endif;?>	
  			</select>
  			<?php if(!empty($errors['id_categorie'])):?>		
  			<small class="error"><?=$errors['id_categorie']?></small>
  		<?php endif;?>

  			<button class ="btn bg-purple">Save</button>
  			<a href="<?ROOT?>/admin/artists">
  			<button type="button" class="float-end btn">Back</button>
  		</a>
  		</form>
  	</div>
  <?php elseif($action == 'edit'):?>



  		<div style ="max-width: 500px;margin: auto;">
  		<form method="post">
  			
  			<h3>Edit Artist</h3>

  			<?php if(!empty($row)):?>
  			<input class="form-control my-1"  value="<?=set_value('nume_artist', $row['nume_artist'])?>" type="text" name="nume_artist" placeholder=" Last Name">
  			<?php if(!empty($errors['nume_artist'])):?>		
  			<small class="error"><?=$errors['nume_artist']?></small>
  		<?php endif;?>

  			<?php if(!empty($row)):?>
  			<input class="form-control my-1"  value="<?=set_value('prenume_artist', $row['prenume_artist'])?>" type="text" name="prenume_artist" placeholder=" First Name">
  			<?php if(!empty($errors['prenume_artist'])):?>		
  			<small class="error"><?=$errors['prenume_artist']?></small>
  		<?php endif;?>

  			<?php if(!empty($row)):?>
  			<input class="form-control my-1"  value="<?=set_value('data_nasterii', $row['data_nasterii'])?>" type="text" name="data_nasterii" placeholder=" Birthdate">
  			<?php if(!empty($errors['data_nasterii'])):?>		
  			<small class="error"><?=$errors['data_nasterii']?></small>
  			<?php endif;?>

  		<?php if(!empty($row)):?>
  			<input class="form-control my-1"  value="<?=set_value('tara_origine', $row['tara_origine'])?>" type="text" name="tara_origine" placeholder=" tara_origine">
  			<?php if(!empty($errors['tara_origine'])):?>		
  			<small class="error"><?=$errors['tara_origine']?></small>
  			<?php endif;?>	


<?php endif;?>	
  		<?php endif;?>
  			<?php endif;?>
  			<button class ="btn bg-purple">Save</button>
  			<a href="<?=ROOT?>/admin/artists">
  			<button type="button" class="float-end btn">Back</button>
  		</a>
  		<?php else:?>
  			<div class = "alert">That record was not found</div>
  			<a href="<?=ROOT?>/admin/artists">
  			<button type="button" class="float-end btn">Back</button>
  		</a>
  		<?php endif;?>
  		</form>
  	</div>
  <?php elseif($action == 'delete'):?>
  		<div style ="max-width: 500px;margin: auto;">
  		<form method="post">
  			
  			<h3>Delete Artist</h3>

  			<?php if(!empty($row)):?>
  			<div class="form-control my-1" ><?=set_value('nume_artist', $row['nume_artist'])?></div>
  			<?php if(!empty($errors['nume_artist'])):?>		
  			<small class="error"><?=$errors['nume_artist']?></small>
  		<?php endif;?>
  			

  			
  			

  			<button class ="btn bg-purple">Delete</button>
  			<a href="<?=ROOT?>/admin/artists">
  			<button type="button" class="float-end btn">Back</button>
  		</a>
  		<?php else:?>
  			<div class = "alert">That record was not found</div>
  			<a href="<?=ROOT?>/admin/artists">
  			<button type="button" class="float-end btn">Back</button>
  		</a>
  		<?php endif;?>
  		</form>
  	</div>
  <?php else:?>

  <?php
  	$query = "select * from artists order by id desc limit 20";
  	$rows = db_query($query);
  ?>
  	 <h3>Artists
  	 	<a href="<?=ROOT?>/admin/artists/add">
  	  <button class="float-end btn bg-purple">Add New </button>
  	</a>
  	</h3>

  	 <table class = "table">
  	 		<tr>

  	 			<th>ID</th>
  	 			<th>Artist</th>
  	 			<th>Date</th>
  	 			<th>Band</th>
  	 			<th>Origin</th>
  	 			<th>Action</th>
  	 			

  	 		</tr>
  	 		<?php if (!empty($rows)):?>
  	 				<?php foreach($rows as $row):?>
  	 		 	 		<tr>
  	 			<td><?=$row["id"]?></td>
  	 			<td><?=$row["nume_artist"]?> <?=$row["prenume_artist"]?></td>
  	 			<td><?=$row["data_nasterii"]?></td>
  	 			<td><?=get_band($row["id_band"])?></td>
  	 			<td><?=$row["tara_origine"]?></td>
  	 			<td>
  	 				<a href="<?=ROOT?>/admin/artists/edit/<?=$row['id']?>">
  	 				<img class= "bi"src ="<?=ROOT?>/assets/icons/pencil-square.svg">
  	 			</a>
  	 			<a href="<?=ROOT?>/admin/artists/delete/<?=$row['id']?>">
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
