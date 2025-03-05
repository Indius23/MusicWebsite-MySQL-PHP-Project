<?php

if($action == 'add'){



	if($_SERVER['REQUEST_METHOD'] == "POST")
	{	
		$errors = [];

		if(empty($_POST['categorie']))
		{
			$errors['categorie'] = "a categorie is required";
		}else
		if(!preg_match("/^[a-zA-Z \&\-]+$/", $_POST['categorie']))
		{
			$errors['categorie'] = "a categorie can only have letters & spaces";
		}


		if(empty($errors))
		{	
			$values = [];
			$values['categorie'] = trim($_POST['categorie']);
		
			$query = "insert into categories (categorie) values (:categorie)";
			db_query($query, $values);

			message("category created successfully!!!");
			redirect('admin/categories');
		}

		
		
	}
}else

if($action == 'edit'){

	$query = "select * from categories where id = :id limit 1";
  		$row = db_query_one($query,['id'=>$id]);

	if($_SERVER['REQUEST_METHOD'] == "POST" && $row)
	{	
		$errors = [];

		if(empty($_POST['categorie']))
		{
			$errors['categorie'] = "a categorie is required";
		}else
		if(!preg_match("/^[a-zA-Z \&\-]+$/", $_POST['categorie']))
		{
			$errors['categorie'] = "a categorie can only have letters";
		}

		if(empty($errors))
		{	
			$values = [];
			$values['categorie'] = trim($_POST['categorie']);
			$values['id'] = $id; 

			$query = "update categories set categorie= :categorie where id= :id limit 1";


			
			
			db_query($query, $values);

			message("category edited successfully!!!");
			redirect('admin/categories');
		}

		
		
	}
}else 
	if($action == 'delete'){

	$query = "select * from categories where id = :id limit 1";
  		$row = db_query_one($query,['id'=>$id]);

	if($_SERVER['REQUEST_METHOD'] == "POST" && $row)
	{	
		$errors = [];


		if(empty($errors))
		{	
			$values = [];
			$values['id'] = $id; 

			$query = "delete from categories where id = :id limit 1";
			
			db_query($query, $values);

			message("category deleted successfully!!!");
			redirect('admin/categories');
		}

		
		
	}
}

?>
<?php require page('includes/admin-header')?>

	<section class = "admin-content" style = "min-height: 200px;">


  <?php if($action == 'add'):?>
  	<div style ="max-width: 500px;margin: auto;">
  		<form method="post">
  			
  			<h3>Add New Category</h3>

  			<input class="form-control my-1"  value="<?=set_value('categorie')?>" type="text" name="categorie" placeholder="Category Name">
  			<?php if(!empty($errors['categorie'])):?>		
  			<small class="error"><?=$errors['categorie']?></small>
  		<?php endif;?>

  

  			

  			<button class ="btn bg-purple">Save</button>
  			<a href="<?ROOT?>/admin/categories">
  			<button type="button" class="float-end btn">Back</button>
  		</a>
  		</form>
  	</div>
  <?php elseif($action == 'edit'):?>



  		<div style ="max-width: 500px;margin: auto;">
  		<form method="post">
  			
  			<h3>Edit Category</h3>

  			<?php if(!empty($row)):?>
  			<input class="form-control my-1"  value="<?=set_value('categorie', $row['categorie'])?>" type="text" name="categorie" placeholder="categorie">
  			<?php if(!empty($errors['categorie'])):?>		
  			<small class="error"><?=$errors['categorie']?></small>
  		<?php endif;?>

  			<button class ="btn bg-purple">Save</button>
  			<a href="<?=ROOT?>/admin/categories">
  			<button type="button" class="float-end btn">Back</button>
  		</a>
  		<?php else:?>
  			<div class = "alert">That record was not found</div>
  			<a href="<?=ROOT?>/admin/categories">
  			<button type="button" class="float-end btn">Back</button>
  		</a>
  		<?php endif;?>
  		</form>
  	</div>
  <?php elseif($action == 'delete'):?>
  		<div style ="max-width: 500px;margin: auto;">
  		<form method="post">
  			
  			<h3>Delete Category</h3>

  			<?php if(!empty($row)):?>
  			<div class="form-control my-1" ><?=set_value('categorie', $row['categorie'])?></div>
  			<?php if(!empty($errors['categorie'])):?>		
  			<small class="error"><?=$errors['categorie']?></small>
  		<?php endif;?>
  			

  			
  			

  			<button class ="btn bg-purple">Delete</button>
  			<a href="<?=ROOT?>/admin/categories">
  			<button type="button" class="float-end btn">Back</button>
  		</a>
  		<?php else:?>
  			<div class = "alert">That record was not found</div>
  			<a href="<?=ROOT?>/admin/categories">
  			<button type="button" class="float-end btn">Back</button>
  		</a>
  		<?php endif;?>
  		</form>
  	</div>
  <?php else:?>

  <?php
  	$query = "select * from categories order by id desc limit 20";
  	$rows = db_query($query);
  ?>
  	 <h3>categories
  	 	<a href="<?=ROOT?>/admin/categories/add">
  	  <button class="float-end btn bg-purple">Add New </button>
  	</a>
  	</h3>

  	 <table class = "table">
  	 		<tr>

  	 			<th>ID</th>
  	 			<th>Category</th>
  	 			
  	 			
  	 			<th>Action</th>
  	 			

  	 		</tr>
  	 		<?php if (!empty($rows)):?>
  	 				<?php foreach($rows as $row):?>
  	 		 	 		<tr>
  	 			<td><?=$row["id"]?></td>
  	 			<td><?=$row["categorie"]?></td>
  	 			<td>
  	 				<a href="<?=ROOT?>/admin/categories/edit/<?=$row['id']?>">
  	 				<img class= "bi"src ="<?=ROOT?>/assets/icons/pencil-square.svg">
  	 			</a>
  	 			<a href="<?=ROOT?>/admin/categories/delete/<?=$row['id']?>">
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
