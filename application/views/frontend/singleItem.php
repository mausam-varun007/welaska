<style type="text/css">
	.infinit-scroll-container {
	  height: 150px;
	  overflow-y:scroll
	}
	h3 img {
    max-height: 50px;
    display:none; 
}
#map { 
    height: 400px;
    margin: 20px 0;
    border-radius: 5px;
    border: 1px solid silver;
}

</style>
<div class="row main-content-box" >	
	<div class="row review-all-icons">		
		<div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 goto-icons">
			<span class="inline-edit"><a ng-click="gotoReview('reviewSection')"><img src="<?=base_url()?>assets/img/view_reviews.png" class="edit-listings-icon"></a>View Review</span>
		</div>
		<div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 goto-icons">
			<span class="inline-edit"><a ng-click="gotoReview('ratingSection')" ><img src="<?=base_url()?>assets/img/achiev-star.png" class="edit-listings-icon"></a>Give Rating</span>
		</div>
		<div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 goto-icons" >
			<span class="inline-edit"><a ng-click="gotoReview('ratingSection')" ><img src="<?=base_url()?>assets/img/review.png" class="edit-listings-icon"></a>Review Listing</span>		
		</div>
		<div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 goto-icons">		
			<span class="inline-edit"><a ui-sref="edit-listing({id:itemDetailsByID.id})" ><img src="<?=base_url()?>assets/img/timesheet-ic-min.png" class="edit-listings-icon"></a> Edit Listing</span>
		</div>
		<div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 goto-icons">		
			<span class="inline-edit"><a ng-click="openMap(itemDetailsByID.latitude,itemDetailsByID.longitude)" data-toggle="modal" data-target="#myModal"><img src="<?=base_url()?>assets/img/map.png" class="edit-listings-icon"></a> Map </span>
		</div>
		<div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 goto-icons">		
			<!-- <span class="inline-edit"><a ><img src="<?=base_url()?>assets/img/share_new.png" class="edit-listings-icon"></a> Share </span> -->
			
			<div class="dropdown" >
				<span class="menu-custom-drp dropdown-toggle social-shr" data-toggle="dropdown"><img src="<?=base_url()?>assets/img/share_new.png" class="profile-image">Share</span>
				<ul class="dropdown-menu social-share">			      
			      <li><a social-share data-conf="jobShare.facebook" href="javascript:void(0)" class="share-icon sh-fb-icon" data-toggle="tooltip" title="Share on Facebook">
			            <i class="fa fa-facebook"></i><span class="social-text">Facebook</span> 
			          </a></li>
			      <li><a social-share data-conf="jobShare.twitter" href="javascript:void(0)" class="share-icon sh-tw-icon" data-toggle="tooltip" title="Share on Twitter">
		            <i class="fa fa-twitter"></i><span class="social-text">Twitter</span> 
		          </a></li>
			      <li><a social-share="" data-provider="whatsapp" data-url="{{ jobShare.url }}" class="share-icon sh-wp-icon" data-toggle="tooltip" title="Share on Whatsapp">
		            <i class="fa fa-whatsapp"></i><span class="social-text">Whats App</span> 
		          </a></li>
		          <li><a social-share data-conf="jobShare.linkedin" href="javascript:void(0)" class="share-icon sh-ld-icon" data-toggle="tooltip" title="Share on Linkedin">
		            <i class="fa fa-linkedin"></i><span class="social-text">Linkedin</span> 
		          </a></li>
		          <li><a social-share data-conf="jobShare.clipboard" href="javascript:void(0)" class="share-icon sh-fb-icon" data-toggle="tooltip" title="Copy Link">
		            <i class="fa fa-clone"></i><span class="social-text">Copy Link</span> 
		          </a></li>
			    </ul>				
			</div>
		</div>
	</div>
	<div class="row first-card">			
		<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">				
			<p class="content-title">{{itemDetailsByID.business_name}}</p>				
			<p class="content-type"><i class="fa fa-chevron-right" aria-hidden="true"></i><span> {{itemDetailsByID.category_name}} ...more</span> </p>
			<p class="content-contact"><i class="fa fa-phone" aria-hidden="true"></i> {{itemDetailsByID.mobile}}</p>								
		</div>			
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">				
			<img ng-src="{{itemImagesVO[0].image_url}}" src="<?= base_url()."assets/img/dummy-image.png" ?> " class="card-image">			
		</div>		
	</div>		
	<div class="row second-card">			
		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">				
			<p class="content-location"><span><i class="fa fa-map-marker custom-icon" aria-hidden="true"></i></span> 
				<span >{{itemDetailsByID.street_address}} {{itemDetailsByID.building}} {{itemDetailsByID.area}} {{itemDetailsByID.city}} {{itemDetailsByID.pin_code}}</span>		
				</p>
			<p class="content-world"><i class="fa fa-globe custom-icon" aria-hidden="true"></i> http://www.example.com</p>				
			<div class="hours-section" ng-init="limitedDays=true">   
				<p class="hours-operation">Hours of Operation 
					<span class="show-more" ng-show="limitedDays" ng-click="limitedDays=false">(Show All)</span>
					<span class="show-less" ng-show="!limitedDays" ng-click="limitedDays=true">(Show less...)</span>
				</p>
				<table class="shop-hourse">
					<tr ng-repeat="item in itemShopDetailsByID" ng-show="todayDay==item.id || !limitedDays">
						<td>{{limitedDays ? 'Today' : item.day}}</td>
						<td><span ng-class="item.isChecked==1 ? 'shop-close':''">{{item.isChecked==0 ? item.start_from : 'Closed'}}</span></td>
						<td ng-show="item.isChecked==0">{{item.start_to}}</td>
						<td ng-show="limitedDays && item.isChecked==0"><span ng-class="item.start_from=='Open 24 Hrs' || (currenrtTime > item.start_from && currenrtTime < item.start_to ) ? 'shop-open':'shop-close' ">{{ item.start_from=='Open 24 Hrs' || (currenrtTime > item.start_from && currenrtTime < item.start_to ) ? 'Open Now':'Closed Now' }}</span></td>
					</tr>
				</table>
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" >			
			<div class="iamge-section single-list"> 				
	            <div class="form-group edit-prf-error">             	              
	              <div class="drag-drop-image">
	                <div img-upload ></div>
	              </div> 
	            </div>
	        </div> 	        			
		</div>
	</div>		
	<div class="row third-card" id="ratingSection">			
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-2">
			<a ng-show="itemDetailsByID.likes_exist > 0" class="single-content-whatsapp"><i class="fa fa-thumbs-up" aria-hidden="true"></i></a>
			<a ng-show="itemDetailsByID.likes_exist==0 || !itemDetailsByID.likes_exist" ng-click="likesItems(itemDetailsByID.id)" class="single-content-whatsapp"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></a>
			<p ng-show="itemDetailsByID.likes_count > 0" class="likes-count">{{itemDetailsByID.likes_count}} Likes</p>
		</div>
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-8 text-center rating-section">
			<rating ng-model="rate" max="max" readonly="isReadonly" on-hover="hoveringOver(value)" on-leave="overStar = null" ng-click="giveRating(itemDetailsByID.id)"></rating>				
			<p class="rating-here">Rate Here</p>
		    <!-- <span class="label" ng-class="{'label-warning': percent<30, 'label-info': percent>=30 && percent<70, 'label-success': percent>=70}" ng-show="overStar && !isReadonly">{{percent}}%</span> -->
		</div>
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-2 text-right">
			<a href=""><span class="single-content-whatsapp"><i class="fa fa-whatsapp" aria-hidden="true"></i></span> </a>
		</div>
	</div>	
		
	<div class="row forth-card">			
		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 review-star">			
			<i class="fa fa-star" ng-class="starAvg > 0 ? 'active':'fa-star-o' " aria-hidden="true"></i>
			<i class="fa fa-star" ng-class="starAvg > 1 ? (starAvg > 1 && starAvg < 2 ? 'fa-star-half-o':'active'):'fa-star-o' " aria-hidden="true"></i>
			<i class="fa fa-star" ng-class="starAvg > 2  ? (starAvg > 2 && starAvg < 3 ? 'fa-star-half-o':'active') :'fa-star-o' " aria-hidden="true"></i>
			<i class="fa fa-star" ng-class="starAvg > 3 ? (starAvg > 3 && starAvg < 4 ? 'fa-star-half-o':'active') :'fa-star-o' " aria-hidden="true"></i>
			<i class="fa fa-star" ng-class="starAvg > 4 ? (starAvg > 4 && starAvg < 5 ? 'fa-star-half-o':'active') : 'fa-star-o' " aria-hidden="true"></i>

			<P ng-show="itemDetailsByID.rating_avg" class="average-rating"><span class="rating-avg">{{itemDetailsByID.rating_avg}}</span> </P>
		</div>			
		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
			<div class="customer-feedback-sec">										
				<div class="form-group">			      
			      <textarea style="resize:none" ng-model="review" class="form-control" placeholder="Review" rows="3" id="comment"></textarea>
			    </div>
			    <button ng-click="submitReview(itemDetailsByID.id)" type="button" class="btn review-submit">Submit</button>
			</div>	
		</div>
	</div>	
	<div class="row fifth-card" ng-init="showDefault=5" id="reviewSection">					
		<div class="row review-card" ng-repeat="item in itemReviewsVO" ng-show="$index < showDefault">
			<div class="col-md-2 custom-col-2 col-xs-12">
				<img ng-src="{{item.image}}" src="<?= base_url()."assets/img/dummy-image.png" ?> " class="review-image">
			</div>
			<div class="col-md-10 custom-col-10 col-xs-12">
				<p class="review-user-name" ng-show="item.first_name">{{item.first_name}} {{item.last_name}} </p>
				<p class="review-user-name"  >{{item.review_user_name}}</p>
				<p class="review-description">{{item.review}}.</p>
				<p class="review-date"><i class="fa fa-clock-o" aria-hidden="true"></i> {{item.created_at}}</p>
			</div>
		</div>			
		<div ng-show="itemReviewsVO.length > 5">			
			<p class="load-more" ng-show="showDefault==5" ng-click="showDefault=itemReviewsVO.length"><span class="load-more-button">Show All....</span> </p>
			<p class="load-more" ng-show="showDefault > 5" ng-click="showDefault=5"><span class="load-more-button">Show Less....</span></p>
		</div>
		<!-- <div class="row review-card">
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
		</div>			 -->


		<p class="frequently-question">Frequently Asked Question</p>
		<p ng-show="itemDetailsByID.landmark" class="question">1. Which is the nearest landmark ?</p>
		<p ng-show="itemDetailsByID.landmark" class="answer-of-q">You can easily locate the establishment as it is in close proximity to {{itemDetailsByID.landmark}}</p>
		<p ng-show="itemShopDetailsByID.length > 0" class="question">2. What are its hours of operation ?</p>
		<table class="shop-hourse shop-hourse-questions" ng-show="itemShopDetailsByID.length > 0">
			<tr ng-repeat="item in itemShopDetailsByID">
				<td>{{item.day}}</td>
				<td><span ng-class="item.isChecked==1 ? 'shop-close':''">{{item.isChecked==0 ? item.start_from : 'Closed'}}</span></td>
				<td ng-show="item.isChecked==0">{{item.start_to}}</td>
				<!-- <td ng-show="limitedDays && item.isChecked==0"><span ng-class="item.start_from=='Open 24 Hrs' || (currenrtTime > item.start_from && currenrtTime < item.start_to ) ? 'shop-open':'shop-close' ">{{ item.start_from=='Open 24 Hrs' || (currenrtTime > item.start_from && currenrtTime < item.start_to ) ? 'Open Now':'Closed Now' }}</span></td> -->
			</tr>
		</table>

		<p ng-show="itemDetailsByID.payment_mode" class="question">3. What are the various mode of payment accepted here ?</p>
		<p ng-show="itemDetailsByID.payment_mode" class="answer-of-q">You can make payment Via {{itemDetailsByID.payment_mode}}</p>
	</div>		
	<div class="social-media-section">			
		<div class="social-section">				
			<a href="{{itemDetailsByID.facebook}}"><i class="fa fa-facebook-square" aria-hidden="true"></i></a>
			<a href="{{itemDetailsByID.twitter}}"><i class="fa fa-twitter-square" aria-hidden="true"></i></a>
			<a href="{{itemDetailsByID.linkedin}}"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a>
		</div>
	</div>			
</div>

<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Location</h4>
        </div>
        <div class="modal-body">
        	<!-- ng-app="GoogleMaps" ng-controller="GoogleMaps" -->
        	<div>
			    <div class="example playground">			        
			        <google-maps id="playground"
	                     data-markers="{{markers}}"
	                     data-center="{{center}}"
	                     data-zoom="{{zoom}}"
	                     data-focus-on="{{focusOn}}">
			        </google-maps>        
				</div>        
        	</div>
        	<div class="container google-map-custom" data-ng-app="App" data-ng-controller="freeListingCtrl">
			  <div id="map"></div>
			</div>

        <!-- <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div> -->
      </div>
      
    </div>
  </div>
</div>

