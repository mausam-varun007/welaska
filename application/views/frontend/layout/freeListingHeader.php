<!DOCTYPE html>
<html>
<head>
	<title></title>	
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo base_url('assets/css/docs.theme.min.css'); ?>">	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/listing_style.css'); ?>">	
	<script src="<?php echo base_url('assets/vendors/jquery.min.js'); ?>"></script>

</head>

<body>
	<div class="row search-header" >	
		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 header-logo-section">
			<p class="logo-text"><a  href="<?= base_url(); ?>">WELASKA</a></p>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 header-listing-section">
	      <p class="free-listing-logo">Free Listing</p>
		</div>				  
      	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 header-listing-section">
			<div class="user-login" ng-if="user_name=='' || user_name==null">
				<a class="login-user" data-toggle="modal" data-target="#loginModal" ng-click="modalType='Login'">Login</a>
				<a class="signup-user" data-toggle="modal" data-target="#loginModal" ng-click="modalType='Signup'">Signup</a>
			</div>			
			<div class="profile-image-section dropdown" ng-show="user_name">
				<span class="menu-custom-drp dropdown-toggle" data-toggle="dropdown"><span>Hi {{user_name}} </span>  <img src="{{profile_image}}" class="profile-image"></span>
				<ul class="dropdown-menu">
			      <!-- <li><a href="#">My Account</a></li> -->
			      <li><a ui-sref="profile({id:user_id})">My Profile</a></li>
			      <li class="divider"></li>
			      <li><a ui-sref="Logout">Log Out</a></li>
			    </ul>				
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
		    	<button class="btn btn-default otp-button" login-signup ng-click="SignupLogin()">{{!isVerificationActives ? 'Send OTP' : 'Verify'}}</button>
		    </div>	      
	    </div>
	  </div>
	  
	</div>
</div>