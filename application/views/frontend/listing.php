<div class="row" >		
	<div class="col-md-12 main-content" ng-repeat="item in listingDataVO"> 
		<div class="content-card">
			<div class="col-md-4">				
				<a href="">	
					<img src="https://www.system-concepts.com/wp-content/uploads/2019/06/mouse-blue-background-banner.jpg" class="card-image">
				</a>
			</div>
			<div class="col-md-8 content-detrail-section">				
				<p class="content-title" ><a ui-sref="singleItem({itemId:item.id})">{{item.business_name}} </a></p>				
				<p class="content-contact"><i class="fa fa-phone" aria-hidden="true"></i>{{item.phone1}}</p> 

				<p class="content-rating"><span class="rating-text">4.2</span>&nbsp; 
					<span> <i class="fa fa-star" aria-hidden="true"></i></span>
					<span><i class="fa fa-star" aria-hidden="true"></i></span> 
					<span><i class="fa fa-star" aria-hidden="true"></i></span>
					<span><i class="fa fa-star" aria-hidden="true"></i></span>
					<span><i class="fa fa-star" aria-hidden="true"></i></span>
					<span><i class="fa fa-star-half-o" aria-hidden="true"></i></span>
					<span class="number-of-rating">Rating</span>
				</p>

				<p class="content-location"><span><i class="fa fa-map-marker" aria-hidden="true"></i></span> 
				<span>{{item.street_address}}</span>		
				</p>
				<p class="content-type"><i class="fa fa-chevron-right" aria-hidden="true"></i><span><a href="">	{{item.category_name}}</a>...more</span> </p>
				<p class="content-price"><i class="fa fa-chevron-right" aria-hidden="true"></i> 
				<span>Open Now </span>
				</p>

			</div>			
		</div>		
	</div>
</div>




{{test}}