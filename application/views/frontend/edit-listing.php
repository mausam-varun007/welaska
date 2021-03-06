<div class="detail-form-sec">  
  <!-- <div class="heading-li">
    <a>Business Informating</a>
  </div> -->
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="df-list">  
        <!-- <ul class="hide-xss">
          <li class="heading-li"><a>Business Informating</a></li>
          <li ng-click="step='location'" ng-class="step=='location' ? 'active' : '' "><a>Location Informating</a></li>
          <li ng-click="step='contact'" ng-class="step=='contact' ? 'active' : '' "><a>Contact Informating</a></li>
          <li ng-click="step='others'" ng-class="step=='others' ? 'active' : '' "><a>Other Informating</a></li>          
          <li ng-click="step='keyword'" ng-class="step=='keyword' ? 'active' : '' "><a>Keywords</a></li>
          <li ng-click="step='upload'" ng-class="step=='upload' ? 'active' : '' " data-toggle="modal" data-target="#myModal"><a>Upload Video/Logo/Pictures</a></li>
        </ul> -->
        <!-- <select class="df-select show-xs">
          <option>Location Informating</option>
          <option>Contact Informating</option>
          <option>Other Informating</option>
          <option>Business Keywords</option>
          <option>Add Keywords</option>
          <option>View/Remove Keywords</option>
          <option>Upload Video/Logo/Pictures</option>
        </select> -->
      </div>
    </div>      
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="df-content main-content">
        <!-- <div class="df-form-sec" id="1" ng-show="step=='location'"> -->        
        <div class="df-form-sec listing-edit-sec" id="1" ng-init="hoverTrure=false">
            <span class="inline-edit  first-edit-lst" ng-class="hoverTrure ? 'image-big' : '' " ng-mouseleave="hoverTrure=false" ng-mousemove="hoverTrure = true"><a ng-click="isBusinessDetailsEdit=true" ><img src="<?=base_url()?>assets/img/edit-icon1.png"></a></span>
            <h4 class="heading-title">Location Informating</h4>
            <div class="row">
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                  <label class="control-label">Business Name <span ng-show="!isBusinessDetailsEdit" class="level-edit">: {{listingObject.business_name}} </span></label>
                  <input ng-show="isBusinessDetailsEdit" type="text" class="form-control custom-input" ng-model="listingObject.business_name">
                  <span  class="error-msg"></span>
                </div>
              </div>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                  <label class="control-label">Building <span ng-show="!isBusinessDetailsEdit" class="level-edit">: {{listingObject.building}} </span></label>
                  <input ng-show="isBusinessDetailsEdit" type="text" class="form-control custom-input" ng-model="listingObject.building">
                  <span  class="error-msg" ></span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                  <label class="control-label">Street <span ng-show="!isBusinessDetailsEdit" class="level-edit">: {{listingObject.street_address}} </span></label>
                  <input ng-show="isBusinessDetailsEdit" type="text" class="form-control custom-input" ng-model="listingObject.street_address">
                  <span  class="error-msg"></span>
                </div>
              </div>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                  <label class="control-label">Landmark <span ng-show="!isBusinessDetailsEdit" class="level-edit">: {{listingObject.landmark}} </span></label>
                  <input ng-show="isBusinessDetailsEdit" type="text" class="form-control custom-input" ng-model="listingObject.landmark">
                  <span  class="error-msg" ></span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                  <label class="control-label">Area <span ng-show="!isBusinessDetailsEdit" class="level-edit">: {{listingObject.area}} </span></label>
                  <input ng-show="isBusinessDetailsEdit" type="text" class="form-control custom-input" ng-model="listingObject.area">
                  <span  class="error-msg"></span>
                </div>
              </div>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="form-group freelist-city">
                  <label class="control-label">City <span ng-show="!isBusinessDetailsEdit" class="level-edit">: {{listingObject.city}} </span></label>
                  <!-- <input ng-show="isBusinessDetailsEdit" type="text" ng-click="notEditable('City')" ng-model="listingObject.city" readonly="" class="form-control custom-input" ng-change="checkCategoryOrCompany()"> -->
                  
                  <md-autocomplete 
                    ng-mouseover="enableScrollOnAutoCompleteList($event)"                    
                    ng-show="isBusinessDetailsEdit"
                    ng-click="enableScrollOnAutoCompleteList($event)"
                    ng-focus="isSearchFocus=true"
                    ng-blur="isSearchFocus=false"
                    md-dropdown-position="{{customPosition}}"                            
                    md-no-cache="noCache"
                    ng-model="listingObject.city"
                    md-selected-item="listingObject.city"
                    md-search-text-change="innerHeaderTextChange(searchObj.citySearchText)"
                    md-search-text="searchObj.citySearchText"
                    md-selected-item-change="citySelectedChange(item,$event)"
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
                  <label class="control-label">Pin Code <span ng-show="!isBusinessDetailsEdit" class="level-edit">: {{listingObject.pin_code}} </span></label>
                  <input ng-show="isBusinessDetailsEdit" type="text" class="form-control custom-input" ng-model="listingObject.pin_code" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? false : (event.charCode >= 48 && event.charCode <= 57) || (event.charCode==46 || event.charCode==46)" maxlength="6">
                  <!-- <select class="custom-select">
                    <option>Select Pincode</option>
                    <option>Select Pincode</option>
                  </select> -->
                </div>
              </div>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                  <label class="control-label">State <span ng-show="!isBusinessDetailsEdit" class="level-edit">: {{listingObject.state}} </span></label>
                  <input ng-show="isBusinessDetailsEdit" type="text" ng-click="notEditable('State')"  class="form-control custom-input" ng-model="listingObject.state" readonly="">
                  <span  class="error-msg" ></span>
                </div>
              </div>
            </div>            
            <div class="fl-btn-sec">
              <button ng-show="isBusinessDetailsEdit" ng-click="submitLocationInfo()" class="btn submit-button"> <img src="<?php echo base_url() ?>assets/img/btn-loading.gif" class="load-img" ng-show="isLoadingActive"><span>{{(isLoadingActive) ?'':'Update'}}</span></button>
              <!-- <a ng-click="step='contact'" class="pull-right">Next <i class="fa fa-arrow-right"></i></a> -->
            </div>
        </div>
        <div class="df-form-sec listing-edit-sec" id="1" ng-init="hoverTrure=false">
            <span class="inline-edit  first-edit-lst" ng-class="hoverTrure ? 'image-big' : '' " ng-mouseleave="hoverTrure=false" ng-mousemove="hoverTrure = true"><a ng-click="isBusinessDetailsEdit=true" ><img src="<?=base_url()?>assets/img/edit-icon1.png"></a></span>
            <h4 class="heading-title">Upload or Delete Images</h4>
            <div class="row">
              <div class="iamge-section edit-list">         
                  <div class="form-group edit-prf-error">                             
                    <div class="drag-drop-image">
                      <div img-upload ></div>
                    </div> 
                  </div>
              </div>          
            </div>
        </div>
        <div class="df-form-sec listing-edit-sec" id="2" ng-init="hoverTrure1=false">            
            <span class="inline-edit  first-edit-lst" ng-class="hoverTrure1 ? 'image-big' : '' " ng-mouseleave="hoverTrure1=false" ng-mousemove="hoverTrure1 = true"><a ng-click="isContactDetailsEdit=true" ><img src="<?=base_url()?>assets/img/edit-icon1.png"></a></span>
            <h4 class="heading-title">Contact Informating</h4>
            <div class="row">
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                  <label class="control-label">Contact Person <span ng-show="!isContactDetailsEdit" class="level-edit">: {{listingObject.contact_person}} </span></label>
                  <input ng-show="isContactDetailsEdit" type="text" class="form-control custom-input" ng-model="listingObject.contact_person">
                  <span  class="error-msg"></span>
                </div>
              </div>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                  <label class="control-label">Designation <span ng-show="!isContactDetailsEdit" class="level-edit">: {{listingObject.designation}} </span></label>
                  <input ng-show="isContactDetailsEdit" type="text" class="form-control custom-input" ng-model="listingObject.designation">
                  <span  class="error-msg" ></span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                  <label class="control-label">Landline No. <span ng-show="!isContactDetailsEdit" class="level-edit">: {{listingObject.land_line}} </span></label>
                  <input ng-show="isContactDetailsEdit" type="text" class="form-control custom-input" ng-model="listingObject.land_line">
                  <span  class="error-msg"></span>
                </div>
              </div>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                  <label class="control-label">Mobile No. <span ng-show="!isContactDetailsEdit" class="level-edit">: {{listingObject.mobile}} </span></label>
                  <input ng-show="isContactDetailsEdit" type="text" class="form-control custom-input" ng-model="listingObject.mobile" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? false : (event.charCode >= 48 && event.charCode <= 57) || (event.charCode==46 || event.charCode==46)" maxlength="10">
                  <span  class="error-msg" ></span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                  <label class="control-label">Fax No. <span ng-show="!isContactDetailsEdit" class="level-edit">: {{listingObject.fax}} </span></label>
                  <input ng-show="isContactDetailsEdit" type="text" class="form-control custom-input" ng-model="listingObject.fax">
                  <span  class="error-msg"></span>
                </div>
              </div>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                  <label class="control-label">Toll Free No. <span ng-show="!isContactDetailsEdit" class="level-edit">: {{listingObject.toll_free_number}} </span></label>
                   <input ng-show="isContactDetailsEdit" type="text" class="form-control custom-input" ng-model="listingObject.toll_free_number">
                  <span  class="error-msg" ></span>
                </div>
              </div>
            </div>                     
            <div class="row">
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                  <label class="control-label">Email Id <span ng-show="!isContactDetailsEdit" class="level-edit">: {{listingObject.email}} </span></label>
                  <input ng-show="isContactDetailsEdit" type="email" class="form-control custom-input" ng-model="listingObject.email">
                  <span  class="error-msg" ></span>
                </div>
              </div>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                  <label class="control-label">Website <span ng-show="!isContactDetailsEdit" class="level-edit">: {{listingObject.website}}</span></label>
                  <input ng-show="isContactDetailsEdit" type="text" class="form-control custom-input" ng-model="listingObject.website">
                  <span  class="error-msg" ></span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                  <label class="control-label">Facebook <span ng-show="!isContactDetailsEdit" class="level-edit">: {{listingObject.facebook}}</span></label>
                  <input ng-show="isContactDetailsEdit" type="text" class="form-control custom-input" ng-model="listingObject.facebook">
                  <span  class="error-msg" ></span>
                </div>
              </div>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                  <label class="control-label">Twitter <span ng-show="!isContactDetailsEdit" class="level-edit">: {{listingObject.twitter}}</span></label>
                  <input ng-show="isContactDetailsEdit" type="text" class="form-control custom-input" ng-model="listingObject.twitter">
                  <span  class="error-msg" ></span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                  <label class="control-label">Instagram <span ng-show="!isContactDetailsEdit" class="level-edit">: {{listingObject.instagram}}</span></label>
                  <input ng-show="isContactDetailsEdit" type="text" class="form-control custom-input" ng-model="listingObject.instagram">
                  <span  class="error-msg" ></span>
                </div>
              </div>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                  <label class="control-label">Linkedin <span ng-show="!isContactDetailsEdit" class="level-edit">: {{listingObject.linkedin}}</span></label>
                  <input ng-show="isContactDetailsEdit" type="text" class="form-control custom-input" ng-model="listingObject.linkedin">
                  <span  class="error-msg" ></span>
                </div>
              </div>
            </div>
             <div class="row">
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                  <label class="control-label">Others <span ng-show="!isContactDetailsEdit" class="level-edit">: {{listingObject.others}}</span></label>
                  <input ng-show="isContactDetailsEdit" type="text" class="form-control custom-input" ng-model="listingObject.others">
                  <span  class="error-msg" ></span>
                </div>
              </div>
            </div>
            <div class="fl-btn-sec">
              <!-- <a ng-click="step='location'" class="pull-left"><i class="fa fa-arrow-left"></i> Previous</a> -->
              <!-- <button class="btn se-btn">Save & Exit</button> -->
              <button ng-show="isContactDetailsEdit" class="btn sc-btn submit-button" ng-click="submitContact()"><img src="<?php echo base_url() ?>assets/img/btn-loading.gif" class="load-img" ng-show="isLoadingActive"><span>{{(isLoadingActive) ?'':'Update'}}</span></button>
              <!-- <a ng-click="step='others'" class="pull-right" >Next <i class="fa fa-arrow-right"></i></a> -->
            </div>
        </div>
        <div class="df-form-sec" id="3" ng-init="hoverTrure2=false">
            <span class="inline-edit  first-edit-lst" ng-class="hoverTrure2 ? 'image-big' : '' " ng-mouseleave="hoverTrure2=false" ng-mousemove="hoverTrure2 = true"><a ng-click="isOthersDetailsEdit=true" ><img src="<?=base_url()?>assets/img/edit-icon1.png"></a></span>            
            <h4 class="heading-title">Other Informating</h4>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <h5 class="hurs-oprtn">Hours of Operation</h5>
                <div class="display-radio" ng-init="is_display_hours=1">                  
                  <md-radio-group ng-model="is_display_hours" ng-blur="submitForm(3)">
                    <md-radio-button value="1" name="is_display_hours"  class="md-primary">Display hours of operation</md-radio-button>                                  
                    <md-radio-button value="0" name="is_display_hours"  class="md-primary">Do not display hours of operation</md-radio-button>                  
                  </md-radio-group>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="week" ng-class="!isOthersDetailsEdit ? 'disable-click':''">
                  <p class="hours-select"><span>Monday :</span>                                        
                      <select class="form-control custom-select-input" ng-class="isOverallExperience ? 'border-error-red':'border-success-green'" name="monday_from" ng-model="monday_from" required="" ng-readonly="!isOthersDetailsEdit" ng-options="o as o.display for o in workingHours track by o.id">
                      </select>         
                    To                    
                      <select class="form-control custom-select-input" ng-class="isOverallExperience ? 'border-error-red':'border-success-green'" name="overall_experince" ng-model="monday_to" ng-readonly="!isOthersDetailsEdit" required="" ng-options="o as o.display for o in workingHours track by o.id">
                      </select>                       
                      <input type="checkbox" ng-model="monday_closed" name="0" class="close-checkbox"> Closed
                  </p>
                  <p class="hours-select"><span>Tuesday :</span>
                    <select class="form-control custom-select-input" ng-class="isOverallExperience ? 'border-error-red':'border-success-green'" name="overall_experince" ng-model="tuesday_from" ng-readonly="!isOthersDetailsEdit" required="" ng-options="o as o.display for o in workingHours track by o.id">
                          </select>                       
                    To
                    <select class="form-control custom-select-input" ng-class="isOverallExperience ? 'border-error-red':'border-success-green'" name="overall_experince" ng-model="tuesday_to" required="" ng-readonly="!isOthersDetailsEdit" ng-options="o as o.display for o in workingHours track by o.id">
                    </select>                       
                    
                    <input type="checkbox" id="0" ng-model="tuesday_closed" name="0" class="close-checkbox"> Closed
                  </p>
                  <p class="hours-select"><span>Wednesday :</span>
                    <select class="form-control custom-select-input" ng-class="isOverallExperience ? 'border-error-red':'border-success-green'" name="overall_experince" ng-model="wednesday_from" ng-readonly="!isOthersDetailsEdit" required="" ng-options="o as o.display for o in workingHours track by o.id">
                          </select>                       
                    To
                    <select class="form-control custom-select-input" ng-class="isOverallExperience ? 'border-error-red':'border-success-green'" name="overall_experince" ng-model="wednesday_to" required="" ng-readonly="!isOthersDetailsEdit" ng-options="o as o.display for o in workingHours track by o.id">
                    </select>                       
                    <input type="checkbox" id="0" name="0" ng-model="wednesday_closed" class="close-checkbox"> Closed
                  </p>
                  <p class="hours-select"><span>Thursday :</span>
                    <select class="form-control custom-select-input" ng-class="isOverallExperience ? 'border-error-red':'border-success-green'" name="overall_experince" ng-model="thursday_from" ng-readonly="!isOthersDetailsEdit" required="" ng-options="o as o.display for o in workingHours track by o.id">
                          </select>                       
                    To
                    <select class="form-control custom-select-input" ng-class="isOverallExperience ? 'border-error-red':'border-success-green'" name="overall_experince" ng-model="thursday_to" ng-readonly="!isOthersDetailsEdit" required="" ng-options="o as o.display for o in workingHours track by o.id">
                    </select>                       
                    
                    <input type="checkbox" id="0" ng-model="thursday_closed" class="close-checkbox"> Closed
                  </p>
                  <p class="hours-select"><span>Friday :</span>
                    <select class="form-control custom-select-input" ng-class="isOverallExperience ? 'border-error-red':'border-success-green'" name="overall_experince" ng-model="friday_from" ng-readonly="!isOthersDetailsEdit" required="" ng-options="o as o.display for o in workingHours track by o.id">
                          </select>                       
                    To
                    <select class="form-control custom-select-input" ng-class="isOverallExperience ? 'border-error-red':'border-success-green'" name="overall_experince" ng-model="friday_to" ng-readonly="!isOthersDetailsEdit" required="" ng-options="o as o.display for o in workingHours track by o.id">
                    </select>                                           
                    <input type="checkbox" id="0" name="0" ng-model="friday_closed" class="close-checkbox"> Closed
                  </p>
                  <p class="hours-select">
                    <span>Saturday :</span>
                    <select class="form-control custom-select-input" ng-class="isOverallExperience ? 'border-error-red':'border-success-green'" name="overall_experince" ng-model="saturday_from" ng-readonly="!isOthersDetailsEdit" required="" ng-options="o as o.display for o in workingHours track by o.id">
                          </select>                       
                    To
                    <select class="form-control custom-select-input" ng-class="isOverallExperience ? 'border-error-red':'border-success-green'" name="overall_experince" ng-model="saturday_to" ng-readonly="!isOthersDetailsEdit" required="" ng-options="o as o.display for o in workingHours track by o.id">
                    </select>                       
                    
                    <input type="checkbox" id="0" ng-model="saturday_closed" class="close-checkbox"> Closed
                  </p>
                  <p class="hours-select"><span>Sunday :</span>
                    <select class="form-control custom-select-input" ng-class="isOverallExperience ? 'border-error-red':'border-success-green'" name="overall_experince" ng-model="sunday_from" ng-readonly="!isOthersDetailsEdit" required="" ng-options="o as o.display for o in workingHours track by o.id">
                          </select>                       
                    To
                    <select class="form-control custom-select-input" ng-class="isOverallExperience ? 'border-error-red':'border-success-green'" name="overall_experince" ng-model="sunday_to" ng-readonly="!isOthersDetailsEdit" required="" ng-options="o as o.display for o in workingHours track by o.id">
                    </select>                                           
                    <input type="checkbox" id="0" name="0" ng-model="sunday_closed" ng-value="sunday_closed" value="1" ng-checked="sunday_closed" checked="{{sunday_closed}}" class="close-checkbox"> Closed
                  </p>
                </div>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <h5 class="hurs-oprtn">Payment Modes Accepted By You</h5>
                <div class="payment_mode" ng-class="!isOthersDetailsEdit ? 'disable-click':''" >
                  <ul>
                    <li ng-repeat="item in paymentMode">
                      <md-checkbox md-no-ink aria-label="Full Time" ng-model="item.isChecked" class="md-primary color-primary availablility-plan-title" ng-click="!isOthersDetailsEdit ? readonlyFunc() : ''">{{item.value}}
                      </md-checkbox> 
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <hr>           
            <div class="fl-btn-sec">
              <!-- <a ng-click="step='contact'" class="pull-left"><i class="fa fa-arrow-left"></i> Previous</a> -->
              <!-- <button class="btn se-btn">Save & Exit</button> -->
              <button ng-show="isOthersDetailsEdit" class="btn sc-btn submit-button" ng-click="submitOthers()"><img src="<?php echo base_url() ?>assets/img/btn-loading.gif" class="load-img" ng-show="isLoadingActive"><span>{{(isLoadingActive) ?'':'Update'}}</span></button>
              <!-- <a ng-click="step='keyword'"  class="pull-right">Next <i class="fa fa-arrow-right"></i></a> -->
            </div>
        </div>
        <div class="df-form-sec" id="4" ng-init="hoverTrure3=false">          
          <span class="inline-edit  first-edit-lst" ng-class="hoverTrure3 ? 'image-big' : '' " ng-mouseleave="hoverTrure3=false" ng-mousemove="hoverTrure3 = true"><a ng-click="isKeywordDetailsEdit=true" ><img src="<?=base_url()?>assets/img/edit-icon1.png"></a></span>
          
          <h4 class="heading-title">Keywords & Category</h4>
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <h5 class="hurs-oprtn">Add Category</h5>
              <div class="form-group ">                  
                <md-autocomplete ng-disabled="isDisabled" 
                  ng-mouseover="enableScrollOnAutoCompleteList($event)"
                  ng-click="enableScrollOnAutoCompleteList($event)"
                  ng-focus="isSearchFocus=true"
                  ng-blur="isSearchFocus=false"
                  ng-readonly="!isKeywordDetailsEdit"
                  md-dropdown-position="{{customPosition}}"                            
                  md-selected-item="listingObject.category_name" 
                  md-search-text-change="searchTextChange(searchText)" 
                  md-search-text="searchText" 
                  md-selected-item-change="categorySelectedChange(item)" 
                  md-items="item in categoryQuerySearch(searchText)" 
                  md-item-text="item.city" 
                  md-min-length="0" 
                  md-escape-options="clear" 
                  placeholder="Choose Category" 
                  class="category-dropdown"
                  input-aria-labelledby="favoriteStateLabel">
                  <md-item-template>
                    <span md-highlight-text="searchText" md-highlight-flags="^i">{{item.city}}</span>
                  </md-item-template>
                  <md-not-found>
                    No states matching "{{searchText}}" were found.
                    <a ng-click="newState(searchText)">Create a new one!</a>
                  </md-not-found>
                </md-autocomplete>
              </div>
            </div>

            <div class="col-md-12 col-sm-12 col-xs-12">
              <h5 class="hurs-oprtn">Business Keywords</h5>
              <p class="bk-p">For business keywords that you no longer wish to be listed in simply click on cross next to the keyword and when you are done, Click "Save"</p>
              <div class="keyword-chips">
                    <md-chips ng-model="keywordObject" md-add-on-blur="true" readonly="readonly" ng-change="onModelChange(keywordObject)"  placeholder="Enter keywords..." input-aria-label="Fruit names" md-removable="removable"></md-chips>
              </div>
              <!-- <div class="bk-add">
                <a href="" class="pull-right">Add More Keywords</a>
              </div> -->
            </div>
          </div>
          <div class="fl-btn-sec">
            <!-- <a href="" class="pull-left" ng-click="step='others'" ><i class="fa fa-arrow-left"></i> Previous</a> -->
            <!-- <button class="btn se-btn">Save & Exit</button> -->
            <button ng-show="isKeywordDetailsEdit" ng-click="submitKeywords()" class="btn sc-btn submit-button"><img src="<?php echo base_url() ?>assets/img/btn-loading.gif" class="load-img" ng-show="isLoadingActive"><span>{{(isLoadingActive) ?'':'Update'}}</span></button>
          </div>
        </div>        
      </div>
      <div class="fl-btn-sec">          
        <button class="btn sc-btn submit-button" ui-sref="singleItem({itemId:listingObject.id})"><img src="<?php echo base_url() ?>assets/img/btn-loading.gif" class="load-img" ng-show="isLoadingActive"><span>{{(isLoadingActive) ?'':'Preview'}}</span></button>          
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog custom-modal">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Business Listing Summary</h4>
        </div>
        <div class="modal-body">
          <div ng-show="!isVerificationActive">            
            <p>You just need to verify your listing now and it will be LIVE on Welaska!</p>
            <span>(The verification SMS will be sent on the Mobile number)</span>
          </div>
          <div class="verification-section" ng-show="isVerificationActive">         
            <p>Please enter your verification code</p>
              <div class="form-group">          
              <input type="text" class="form-control custom-input" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? false : (event.charCode >= 48 && event.charCode <= 57) || (event.charCode==46 || event.charCode==46)" maxlength="6" id="verification_code" placeholder="Verification Code" ng-model="item_verification_code" name="item_verification_code">
            </div>          
          </div>
        </div>
        <div class="modal-footer fl-btn-sec">
          <button type="button" class="btn btn-default submit-button" ng-click="getVerificatioCode()" > {{!isVerificationActive ? 'Click to get verification code' : 'Verify' }} </button>
        </div>
      </div>
      
    </div>
  </div>
  