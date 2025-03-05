<?php require page('includes/header')?>

	<section>
		<img class= "hero"src="<?=ROOT?>/assets/images/reg1.jpg">
	</section>
<div class = "section-title"> Featured </div>
	<section class = "content">
		
<?php

		$rows = db_query("select * from songs order by id desc limit 24");

	?>
<!--start music card-->
	<?php if(!empty($rows)):?>
		<?php foreach($rows as $row):?>
			<?php include page('includes/song')?>
		<?php endforeach;?>
	<?php endif;?>
<!--end music card-->
	</section>

<?php require page('includes/footer')?>

	