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
			<a href="" class="free-listing">Free Listing</a>
			<div class="user-login">
				<a class="login-user" data-toggle="modal" data-target="#loginModal">Login</a>
				<a class="signup-user" data-toggle="modal" data-target="#loginModal">Signup</a>
				
			</div>
		</div>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="search">	        		        			
        		<div class="search-area ">	        			
        			<select class="form-control custom-select"  name="searchLocation" ng-model="listingObj.searchLocation" ng-options="o.value as o.value for o in cityList">
                      </select>	        	
        			<input type="search" id="search_input" name="search_input" placeholder="Search.." class="form-control search-input" name="key_words" >
        			<button type="submit" class="form-control search-button" ><i class="fa fa-search" aria-hidden="true" class="search-icon"></i>
					</button>
					<div class="home-search-result home-search-hide" id="dataList">						
					</div>
        			
        		</div>	        	
		    </div>
		</div>
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

<!-- <script type="text/javascript">
	
	function getSearchProduct(){
	    if($("#search_input").val()==''){
	    }
    
	    var keywords = $("#search_input").val()
	    	console.log(keywords);

		      var keyword = $("#search_input").val();
		        $.ajax({
		            type: 'post',
		            data:{keyword:keyword},
		            url: '<?php echo base_url(); ?>/home/getSearchItems/',                
		            async: false,            
		            success: function(response){               
		              if(keywords==''){
		                $('#dataList').html('');
		              }else{
		                $('#dataList').html(response);
		              }

		            },
		            error: function(){
		                //alert('Could not get Data from Database');
		            }
		        });
	}
</script> -->
<!-- Login Modal -->
<div class="modal fade" id="loginModal" role="dialog">
	<div class="modal-dialog">
	  <!-- Modal content-->
	  <div class="modal-content">
	    <div class="modal-header">
	      <button type="button" class="close" data-dismiss="modal">&times;</button>
	      <h4 class="modal-title">Login</h4>
	    </div>
	    <div class="modal-body">	      	
	      	<div class="form-group">		      
		      <input type="text" class="form-control custom-input" id="name" placeholder="Name" name="name">
		    </div>
		    <div class="form-group">		      
		      <input type="text" class="form-control custom-input" id="mobile" placeholder="Mobile Number" name="mobile">
		    </div>
	    </div>
	    <div class="modal-footer">
		    <div>
		    	<button class="btn btn-default otp-button">Send OTP</button>
		    </div>	      
	    </div>
	  </div>
	  
	</div>
</div>