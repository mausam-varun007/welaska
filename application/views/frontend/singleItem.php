<style type="text/css">
	.infinit-scroll-container {
	  height: 150px;
	  overflow-y:scroll
	}
</style>
<div class="row" >			
	<div class="col-lg-12 col-md-12 col-sm-8 col-xs-12 single-content"> 
		<div class="content-card padding-card custom-row1">			
			<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 content-single-detail">				
				<p class="content-title">{{itemDetailsByID.business_name}}</p>				
				<p class="content-type"><i class="fa fa-chevron-right" aria-hidden="true"></i><span> {{itemDetailsByID.category_name}} ...more</span> </p>
				<p class="content-contact"><i class="fa fa-phone" aria-hidden="true"></i> {{itemDetailsByID.phone1}}</p>				
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
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-2">
				<a class="single-content-whatsapp"><i class="fa fa-thumbs-up" aria-hidden="true"></i></a>	
			</div>
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-8 text-center rating-section">
				<rating ng-model="rate" max="max" readonly="isReadonly" on-hover="hoveringOver(value)" on-leave="overStar = null"></rating>				
			    <!-- <span class="label" ng-class="{'label-warning': percent<30, 'label-info': percent>=30 && percent<70, 'label-success': percent>=70}" ng-show="overStar && !isReadonly">{{percent}}%</span> -->
			</div>
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-2 text-right">
				<a href=""><span class="single-content-whatsapp"><i class="fa fa-whatsapp" aria-hidden="true"></i></span> </a>
			</div>
		</div>		
		<div class="content-card review-comment-section padding-card custom-row4">			
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 review-colum1">
				<i class="fa fa-star" aria-hidden="true"></i>
				<i class="fa fa-star" aria-hidden="true"></i>
				<i class="fa fa-star" aria-hidden="true"></i>
				<i class="fa fa-star" aria-hidden="true"></i>
				<i class="fa fa-star" aria-hidden="true"></i>
			</div>			
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 review-colum2">
				<div class="customer-feedback-sec">										
					<div class="add-comment">
						<input id="comment_input" type="search" required="required" name="product_comment" class="product_comment_input" placeholder="Write a review">
						<input type="hidden" name="item_id" id="item_id" value="">								
						<button type="button" onclick="productComment()" class="product_comment_button" value="Submit"><i class="fa fa-paper-plane"></i></button>
					</div>
				</div>	
			</div>
		</div>	
		<div class="review-content-section padding-card custom-row5">			
			<div class="row review-card">
				<div class="col-md-2 custom-col-2 col-xs-12">
					<img src="<?= base_url()."assets/img/dummy-image.png" ?> " class="review-image">
				</div>
				<div class="col-md-10 custom-col-10 col-xs-12">
					<p class="review-user-name">Mausam varun </p>
					<p class="review-description">This restaurants serves variety of Cuisines across the world. We tried their signatures dishes which was fantastic. Cocktails are also great.</p>
					<p class="review-date"><i class="fa fa-clock-o" aria-hidden="true"></i> 09 Sep 2020 11:12 PM </p>
					
				</div>
			</div>			
			<div class="row review-card">
				<div class="col-md-2 custom-col-2">
					<img src="<?= base_url()."assets/img/dummy-image.png" ?> " class="review-image">
				</div>
				<div class="col-md-10 custom-col-10">
					<p class="review-user-name">Mausam varun </p>
					<p class="review-description">This restaurants serves variety of Cuisines across the world. We tried their signatures dishes which was fantastic. Cocktails are also great.</p>
					<p class="review-date"><i class="fa fa-clock-o" aria-hidden="true"></i> 09 Sep 2020 11:12 PM </p>
				</div>
			</div>			
			<div class="row review-card">
				<div class="col-md-2 custom-col-2">
					<img src="<?= base_url()."assets/img/dummy-image.png" ?> " class="review-image">
				</div>
				<div class="col-md-10 custom-col-10">
					<p class="review-user-name">Mausam varun </p>
					<p class="review-description">This restaurants serves variety of Cuisines across the world. We tried their signatures dishes which was fantastic. Cocktails are also great.</p>
					<p class="review-date"><i class="fa fa-clock-o" aria-hidden="true"></i> 09 Sep 2020 11:12 PM </p>
					
				</div>
			</div>			
		</div>		
		<div class="social-media-section">			
			<div class="social-section">				
				<a href=""><i class="fa fa-facebook-square" aria-hidden="true"></i></a>
				<a href=""><i class="fa fa-twitter-square" aria-hidden="true"></i></a>
				<a href=""><i class="fa fa-linkedin-square" aria-hidden="true"></i></a>
			</div>
		</div>		
	</div>
</div>
