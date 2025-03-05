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
			$values['durata'] = trim($_POST['durata']);
			$values['an_aparitie'] = trim($_POST['an_aparitie']);
			$values['id_band'] = trim($_POST['id_band']);
			$query = "insert into albums (titlu,durata,an_aparitie,id_band) values (:titlu,:durata,:an_aparitie,:id_band)";
			db_query($query, $values);

			message("Album created successfully!!!");
			redirect('admin/albums');
		}

		
		
	}
}else

if($action == 'edit'){

	$query = "select * from albums where id = :id limit 1";
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
			$values['durata'] = trim($_POST['durata']);
			$values['an_aparitie'] = trim($_POST['an_aparitie']);
			$values['id'] = $id; 

			$query = "update albums set titlu= :titlu, durata = :durata , an_aparitie= :an_aparitie where id= :id limit 1";
			db_query($query, $values);

			message("album edited successfully!!!");
			redirect('admin/albums');
		}

		
		
	}
}else 
	if($action == 'delete'){

	$query = "select * from albums where id = :id limit 1";
  		$row = db_query_one($query,['id'=>$id]);

	if($_SERVER['REQUEST_METHOD'] == "POST" && $row)
	{	
		$errors = [];


		if(empty($errors))
		{	
			$values = [];
			$values['id'] = $id; 

			$query = "delete from albums where id = :id limit 1";
			
			db_query($query, $values);

			message("category deleted successfully!!!");
			redirect('admin/albums');
		}

		
		
	}
}

?>
<?php require page('includes/admin-header')?>

	<section class = "admin-content" style = "min-height: 200px;">


  <?php if($action == 'add'):?>
  	<div style ="max-width: 500px;margin: auto;">
  		<form method="post">
  			
  			<h3>Add New Album</h3>

  			<input class="form-control my-1"  value="<?=set_value('titlu')?>" type="text" name="titlu" placeholder="Title">
  			<?php if(!empty($errors['titlu'])):?>		
  			<small class="error"><?=$errors['titlu']?></small>
  		<?php endif;?>

  			<input class="form-control my-1"  value="<?=set_value('an_aparitie')?>" type="text" name="an_aparitie" placeholder="Release Year">
  			<?php if(!empty($errors['an_aparitie'])):?>		
  			<small class="error"><?=$errors['an_aparitie']?></small>
  		<?php endif;?>
  
  			<input class="form-control my-1"  value="<?=set_value('durata')?>" type="text" name="durata" placeholder="Duration">
  			<?php if(!empty($errors['durata'])):?>		
  			<small class="error"><?=$errors['durata']?></small>
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
  			<a href="<?ROOT?>/admin/albums">
  			<button type="button" class="float-end btn">Back</button>
  		</a>
  		</form>
  	</div>
  <?php elseif($action == 'edit'):?>



  		<div style ="max-width: 500px;margin: auto;">
  		<form method="post">
  			
  			<h3>Edit Album</h3>

  			<?php if(!empty($row)):?>
  			<input class="form-control my-1"  value="<?=set_value('titlu', $row['titlu'])?>" type="text" name="titlu" placeholder=" Title">
  			<?php if(!empty($errors['titlu'])):?>		
  			<small class="error"><?=$errors['titlu']?></small>
  		<?php endif;?>

  			<?php if(!empty($row)):?>
  			<input class="form-control my-1"  value="<?=set_value('durata', $row['durata'])?>" type="text" name="durata" placeholder="Duration">
  			<?php if(!empty($errors['durata'])):?>		
  			<small class="error"><?=$errors['durata']?></small>
  		<?php endif;?>

  			<?php if(!empty($row)):?>
  			<input class="form-control my-1"  value="<?=set_value('an_aparitie', $row['an_aparitie'])?>" type="text" name="an_aparitie" placeholder=" Release year">
  			<?php if(!empty($errors['an_aparitie'])):?>		
  			<small class="error"><?=$errors['an_aparitie']?></small>
  			<?php endif;?>

  		<?php endif;?>
  			<?php endif;?>
  			<button class ="btn bg-purple">Save</button>
  			<a href="<?=ROOT?>/admin/albums">
  			<button type="button" class="float-end btn">Back</button>
  		</a>
  		<?php else:?>
  			<div class = "alert">That record was not found</div>
  			<a href="<?=ROOT?>/admin/albums">
  			<button type="button" class="float-end btn">Back</button>
  		</a>
  		<?php endif;?>
  		</form>
  	</div>
  <?php elseif($action == 'delete'):?>
  		<div style ="max-width: 500px;margin: auto;">
  		<form method="post">
  			
  			<h3>Delete Album</h3>

  			<?php if(!empty($row)):?>
  			<div class="form-control my-1" ><?=set_value('titlu', $row['titlu'])?></div>
  			<?php if(!empty($errors['titlu'])):?>		
  			<small class="error"><?=$errors['titlu']?></small>
  		<?php endif;?>
  			

  			
  			

  			<button class ="btn bg-purple">Delete</button>
  			<a href="<?=ROOT?>/admin/albums">
  			<button type="button" class="float-end btn">Back</button>
  		</a>
  		<?php else:?>
  			<div class = "alert">That record was not found</div>
  			<a href="<?=ROOT?>/admin/albums">
  			<button type="button" class="float-end btn">Back</button>
  		</a>
  		<?php endif;?>
  		</form>
  	</div>
  <?php else:?>

  <?php
  	$query = "select * from albums order by id desc limit 20";
  	$rows = db_query($query);
  ?>
  	 <h3>Albums
  	 	<a href="<?=ROOT?>/admin/albums/add">
  	  <button class="float-end btn bg-purple">Add New </button>
  	</a>
  	</h3>

  	 <table class = "table">
  	 		<tr>

  	 			<th>ID</th>
  	 			<th>Title</th>
  	 			<th>Release Year</th>
  	 			<th>Band</th>
  	 			<th>Duration</th>
  	 			<th>Action</th>
  	 			

  	 		</tr>
  	 		<?php if (!empty($rows)):?>
  	 				<?php foreach($rows as $row):?>
  	 		 	 		<tr>
  	 			<td><?=$row["id"]?></td>
  	 			<td><?=$row["titlu"]?></td>
  	 			<td><?=$row["an_aparitie"]?></td>
  	 			<td><?=get_band($row["id_band"])?></td>
  	 			<td><?=$row["durata"]?></td>
  	 			<td>
  	 				<a href="<?=ROOT?>/admin/albums/edit/<?=$row['id']?>">
  	 				<img class= "bi"src ="<?=ROOT?>/assets/icons/pencil-square.svg">
  	 			</a>
  	 			<a href="<?=ROOT?>/admin/albums/delete/<?=$row['id']?>">
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
