<div class="detail-form-sec">
  <div class="df-top">
    <h3>You are few steps away from availing a Free listing at Welaska</h3>
  </div>
  <!-- <div class="heading-li">
    <a>Business Informating</a>
  </div> -->
  <div class="row">
    <div class="col-md-3 col-sm-3 col-xs-12">
      <div class="df-list">  
        <ul class="hide-xss">
          <li class="heading-li"><a>Business Informating</a></li>
          <li ng-click="step='location'" ng-class="step=='location' ? 'active' : '' "><a>Location Informating</a></li>
          <li ng-click="step='contact'" ng-class="step=='contact' ? 'active' : '' "><a>Contact Informating</a></li>
          <li ng-click="step='others'" ng-class="step=='others' ? 'active' : '' "><a>Other Informating</a></li>          
          <li ng-click="step='keyword'" ng-class="step=='keyword' ? 'active' : '' "><a>Keywords</a></li>
          <!-- <li><a>View/Remove Keywords</a></li> -->
          <li ng-click="step='upload'" ng-class="step=='upload' ? 'active' : '' " data-toggle="modal" data-target="#myModal"><a>Upload Video/Logo/Pictures</a></li>
        </ul>
        <select class="df-select show-xs">
          <option>Location Informating</option>
          <option>Contact Informating</option>
          <option>Other Informating</option>
          <option>Business Keywords</option>
          <option>Add Keywords</option>
          <option>View/Remove Keywords</option>
          <option>Upload Video/Logo/Pictures</option>
        </select>
      </div>
    </div>    
    <div class="col-md-9 col-sm-9 col-xs-12">
      <div class="df-content main-content">
        <div class="df-form-sec" id="1" ng-show="step=='location'">
            <div class="row">
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                  <label class="control-label">Business Name</label>
                  <input type="text" class="form-control custom-input" ng-model="listingObject.business_name">
                  <span  class="error-msg"></span>
                </div>
              </div>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                  <label class="control-label">Building</label>
                  <input type="text" class="form-control custom-input" ng-model="listingObject.building">
                  <span  class="error-msg" ></span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                  <label class="control-label">Street</label>
                  <input type="text" class="form-control custom-input" ng-model="listingObject.street_address">
                  <span  class="error-msg"></span>
                </div>
              </div>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                  <label class="control-label">Landmark</label>
                  <input type="text" class="form-control custom-input" ng-model="listingObject.landmark">
                  <span  class="error-msg" ></span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                  <label class="control-label">Area</label>
                  <input type="text" class="form-control custom-input" ng-model="listingObject.area">
                  <span  class="error-msg"></span>
                </div>
              </div>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                  <label class="control-label">City</label>
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
                  <label class="control-label">Pin Code</label>
                  <input type="text" class="form-control custom-input" ng-model="listingObject.pin_code">
                  <!-- <select class="custom-select">
                    <option>Select Pincode</option>
                    <option>Select Pincode</option>
                  </select> -->
                </div>
              </div>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                  <label class="control-label">State</label>
                  <input type="text" class="form-control custom-input" ng-model="listingObject.state" readonly="">
                  <span  class="error-msg" ></span>
                </div>
              </div>
            </div>            
            <div class="fl-btn-sec">
              <button ng-click="submitLocationInfo()" class="btn">Submit</button>
              <a href="" class="pull-right">Next <i class="fa fa-arrow-right"></i></a>
            </div>
        </div>
        <div class="df-form-sec" id="2" ng-show="step=='contact'">
            <div class="row">
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                  <label class="control-label">Contact Person</label>
                  <input type="text" class="form-control custom-input" ng-model="listingObject.contact_person">
                  <span  class="error-msg"></span>
                </div>
              </div>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                  <label class="control-label">Designation</label>
                  <input type="text" class="form-control custom-input" ng-model="listingObject.designation">
                  <span  class="error-msg" ></span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                  <label class="control-label">Landline No.</label>
                  <input type="text" class="form-control custom-input" ng-model="listingObject.land_line_number">
                  <span  class="error-msg"></span>
                </div>
              </div>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                  <label class="control-label">Mobile No.</label>
                  <input type="text" class="form-control custom-input" ng-model="listingObject.mobile">
                  <span  class="error-msg" ></span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                  <label class="control-label">Fax No.</label>
                  <input type="text" class="form-control custom-input" ng-model="listingObject.fax">
                  <span  class="error-msg"></span>
                </div>
              </div>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                  <label class="control-label">Toll Free No.</label>
                   <input type="text" class="form-control custom-input" ng-model="listingObject.toll_free_number">
                  <span  class="error-msg" ></span>
                </div>
              </div>
            </div>                     
            <div class="row">
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                  <label class="control-label">Email Id</label>
                  <input type="text" class="form-control custom-input" ng-model="listingObject.email">
                  <span  class="error-msg" ></span>
                </div>
              </div>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                  <label class="control-label">Website</label>
                  <input type="text" class="form-control custom-input" ng-model="listingObject.website">
                  <span  class="error-msg" ></span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                  <label class="control-label">Facebook</label>
                  <input type="text" class="form-control custom-input" ng-model="listingObject.facebook">
                  <span  class="error-msg" ></span>
                </div>
              </div>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                  <label class="control-label">Twitter</label>
                  <input type="text" class="form-control custom-input" ng-model="listingObject.twitter">
                  <span  class="error-msg" ></span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                  <label class="control-label">Instagram</label>
                  <input type="text" class="form-control custom-input" ng-model="listingObject.instagram">
                  <span  class="error-msg" ></span>
                </div>
              </div>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                  <label class="control-label">YouTube</label>
                  <input type="text" class="form-control custom-input" ng-model="listingObject.youtube">
                  <span  class="error-msg" ></span>
                </div>
              </div>
            </div>
             <div class="row">
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                  <label class="control-label">Others</label>
                  <input type="text" class="form-control custom-input" ng-model="listingObject.others">
                  <span  class="error-msg" ></span>
                </div>
              </div>
            </div>
            <div class="fl-btn-sec">
              <a href="" class="pull-left"><i class="fa fa-arrow-left"></i> Previous</a>
              <!-- <button class="btn se-btn">Save & Exit</button> -->
              <button class="btn sc-btn" ng-click="submitContact()">Save & Continue</button>
              <a href="" class="pull-right" ng-click="submitContact()">Next <i class="fa fa-arrow-right"></i></a>
            </div>
        </div>
        <div class="df-form-sec" id="3" ng-show="step=='others'">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <h5 class="hurs-oprtn">Hours of Operation</h5>
                <div class="form-group">
                  <span class="custom-radio-left"> 
                    <input type="radio" id="male" name="gender" value="male" class="custom-radio"  checked="checked">
                    <label for="male">Display hours of operation</label>
                  </span>
                  <span class="custom-radio-left"> 
                    <input type="radio" id="female" name="gender" value="female" class="custom-radio">
                    <label for="female">Do not display hours of operation</label>
                  </span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="week">
                  <p class="hours-select"><span>Monday :</span>                                        
                      <select class="form-control custom-select-input" ng-class="isOverallExperience ? 'border-error-red':'border-success-green'" name="monday_from" ng-model="monday_from" required="" ng-options="o as o.display for o in workingHours track by o.id">
                      </select>         
                    To                    
                      <select class="form-control custom-select-input" ng-class="isOverallExperience ? 'border-error-red':'border-success-green'" name="overall_experince" ng-model="monday_to" required="" ng-options="o as o.display for o in workingHours track by o.id">
                      </select>                       
                      <input type="checkbox" ng-model="monday_closed" name="0" class="close-checkbox"> Closed
                  </p>
                  <p class="hours-select"><span>Tuesday :</span>
                    <select class="form-control custom-select-input" ng-class="isOverallExperience ? 'border-error-red':'border-success-green'" name="overall_experince" ng-model="tuesday_from" required="" ng-options="o as o.display for o in workingHours track by o.id">
                          </select>                       
                    To
                    <select class="form-control custom-select-input" ng-class="isOverallExperience ? 'border-error-red':'border-success-green'" name="overall_experince" ng-model="tuesday_to" required="" ng-options="o as o.display for o in workingHours track by o.id">
                    </select>                       
                    
                    <input type="checkbox" id="0" ng-model="tuesday_closed" name="0" class="close-checkbox"> Closed
                  </p>
                  <p class="hours-select"><span>Wednesday :</span>
                    <select class="form-control custom-select-input" ng-class="isOverallExperience ? 'border-error-red':'border-success-green'" name="overall_experince" ng-model="wednesday_from" required="" ng-options="o as o.display for o in workingHours track by o.id">
                          </select>                       
                    To
                    <select class="form-control custom-select-input" ng-class="isOverallExperience ? 'border-error-red':'border-success-green'" name="overall_experince" ng-model="wednesday_to" required="" ng-options="o as o.display for o in workingHours track by o.id">
                    </select>                       
                    <input type="checkbox" id="0" name="0" ng-model="wednesday_closed" class="close-checkbox"> Closed
                  </p>
                  <p class="hours-select"><span>Thursday :</span>
                    <select class="form-control custom-select-input" ng-class="isOverallExperience ? 'border-error-red':'border-success-green'" name="overall_experince" ng-model="thursday_from" required="" ng-options="o as o.display for o in workingHours track by o.id">
                          </select>                       
                    To
                    <select class="form-control custom-select-input" ng-class="isOverallExperience ? 'border-error-red':'border-success-green'" name="overall_experince" ng-model="thursday_to" required="" ng-options="o as o.display for o in workingHours track by o.id">
                    </select>                       
                    
                    <input type="checkbox" id="0" ng-model="thursday_closed" class="close-checkbox"> Closed
                  </p>
                  <p class="hours-select"><span>Friday :</span>
                    <select class="form-control custom-select-input" ng-class="isOverallExperience ? 'border-error-red':'border-success-green'" name="overall_experince" ng-model="friday_from" required="" ng-options="o as o.display for o in workingHours track by o.id">
                          </select>                       
                    To
                    <select class="form-control custom-select-input" ng-class="isOverallExperience ? 'border-error-red':'border-success-green'" name="overall_experince" ng-model="friday_to" required="" ng-options="o as o.display for o in workingHours track by o.id">
                    </select>                                           
                    <input type="checkbox" id="0" name="0" ng-model="friday_closed" class="close-checkbox"> Closed
                  </p>
                  <p class="hours-select">
                    <span>Saturday :</span>
                    <select class="form-control custom-select-input" ng-class="isOverallExperience ? 'border-error-red':'border-success-green'" name="overall_experince" ng-model="saturday_from" required="" ng-options="o as o.display for o in workingHours track by o.id">
                          </select>                       
                    To
                    <select class="form-control custom-select-input" ng-class="isOverallExperience ? 'border-error-red':'border-success-green'" name="overall_experince" ng-model="saturday_to" required="" ng-options="o as o.display for o in workingHours track by o.id">
                    </select>                       
                    
                    <input type="checkbox" id="0" ng-model="saturday_closed" class="close-checkbox"> Closed
                  </p>
                  <p class="hours-select"><span>Sunday :</span>
                    <select class="form-control custom-select-input" ng-class="isOverallExperience ? 'border-error-red':'border-success-green'" name="overall_experince" ng-model="sunday_from" required="" ng-options="o as o.display for o in workingHours track by o.id">
                          </select>                       
                    To
                    <select class="form-control custom-select-input" ng-class="isOverallExperience ? 'border-error-red':'border-success-green'" name="overall_experince" ng-model="sunday_to" required="" ng-options="o as o.display for o in workingHours track by o.id">
                    </select>                                           
                    <input type="checkbox" id="0" name="0" ng-model="sunday_closed" class="close-checkbox"> Closed
                  </p>
                </div>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <h5 class="hurs-oprtn">Payment Modes Accepted By You</h5>
                <div class="payment_mode">
                  <ul>
                    <li ng-repeat="item in paymentMode">
                      <md-checkbox md-no-ink aria-label="Full Time" ng-model="item.isChecked" class="md-primary color-primary availablility-plan-title" >{{item.value}}
                      </md-checkbox> 
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <hr>
            <!-- <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <h5 class="hurs-oprtn">Company Information</h5>
                <div class="company_info">
                  <p>
                    <label>Year Of Establishment:</label>
                    <input class="small jd_rule" type="text" name="year_establishment" id="year_establishment" value="" placeholder="1995" maxlength="4" validation="yearestablish">
                    <input class="medium" type="text" name="annual_turnover" id="annual_turnover" value="" placeholder="Annual Turnover">
                    <select class="large" id="number_employees" name="number_employees">
                      <option value="Not Answered">Select No of Employees</option>
                      <option value="Less than 10">Less than 10</option>
                      <option value="10-100">10-100</option>
                      <option value="100-500">100-500</option>
                      <option value="500-1000">500-1000</option>
                      <option value="1000-2000">1000-2000</option>
                      <option value="2000-5000">2000-5000</option>
                      <option value="5000-10000">5000-10000</option>
                      <option value="More than 10000">More than 10000</option>
                    </select>
                  </p>
                  <p>
                    <label>Professional Associations:</label>
                    <input type="text" name="assoc" value="" class="input-right">
                  </p>
                  <p>
                    <label>Certifications:</label>
                    <input type="text" name="certifications" value="" class="input-right">
                  </p>
                </div>
              </div>
            </div> -->
            <div class="fl-btn-sec">
              <a href="" class="pull-left"><i class="fa fa-arrow-left"></i> Previous</a>
              <!-- <button class="btn se-btn">Save & Exit</button> -->
              <button class="btn sc-btn" ng-click="submitOthers()">Save & Continue</button>
              <a href="" class="pull-right">Next <i class="fa fa-arrow-right"></i></a>
            </div>
        </div>
        <div class="df-form-sec" id="4" ng-show="step=='keyword'">
          <div class="row">
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
            <a href="" class="pull-left"><i class="fa fa-arrow-left"></i> Previous</a>
            <!-- <button class="btn se-btn">Save & Exit</button> -->
            <button ng-click="submitKeywords()" class="btn sc-btn">Save & Continue</button>
          </div>
        </div>
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
              <input type="number" class="form-control custom-input" minlength="6" maxlength="6" id="verification_code" placeholder="Verification Code" ng-model="item_verification_code" name="item_verification_code">
            </div>          
          </div>
        </div>
        <div class="modal-footer fl-btn-sec">
          <button type="button" class="btn btn-default" ng-click="getVerificatioCode()" > {{!isVerificationActive ? 'Click to get verification code' : 'Verify' }} </button>
        </div>
      </div>
      
    </div>
  </div>
  