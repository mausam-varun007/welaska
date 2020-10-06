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
			<a ui-sref="freeListing" class="free-listing">Free Listing</a>			
			<div class="user-login" ng-if="user_name=='' || user_name==null">
				<a class="login-user" data-toggle="modal" data-target="#loginModal" ng-click="modalType='Login'">Login</a>
				<a class="signup-user" data-toggle="modal" data-target="#loginModal" ng-click="modalType='Signup'">Signup</a>
			</div>			
			<div class="profile-image-section dropdown" ng-show="user_name">
				<span class="menu-custom-drp dropdown-toggle" data-toggle="dropdown"><span>Hi {{user_name}} </span>  <img src="{{profile_image}}" class="profile-image"></span>
				<ul class="dropdown-menu">
			      <li><a href="#">My Account</a></li>
			      <li><a href="#">My Profile</a></li>
			      <li class="divider"></li>
			      <li><a ui-sref="Logout">Log Out</a></li>
			    </ul>				
			</div>
		</div>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="search">	        		        			        		
        			<!-- <select class="form-control custom-select"  name="searchLocation" 	ng-model="listingObj.searchLocation" ng-options="o.value as o.value for o in cityList">
                      </select>	  -->

                 <div class="city-dropdown">                 	
                     <md-autocomplete 
			            ng-mouseover="enableScrollOnAutoCompleteList($event)"
			            ng-click="enableScrollOnAutoCompleteList($event)"			            
			            md-dropdown-position="{{customPosition}}"                            
			            md-no-cache="noCache"
			            ng-model="listingObject.city"
			            md-selected-item="citySelectedItem"
			            md-search-text-change="innerHeaderTextChange(searchObj.citySearchText)"
			            md-search-text="searchObj.citySearchText"
			            md-selected-item-change="citySelectedChange(item)"
			            md-items="item in cityQuerySearch(searchObj.citySearchText)"
			            md-item-text="item.city"                          
			            md-clear-button="false" 
			            placeholder="{{(listingObject.city) ? listingObject.city : 'City' }}"
			            input-aria-labelledby="favoriteStateLabel"
			            class="custom-md-autocomplete custom-input"
			            input-aria-describedby="autocompleteDetailedDescription" md-dropdown-position="auto">
			            <mat-option >             
			              <a ng-click="reditectToPage(item)"><span class="search-all-list" md-highlight-text="searchObj.citySearchText" md-highlight-flags="^i" class="capitalize">{{item.city}}</span></a>                             
			            </mat-option>          
			            <md-not-found>
			              <i class="fa fa-exclamation-circle" style="color: red;"></i> No results found
			            </md-not-found>
			        </md-autocomplete>
                 </div>
                      <div class="main-search-md-autocomple">
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
			                <a class="category-items"><span class="search-all-list" md-highlight-text="searchObj.innerHeaderSearchText" md-highlight-flags="^i" class="capitalize">{{item.name}}</span></a>                
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
			            <button type="submit" ng-click="reditectToPage(selectItem)" class="form-control search-button main-search-button" ><i class="fa fa-search" aria-hidden="true" class="search-icon"></i>
						</button>
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
