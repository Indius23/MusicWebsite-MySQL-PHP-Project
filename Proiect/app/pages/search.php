<?php require page('includes/header')?>

<div class= "section-title"> Search</div>

	<section class= "content">

	<?php

		$title = $_GET['find'] ?? null ;
		if(!empty($nume)){

			$nume = "%$nume%";
		$query = "select * from bands where nume like :nume"
		$rows = db_query($query,['nume'=>$nume]):
		}

	?>
<!--start music card-->
	<?php if(!empty($rows)):?>
		<?php foreach($rows as $row):?>
			<?php include page('includes/band')?>
		<?php endforeach;?>
	<?php endif;?>
<!--end music card-->
	</section>
	
<?php require page('includes/footer')?>	

