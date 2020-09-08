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
		<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 header-logo-section">
			<p class="logo-text"><a  href="<?= base_url(); ?>">WELASKA</a></p>
		</div>
		<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 header-listing-section">			

			<!-- <form class="example" action="/action_page.php" style="margin:auto;max-width:300px">
			  <input type="text" search-listing-data id="search_input" name="search_input" ng-model="searchData" placeholder="Search.." autocomplete="off" >
			  <button type="submit"><i class="fa fa-search"></i></button>
			</form>		 -->	
			<!-- <div class="search">	        		        			
        		<div class="search-area ">	        			        			
        			<input type="search" id="search_input" name="search_input" placeholder="Search.." class="form-control search-input" name="key_words" >
        			<button type="submit" class="form-control search-button" ><i class="fa fa-search" aria-hidden="true" class="search-icon"></i>
					</button>
					<div class="home-search-result home-search-hide" id="dataList">						
					</div>
        			
        		</div>	        	
		    </div> -->

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
