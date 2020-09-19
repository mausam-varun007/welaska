<!DOCTYPE html>
<html>
<head>
	<title></title>	
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"> -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo base_url('assets/css/docs.theme.min.css'); ?>">
	<!-- <link rel="stylesheet" href="<?php echo base_url('assets/owlcarousel/assets/owl.carousel.min.css'); ?>"> -->
	<!-- <link rel="stylesheet" href="<?php echo base_url('assets/owlcarousel/assets/owl.theme.default.min.css'); ?>"> -->
	<!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style2.css'); ?>"> -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/listing_style.css'); ?>">
	<!-- <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.7.6/angular.min.js"></script>       -->
	<script src="<?php echo base_url('assets/vendors/jquery.min.js'); ?>"></script>
	<!-- <script src="<?php echo base_url('assets/owlcarousel/owl.carousel.js'); ?>"></script> -->

</head>

<body>
	<div class="row search-header" >	
		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 header-logo-section">
			<p class="logo-text"><a  href="<?= base_url(); ?>">WELASKA</a></p>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 header-listing-section">
	      <div class="search-md-autocomple">
			    <md-autocomplete 
	              ng-mouseover="enableScrollOnAutoCompleteList($event)"
	              ng-click="enableScrollOnAutoCompleteList($event)"
	              ng-focus="isSearchFocus=true"
	              ng-blur="isSearchFocus=false"
	              md-dropdown-position="{{customPosition}}"                            
	              md-no-cache="noCache"
	              ng-model="searchData"
	              md-selected-item="classmateSelectedItem"
	              md-search-text-change="innerHeaderTextChange(searchObj.innerHeaderSearchText)"
	              md-search-text="searchObj.innerHeaderSearchText"
	              md-selected-item-change="innerHeaderChange(item)"
	              md-items="item in innerHeaderQuerySearch(searchObj.innerHeaderSearchText)"
	              md-item-text="item.name"              
	              placeholder="{{isSearchFocus ? searchLocation : 'Search'}}"
	              md-clear-button="true" 
	              input-aria-labelledby="favoriteStateLabel"
	              class="custom-md-autocomplete"
	              input-aria-describedby="autocompleteDetailedDescription" md-dropdown-position="auto">
	              <mat-option >
	               <!--  <img style="vertical-align:middle;" aria-hidden data-ng-src="{{(item.image) ? item.image : '<?= base_url() ?>assets/img/defualt-logo.png'}}" height="20" /> -->               
	                <a ng-click="reditectToPage(item)"><span class="search-all-list" md-highlight-text="searchObj.innerHeaderSearchText" md-highlight-flags="^i" class="capitalize">{{item.name}}</span></a>                
	               <!-- <a href="" ng-if="item.type='item_type'">               	
	                <span class="category-item" md-highlight-text="searchObj.innerHeaderSearchText" md-highlight-flags="^i" class="capitalize">{{item.name}}</span>                
	               </a> -->
	              </mat-option>
	              <!-- <md-item-template>
	                <span md-highlight-text="searchObj.innerHeaderSearchText" md-highlight-flags="^i" class="capitalize">{{item.name + ' ' +item.last_name}} </span>&nbsp; <span class="help-email">{{item.email}}</span>
	              </md-item-template> -->
	              <md-not-found>
	                <i class="fa fa-exclamation-circle" style="color: red;"></i> No results found
	              </md-not-found>
	            </md-autocomplete>   
	            <button type="submit" class="form-control search-button" ><i class="fa fa-search" aria-hidden="true" class="search-icon"></i>
				</button>
	      </div>
		</div>				  
      	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 header-listing-section">
			<div class="user-login" ng-if="user_name=='' || user_name==null">
				<a class="login-user" data-toggle="modal" data-target="#loginModal" ng-click="modalType='Login'">Login</a>
				<a class="signup-user" data-toggle="modal" data-target="#loginModal" ng-click="modalType='Signup'">Signup</a>
			</div>
			<div class="inner-free-listing">				
				<a ui-sref="freeListing" class="free-inner-listing">Free Listing</a>
			</div>
			<div class="profile-image-section" ng-show="user_name">
				<span>Hi {{user_name}} </span>  <img src="{{profile_image}}" class="profile-image">
			</div>
	  	</div>
		</div>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			
		<div class="main-slider-div">
		   <carousel interval="myInterval">
		      <slide ng-repeat="slide in slides" active="slide.active">
		        <img class="slider-image" ng-src="{{slide.image}}" style="margin:auto;">
		        <div class="carousel-caption">
		          <!-- <h4>Slide {{$index}}</h4>
		          <p>{{slide.text}}</p> -->
		        </div>
		      </slide>
		   </carousel>		   
		</div>		
	</div>

</body>
</html>

<!-- Login Modal -->
<div class="modal fade" id="loginModal" role="dialog">
	<div class="modal-dialog">
	  <!-- Modal content-->
	  <div class="modal-content">
	    <div class="modal-header">
	      <button type="button" class="close" data-dismiss="modal">&times;</button>
	      <h4 class="modal-title">{{modalType}}</h4>
	    </div>
	    <div class="modal-body">	      	
	    	<div class="mobile-section" ng-show="!isVerificationActives">	    		
		      	<div class="form-group">		      
			      <input type="text" class="form-control custom-input" id="name" placeholder="Name" name="name" ng-model="listingObj.user_name">
			    </div>
			    <div class="form-group">		      
			      <input type="text" class="form-control custom-input" id="mobile" placeholder="Mobile Number" ng-model="listingObj.mobile" name="mobile">
			    </div>
	    	</div>
	    	<div class="verification-section" ng-show="isVerificationActives">	    		
	    		<p>Please enter your mobile verification code</p>
		      	<div class="form-group">		      
			      <input type="number" class="form-control custom-input" minlength="6" maxlength="6" id="verification_code" placeholder="Verification Code" ng-model="listingObj.verification_code" name="verification_code">
			    </div>			    
	    	</div>
	    </div>
	    <div class="modal-footer">
		    <div>
		    	<button class="btn btn-default otp-button" login-signup ng-click="SignupLogin()">{{!isVerificationActives ? 'Send OTP' : 'Verify'}} </button>
		    </div>	      
	    </div>
	  </div>
	  
	</div>
</div>