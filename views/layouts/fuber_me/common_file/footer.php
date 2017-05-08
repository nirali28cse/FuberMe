<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
.fa {
    padding: 5px;
    font-size: 25px;
    width: 32px;
    text-align: center;
    text-decoration: none;
    border-radius: 50%;
}

/* Add a hover effect if you want */
.fa:hover {
    opacity: 0.7;
}

/* Set a specific color for each brand */

/* Facebook */
.fa-facebook {
    background: #3B5998;
    color: white;
}

/* Twitter */
.fa-twitter {
    background: #55ACEE;
    color: white;
}

/* Twitter */
.fa-twitter {
    background: #55ACEE;
    color: white;
}
/* You Tube */
.fa-youtube {
	background: #bb0000;
    color: white;
}


.copywrite1{
	 width: 74%;
}
.copywrite2{
	 width: 40%;
}
.copywrite3{
	 width: 50%;
}
.container1{
	display: flex;
	align-items: center;
}

@media (max-width: 768px){
.copywrite1{
	 width: 100%;
	 text-align: center;
}
.copywrite2{
	 width: 100%;
	 text-align: center;
}
.copywrite3{
	 width: 100%;
	 text-align: center;
}
.container1{
	display: initial;
	align-items: center;
}
}
</style>


	<div class="clearfix">&nbsp;</div>
	<div class="clearfix">&nbsp;</div>
	<div class="clearfix">&nbsp;</div>
	<div class="clearfix">&nbsp;</div>
	<div class="clearfix">&nbsp;</div>

<div class="footer-content">
	 <div class="container container1">
		 <div class="copywrite copywrite1">
			 <p>Copyright © <?php echo date('Y'); ?> <a href="#">FuberMe</a></p>
		 </div>	

		 
			 <div class="copywrite copywrite2">
				<a href="https://www.facebook.com/FuberMe/" target="_blank"  class="fa fa-facebook"></a>
				<a href="https://twitter.com/fuberme" target="_blank"  class="fa fa-twitter"></a>
				<a href="https://www.youtube.com/channel/UCoNeWMw8UW2DbLkhwpJq3bg" target="_blank"  class="fa fa-youtube"></a>
			 </div>	

		 <div class="copywrite copywrite3">

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



