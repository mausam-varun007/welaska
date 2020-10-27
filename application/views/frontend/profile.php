<div class="detail-form-sec">
  <!-- <div class="heading-li">
    <a>Business Informating</a>
  </div> -->
  <div class="row">
    <div class="col-md-3 col-sm-3 col-xs-12">
      <div class="df-list profile-list">  
        <ul class="hide-xss">
          <li ng-click="step='personal'" ng-class="step=='personal' ? 'complete' : '' "><a><span class="info-gray"> <i class="fa" ng-class="isPersonalDetailsCompleted ? 'fa-check-square-o' : 'fa-dot-circle-o' " aria-hidden="true"></i></span> Personal Details</a></li>
          <li ng-click="step='address'" ng-class="step=='address' ? 'complete' : '' "><a><span class="info-gray"> <i class="fa" ng-class="isAddressCompleted ? 'fa-check-square-o' : 'fa-dot-circle-o' " aria-hidden="true"></i></span> Addresses</a></li>
          <!-- <li ng-click="step='contact'" ng-class="step=='contact' ? 'active' : '' "><a>Credit / Debit Cards</a></li> -->
          <li ng-click="step='documents'" ng-class="step=='documents' ? 'complete' : '' "><a><span class="info-gray"> <i class="fa fa-dot-circle-o" ng-class="isDocuemntsCompleted ? 'fa-check-square-o' : 'fa-dot-circle-o' " aria-hidden="true"></i></span> Documents</a></li>
          <li ng-click="step='all'" ng-class="step=='all' ? 'complete' : '' "><a><span class="info-gray"> <i class="fa" ng-class="isAllCompleted ? 'fa-check-square-o' : 'fa-dot-circle-o' " aria-hidden="true"></i></span> Completed</a></li>
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
        <div class="df-form-sec" id="0" ng-show="step=='personal'">                      
            <div class="row">
              <div class="col-md-3 col-sm-3 col-xs-12">
                <input id="prfileImage" type="file" ng-file-select="onFileSelect($files)" ng-model="imageSrc">
                <a ng-show="imageSrc==''" ng-click="imageCall()"><img class="profile-add-images" src="<?=base_url()?>assets/img/add-new.png" /></a>           
                <a ng-show="imageSrc!=''" ng-click="imageCall()"><img class="profile-edit-images" src="<?=base_url()?>assets/img/edit-icon1.png" /></a>           

                <img class="profile-inages" ng-src="{{imageSrc!='' ? imageSrc : profileImageSrc }}" />
              </div>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <div class="form-group">
                    <label class="control-label">First Name</label>
                    <input type="text" class="form-control custom-input" ng-model="listingObject.first_name">
                    <span  class="error-msg"></span>
                  </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <div class="form-group">
                    <label class="control-label">Last Name</label>
                    <input type="text" class="form-control custom-input" ng-model="listingObject.last_name">
                    <span  class="error-msg" ></span>
                  </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <div class="form-group">
                    <label class="control-label">Email</label>
                    <input type="text" class="form-control custom-input" ng-model="listingObject.email">
                    <span  class="error-msg"></span>
                  </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <div class="form-group">
                    <label class="control-label">Mobile</label>
                    <input type="text" readonly="" class="form-control custom-input" ng-model="listingObject.mobile">
                    <span  class="error-msg" ></span>
                  </div>
                </div>
                <div class="fl-btn-sec adrs-btn">
                  <button ng-click="submitPersonalDetails('personal')" class="btn submit-button"> <img src="<?php echo base_url() ?>assets/img/btn-loading.gif" class="load-img" ng-show="isLoadingActive"><span>{{(isLoadingActive) ?'':'Submit'}}</span></button>
                  <a ng-click="step='address'"  class="pull-right">Next <i class="fa fa-arrow-right"></i></a>
                </div>
              </div>              
            </div>            
            <!-- <div class="row">
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                  <label class="control-label">Area</label>
                  <input type="text" class="form-control custom-input" ng-model="listingObject.area">
                  <span  class="error-msg"></span>
                </div>
              </div>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="form-group freelist-city">
                  <label class="control-label">City</label>
                  <input type="text" ng-click="notEditable('City')" ng-model="listingObject.city" readonly="" class="form-control custom-input" ng-change="checkCategoryOrCompany()">
                  <span  class="error-msg" ></span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                  <label class="control-label">Pin Code</label>
                  <input type="text" class="form-control custom-input" ng-model="listingObject.pin_code" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? false : (event.charCode >= 48 && event.charCode <= 57) || (event.charCode==46 || event.charCode==46)" maxlength="6">                 
                </div>
              </div>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                  <label class="control-label">State</label>
                  <input type="text" ng-click="notEditable('State')"  class="form-control custom-input" ng-model="listingObject.state" readonly="">
                  <span  class="error-msg" ></span>
                </div>
              </div>
            </div>  -->                       
        </div>
        <div class="df-form-sec" id="1" ng-show="step=='address'">
            <div class="row" ng-init="isAddressNew=false">
              <div class="col-md-12 col-sm-12 col-xs-12 address-btn">
                <button ng-show="!isAddressNew" type="button" ng-click="isAddressNew=true" class="btn address-button">Add New Address</button>
              </div>
            </div>
            <div class="address" ng-show="isAddressNew">              
              <div class="row">
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <div class="form-group">
                    <label class="control-label">Name</label>
                    <input type="text" class="form-control custom-input" ng-model="listingObject.address_name">
                    <span  class="error-msg"></span>
                  </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <div class="form-group">
                    <label class="control-label">Contact Number</label>
                    <input type="text" class="form-control custom-input" ng-model="listingObject.contact_number">
                    <span  class="error-msg" ></span>
                  </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <div class="form-group">
                    <label class="control-label">Email</label>
                    <input type="text" class="form-control custom-input" ng-model="listingObject.address_email">
                    <span  class="error-msg" ></span>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <div class="form-group">
                    <label class="control-label">Address</label>
                    <input type="text" class="form-control custom-input" ng-model="listingObject.address">
                    <span  class="error-msg"></span>
                  </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <div class="form-group">
                    <label class="control-label">Pincode</label>
                    <input type="text" class="form-control custom-input" ng-model="listingObject.address_pin_code">
                    <span  class="error-msg" ></span>
                  </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <div class="form-group">
                    <label class="control-label">City</label>
                    <md-autocomplete 
                      ng-mouseover="enableScrollOnAutoCompleteList($event)"
                      ng-click="enableScrollOnAutoCompleteList($event)"
                      ng-focus="isSearchFocus=true"
                      ng-blur="isSearchFocus=false"
                      md-dropdown-position="{{customPosition}}"                            
                      md-no-cache="noCache"
                      ng-model="listingObject.address_city"
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
              <div class="fl-btn-sec adrs-btn">
                <button ng-click="submitPersonalDetails('address')" class="btn submit-button"> <img src="<?php echo base_url() ?>assets/img/btn-loading.gif" class="load-img" ng-show="isLoadingActive"><span>{{(isLoadingActive) ?'':'Submit'}}</span></button>
                <!-- <a ng-click="step='documents'" class="pull-right">Next <i class="fa fa-arrow-right"></i></a> -->
              </div>
            </div>
            <div class="address-showing" ng-repeat="item in listingObjectAdd">
              <span class="inline-edit  tras-add"><a ng-click="removeAddress(item.id)" ><img src="<?=base_url()?>assets/img/trash.png"></a></span>
              <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <div class="form-group">
                    <label class="control-label">Name <span class="level-edit">: {{item.address_name}} </span></label>
                  </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <div class="form-group">
                    <label class="control-label">Contact Number <span class="level-edit">: {{item.contact_number}} </span></label>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <div class="form-group">
                    <label class="control-label">Email <span class="level-edit">: {{item.address_email}} </span></label>
                  </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <div class="form-group">
                    <label class="control-label">Address<span class="level-edit">: {{item.address}} </span></label>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <div class="form-group">
                    <label class="control-label">Pin Code <span class="level-edit">: {{item.address_pin_code}} </span></label>
                  </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <div class="form-group">
                    <label class="control-label">City<span class="level-edit">: {{item.address_city}} </span></label>
                  </div>
                </div>
              </div>
              
            </div>

            <!-- <div class="row">
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                  <label class="control-label">Land Mark</label>
                  <input type="text" class="form-control custom-input" ng-model="listingObject.landmark">
                  <span  class="error-msg"></span>
                </div>
              </div>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="form-group freelist-city">
                  <label class="control-label">City</label>                  

                  <span  class="error-msg" ></span>
                </div>
              </div>
            </div> -->
            <!-- <div class="row">
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                  <label class="control-label">Pin Code</label>
                  <input type="text" class="form-control custom-input" ng-model="listingObject.pin_code" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? false : (event.charCode >= 48 && event.charCode <= 57) || (event.charCode==46 || event.charCode==46)" maxlength="6">               
                </div>
              </div>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                  <label class="control-label">State</label>
                  <input type="text" ng-click="notEditable('State')"  class="form-control custom-input" ng-model="listingObject.state" readonly="">
                  <span  class="error-msg" ></span>
                </div>
              </div>
            </div>             -->            
        </div>        
        <div class="df-form-sec" id="3" ng-show="step=='documents'">

            <div class="iamge-section edit-list">         
                <!-- <div class="form-group edit-prf-error">                             
                  <div class="drag-drop-image">
                    <div file-upload ></div>
                  </div> 
                </div> -->
                <div class="drag-drop-image" file-upload >
                  <input class="fileUpload" name="file" type="file" multiple/>
                  <div class="dropzone">
                    <p class="msg uploading-placeholder"><span>Click here to Upload</span> Or Drag and Drop a File</p>
                  </div>                          
                  <div class="added-files">
                    <span class="cap" ng-repeat="data in previewData track by $index" ng-switch on="data.ext">
                    <span class="skill-tag"><span class="capsule"><a href="{{(data.src)?data.src:data.url}}" target="_blank">
                    <i class="fa fa-file-image-o" ng-switch-when="jpg"></i>
                    <i class="fa fa-file-image-o" ng-switch-when="jpeg"></i>
                    <i class="fa fa-file-image-o" ng-switch-when="bmp"></i>
                    <i class="fa fa-file-image-o" ng-switch-when="png"></i>
                    <i class="fa fa-file-pdf-o" ng-switch-when="pdf"></i>
                    <i class="fa fa-file-o" ng-switch-default></i>
                    {{data.name}}</a><a href="javascript:void(0)" ng-click="remove(data)" class="remove-icon"><i class="fa fa-times"></i></a> </span>
                    </span>
                    </span>                          
                    <!--  <span class="skill-tag" ng-if="proposalAttachments"  ng-repeat="items in proposalAttachments"><a href="{{items.attachment_url}}" target="_blank"> <p>{{items.name}}</a><a href="javascript:void(0)" ng-click="removeAttachments(items,'old_file')" class="remove-icon"><i class="fa fa-times"></i></a></p></span>                           -->
                    <!-- <span class="skill-tag" ng-show="uploadStatus"><p><a>Uploading..<i class="fa fa-circle-o-notch fa-spin fa-3x fa-fw upload-status"></i></a></p></span> -->
                  </div>
                </div>

            </div>                              
            <div class="fl-btn-sec">
              <!-- <a ng-click="step='contact'" class="pull-left"><i class="fa fa-arrow-left"></i> Previous</a> -->
              <!-- <button class="btn se-btn">Save & Exit</button> -->
              <button class="btn sc-btn submit-button" ng-click="step='all'"><img src="<?php echo base_url() ?>assets/img/btn-loading.gif" class="load-img" ng-show="isLoadingActive"><span>{{(isLoadingActive) ?'':'Next'}}</span></button>
              <a ng-click="step='all'" class="pull-right">Next <i class="fa fa-arrow-right"></i></a>
            </div>
        </div>
        <div class="df-form-sec all-stps" id="4" ng-show="step=='all'">
          <div class="row">
            <p class="cmplt-sec">Personal Details </p>
          </div>
          <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="form-group">
                <label class="control-label">First Name : <span class="sut-txt">{{listingObject.first_name}} </span> </label>                
              </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="form-group">
                <label class="control-label">Last Name : <span class="sut-txt">{{listingObject.last_name}} </span> </label>                
              </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="form-group">
                <label class="control-label">Email : <span class="sut-txt">{{listingObject.email}} </span> </label>
              </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="form-group">
                <label class="control-label">Mobile : <span class="sut-txt">{{listingObject.mobile}} </span> </label>                
              </div>
            </div>
          </div>          
          <div class="row">
            <p class="cmplt-sec">Address </p>
          </div>
          <div ng-repeat="item in listingObjectAdd">              
              <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <div class="form-group">
                    <label class="control-label">Name <span class="sut-txt">: {{item.address_name}} </span></label>
                  </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <div class="form-group">
                    <label class="control-label">Contact Number <span class="sut-txt">: {{item.contact_number}} </span></label>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <div class="form-group">
                    <label class="control-label">Email <span class="sut-txt">: {{item.address_email}} </span></label>
                  </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <div class="form-group">
                    <label class="control-label">Address<span class="sut-txt">: {{item.address}} </span></label>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <div class="form-group">
                    <label class="control-label">Pin Code <span class="sut-txt">: {{item.address_pin_code}} </span></label>
                  </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <div class="form-group">
                    <label class="control-label">City<span class="sut-txt">: {{item.address_city}} </span></label>
                  </div>
                </div>
              </div>              
          </div>
          <div class="row">
            <p class="cmplt-sec">Documents </p>

            <div class="added-files">
              <span ng-repeat="data in previewData track by $index" ng-switch on="data.ext">
              <span class="skill-tag"><span class="capsule"><a href="{{(data.src)?data.src:data.url}}" target="_blank">
              <i class="fa fa-file-image-o" ng-switch-when="jpg"></i>
              <i class="fa fa-file-image-o" ng-switch-when="jpeg"></i>
              <i class="fa fa-file-image-o" ng-switch-when="bmp"></i>
              <i class="fa fa-file-image-o" ng-switch-when="png"></i>
              <i class="fa fa-file-pdf-o" ng-switch-when="pdf"></i>
              <i class="fa fa-file-o" ng-switch-default></i>
              {{data.name}}</a>
              <!-- <a href="javascript:void(0)" ng-click="remove(data)" class="remove-icon"><i class="fa fa-times"></i></a> --> </span>
              </span>
              </span>                                        
            </div>
          </div>
        </div>
        <div class="df-form-sec" id="4" ng-show="step=='upload'">
          <h3>Veriy Your Listing</h3>
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
  