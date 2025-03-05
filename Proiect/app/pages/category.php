<?php require page('includes/header')?>

<div class= "section-title"> Category</div>

	<section class= "content">

	<?php

		$rows = db_query("select * from bands order by nume desc limit 24");

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

