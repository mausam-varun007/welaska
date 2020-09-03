<style type="text/css">
	.jk-rating-stars-container .button{cursor:pointer}.jk-rating-stars-container .button .material-icons{font-size:30px}.jk-rating-stars-container .star-button{text-shadow:.06em .04em #000}.jk-rating-stars-container .star-button.star-on .material-icons{color:#ee9a00}.jk-rating-stars-container .star-button.star-off .material-icons{color:#ddd}
</style>
<div class="row" >			
	<div class="col-lg-12 col-md-12 col-sm-8 col-xs-12 single-content"> 
		<div class="content-card padding-card custom-row1">			
			<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 content-single-detail">				
				<p class="content-title">{{itemDetailsByID.business_name}}</p>				
				<p class="content-type"><i class="fa fa-chevron-right" aria-hidden="true"></i><span> {{itemDetailsByID.category_name}} ...more</span> </p>
				<p class="content-contact"><i class="fa fa-phone" aria-hidden="true"></i> {{itemDetailsByID.phone1}} ?></p>				
			</div>			
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 content-single-image">				
				<img src="<?= base_url()."assets/img/dummy-image.png" ?> " class="card-image">
			</div>		
		</div>		
		<div class="content-card review-whatsapp-section padding-card custom-row2">			
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 adress-section">				
				<p class="content-location"><span><i class="fa fa-map-marker custom-icon" aria-hidden="true"></i></span> 
					<span >{{itemDetailsByID.street_address}}</span>		
					</p>
				<p class="content-world"><i class="fa fa-globe custom-icon" aria-hidden="true"></i> http://www.example.com</p>				
			</div>
			
		</div>		
		<div class="content-card review-whatsapp-section padding-card custom-row3">			
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 thumbs-up-icon">
				<a onclick="productLike()" ><span class="single-content-whatsapp" id="likesSet"></span></a>
				
			</div>
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 text-center">
				<div id="ratingData">
					
				</div>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 text-right whats-app-icon">
				<a href=""><span class="single-content-whatsapp"><i class="fa fa-whatsapp" aria-hidden="true"></i></span> </a>
			</div>
		</div>		
		<div class="content-card review-comment-section padding-card custom-row4">			
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 review-colum1">
				<h3>Basic</h3>
      			<jk-rating-stars rating="firstRate" ></jk-rating-stars>
				<!-- <div id="ratingAverage">					
				</div> -->
			</div>			
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 review-colum2">
				<div class="customer-feedback-sec">										
						<div class="add-comment">
							<div>
								<form method="post" id="product_comment_byuser">
									<input id="comment_input" type="search" required="required" name="product_comment" class="product_comment_input" placeholder="Write a review">
									<input type="hidden" name="item_id" id="item_id" value="">								
									<button type="button" onclick="productComment()" class="product_comment_button" value="Submit"><i class="fa fa-paper-plane"></i></button>
								</form>
							</div>
						</div>
					</div>	
			</div>
		</div>	
		<div class=" content-card review-content-section padding-card custom-row5">			
			<p>Hand Sanitizer Manufacturers Onion Wholesalers Body Massage Centres Pet Shops Homeopathic Medicine Retailers Gun Dealers Second Hand Mobile Phone Dealers Beauty Parlours Tarpaulin Dealers Commission Agents For Vegetable</p>
		</div>		
		<div class="content-card social-media-section padding-card custom-row6">			
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">				
				<a href=""><i class="fa fa-facebook-square" aria-hidden="true"></i></a>
				<a href=""><i class="fa fa-twitter-square" aria-hidden="true"></i></a>
				<a href=""><i class="fa fa-linkedin-square" aria-hidden="true"></i></a>
			</div>
		</div>		
	</div>
</div>