<!DOCTYPE html>
<html>
<head>
	<title></title>	
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo base_url('assets/css/docs.theme.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/owlcarousel/assets/owl.carousel.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/owlcarousel/assets/owl.theme.default.min.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/listing_style.css'); ?>">
	<!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style2.css'); ?>"> -->
	<script src="<?php echo base_url('assets/vendors/jquery.min.js'); ?>"></script>
	<script src="<?php echo base_url('assets/owlcarousel/owl.carousel.js'); ?>"></script>
</head>
<body>
	<div class="row search-header" >	
		<div class="main-slider">
			<div class="carousel slide" id="main-carousel" data-ride="carousel">
				<div class="carousel-inner div-inner">
					<div class="carousel-item active">
						<img class="d-block img-fluid" src="https://s19.postimg.cc/qzj5uncgj/slide1.jpg" alt="">
					</div>
					<div class="carousel-item div-inner">
						<img class="d-block img-fluid" src="https://s19.postimg.cc/lmubh3h0j/slide2.jpg" alt="">
					</div>
					<div class="carousel-item div-inner">
						<img class="d-block img-fluid" src="https://s19.postimg.cc/99hh9lr5v/slide3.jpg" alt="">
					</div>
					<div class="carousel-item div-inner">
						<img src="https://s19.postimg.cc/nenabzsnn/slide4.jpg" alt="" class="d-block img-fluid">
					</div>
				</div><!-- /.carousel-inner -->
				
				<a href="#main-carousel" class="carousel-control-prev mainprev" data-slide="prev">
					<span class="carousel-control-prev-icon"></span>
					<span class="sr-only" aria-hidden="true">Prev</span>
				</a>
				<a href="#main-carousel" class="carousel-control-next mainnext" data-slide="next">
					<span class="carousel-control-next-icon"></span>
					<span class="sr-only" aria-hidden="true">Next</span>
				</a>
			</div>
			
		</div>	
		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 search-logo-section">
			<a href="<?= base_url(); ?>" class="logo" style="color: #f00;">WE LASKA</a>
		</div>
		<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12 search-button-section" >
			<div class="search">
	        	<form method="post" action="<?php echo base_url('home/index'); ?>">
	        		<div class="search-area ">
	        			<select name="city" class="form-control custom-select" id="selected_city">
	        				<option class="custom-select" value="Indore">Indore</option>
	        				<option value="Bangalore">Bangalore</option>
	        				<option value="Jabalpure">Jabalpure</option>
	        				<option value="Pune">Pune</option>
	        				<option value="Delhi">Delhi</option>
	        				<option value="Ahmedabed">Ahmedabed</option>
	        				<option value="Chennai">Chennai</option>
	        			</select>
	        			<input type="search" id="search_input" name="search_input" onkeyup="getSearchProduct()" placeholder="Search.." class="form-control search-input" name="key_words" >
	        			<button type="submit" class="form-control search-button" ><i class="fa fa-search" aria-hidden="true" class="search-icon"></i>
						</button>
						<div class="home-search-result home-search-hide" id="dataList">						
						</div>
	        			
	        		</div>
	        	</form>
		    </div>
			<!-- <form class="example" action="/action_page.php" style="margin:auto;max-width:300px">
			  <input type="text" id="search_input" name="search_input" onkeyup="getSearchProduct()" placeholder="Search.." >
			  <button type="submit"><i class="fa fa-search"></i></button>
			</form> -->
			<div id="dataList">
				
			</div>
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