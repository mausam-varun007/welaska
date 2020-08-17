
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 header">
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
				</div><!-- /.carousel -->	
				<div class="search">
		        	<form method="post" action="">
		        		<div class="search-area ">
		        			<select style="width: 100px;height: 38px;" name="city" class="form-control custom-select" id="selected_city">
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
			</div>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 header">
			    <div class="row list-row">

			    	<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 abc" data-ng-repeat="item in category">
			    		<div class="box">
			    			<input type="hidden" name="category" value="Restaurants">
			    			<h6 class="box-h6"><a >{{item.category_name}}</a></h6>
			    			<!-- <p class="box-p">Order Online</p>
			    			<p class="box-p">Book Table</p>
			    			<p class="box-p">Trending</p> -->
			    			<p class="box-p"><a >more...</a></p>
			    			<a >	    				
			    				<img src="{{'assets/image/'+item.category_image}}" class="box-image">
			    			</a>
			    			
			    		</div>
			    	</div>  	
			    	<input type="hidden" name="" id="select_cities">
			    </div>
			</div>
			<div class="col-md-12 footer">
				<div class="box-form">
		    		<h3 class="b-f-h3">What is Your Requirement</h3>
		    		<form>
		    			<input type="text" name="" placeholder="Service Name" class="form-control">
		    			<input type="text" name="" placeholder="Requirement Detals" class="form-control">
		    			<p>Contact No</p>
		    			<div class="box-form-div">
		    				<button type="submit" class="box-form-button">Submit</button>
		    			</div>
		    			
		    		</form>
		    	</div>
			</div>
		</div>
		
	</div>
	