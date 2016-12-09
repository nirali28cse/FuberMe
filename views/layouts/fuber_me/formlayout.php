		
<?php include('common_file/html_start.php'); ?>


<?php include('common_file/head.php'); ?>

	
<?php include('common_file/header.php'); ?>

<style>

.btn-success {
    float: right;
    background-color: #38b662;
    border-color: #4cae4c;
	border-radius: 0;
}


.grid-view,.list-view{
	clear: both;
}

form{
	clear: both;
}
    
</style>


<?php //  include('common_file/header_search.php'); ?>
 <?php 	if(!Yii::$app->user->isGuest){ ?>
		<?php   include('common_file/chef_header.php'); ?>
 <?php } ?>

		<!-- content-starts-here -->
		<div class="content">
			<div class="login_sec">
				<div class="container">
		
					<?php  echo $content; ?>
					
					<div class="clearfix"></div>
				</div>
			</div>
		</div>


<?php include('common_file/footer.php'); ?>

		
<?php include('common_file/html_end.php'); ?>


