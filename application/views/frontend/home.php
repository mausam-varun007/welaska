<style type="text/css">
	/* UI Bootstrap Demo */
.ui-bootstrap-carousel {
  width:400px;
  height:200px;
  margin-left:20px;
}
.ui-bootstrap-carousel img {
  width:400px;
}
/* angular-carousel Demo */
.angular-carousel {
  width:400px;
  height:200px;
  margin-left:20px;
}
</style>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style2.css'); ?>">
<!-- <div class="row search-header">
	<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 main-category-row" data-ng-repeat="item in category">
		<div class="content-card">
			<h6 class="category-title"><a ui-sref="listing({location:listingObj.searchLocation,categoryId:item.id})">{{item.category_name}}</a></h6>
			<p class="category-more"><a >more...</a></p>
			<a >	    				
				<img src="{{'assets/image/'+item.category_image}}" class="card-image-img">
			</a>
			
		</div>
	</div>  	
</div> -->
<div class="containers category-container">
	<div class="row category-column">
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 con-card" data-ng-repeat="item in category">
			<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
				<p class="category-title"><a ui-sref="listing({location:listingObj.searchLocation,categoryId:item.id})">{{item.category_name}}</a></p>
				<p class="category-more"><a >more...</a></p>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
				<a >	    				
					<img src="{{'assets/image/'+item.category_image}}" class="card-image-img">
				</a>
			</div>
		</div>		
	</div>
	
</div>

<!-- Login Modal -->
<div class="modal fade" id="loginModal" role="dialog">
	<div class="modal-dialog">
	  <!-- Modal content-->
	  <div class="modal-content">
	    <div class="modal-header">
	      <h4 class="modal-title">Modal Header</h4>
	      <button type="button" class="close" data-dismiss="modal">&times;</button>
	    </div>
	    <div class="modal-body">
	      <p>Some text in the modal.</p>
	    </div>
	    <div class="modal-footer">
	      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	    </div>
	  </div>
	  
	</div>
</div>