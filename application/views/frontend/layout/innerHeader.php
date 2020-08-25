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
	<script src="<?php echo base_url('assets/vendors/jquery.min.js'); ?>"></script>
	<!-- <script src="<?php echo base_url('assets/owlcarousel/owl.carousel.js'); ?>"></script> -->

</head>

<body>
	<div class="row search-header" >	
		<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 header-logo-section">
			<p class="logo-text"><a href="" style="color: #f00;">WE LASKA</a></p>
		</div>
		<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 header-listing-section">			
			<form class="example" action="/action_page.php" style="margin:auto;max-width:300px">
			  <input type="text" id="search_input" name="search_input" onkeyup="getSearchProduct()" placeholder="Search.." >
			  <button type="submit"><i class="fa fa-search"></i></button>
			</form>
			<!-- <div class="search">	        		        			
        		<div class="search-area ">	        			        			
        			<input type="search" id="search_input" name="search_input" placeholder="Search.." class="form-control search-input" name="key_words" >
        			<button type="submit" class="form-control search-button" ><i class="fa fa-search" aria-hidden="true" class="search-icon"></i>
					</button>
					<div class="home-search-result home-search-hide" id="dataList">						
					</div>
        			
        		</div>	        	
		    </div> -->
			<a href="" class="free-inner-listing">Free Listing</a>
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
