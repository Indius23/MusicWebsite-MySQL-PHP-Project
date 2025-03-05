<?php require page('includes/header')?>

<div class= "section-title"> Albums</div>

	<section class= "content">

	<?php

		$rows = db_query("select * from albums order by titlu desc limit 24");

	?>
<!--start music card-->
	<?php if(!empty($rows)):?>
		<?php foreach($rows as $row):?>
			<?php include page('includes/album')?>
		<?php endforeach;?>
	<?php endif;?>
<!--end music card-->
	</section>
	
<?php require page('includes/footer')?>	

