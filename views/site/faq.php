<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\users\models\Userdetail */
/* @var $form yii\widgets\ActiveForm */
?>

<style>
.faque{
	padding: 15px 0;
}
.faqans{
	color: #999;
}
</style>
<!---->
<div class="container">

	 <div class="registration">
					
			<div class="clearfix">&nbsp;</div>
			<div class="row">
				<h2 style="margin: 2% 0;">Frequently Asked Questions </h2>
			 </div>

			<p class="faque">What is FuberMe?</p>
			<p class="faqans">FuberMe is a marketplace that connects foodies, looking for fresh and authentic food, directly to home chefs in your local area. In short, it is a platform like Uber but for Food. Thus, FuberMe.</p>
			
			<p class="faque">How does it work?</p>
			<p class="faqans">Quite simple. Browse or search from a wide variety of fresh food available from your local chefs, place your order, and pick up your food or get it delivered at the designated time.</p>

			
			<p class="faque">I don’t see FuberMe chefs available in my area. What should I do?</p>
			<p class="faqans">We are growing fast. We have started in the metrowest area of massachusetts, but planning to expand to the other locations soon. Please like us on Facebook or follow us on Twitter and we will keep you posted.</p>

			
			<p class="faque">I'm having issues with the website. How do I report it?</p>
			<p class="faqans">Our sincere apologies! We are always looking to improve. Please contact us by email at <a href="https://mail.google.com/mail/?view=cm&fs=1&tf=1&to=<?php echo Yii::$app->params['adminemailid']; ?>"><?php echo Yii::$app->params['adminemailid']; ?></a>, or reach us by phone / text at <a>508-257-1499</a>.</p>
			
			
			<div class="clearfix">&nbsp;</div>
			<div class="row">
				<h2 style="margin: 2% 0;">FAQs - From Foodies</h2>
			 </div>

			 
			 
			<p class="faque">What kind of food options are available?</p>
			<p class="faqans">
			The options are endless! </p>
			<div class="clearfix">&nbsp;</div>
			<p class="faqans">
			It can be your favorite food item that you love to eat, or even a unique recipe from a chef that are not available in restaurants or supermarkets. It can be your regular meal, or a catering order for your party. 
			</p>
			<div class="clearfix">&nbsp;</div>
			<p class="faqans">
			Start browsing and you will be amazed with the available varieties.
			</p>
			 
			<p class="faque">I couldn’t find the food/item I was looking for. What should I do?</p>
			<p class="faqans">Excellent! If you have any specific suggestions, do share with us via email, facebook, or twitter. Our chefs are always looking for suggestions directly from their customers.</p>
						 
			<p class="faque">I have dietary restrictions – how can I clarify what's in the food?</p>
			<p class="faqans">We encourage our chefs to list dietary preference (vegetarian, non-vegetarian, gluten-free, halal and so on...) in their listing. You can filter by dietary preference while searching for your favorite food items.</p>
									 
			<p class="faque">I have allergy restrictions - how can I clarify what’s in the food?</p>
			<p class="faqans">Same as above. Chefs list all allergens in their meal listing, but if you have specific questions you can also add a note while placing an order. </p>
												 
			<p class="faque">How do I get my food? Pickup or delivery?</p>
			<p class="faqans">It is completely up to the chef that you are ordering from. A chef can either offer a pickup option, delivery, or both. If you have a preference, you can apply a filter during your search to select chefs that offer your preferred option. </p>
			<div class="clearfix">&nbsp;</div>
			<p class="faqans">Note that delivery option may include additional delivery charges from chef.</p>
			
						 
			<p class="faque">How do I find chef’s address for a pickup?</p>
			<p class="faqans">Chef’s address will be displayed after you place an order. Before placing an order, you can see chef’s approximate location by town name or zip code. </p>
			
			<p class="faque">For pickup, can I bring my own container for the food?</p>
			<p class="faqans">Our chefs use their own containers, but please contact the chef directly if you want to bring your own container and it can be accommodated. </p>
			
			<p class="faque">How do I pay?</p>
			<p class="faqans">Two options. Either you pay online (credit card, debit card or PayPal) Or pay cash at the time of pickup/delivery. </p>
			<div class="clearfix">&nbsp;</div></p>
			<p class="faqans">For online payments, we use a secure provider and your information is always safe.</p>
			
			<p class="faque">How does food pricing work?</p>
			<p class="faqans">Chefs have complete control over the pricing of their food. We understand that not every food item costs the same to make and we respect that. You may even find a same food item with different price from different chefs. Foodies have a choice to find their best suitable item based on the price, chef ratings, pickup/delivery, and other options. </p>
			
			<p class="faque">I am a regular user/foodie, but would also like to be a home chef. Is it possible?</p>
			<p class="faqans">Of course! That’s the flexibility of this platform. You can be a foodie/user on certain days when you cannot cook, but can be a chef on other days and sell when you feel like cooking. </p>
			
			<p class="faque">I want homemade food on a daily basis or for multiple days in a row. Can I do it? </p>
			<p class="faqans">Why not! While placing an order, you can decide the pickup/delivery time, and chef will plan accordingly!</p>
			
			<p class="faque">Can I place a big/catering order for multiple people? </p>
			<p class="faqans">It depends. There are certain chefs who specialize only in catering orders and requires minimum quantity. Please check the details in chef’s food item testing</p>

			
			<div class="clearfix">&nbsp;</div>
			<div class="row">
				<h2 style="margin: 2% 0;">FAQs - From Chefs</h2>
			 </div>

		
			<p class="faque">Is there a fee to be a Chef?</p>
			<p class="faqans">No.</p>
			<p class="faqans">It’s completely free to be a chef and start selling. Just register yourself and start cooking!</p>

					
			<p class="faque">Are there any other fees for Chefs?</p>
			<p class="faqans">Chefs just cover payment processing fees on any food sold via online payment via PayPal or credit/debit card. We do not take any commissions currently for any transactions between chef and foodies. </p>

			<p class="faque">What can I cook?</p>
			<p class="faqans">You can check out the various food categories while creating a new food item. It can be your popular recipe praised by your guests/foodies, or something that foodies may not find anywhere else like restaurants or supermarkets. </p>
			<div class="clearfix">&nbsp;</div>
			<p class="faqans">We encourage our foodies to share their suggestions, so if you still have a doubt what can you cook, please contact us and we can guide you further.</p>

			<p class="faque">Can I sell homemade food items like snacks, rotis, cakes, pickles etc.?</p>
			<p class="faqans">Yes, all of that and more. The possibilities are endless.</p>

			<p class="faque">I cannot cook every day. Can I still register as a chef?</p>
			<p class="faqans">Of course! You have complete flexibility to cook whenever you can. While adding a food item, you can select the item availability dates and time, in 30 minutes incrementals. </p>
			
			<p class="faque">Once my food item is live, can I take it offline temporarily when I cannot cook?</p>
			<p class="faqans">Yes. with a single click, by clicking ‘Take Offline’ under My Menu in your profile. When you are ready to cook again, just click on ‘Make Live’ and select the end date. It cannot get more simple than that, right?!</p>
			<div class="clearfix">&nbsp;</div>
			<p class="faqans">When an item is offline, it won’t be visible to the foodies to place an order.</p>
			
			<p class="faque">Do I have to cook an item in advance? Or can I start cooking only after I receive an order?</p>
			<p class="faqans">This is one of the most common questions!</p>
			<div class="clearfix">&nbsp;</div>
			<p class="faqans">When you are building your business, you may not have many customer orders to prepare in advance. In that case, you can select appropriate ‘Preparation Time’ from the drop-down menu while adding a food item. </p>
			<div class="clearfix">&nbsp;</div>
			<p class="faqans">Once your business is booming and you receive many orders, you have an option to decide the maximum quantity available. Your food item will go offline automatically after all your available quantities are sold, or once your item end date expires, whichever happens first.</p>
			
			<p class="faque">Do I need to list all of my Ingredients? </p>
			<p class="faqans">Not really. Just list the most important ingredients which will help you and your customer to identify the food contents, as well as any allergic ingredients. </p>
			
			<p class="faque">What do I write in Description?</p>
			<p class="faqans">Other than the important fields you populate while creating an item, this item description field is an important field to market your item, of course, without revealing your secret recipe. You can also include information like price per quantity, quantity size, packaging details etc.</p>
			
			<p class="faque">How will I get orders from customers?</p>
			<p class="faqans">After a customer completes the online checkout process, you will receive an instant SMS and email notification with the order details, as well as the contact information of the customer. You can also review your orders by going into your profile page.</p>
			
			<p class="faque">Do I have to deliver the food to customers?</p>
			<p class="faqans">It depends on your preference. You can offer options like pick up (from your designated location), delivery (in certain radius from you), or both. If you pick a delivery option, you may mention extra delivery charges, if any. Customers have options to filter out their searches by delivery or pick up options. </p>
			
			<p class="faque">How will the money be paid?</p>
			<p class="faqans">You have an option to offer online payments via PayPal/Credit/Debit cards to your PayPal account, and/or offer cash on delivery. </p>
			
			<p class="faque">When can I start receiving orders?</p>
			<p class="faqans">We are trying to avoid chicken and egg situation. So our current focus is to allow chefs to register themselves and have them start adding their food items in their profile. </p>
			<div class="clearfix">&nbsp;</div>
			<p class="faqans">With growing interest of customer registrations already, we are planning to launch the customer focus website soon, where they can start placing their orders from large variety of food items. </p>
			<div class="clearfix">&nbsp;</div>
			<p class="faqans">If you are interested in being a foodie/customer, please subscribe with your email, and we will keep you posted with the launch. </p>
					
					
		
		 <div class="clearfix"></div>
	 </div>
</div>


