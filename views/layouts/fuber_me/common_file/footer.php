
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


var ajaxsupport=false;

if(!window.XMLHttpRequest) {
  ajaxsupport=true;
}

if(typeof(Storage) !== "undefined") {
  //   alert('if');
} else {
   // Sorry! No Web Storage support..
   ajaxsupport=true;
}

if(ajaxsupport){
	alert('Sorry! No Web Storage support..Please use another browser.');
}

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





<script type="text/javascript">
// session timeout

var idleTime = 0;
$(document).ready(function () {
    //Increment the idle time counter every minute.
    var idleInterval = setInterval(timerIncrement, 60000); // 1 minute

    //Zero the idle timer on mouse movement.
    $(this).mousemove(function (e) {
        idleTime = 0;
    });
    $(this).keypress(function (e) {
        idleTime = 0;
    });
});

function timerIncrement() {
    idleTime = idleTime + 1;
    if (idleTime > 30){ // 20 minutes
		// Call ajax request for logout user
		$.ajax({			
			type: 'POST',
			url: <?php Yii::$app->homeUrl; ?>'?r=users/login/idealusertimeout',
			data: {},			
			error: function (err) {
			//	alert("error - " + err);
				return false;
			},
			success: function (data1) {
				if(data1==1){	
					window.home();
				}else if(data1==2){	
					window.location.reload();
				}			
			}
		});
    }
}
// session timeout
</script>   



