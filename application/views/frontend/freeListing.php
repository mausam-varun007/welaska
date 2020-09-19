<div class="freelisting-sec main-content">
	<h4>List your business for <span>Free</span> with India's leading local search engine</h4>
	<h6>Enter your details below</h6>
	<div class="row">
    <div class="col-md-6 col-sm-6 col-xs-12">
      <div class="form-group">
        <label class="control-label">Company Name <span>*</span></label>
        <input type="text" ng-model="listingObject.company_name" class="form-control custom-input">
        <!-- <span  class="error-msg">ddfdf</span> -->
      </div>
    </div>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <div class="form-group freelist-city" >
        <label class="control-label">City <span>*</span></label>
         <md-autocomplete 
            ng-mouseover="enableScrollOnAutoCompleteList($event)"
            ng-click="enableScrollOnAutoCompleteList($event)"
            ng-focus="isSearchFocus=true"
            ng-blur="isSearchFocus=false"
            md-dropdown-position="{{customPosition}}"                            
            md-no-cache="noCache"
            ng-model="listingObject.city"
            md-selected-item="citySelectedItem"
            md-search-text-change="innerHeaderTextChange(searchObj.citySearchText)"
            md-search-text="searchObj.citySearchText"
            md-selected-item-change="citySelectedChange(item)"
            md-items="item in innerHeaderQuerySearch(searchObj.citySearchText)"
            md-item-text="item.city"                          
            md-clear-button="true" 
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
        <span  class="error-msg" ></span>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6 col-sm-6 col-xs-12">
      <div class="form-group">
        <label class="control-label">First Name</label>
        <input type="text" ng-model="listingObject.first_name" class="form-control custom-input">
        <span  class="error-msg"></span>
      </div>
    </div>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <div class="form-group">
        <label class="control-label">Last Name</label>
        <input type="text" ng-model="listingObject.last_name" class="form-control custom-input">
        <span  class="error-msg" ></span>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6 col-sm-6 col-xs-12">
      <div class="form-group">
        <label class="control-label">Mobile Number</label>
        <input type="text" ng-model="listingObject.mobile" class="form-control custom-input">
        <span  class="error-msg" ></span>        
      </div>
    </div>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <div class="form-group">
        <label class="control-label">Landline Number </label>
        <input type="text" ng-model="listingObject.land_line" class="form-control custom-input">
        <span  class="error-msg"></span>
      </div>
    </div>
  </div>  
  <div class="fl-btn-sec">
  	<button type="button" class="btn submit-button" ng-click="submitBasicDetails()"><img src="<?php echo base_url() ?>assets/img/btn-loading.gif" class="load-img" ng-show="isLoadingActive"><span>{{(isLoadingActive) ?'':'Submit'}}</span></button>
  </div>
</div>
