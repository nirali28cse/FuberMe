
	<div class="clearfix">&nbsp;</div>
	<div class="clearfix">&nbsp;</div>
	<div class="clearfix">&nbsp;</div>
	<div class="clearfix">&nbsp;</div>
	<div class="clearfix">&nbsp;</div>

<div class="footer-content">
	 <div class="container">
		 <div class="copywrite"  style="float:left;">
			 <p>Copyright © <?php echo date('Y'); ?> <a href="#">FuberMe</a></p>
		 </div>	

		 <div class="copywrite" style="float:right;">
<?php /* 				<div class="social">
					<ul>
						<li><a href="#"><i class="facebook"></i></a></li>
						<li><a href="#"><i class="twitter"></i></a></li>
						<li><a href="#"><i class="dribble"></i></a></li>	
						<li><a href="#"><i class="google"></i></a></li>										
					</ul>
				</div> */
				?>
			 <p>
			  <a href="<?php echo Yii::$app->homeUrl; ?>?r=site/faq">FAQ</a> 	|
			 Help |
					<a href="https://mail.google.com/mail/?view=cm&fs=1&tf=1&to=<?php echo Yii::$app->params['adminemailid']; ?>"><?php echo Yii::$app->params['adminemailid']; ?></a>
					|
					Contact Us | <a>508-257-1499</a>
						
			 </p>
		 </div>	

			
	 </div>
</div>





<script>
$(document).ready(function(){
	$(document).on("click",".placeorder",function(e){		
		e.preventDefault();
		var oldHref = $(this).attr('href');
		var item_id=$(this).attr('id');
		$.ajax({			
			type: 'POST',
			url: <?php Yii::$app->homeUrl; ?>'?r=orderinfo/checkchef',
			data: {item_id:item_id},			
			error: function (err) {
			//	alert("error - " + err);
				return false;
			},
			success: function (data1) {
				// return false;
				// alert(data1);
				var chefname=null;
				chefname='<?php if(isset($_SESSION['master_chef_name'])) echo $_SESSION['master_chef_name']; ?>';
				if(data1==0){	
					$('.itemerror'+item_id).html('Please finish your order from Chef "'+chefname+'" before you can order from other chefs.');
					return false;
				}else if(data1==3){	
					$('.itemerror'+item_id).html('Sorry,This item cannot be added,Due to less Qty.');
					return false;
				}else if(data1==4){	
					$('.itemerror'+item_id).html('Sorry,you can not purchase your own item.');
					return false;
				}else{					
					 window.location.href = oldHref; // go to the new url
				}				
			}
		});
	});
});
</script>







