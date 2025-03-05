<?php

if($action == 'add'){



	if($_SERVER['REQUEST_METHOD'] == "POST")
	{	
		$errors = [];

		if(empty($_POST['nume']))
		{
			$errors['nume'] = "a Name is required";
		}else
		if(!preg_match("/^[a-zA-Z ]+$/", $_POST['nume']))
		{
			$errors['nume'] = "a name can only have letters";
		}
		

		if(empty($errors))
		{	
			$values = [];
			$values['nume'] = trim($_POST['nume']);
			$values['nr_membrii'] = trim($_POST['nr_membrii']);
			$values['an_fondare'] = trim($_POST['an_fondare']);
			$values['tara_origine'] = trim($_POST['tara_origine']);
			$query = "insert into bands (nume,nr_membrii,an_fondare,tara_origine) values (:nume,:nr_membrii,:an_fondare,:tara_origine)";
			db_query($query, $values);

			message("band created successfully!!!");
			redirect('admin/bands');
		}

		
		
	}
}else

if($action == 'edit'){

	$query = "select * from bands where id = :id limit 1";
  		$row = db_query_one($query,['id'=>$id]);

	if($_SERVER['REQUEST_METHOD'] == "POST" && $row)
	{	
		$errors = [];

		if(empty($_POST['nume']))
		{
			$errors['nume'] = "a name is required";
		}else
		if(!preg_match("/^[a-zA-Z ]+$/", $_POST['nume']))
		{
			$errors['nume'] = "a username can only have letters and spaces";
		}

		if(empty($errors))
		{	
			$values = [];
			$values['nume'] = trim($_POST['nume']);
			$values['nr_membrii'] = trim($_POST['nr_membrii']);
			$values['an_fondare'] = trim($_POST['an_fondare']);
			$values['tara_origine'] = trim($_POST['tara_origine']);
			$values['id'] = $id; 

			$query = "update bands set nume = :nume, nr_membrii= :nr_membrii, an_fondare= :an_fondare, tara_origine= :tara_origine where id = :id limit 1";
			
			db_query($query, $values);

			message("band edited successfully!!!");
			redirect('admin/bands');
		}

		
		
	}
}else 
	if($action == 'delete'){

	$query = "select * from bands where id = :id limit 1";
  		$row = db_query_one($query,['id'=>$id]);

	if($_SERVER['REQUEST_METHOD'] == "POST" && $row)
	{	
		$errors = [];

		

		if(empty($errors))
		{	
			$values = [];
			$values['id'] = $id; 

			$query = "delete from bands where id = :id limit 1";
			
			db_query($query, $values);

			message("band deleted successfully!!!");
			redirect('admin/bands');
		}

		
		
	}
}

?>
<?php require page('includes/admin-header')?>

	<section class = "admin-content" style = "min-height: 200px;">


  <?php if($action == 'add'):?>
  	<div style ="max-width: 500px;margin: auto;">
  		<form method="post">
  			
  			<h3>Add New Band</h3>

  			<input class="form-control my-1"  value="<?=set_value('nume')?>" type="text" name="nume" placeholder="Band Name">
  			<?php if(!empty($errors['nume'])):?>		
  			<small class="error"><?=$errors['nume']?></small>
  		<?php endif;?>
  		<input class="form-control my-1"  value="<?=set_value('nr_membrii')?>" type="text" name="nr_membrii" placeholder="Number of members">
  			<?php if(!empty($errors['nr_membrii'])):?>		
  			<small class="error"><?=$errors['nr_membrii']?></small>
  		<?php endif;?>
  		<input class="form-control my-1"  value="<?=set_value('an_fondare')?>" type="text" name="an_fondare" placeholder="Founding Year">
  			<?php if(!empty($errors['an_fondare'])):?>		
  			<small class="error"><?=$errors['an_fondare']?></small>
  		<?php endif;?>
  		<input class="form-control my-1"  value="<?=set_value('tara_origine')?>" type="text" name="tara_origine" placeholder="Origin Country">
  			<?php if(!empty($errors['tara_origine'])):?>		
  			<small class="error"><?=$errors['tara_origine']?></small>
  		<?php endif;?>
  			<button class ="btn bg-purple">Save</button>
  			<a href="<?ROOT?>/admin/bands">
  			<button type="button" class="float-end btn">Back</button>
  		</a>
  		</form>
  	</div>
  <?php elseif($action == 'edit'):?>



  		<div style ="max-width: 500px;margin: auto;">
  		<form method="post">
  			
  			<h3>Edit Band</h3>

  			<?php if(!empty($row)):?>
  			<input class="form-control my-1"  value="<?=set_value('nume', $row['nume'])?>" type="text" name="nume" placeholder="Name">
  			<?php if(!empty($errors['nume'])):?>		
  			<small class="error"><?=$errors['nume']?></small>
  		<?php endif;?>

  			<input class="form-control my-1"  value="<?=set_value('tara_origine', $row['tara_origine'])?>" type="text" name="tara_origine" placeholder="Origin Country">
  			<?php if(!empty($errors['tara_origine'])):?>		
  			<small class="error"><?=$errors['tara_origine']?></small>
  		<?php endif;?>

  			<input class="form-control my-1"  value="<?=set_value('nr_membrii', $row['nr_membrii'])?>" type="text" name="nr_membrii" placeholder="Number of members">
  			<?php if(!empty($errors['nr_membrii'])):?>		
  			<small class="error"><?=$errors['nr_membrii']?></small>
  		<?php endif;?>


  			<input class="form-control my-1"  value="<?=set_value('an_fondare', $row['an_fondare'])?>" type="text" name="an_fondare" placeholder="Founding Year">
  			<?php if(!empty($errors['an_fondare'])):?>		
  			<small class="error"><?=$errors['an_fondare']?></small>
  		<?php endif;?>

  			<button class ="btn bg-purple">Save</button>
  			<a href="<?=ROOT?>/admin/bands">
  			<button type="button" class="float-end btn">Back</button>
  		</a>
  		<?php else:?>
  			<div class = "alert">That record was not found</div>
  			<a href="<?=ROOT?>/admin/bands">
  			<button type="button" class="float-end btn">Back</button>
  		</a>
  		<?php endif;?>
  		</form>
  	</div>
  <?php elseif($action == 'delete'):?>
  		<div style ="max-width: 500px;margin: auto;">
  		<form method="post">
  			
  			<h3>Delete User</h3>

  			<?php if(!empty($row)):?>
  			<div class="form-control my-1" ><?=set_value('nume', $row['nume'])?></div>
  			<?php if(!empty($errors['nume'])):?>		
  			<small class="error"><?=$errors['nume']?></small>
  		<?php endif;?>

  		
  			<button class ="btn bg-purple">Delete</button>
  			<a href="<?=ROOT?>/admin/bands">
  			<button type="button" class="float-end btn">Back</button>
  		</a>
  		<?php else:?>
  			<div class = "alert">That record was not found</div>
  			<a href="<?=ROOT?>/admin/bands">
  			<button type="button" class="float-end btn">Back</button>
  		</a>
  		<?php endif;?>
  		</form>
  	</div>
  <?php else:?>

  <?php
  	$query = "select * from bands order by id desc limit 20";
  	$rows = db_query($query);
  ?>
  	 <h3>Bands
  	 	<a href="<?=ROOT?>/admin/bands/add">
  	  <button class="float-end btn bg-purple">Add New </button>
  	</a>
  	</h3>

  	 <table class = "table">
  	 		<tr>

  	 			<th>ID</th>
  	 			<th>Name</th>
  	 			<th>Number of members</th>
  	 			<th>Founding year</th>
  	 			<th>Origin Country</th>
  	 			<th>Action</th>


  	 		</tr>
  	 		<?php if (!empty($rows)):?>
  	 				<?php foreach($rows as $row):?>
  	 		 	 		<tr>
  	 			<td><?=$row["id"]?></td>
  	 			<td><?=$row["nume"]?></td>
  	 			<td><?=$row["nr_membrii"]?></td>
  	 			<td><?=$row["an_fondare"]?></td>
  	 			<td><?=$row["tara_origine"]?></td>
  	 			<td>
  	 				<a href="<?=ROOT?>/admin/bands/edit/<?=$row['id']?>">
  	 				<img class= "bi"src ="<?=ROOT?>/assets/icons/pencil-square.svg">
  	 			</a>
  	 			<a href="<?=ROOT?>/admin/bands/delete/<?=$row['id']?>">
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
