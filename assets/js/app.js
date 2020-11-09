var app = angular.module('App', ['ngAnimate','ngSanitize','ui.bootstrap','ui.router','ngMaterial', 'ngMessages','toastr','socialShare']); 

app.service('homeService', function ($http,$q,$rootScope) {
    var getCategoryList    = undefined;
     
    this.getCategoryList = function() {
  
       if (!getCategoryList) { 
        
        var deferred = $q.defer(); 
        // get skills list form backend
        $http.post(Base_url+'get/category')
          .then(function(result) {            
            getCategoryList = result.data.data;            
            deferred.resolve(getCategoryList);
          }, function(error) {
            getCategoryList = error;
            deferred.reject(error);
          }); 
        
        getCategoryList = deferred.promise;
      }
      return $q.when(getCategoryList);
    }
});
app.service('Map', function($q) {
    this.init = function(lat,long) {
        var options = {
            center: new google.maps.LatLng(lat, long),
            zoom: 13,
            disableDefaultUI: true    
        }
        this.map = new google.maps.Map(
            document.getElementById("map"), options
        );
        this.places = new google.maps.places.PlacesService(this.map);
    }
    
    this.search = function(str) {
        var d = $q.defer();
        this.places.textSearch({query: str}, function(results, status) {
            if (status == 'OK') {
                d.resolve(results[0]);
            }
            else d.reject(status);
        });
        return d.promise;
    }
    
    this.addMarker = function(res) {
        if(this.marker) this.marker.setMap(null);
        this.marker = new google.maps.Marker({
            map: this.map,
            position: res.geometry.location,
            animation: google.maps.Animation.DROP
        });
        this.map.setCenter(res.geometry.location);
    }
    
});
app.factory('storageService', ['$rootScope', function ($rootScope) {
    return {
        get: function (key) {
            return localStorage.getItem(key);
        },
        set: function (key, data) {
            localStorage.setItem(key, data);
        }
    };
}]);

app.config(function (toastrConfig) {
    angular.extend(toastrConfig, {
            autoDismiss: false,
            allowHtml:true,
            containerId: 'toast-container',
            maxOpened: 0, 
            progressBar: true,   
            newestOnTop: true,
            positionClass: 'toast-top-center custom-developer-toster',
            preventDuplicates: false,
            preventOpenDuplicates: false,
            timeOut: 6000,
            target: 'body',
            bodyOutputType: 'trustedHtml'
    });
});
app.directive('lightgallery', function () {
    return {
        restrict: 'A',
        link: function (scope, element, attrs) {
            if (scope.$last) {
                element.parent().lightGallery();
            }
        }
    };
})
 app.directive("ngFileSelect", function(fileReader, $timeout,$stateParams,$http,$rootScope) {
    return {
      scope: {
        ngModel: '='
      },
      link: function($scope, el) {
        function getFile(file) {
          fileReader.readAsDataUrl(file, $scope)
            .then(function(result) {
              $timeout(function() {
                $scope.ngModel = result;
              });
            });
        }

        el.bind("change", function(e) {
          var file = (e.srcElement || e.target).files[0];
          getFile(file);
          console.log(file);

            var serializeForm = new FormData();

            serializeForm.append('file',file);               
            serializeForm.append('user_id',$stateParams.id);               
            
            $http.post(Base_url + 'Home/uploadProfileImages', serializeForm, {
                  headers: {
                      'Content-Type': undefined
                  },
                  transformRequest: angular.identity
            }).then(function (response) {   
                console.log(response.data.image);
                console.log($scope.previewData);
                console.log($scope.step);
                if(response.data.image){
                    $rootScope.profile_image  = response.data.image;
                }
                $scope.uploadStatus = false;
                // $scope.previewData.push({
                //         'id': response.data.last_id,
                //         'image_url': response.data.image_url                            
                //     });
                
            });


        });
      }
    };
  });
 app.factory("fileReader", function($q, $log) {
  var onLoad = function(reader, deferred, scope) {
    return function() {
      scope.$apply(function() {
        deferred.resolve(reader.result);
      });
    };
  };

  var onError = function(reader, deferred, scope) {
    return function() {
      scope.$apply(function() {
        deferred.reject(reader.result);
      });
    };
  };

  var onProgress = function(reader, scope) {
    return function(event) {
      scope.$broadcast("fileProgress", {
        total: event.total,
        loaded: event.loaded
      });
    };
  };

  var getReader = function(deferred, scope) {
    var reader = new FileReader();
    reader.onload = onLoad(reader, deferred, scope);
    reader.onerror = onError(reader, deferred, scope);
    reader.onprogress = onProgress(reader, scope);
    return reader;
  };

  var readAsDataURL = function(file, scope) {
    var deferred = $q.defer();

    var reader = getReader(deferred, scope);
    reader.readAsDataURL(file);

    return deferred.promise;
  };

  return {
    readAsDataUrl: readAsDataURL
  };
});

app.directive("imgUpload", function ($http, $compile,storageService,$stateParams,$state) {
    return {
        restrict: 'AE',
        template: '<input id="portfolio-image-upload" class="fileUpload" name="listing_img" type="file" multiple />' +
            '<div class="dropzone">' +
            '<img ng-src="{{addDummyImage}}" class="add-dummy-image">' +
            '<p class="upload-msg">Drog Image here or click to upload</p>' +
            '</div>' +
            '<div class="preview clearfix">' +
            '<div class="previewData clearfix" ng-repeat="data in previewData track by $index" lightgallery   img-data-src="{{data.image_url}}">' +
            '<span ng-click="remove(data)" class="circle remove">' +
            'X' +
            '</span>' +
            '<img ng-src={{data.image_url}}></img>' +
            '<div class="previewControls">' +
            '</div>' +
            '</div>' +
            '</div>',
        link: function ($scope, elem, attrs) {
            $scope.addDummyImage  = Base_Url+'assets/img/upload-icon.png';
            $scope.previewData = [];
            $scope.previewDataArr = [];
            $scope.portfolioImgData = [];

            function previewFile(file) {
                var formData = new FormData();
                var reader = new FileReader();                    
                var obj = formData.append('file', file);    

              //  var obj = new FormData();
                //if ($scope.myImage1 != undefined && ($scope.myImage1).length > 0) {
                    // console.log(file);
                    // obj.append('previewDataArr', file);
                    // obj.append('file', file);
                //}
                // profileImageForm.append('Auth_Token',localStorage.getItem('Auth_Token'));
                // profileImageForm.append('developer_id',$scope.developerBasicDetailVO.developer_id);
                // profileImageForm.append('profile_image',$scope.myImage);
                // profileImageForm.append('stages',$scope.developerBasicDetailVO.stages);
              


                reader.onload = function (data) {
                    var src = data.target.result;
                    var size = ((file.size / (1024 * 1024)) > 1) ? (file.size / (1024 * 1024)) + ' mB' : (file.size / 1024) + ' kB';
                    $scope.$apply(function () {
                        $scope.portfolioImgData.push(file);                        
                        // $scope.previewData.push({
                        //     'name': file.name,
                        //     'size': size,
                        //     'type': file.type,
                        //     'src': src,                            
                        //     'data': obj
                        // });
                    });
                }
                reader.readAsDataURL(file);
                
                var serializeForm = new FormData();
                serializeForm.append('file',file);               
                if($stateParams.itemId){
                    serializeForm.append('item_id',$stateParams.itemId);               
                }else{                    
                    serializeForm.append('item_id',$stateParams.id);               
                }
                $http.post(Base_url + 'Home/uploadImages', serializeForm, {
                      headers: {
                          'Content-Type': undefined
                      },
                      transformRequest: angular.identity
                }).then(function (response) {                       
                    $scope.uploadStatus = false;                                        
                    
                    $scope.previewData.push({
                            'id': response.data.last_id,
                            'image_url': response.data.image_url                            
                        });
                    if($scope.previewData.length > 0){
                        $scope.isDocuemntsCompleted = true ;
                    }
                    // if(response.data.status){               
                    //     // $scope.previewData.push({'ext':(file.name.split('.').pop()).toLowerCase(),'name':response.data.filedata.name,'size':response.data.filedata.size,'type':response.data.filedata.type, 'src':response.data.filedata.src,'attachment':response.data.attachment.attachment});
                    //     $scope.previewDataArr.push({'attachment':response.data.attachment.attachment,'ext':(file.name.split('.').pop()).toLowerCase(),'name':response.data.filedata.name});
                    //     $scope.uploadStatus = false;                                
                    // }else{
                    //     toastr.error(response.data.msg, 'Error');
                    // }
                });
            }



            function uploadFile(e, type) {
                e.preventDefault();
                var files = "";
                if (type == "formControl") {
                    files = e.target.files;
                } else if (type === "drop") {
                    files = e.originalEvent.dataTransfer.files;
                }
                for (var i = 0; i < files.length; i++) {
                    var file = files[i];
                    if (file.type.indexOf("image") !== -1) {
                        previewFile(file);
                    } else {
                        alert(file.name + " is not supported");
                    }
                }
            }
            elem.find('.fileUpload').bind('change', function (e) {
                uploadFile(e, 'formControl');
            });

            elem.find('.dropzone').bind("click", function (e) {
                $compile(elem.find('.fileUpload'))($scope).trigger('click');
            });

            elem.find('.dropzone').bind("dragover", function (e) {
                e.preventDefault();
            });

            elem.find('.dropzone').bind("drop", function (e) {
                uploadFile(e, 'drop');
            });
            $scope.upload = function (obj) {
                $http({
                    method: $scope.method,
                    url: $scope.url,
                    data: obj.data,
                    headers: {
                        'Content-Type': undefined
                    },
                    transformRequest: angular.identity
                }).success(function (data) {

                });
            }

            $scope.remove = function (data) {
                var index = $scope.previewData.indexOf(data);
                $scope.previewData.splice(index, 1);

                $http.post(Base_url+'Home/deleteImages',{file:data.image_url.split(/[/]+/).pop(),id:data.id})
                    .then(function(response){                 
                        if($scope.previewData.length == 0){
                            $scope.isDocuemntsCompleted = false ;
                        }
                      
                });
            }
        }
    }
});
app.directive("fileUpload", function ($http, $compile,storageService,$stateParams,$state) {
    return {
        restrict: 'AE',
        // template: '<input id="portfolio-image-upload" class="fileUpload" name="listing_img" type="file" multiple />' +
        //     '<div class="dropzone">' +
        //     '<img ng-src="{{addDummyImage}}" class="add-dummy-image">' +
        //     '<p class="upload-msg">Drog Image here or click to upload</p>' +
        //     '</div>' +
        //     '<div class="preview clearfix">' +
        //     '<div class="previewData clearfix" ng-repeat="data in previewData track by $index" lightgallery   img-data-src="{{data.image_url}}">' +
        //     '<span ng-click="remove(data)" class="circle remove">' +
        //     'X' +
        //     '</span>' +
        //     '<img ng-src={{data.image_url}}></img>' +
        //     '<div class="previewControls">' +
        //     '</div>' +
        //     '</div>' +
        //     '</div>',
        link: function ($scope, elem, attrs) {
            $scope.addDummyImage  = Base_Url+'assets/img/upload-icon.png';
            $scope.previewData = [];
            $scope.previewDataArr = [];
            $scope.portfolioImgData = [];

            function previewFile(file) {
                var formData = new FormData();
                var reader = new FileReader();                    
                var obj = formData.append('file', file);    

              //  var obj = new FormData();
                //if ($scope.myImage1 != undefined && ($scope.myImage1).length > 0) {
                    // console.log(file);
                    // obj.append('previewDataArr', file);
                    // obj.append('file', file);
                //}
                // profileImageForm.append('Auth_Token',localStorage.getItem('Auth_Token'));
                // profileImageForm.append('developer_id',$scope.developerBasicDetailVO.developer_id);
                // profileImageForm.append('profile_image',$scope.myImage);
                // profileImageForm.append('stages',$scope.developerBasicDetailVO.stages);
              


                reader.onload = function (data) {
                    var src = data.target.result;
                    var size = ((file.size / (1024 * 1024)) > 1) ? (file.size / (1024 * 1024)) + ' mB' : (file.size / 1024) + ' kB';
                    $scope.$apply(function () {
                        //$scope.portfolioImgData.push(file);                        
                        // $scope.previewData.push({
                        //     'name': file.name,
                        //     'size': size,
                        //     'type': file.type,
                        //     'src': src,                            
                        //     'data': obj
                        // });
                    });
                }
                reader.readAsDataURL(file);
                
                var serializeForm = new FormData();
                serializeForm.append('file',file);               
                serializeForm.append('user_id',$stateParams.id);               
                // console.log()
                // if($stateParams.itemId){
                //     serializeForm.append('user_id',$stateParams.itemId);               
                // }else{                    
                // }
                $http.post(Base_url + 'Home/uploadFiles', serializeForm, {
                      headers: {
                          'Content-Type': undefined
                      },
                      transformRequest: angular.identity
                }).then(function (response) {   
                    console.log(response.data);
                    $scope.uploadStatus = false;
                    console.log($scope.previewData);
                    $scope.previewData.push({
                            'id': response.data.last_id,
                            'url': response.data.url,                            
                            'name': response.data.name                            
                        });
                    console.log($scope.previewData);
                    // if(response.data.status){               
                    //     // $scope.previewData.push({'ext':(file.name.split('.').pop()).toLowerCase(),'name':response.data.filedata.name,'size':response.data.filedata.size,'type':response.data.filedata.type, 'src':response.data.filedata.src,'attachment':response.data.attachment.attachment});
                    //     $scope.previewDataArr.push({'attachment':response.data.attachment.attachment,'ext':(file.name.split('.').pop()).toLowerCase(),'name':response.data.filedata.name});
                    //     $scope.uploadStatus = false;                                
                    // }else{
                    //     toastr.error(response.data.msg, 'Error');
                    // }
                });
            }

            function uploadFile(e,type){
                    e.preventDefault();     
                    var files = "";
                    if(type == "formControl"){
                        files = e.target.files;
                    } else if(type === "drop"){
                        files = e.originalEvent.dataTransfer.files;
                    }     
                    for(var i=0;i<files.length;i++){
                        var file = files[i];
                        if((file.type.indexOf("image") !== -1) || (file.type.indexOf("application/pdf") !== -1) || (file.type.indexOf("text/plain") !== -1) ) {
                            previewFile(file);                
                        } else {
                            var ext = file.name.split('.').pop();
                            if(ext == "docx" || ext == "doc") {
                                previewFile(file);
                            } else if(ext == "xls" || ext == "xlsx") {
                                previewFile(file);
                            }  else {
                                alert(file.name + " is not supported");
                            }
                        }
                    }
            } 
            elem.find('.fileUpload').bind('change',function(e){
                uploadFile(e,'formControl');
            });

            // function uploadFile(e, type) {
            //     e.preventDefault();
            //     var files = "";
            //     if (type == "formControl") {
            //         files = e.target.files;
            //     } else if (type === "drop") {
            //         files = e.originalEvent.dataTransfer.files;
            //     }
            //     for (var i = 0; i < files.length; i++) {
            //         var file = files[i];
            //         if (file.type.indexOf("image") !== -1) {
            //             previewFile(file);
            //         } else {
            //             alert(file.name + " is not supported");
            //         }
            //     }
            // }
            // elem.find('.fileUpload').bind('change', function (e) {
            //     uploadFile(e, 'formControl');
            // });

            elem.find('.dropzone').bind("click", function (e) {
                $compile(elem.find('.fileUpload'))($scope).trigger('click');
            });

            elem.find('.dropzone').bind("dragover", function (e) {
                e.preventDefault();
            });

            elem.find('.dropzone').bind("drop", function (e) {
                uploadFile(e, 'drop');
            });
            $scope.upload = function (obj) {
                $http({
                    method: $scope.method,
                    url: $scope.url,
                    data: obj.data,
                    headers: {
                        'Content-Type': undefined
                    },
                    transformRequest: angular.identity
                }).success(function (data) {

                });
            }

            $scope.remove = function (data) {
                var index = $scope.previewData.indexOf(data);
                $scope.previewData.splice(index, 1);
                $http.post(Base_url+'Home/deleteFiles',{file:data.name,id:data.id})
                    .then(function(response){                 
                      
                });
            }
        }
    }
});



//////////////////////////////////////////// Searching Directive

app.directive('searchListingData',function ($http, $window, $timeout,$http,storageService,$state,$rootScope) {
        return {
            restrict: 'AE',
            scope: true,
            require: 'ngModel',
            link: function ($scope,elm,attr,ctrl,$event) {
                $scope.searchData = '';
                $rootScope.searchDataListVO = [];
                $scope.newdata = '';
                $rootScope.isSearchEndable = true;

                // angular.element($window).on('input', function() {                                                                                       
                $scope.$watch(attr.ngModel, function (newkeyword,keyword) {                    
                    
                    if(keyword!=''){                        
                        $http.post(Base_url+'Home/getSearchItems',{keyword:keyword,location:storageService.get('current_location'),category_id:$state.params.categoryId})
                            .then(function(response){                
                                if(response.data.status) {  
                                    $rootScope.searchDataListVO = angular.copy(response.data.data) ;
                                    $rootScope.isSearchEndable = true;
                                }else{
                                    $rootScope.isSearchEndable = false;
                                }
                        });
                    }
                    
                });

                $rootScope.changeValue = function(value) {
                    $scope.searchData = value;
                    $rootScope.isSearchEndable = false;
                    
                }
            },
        };

});

app.directive('loginSignup',function ($http, $window, $timeout,$http,storageService,$state,$rootScope,toastr) {
        return {
            restrict: 'AE',
            scope: true,            
            link: function ($scope,elm,attr,ctrl,$event) {
                                    
                    $rootScope.listingObj = {};
                    $rootScope.isVerificationActives = false;
                    $rootScope.mobile = '' ;
                    $scope.SignupLogin =function(){        
                        if(!$rootScope.isVerificationActives){
                            $rootScope.listingObj.verification_code = null ;
                        }
                        
                        $http.post(Base_url+'Home/LoginCode',{user_name:$scope.listingObj.user_name,mobile:$scope.listingObj.mobile,verification_code:$scope.listingObj.verification_code})
                                .then(function(response){                                     
                                if(response.data.status==1){
                                    angular.element("#loginModal").modal('hide');
                                    toastr.success(response.data.msg);
                                    $rootScope.listingObj = {};
                                    $rootScope.isVerificationActives = false;
                                    
                                    storageService.set('user_name', response.data.result.user_name);
                                    storageService.set('mobile', response.data.result.mobile);
                                    storageService.set('user_id', response.data.result.user_id);
                                    $rootScope.mobile = response.data.result.mobile ;
                                    $rootScope.user_name = response.data.result.user_name;
                                    $rootScope.user_id = response.data.result.user_id;
                                    $rootScope.profile_image = Base_Url+'assets/img/welaska_dummy.png';                    
                                }else if(response.data.status==2){                                    
                                    $rootScope.isVerificationActives = true;
                                }         
                                
                        });
                    }
                
            },
        };

});

app.config(function($stateProvider, $locationProvider,  
                                $urlRouterProvider) {

    //$locationProvider.html5Mode(true).hashPrefix('');
    // creating routes or states 
    $stateProvider 
        .state('Home', { 
            url : '/home', 
            templateUrl : Base_url+'view/home', 
            controller : "HomeCtrl"
        }) 
        .state('Login', { 
            url : '/login', 
            template : "<h1>Login Page</h1>", 
            controller : "LoginCtrl"
        })
        .state('Logout', { 
            url : '/logout',             
            controller : "LogoutCtrl"
        })  
        .state('Signup', { 
            url : '/signup', 
            template : "<h1>Signup Page</h1>", 
            controller : "SignupCtrl"
        })
        .state('listing', { 
            url : '/listing/:location/:categoryId', 
            templateUrl : Base_url+'view/listing', 
            controller : "ListingCtrl"
        })
        .state('singleItem', { 
            url : '/single-item/:itemId', 
            templateUrl : Base_url+'view/singleItem', 
            controller : "SingleItemCtrl"
        })
        .state('freeListing', { 
            url : '/free-listing', 
            templateUrl : Base_url+'view/freeListing',
            controller : "freeListingCtrl"
        })
        .state('edit-listing', { 
            url : '/edit-listing/:id', 
            templateUrl : Base_url+'view/edit-listing',
            controller : "freeListingCtrl"
        })
        .state('profile', { 
            url : '/profile/:id', 
            templateUrl : Base_url+'view/profile',
            controller : "profileCtrl"
        })
        .state('detailForm', { 
            url : '/detail-form', 
            templateUrl : Base_url+'view/detailForm',
            controller : "freeListingCtrl"
        });
  
    // Redirect to home page if url does not  
    // matches any of the three mentioned above 
    $urlRouterProvider.otherwise("/home"); 
}); 

app.controller('MainCtrl', function() {}); 
app.controller('HomeCtrl', function($scope,homeService,$state,$log,$http,toastr,storageService,$rootScope,$timeout) {
    
    angular.element("#loader-for-page").addClass("loading-spiner-show").removeClass("loading-spiner-hide");
    $scope.listingObject = {};



    var x=document.getElementById("demo");
    function getLocation(){

        if (navigator.geolocation){
            navigator.geolocation.getCurrentPosition(showPosition);
        }
        else{x.innerHTML="Geolocation is not supported by this browser.";}
    }
    function showPosition(position){
    
        var coordinates = [position.coords.latitude, position.coords.longitude]; 
        getCity(coordinates)
        // x.innerHTML="Latitude: " + position.coords.latitude + 
        // "<br>Longitude: " + position.coords.longitude;  
    }
    if(storageService.get('current_location')==null){
        getLocation()
    }

    // Step 2: Get city name 
    function getCity(coordinates) { 
        var xhr = new XMLHttpRequest(); 
        var lat = coordinates[0]; 
        var lng = coordinates[1]; 

        // Paste your LocationIQ token below. 
        xhr.open('GET',"https://us1.locationiq.com/v1/reverse.php?key=pk.d4ec4ea9a7d5ebd1a19e02b225b8dd7c&lat="+lat+"&lon="+lng+"&format=json", true);     
        //xhr.open('GET',"https://us1.locationiq.com/v1/reverse.php?key=pk.d4ec4ea9a7d5ebd1a19e02b225b8dd7c&lat=22.7196&lon=75.8577&format=json", true);     
        xhr.send(); 
        xhr.onreadystatechange = processRequest; 
        xhr.addEventListener("readystatechange", processRequest, false); 
      
        function processRequest(e) { 
            if (xhr.readyState == 4 && xhr.status == 200) { 
                var response = JSON.parse(xhr.responseText); 
                
                if(response.address.city){
                    var city = response.address.city; 
                }else{
                    var city = response.address.county; 
                }                 
                if(storageService.get('current_location')==null || storageService.get('current_location')=='null' || storageService.get('current_location')==''){
                        $scope.listingObject.city = city;
                        storageService.set('current_location',city);
                }
                return city;  
            } 
        } 
    } 
    
    $scope.listingObject.city = storageService.get('current_location');

    if(storageService.get('user_name')){
        $rootScope.mobile = storageService.get('mobile') ;
        $rootScope.user_name = storageService.get('user_name') ;        
        $rootScope.user_id = storageService.get('user_id');
    }    
    $rootScope.profile_image = Base_Url+'assets/img/welaska_dummy.png';   

    // UI SLIDER
    $scope.myInterval = 5000;
      var slides = $scope.slides = [];
      $scope.addSlide = function() {
        var newWidth = 600 + slides.length + 1;
        slides.push({
          image: 'http://placekitten.com/' + newWidth + '/300',
          text: ['More','Extra','Lots of','Surplus'][slides.length % 4] + ' ' +
            ['Cats', 'Kittys', 'Felines', 'Cutes'][slides.length % 4]
        });
      };
      for (var i=0; i<4; i++) {
        $scope.addSlide();
      }
    
    
    $scope.previous = function(){        
        angular.element('.glyphicon-chevron-left').trigger('click'); 
    }

    
    $scope.cityList = 0;


    homeService.getCategoryList().then(function(response){
         $scope.category = angular.copy(response);          
         angular.element("#loader-for-page").addClass("loading-spiner-hide").removeClass("loading-spiner-show");
    });

    
    $scope.searchObj = {};   
    $scope.searchLocation =  $state.params.location ;    
    $scope.innerHeaderChange = innerHeaderChange;

    function loadAllClassmate(data) {

        var classMateAllStates = data;
        $scope.generateArray = [];
        angular.forEach(classMateAllStates, function (value, key) {                               
            if(value.search_item){                    
                $scope.generateArray.push({                        
                    'name': value.search_item.toLowerCase(),
                    'item_id':value.item_id,
                    'category_id':value.category_id,
                    'type':value.type
                });                    
            }
        });
        return $scope.generateArray;
    }     
    $scope.innerHeaderQuerySearch = function (keyword) {            
        return $http
        .post(Base_url+'Home/getSearchItems',{keyword:keyword,location:storageService.get('current_location'),category_id:$state.params.categoryId})
            .then(function(response){                                    
                $scope.classmateStats = loadAllClassmate(response.data.data);                                       
                return $scope.classmateStats;
        });
    };

    function createFilterForClassmate(query) {
        var lowercaseQuery = query.toLowerCase();
        return function filterFn(state) {                
            return (state.name.indexOf(lowercaseQuery) === 0 );
        };

    }

    function innerHeaderTextChange(text) {
        console.log(text);
        $log.info('Text changed to ' + text);            
    }
    $scope.classmateData = '';
    $scope.selectItem = [];

    function innerHeaderChange(item) {
        $scope.selectItem = item;
    }
    $scope.reditectToPage = function(item){
            
            if(item.length==0){
                toastr.error("Please enter category name or business name");
            }
            if(item.type=='category_type'){                
                $state.go('listing',{'location':storageService.get('current_location'),'categoryId':item.category_id})
            }else if(item.type=='item_type'){                    
                storageService.set('current_location',storageService.get('current_location'));                
                $state.go('singleItem',{'itemId':item.item_id});
            }
    }

    $scope.searchObj = {};   
    $scope.searchLocation =  $state.params.location ;    
    $scope.citySelectedChange = citySelectedChange;
    function loadAllCityList(data) {
        var classMateAllStates = data;
        $scope.generateArray = [];
        angular.forEach(classMateAllStates, function (value, key) {                               
            if(value.city_name){                    
                $scope.generateArray.push({                        
                    'id': value.id.toLowerCase(),
                    'city':value.city_name,
                    'state':value.city_state,
                });                    
            }
        });
        return $scope.generateArray;
    }     
    $scope.cityQuerySearch = function (keyword) {            
        return $http
        .post(Base_url+'Home/getCityList',{keyword:keyword})
            .then(function(response){                                    
                $scope.classmateStats = loadAllCityList(response.data.data);                                       
                return $scope.classmateStats;
        });
    };
    
    function citySelectedChange(item) {                
        if(item){
              storageService.set('current_location',item.city);
              $scope.listingObject.city = item.city;
              // $scope.listingObject.city = item.city;
              // $scope.listingObject.state = item.state;            
        }else{
              // $scope.listingObject.state = '';    
        }
    }   
    

    

    
    
}); 
app.controller('LoginCtrl', function() {}); 
app.controller('LogoutCtrl', function($state,storageService,$rootScope ) {    
    localStorage.removeItem('user_name');
    localStorage.removeItem('user_id');
    localStorage.removeItem('mobile');
    $rootScope.mobile = '' ;
    $rootScope.user_name = '' ;
    $rootScope.profile_image = '';
    $state.go('Home');

});

app.controller('ListingCtrl', function($scope,$state,$http,$stateParams,$timeout,$q,$log,storageService,$rootScope,toastr) {

    angular.element("#loader-for-page").addClass("loading-spiner-show").removeClass("loading-spiner-hide");
    window.scrollTo(0, 0);      
    if(storageService.get('user_name')){
        $rootScope.mobile = storageService.get('mobile') ;
        $rootScope.user_name = storageService.get('user_name') ;
        $rootScope.user_id = storageService.get('user_id');
    }    
    $rootScope.profile_image = Base_Url+'assets/img/welaska_dummy.png';
    $scope.listingObj = {};    
    
    $scope.listingDataVO = [];

    $scope.maxSize = 5;     // Limit number for pagination display number.  
    $scope.pageIndex = 1;   // Current page number. First page is 1.-->    
    $scope.premiumPageIndex = 1;  
    // $scope.pageSizeSelected = ($stateParams.paginationLength && angular.isNumber(parseInt($stateParams.paginationLength)))?$stateParams.paginationLength:5; // Maximum number of items per page.      
    $scope.pageSizeSelected = 5; // Maximum number of items per page.      

   
    
    $scope.isLoaderActive = false ;
    $scope.pageChanged = function (Type) {        
        $scope.listingDataVO = [] ;
        $scope.getListingByCategoryID();
    };

    $scope.getListingByCategoryID = function(){        
        $scope.isLoaderActive = true ;
        $http.post(Base_url+'Home/categoryListing',{category_id:$stateParams.categoryId,location:$stateParams.location,
                        pageIndex : $scope.pageIndex,
                        pageSize  : $scope.pageSizeSelected
                    })
            .then(function(response){                                    
                if(response.data.status) {                      
                    $scope.isLoaderActive = false ;
                    // toastr.success(response.data.message);
                    angular.element("#loader-for-page").addClass("loading-spiner-hide").removeClass("loading-spiner-show");
                    $scope.listingDataVO = response.data.selectedAllData ;                    
                    $scope.allListCount = response.data.allCount;

                    angular.forEach($scope.listingDataVO.shop_timing, function (value) {                               
                        console.log(value);
                        
                    });
                 
                }else{
                    angular.element("#loader-for-page").addClass("loading-spiner-hide").removeClass("loading-spiner-show");
                    $scope.isLoaderActive = false ;
                }
        });
    }
    $scope.getListingByCategoryID();

    $scope.searchInputFocud = function(){
        angular.element(document.querySelector("body")).css('position', 'relative');
        angular.element(document.querySelector("body")).css('scroll-behavior', 'auto');
    }

    $scope.isSearchFocus = false ;

    
    $scope.innerHeaderChange = innerHeaderChange;
    $scope.innerHeaderTextChange = innerHeaderTextChange;
    $scope.searchObj = {};   
    $scope.searchLocation =  $state.params.location ;    
    storageService.set('current_location',$scope.searchLocation);                  

    function loadAllClassmate(data) {

        var classMateAllStates = data;
        $scope.generateArray = [];
        angular.forEach(classMateAllStates, function (value, key) {                               
            if(value.search_item){                    
                $scope.generateArray.push({                        
                    'name': value.search_item.toLowerCase(),
                    'item_id':value.item_id,
                    'category_id':value.category_id,
                    'type':value.type
                });                    
            }
        });
        return $scope.generateArray;
    }     
    $scope.innerHeaderQuerySearch = function (keyword) {            
        return $http
        .post(Base_url+'Home/getSearchItems',{keyword:keyword,location:storageService.get('current_location'),category_id:$state.params.categoryId})
            .then(function(response){                                    
                $scope.classmateStats = loadAllClassmate(response.data.data);                    
                // var results = keyword ? $scope.classmateStats.filter(createFilterForClassmate(keyword)) : $scope.classmateStats,
                //     deferred;
                return $scope.classmateStats;
        });
    };

    function createFilterForClassmate(query) {
        var lowercaseQuery = query.toLowerCase();
        return function filterFn(state) {                
            return (state.name.indexOf(lowercaseQuery) === 0 );
        };

    }

    function innerHeaderTextChange(text) {
        $log.info('Text changed to ' + text);            
    }
    $scope.classmateData = '';
    $scope.selectItem = [];
    function innerHeaderChange(item) {
        $scope.selectItem = item;      
    }
    $scope.reditectToPage = function(item){
            if(item.length==0){
                toastr.error("Please enter category name or business name");
            }        
            console.log(item);            
            if(item.type=='category_type'){
                $state.go('listing',{'location':$state.params.location,'categoryId':item.category_id})
            }else if(item.type=='item_type'){                    
                storageService.set('current_location',$state.params.location);                
                $state.go('singleItem',{'itemId':item.item_id});
            }
    }
});
// app.controller('editListingCtrl', function($state,$scope,$http) {

    
//     $scope.getItemByID = function(){        
//         $scope.itemShopDetailsByID = [];

//         $http.post(Base_url+'Home/getItemByID',{ item_id:$state.params.id})
//             .then(function(response){                
//                 if(response.data.status) {  
//                     console.log(response.data);

//                     angular.element("#loader-for-page").addClass("loading-spiner-hide").removeClass("loading-spiner-show");
//                     // toastr.success(response.data.message);
//                     // $scope.itemDetailsByID = response.data.data.listing_items ;                    
//                     // $scope.itemShopDetailsByIDObj = angular.copy(response.data.data.shop_timming);                    
//                     // $scope.itemReviewsVO = angular.copy(response.data.data.reviews);                                        
//                     // if($scope.itemDetailsByID.rating_avg){
//                     //     $scope.starAvg = parseFloat($scope.itemDetailsByID.rating_avg);
//                     // }                    

//                     // if($scope.itemDetailsByID.rating){
//                     //     $scope.rate = $scope.itemDetailsByID.rating ;
//                     // }else{
//                     //     $scope.rate = 0 ;
//                     // }

//                     // angular.forEach($scope.itemShopDetailsByIDObj, function (value) {                               
//                     //     if(value.days=='monday'){
//                     //         value.id=1;
//                     //     }else if(value.days=='tuesday'){
//                     //         value.id=2;
//                     //     }else if(value.days=='wednesday'){
//                     //         value.id=3;
//                     //     }else if(value.days=='thursday'){
//                     //         value.id=4;
//                     //     }else if(value.days=='friday'){
//                     //         value.id=5;
//                     //     }else if(value.days=='saturday'){
//                     //         value.id=6;
//                     //     }else if(value.days=='sunday'){
//                     //         value.id=7;
//                     //     }
                        
//                     //     $scope.itemShopDetailsByID.push({'id':value.id, 'day':value.days.charAt(0).toUpperCase()+ value.days.slice(1),'start_from':value.start_from,'start_to':value.start_to,'isChecked':value.is_closed});
//                     // });
//                     // var dayss = new Date();
//                     // var dayNumber = dayss.getDay();
//                     // $scope.todayDay = dayNumber;

//                     // var today = new Date();
//                     // var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
//                     // // var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
//                     // $scope.currenrtTime = today.getHours() + ":" + today.getMinutes();
//                 }
//         });
//     }
//     $scope.getItemByID();


// });  
app.controller('SingleItemCtrl', function($scope,$state,$http,$stateParams,$timeout,$q,$log,storageService,$rootScope,toastr,$anchorScroll,$window,Map) {

    angular.element("#loader-for-page").addClass("loading-spiner-show").removeClass("loading-spiner-hide");
    if(storageService.get('user_name')){
        $rootScope.mobile = storageService.get('mobile') ;
        $rootScope.user_name = storageService.get('user_name') ;
        $rootScope.user_id = storageService.get('user_id');
    }    
    $rootScope.profile_image = Base_Url+'assets/img/welaska_dummy.png';
    $scope.searchLocation  = storageService.get('current_location') ;
    $scope.itemDetailsByID = [];    
    $scope.itemReviewsVO   = [];
    $scope.itemImagesVO    = [];
    $scope.todayDay = '';
    $scope.review = '';
    if($stateParams.itemId){
        storageService.set('item_id',$stateParams.itemId);
    }    
    $scope.addDummyImage  = Base_Url+'assets/img/upload-icon.png'



    

    $scope.submitReview = function(item_id){
        
        if(storageService.get('user_id')==null){            
            angular.element('#loginModal').modal('show');
            return false;
        }
        if($scope.review==''){
            toastr.error('Please fill review');
            return false;
        }

        $http.post(Base_url+'Home/submitReview',{ item_id:item_id,user_id:storageService.get('user_id'),review:$scope.review})
            .then(function(response){                
                console.log(response);
                $scope.getItemByID();
                $scope.review = '';
        });

    }

   
    
    $scope.getItemByID = function(){        
        $scope.itemShopDetailsByID = [];

        $http.post(Base_url+'Home/getItemByID',{ item_id:$stateParams.itemId,user_id:storageService.get('user_id')})
            .then(function(response){                
                if(response.data.status) {  

                    angular.element("#loader-for-page").addClass("loading-spiner-hide").removeClass("loading-spiner-show");
                    // toastr.success(response.data.message);
                    $scope.itemDetailsByID = response.data.data.listing_items ;                    
                    $scope.itemShopDetailsByIDObj = angular.copy(response.data.data.shop_timming);                    
                    $scope.itemReviewsVO = angular.copy(response.data.data.reviews);                                        
                    $scope.itemImagesVO = angular.copy(response.data.data.listing_images);                                        
                    $scope.previewData  = $scope.itemImagesVO;

                    if($scope.itemDetailsByID.rating_avg){
                        $scope.starAvg = parseFloat($scope.itemDetailsByID.rating_avg);
                    }                    

                    if($scope.itemDetailsByID.rating){
                        $scope.rate = $scope.itemDetailsByID.rating ;
                    }else{
                        $scope.rate = 0 ;
                    }

                    angular.forEach($scope.itemShopDetailsByIDObj, function (value) {                               
                        if(value.days=='monday'){
                            value.id=1;
                        }else if(value.days=='tuesday'){
                            value.id=2;
                        }else if(value.days=='wednesday'){
                            value.id=3;
                        }else if(value.days=='thursday'){
                            value.id=4;
                        }else if(value.days=='friday'){
                            value.id=5;
                        }else if(value.days=='saturday'){
                            value.id=6;
                        }else if(value.days=='sunday'){
                            value.id=7;
                        }
                        if($scope.itemShopDetailsByID.length < 8){
                            $scope.itemShopDetailsByID.push({'id':value.id, 'day':value.days.charAt(0).toUpperCase()+ value.days.slice(1),'start_from':value.start_from,'start_to':value.start_to,'isChecked':value.is_closed});
                        }
                    });
                    var dayss = new Date();
                    var dayNumber = dayss.getDay();
                    $scope.todayDay = dayNumber;

                    var today = new Date();
                    var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
                    // var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
                    $scope.currenrtTime = today.getHours() + ":" + today.getMinutes();
                }
        });
    }
    $scope.getItemByID();

    // $scope.rate = 2;
    $scope.max = 5;
    $scope.isReadonly = false;

    $scope.hoveringOver = function(value) {        
        $scope.overStar = value;
        $scope.percent = 100 * (value / $scope.max);        
    };
    $scope.giveRating = function(item_id){
        if(storageService.get('user_id')==null){            
            angular.element('#loginModal').modal('show');
            return false;
        }        

        $http.post(Base_url+'Home/giveRating',{ item_id:item_id,user_id:storageService.get('user_id'),stars:$scope.overStar})
            .then(function(response){                                
                $scope.getItemByID();
        });
    }
    $scope.likesItems = function(item_id){
        if(storageService.get('user_id')==null){            
            angular.element('#loginModal').modal('show');
            return false;
        }        

        $http.post(Base_url+'Home/productLike',{ item_id:item_id,user_id:storageService.get('user_id'),stars:$scope.overStar})
            .then(function(response){                
                console.log(response);
                $scope.getItemByID();
        });
    }
    


    $scope.ratingStates = [
        {stateOn: 'glyphicon-ok-sign', stateOff: 'glyphicon-ok-circle'},
        {stateOn: 'glyphicon-star', stateOff: 'glyphicon-star-empty'},
        {stateOn: 'glyphicon-heart', stateOff: 'glyphicon-ban-circle'},
        {stateOn: 'glyphicon-heart'},
        {stateOff: 'glyphicon-off'}
      ];


   
    $scope.innerHeaderChange = innerHeaderChange;
    $scope.innerHeaderTextChange = innerHeaderTextChange;
    $scope.searchObj = {};   
    
    function loadAllClassmate(data) {

        var classMateAllStates = data;
        $scope.generateArray = [];
        angular.forEach(classMateAllStates, function (value, key) {                               
            if(value.search_item){                    
                $scope.generateArray.push({                        
                    'name': value.search_item.toLowerCase(),
                    'item_id':value.item_id,
                    'category_id':value.category_id,
                    'type':value.type
                });                    
            }
        });
        return $scope.generateArray;
    }     
    $scope.innerHeaderQuerySearch = function (keyword) {            
        return $http
        .post(Base_url+'Home/getSearchItems',{keyword:keyword,location:storageService.get('current_location') ,category_id:$state.params.categoryId})
            .then(function(response){                                    
                $scope.classmateStats = loadAllClassmate(response.data.data);                    
                // var results = keyword ? $scope.classmateStats.filter(createFilterForClassmate(keyword)) : $scope.classmateStats,
                //     deferred;
                return $scope.classmateStats;
        });
    };

    function createFilterForClassmate(query) {
        var lowercaseQuery = query.toLowerCase();
        return function filterFn(state) {                
            return (state.name.indexOf(lowercaseQuery) === 0 );
        };

    }

    function innerHeaderTextChange(text) {
        $log.info('Text changed to ' + text);            
    }
    $scope.classmateData = '';

    function innerHeaderChange(item) {
      
    }
    $scope.reditectToPage = function(item){            
            if(item.type=='category_type'){                
                $state.go('listing',{'location':storageService.get('current_location'),'categoryId':item.category_id})
            }else if(item.type=='item_type'){                    
                $state.go('singleItem',{'itemId':item.item_id});
            }
    }
    $scope.gotoReview = function(id){
        console.log(id);
        $anchorScroll(id);
    }
    $scope.testObj = [];
    $scope.testObj.push({a:'my value'});
    $scope.jobShare = {
                        facebook: {
                                provider: 'facebook',
                                url: $window.location.href
                        },
                        twitter: {
                                provider: 'twitter',
                                url: $window.location.href,
                                hashtags: $scope.testObj.map(function (item) {
                                        return item.a;
                                        }).join(','),
                                text:'test'
                        },
                        linkedin: {
                                provider: 'linkedin',
                                url: $window.location.href,
                                title: 'title',
                                summary: 'summary'
                        },
                        clipboard: {
                                provider: 'clipboard',
                                url: $window.location.href
                        }
                }

                $scope.openMap = function(lat,long){                                        
                    Map.init(lat,long);    
                }


        

}); 
app.controller('freeListingCtrl', function($scope,$state,$http,$stateParams,$timeout,$q,$log,storageService,toastr,homeService,$rootScope,$anchorScroll,$window,Map) {

      
    $scope.listingObject    = {};
    $scope.selectObj        = {};
    
    angular.element("#loader-for-page").addClass("loading-spiner-show").removeClass("loading-spiner-hide");
    if(storageService.get('user_name')){
        $rootScope.mobile = storageService.get('mobile') ;
        $rootScope.user_name = storageService.get('user_name') ;
        $rootScope.user_id = storageService.get('user_id');
    } 
    $timeout(function () {                    
        angular.element("#loader-for-page").addClass("loading-spiner-hide").removeClass("loading-spiner-show");
    }, 500);
    $rootScope.profile_image = Base_Url+'assets/img/welaska_dummy.png';
    



    $scope.workingHours = [{'id':1,value:'all_time',display:'Open 24 Hrs'},{'id':2,value:'00:00',display:'00:00'},{'id':3,value:'00:30',display:'00:30'},{'id':4,value:'01:00',display:'01:00'},{'id':5,value:'01:30',display:'01:30'},{'id':6,value:'02:00',display:'02:00'},{'id':6,value:'02:30',display:'02:30'},{'id':7,value:'03:00',display:'03:00'},{'id':8,value:'03:30',display:'03:30'},{'id':9,value:'04:00',display:'04:00'},{'id':10,value:'04:30',display:'04:30'},{'id':11,value:'05:00',display:'05:00'},{'id':12,value:'05:30',display:'05:30'},{'id':13,value:'06:00',display:'06:00'},{'id':14,value:'06:30',display:'06:20'},
                            {'id':15,value:'07:00',display:'07:00'},{'id':16,value:'07:30',display:'07:30'},{'id':17,value:'08:00',display:'08:00'},{'id':18,value:'08:30',display:'08:30'},{'id':19,value:'09:00',display:'09:00'},{'id':19,value:'09:00',display:'09:00'},{'id':20,value:'09:30',display:'09:30'},{'id':21,value:'10:00',display:'10:00'},{'id':22,value:'10:30',display:'10:30'},{'id':23,value:'11:00',display:'11:00'},{'id':24,value:'11:30',display:'11:30'},{'id':25,value:'12:00',display:'12:00'},{'id':26,value:'12:30',display:'12:30'},{'id':27,value:'13:00',display:'13:00'},
                            {'id':28,value:'13:30',display:'13:30'},{'id':29,value:'14:00',display:'14:00'},{'id':30,value:'14:30',display:'14:30'},{'id':31,value:'15:00',display:'15:00'},{'id':32,value:'15:30',display:'15:30'},{'id':33,value:'16:00',display:'16:00'},{'id':34,value:'16:30',display:'16:30'},{'id':35,value:'17:00',display:'17:00'},{'id':36,value:'17:30',display:'17:30'},{'id':37,value:'18:00',display:'18:00'},{'id':38,value:'18:30',display:'18:30'},{'id':39,value:'19:00',display:'19:00'},{'id':40,value:'19:30',display:'19:30'},{'id':41,value:'20:00',display:'20:00'},
                            {'id':42,value:'21:00',display:'21:00'},{'id':43,value:'21:00',display:'21:00'},{'id':44,value:'21:30',display:'21:30'},{'id':45,value:'22:00',display:'22:00'},{'id':46,value:'22:30',display:'22:30'},{'id':47,value:'23:00',display:'23:00'},{'id':48,value:'23:30',display:'23:30'}];

          
    $scope.monday_from      = $scope.workingHours[0];
    $scope.monday_to        = $scope.workingHours[0];
    $scope.tuesday_from     = $scope.workingHours[0];
    $scope.tuesday_to       = $scope.workingHours[0];
    $scope.wednesday_from   = $scope.workingHours[0];
    $scope.wednesday_to     = $scope.workingHours[0];    
    $scope.thursday_from    = $scope.workingHours[0];
    $scope.thursday_to      = $scope.workingHours[0];
    $scope.friday_from      = $scope.workingHours[0];
    $scope.friday_to        = $scope.workingHours[0];
    $scope.saturday_from    = $scope.workingHours[0];
    $scope.saturday_to      = $scope.workingHours[0];
    $scope.sunday_from      = $scope.workingHours[0];
    $scope.sunday_to        = $scope.workingHours[0];



    $scope.paymentMode = [{id:0,value:'Cash',isChecked:false},{id:1,value:'Master Card',isChecked:false},{id:2,value:'Visa Card',isChecked:false},{id:3,value:'Debit Cards',isChecked:false},{id:4,value:'Money Orders',isChecked:false},{id:5,value:'Cheques',isChecked:false},{id:6,value:'Credit Card',isChecked:false},{id:7,value:'American Express Card',isChecked:false},{id:8,value:'Paytm',isChecked:false},{id:9,value:'G Pay',isChecked:false},{id:10,value:'UPI',isChecked:false},{id:11,value:'BHIM',isChecked:false},{id:12,value:'Airtel Money',isChecked:false},{id:13,value:'PhonePe',isChecked:false},{id:14,value:'NEFT',isChecked:false},{id:15,value:'Amazon Pay',isChecked:false}];

    $scope.yearList = [{
        key: 0,
        value: 'Select Years'
    }];
    for (x = 1; x <= 31; x++) {
        if (x > 1) {
            $scope.yearList.push({
                key: x,
                value: x + ' Years'
            });
        } else {
            $scope.yearList.push({
                key: x,
                value: x + ' Year'
            });
        }
    }    


    $scope.listingObject = {};
    $scope.step = 'location';

    $scope.searchObj = {};   
    $scope.searchLocation =  $state.params.location ;    
    $scope.citySelectedChange = citySelectedChange;
    function loadAllCityList(data) {
        var classMateAllStates = data;
        $scope.generateArray = [];
        angular.forEach(classMateAllStates, function (value, key) {                               
            if(value.city_name){                    
                $scope.generateArray.push({                        
                    'id': value.id.toLowerCase(),
                    'city':value.city_name,
                    'state':value.city_state,
                });                    
            }
        });
        return $scope.generateArray;
    }     
    $scope.innerHeaderQuerySearch = function (keyword) {            
        return $http
        .post(Base_url+'Home/getCityList',{keyword:keyword})
            .then(function(response){                                    
                $scope.classmateStats = loadAllCityList(response.data.data);                                       
                return $scope.classmateStats;
        });
    };

    function createFilterForClassmate(query) {
        var lowercaseQuery = query.toLowerCase();
        return function filterFn(state) {                
            return (state.name.indexOf(lowercaseQuery) === 0 );
        };

    }

    function innerHeaderTextChange(text) {
        $log.info('Text changed to ' + text);            
    }
    $scope.classmateData = '';

    function citySelectedChange(item,ev) {
        
        
        if(item){         
              storageService.set('selected_city',item.city);
              storageService.set('selected_state',item.state);
        }else{
                storageService.set('selected_state');
                $scope.listingObject.state = '';    
        }                
        if($state.params.id && item.city){
            $scope.listingObject.city = item.city;
            $scope.listingObject.state = item.state;
        }
    }    
    if(storageService.get('selected_state')){
            $scope.listingObject.state = storageService.get('selected_state');            
            $scope.listingObject.city = storageService.get('selected_city');            
            $scope.listingObject.mobile = storageService.get('mobile');
            $scope.listingObject.land_line = storageService.get('landline_number');
            $scope.listingObject.contact_person = storageService.get('contact_person');
            $scope.listingObject.business_name = storageService.get('business_name');

    }    
    /////////////////////
    $scope.isCompanyNameInCategoryName = false;
    $scope.checkCategoryOrCompany = function(){
        
        $http.post(Base_url+'Home/checkCompany',{keyword:$scope.listingObject.business_name})
                .then(function(response){                    
                    if(response.data.status){
                        $scope.isCompanyNameInCategoryName = true;
                    }else{
                        $scope.isCompanyNameInCategoryName = false;
                    }
            });
    }


    /////////////////////
    $scope.category = [];
    $scope.categoryQuerySearch = categoryQuerySearch;
    $scope.categorySelectedChange = categorySelectedChange;
    homeService.getCategoryList().then(function(response){
        $scope.category = angular.copy(response);                 
        $scope.toolList = angular.copy(response);
        //$scope.protfoliotoolsstates = loadAllProjectTools($scope.toolList);
        $scope.toolsStates = loadAllProjectTools($scope.toolList);
    });

    $scope.citySelectedChange = citySelectedChange;
    // function loadAllCategoryList(data) {
    //     console.log(data);
    //     var classMateAllStates = data;
    //     $scope.generateArray = [];
    //     angular.forEach(classMateAllStates, function (value, key) {                               
    //         if(value.city_name){                    
    //             $scope.generateArray.push({                        
    //                 'id': value.id,
    //                 'city':value.category_name,
    //             });                    
    //         }
    //     });
    //     return $scope.generateArray;
    // } 
    function loadAllProjectTools(data) {
            var projectToolsallStates = data;
            $scope.generateArray = [];
            angular.forEach(projectToolsallStates, function (value, key) {
                var smallCaseTechnologies = value.category_name.toLowerCase();
                $scope.generateArray.push({
                    'id': value.id,
                    'city': value.category_name,
                    'filter': smallCaseTechnologies
                });
                $scope.projectToolsSearchText = '';
            });
            return $scope.generateArray;
    }
    function categoryQuerySearch(query) {
            
            var results = query ? $scope.toolsStates.filter(createFilterForClassmate(query)) : $scope.toolsStates,
                deferred;                
            return results;                
            //return results;                
    }    
    

    function createFilterForClassmate(query) {

        var lowercaseQuery = query.toLowerCase();
        return function filterFn(state) {                                        
            return (state.filter.indexOf(lowercaseQuery) === 0 );
        };

    }

    function categoryTextChange(text) {
        $log.info('Text changed to ' + text);            
    }
    $scope.classmateData = '';
    $scope.category_id = []
    function categorySelectedChange(item) {         
        if(item){
            $scope.category_id = [];
            $scope.category_id = item.id;
        }        
    }

    // ///////////// 
    $scope.customPosition = '';
    $scope.enableScrollOnAutoCompleteList = function (event) {         
            var totalHeigh = event.view.innerHeight;
            var topMargin = event.screenY;
            var bottomMargin = parseInt(totalHeigh)-parseInt(topMargin);                
            if(topMargin > bottomMargin){
                $scope.customPosition = 'top';
            }else{
                $scope.customPosition = 'bottom';
            }
    }



    $scope.keywordObject = [];
    //$scope.ngChangeFruitNames = angular.copy($scope.fruitNames);
    $scope.onModelChange = function(newModel) {
      $log.log('The model has changed to ' + newModel + '.');
    };
    $scope.notEditable = function(text){
                toastr.error("Sorry you cannot change the "+text+".");
    }

    $scope.isLoadingActive = false;
    $scope.submitBasicDetails = function(){
            $scope.isLoadingActive = true;                        
            var serialize = $scope.listingObject;
                serialize['step'] = 'business' ;
                serialize['city'] = storageService.get('selected_city');
            $http.post(Base_url+'Home/submitBasicDetails', serialize)
                .then(function(response){   
                storageService.set('mobile', $scope.listingObject.mobile);
                storageService.set('business_name', $scope.listingObject.business_name);
                storageService.set('landline_number', $scope.listingObject.land_line);
                storageService.set('contact_person', $scope.listingObject.first_name+" "+$scope.listingObject.last_name);
                if(response.data.status){                    
                    $state.go('detailForm');
                }else{                    
                    toastr.error(response.data.msg);
                }                                 
                $scope.isLoadingActive = false;
                    
            });
    }    
    $scope.submitLocationInfo = function(){
            $scope.isLoadingActive = true;            
            // console.log($scope.ListItemByID);
            // if($scope.ListItemByID){
            //     console.log()
            //     $scope.listingObject = $scope.ListItemByID;
            // }
            var serialize = $scope.listingObject;
            serialize['step'] = 'location';
            if($state.params.id){
                serialize['item_id'] = $state.params.id;
            }

            $http.post(Base_url+'Home/submitBasicDetails',serialize)
                .then(function(response){
                $scope.isLoadingActive = false;               
                if(response.data.status){                    
                    if($state.params.id){
                        toastr.success('Successfully Updated');
                    }
                    $scope.step = 'contact';
                }else{                    
                    toastr.error(response.data.msg);
                }                                 
                    
            });
    }
    $scope.submitContact = function(){
            $scope.isLoadingActive = true;            
            var seriaLize = $scope.listingObject;
            seriaLize['step'] = 'contact' ;
            if($state.params.id){
                seriaLize['item_id'] = $state.params.id;
            }
            console.log($scope.listingObject);
            $http.post(Base_url+'Home/submitBasicDetails',seriaLize)
                .then(function(response){   
                $scope.isLoadingActive = false;            
                if(response.data.status){                    
                    if($state.params.id){
                        toastr.success('Successfully Updated');
                    }
                    $scope.step = 'others';
                }else{                    
                    toastr.error(response.data.msg);
                }                                 
                    
            });
    }
    $scope.submitOthers = function(){
            
            $scope.isLoadingActive = true;            
            $scope.shopTimingObj = [];

            if($scope.monday_from){
                $scope.shopTimingObj.push({id:0,days:'monday',shop_id:$scope.monday_id,from_id:$scope.monday_from.id,from:$scope.monday_from.display,to_id:$scope.monday_to.id,to:$scope.monday_to.display,isClosed:$scope.monday_closed ? 1 : 0})
            }
            if($scope.tuesday_from){
                $scope.shopTimingObj.push({id:1,days:'tuesday',shop_id:$scope.tuesday_id,from_id:$scope.tuesday_from.id,from:$scope.tuesday_from.display,to_id:$scope.tuesday_to.id,to:$scope.tuesday_to.display,isClosed:$scope.tuesday_closed ? 1 : 0})
            }
            if($scope.wednesday_from){
                $scope.shopTimingObj.push({id:2,days:'wednesday',shop_id:$scope.wednesday_id,from_id:$scope.wednesday_from.id,from:$scope.wednesday_from.display,to_id:$scope.wednesday_to.id,to:$scope.wednesday_to.display,isClosed:$scope.wednesday_closed ? 1 : 0})
            }
            if($scope.thursday_from){
                $scope.shopTimingObj.push({id:3,days:'thursday',shop_id:$scope.thursday_id,from_id:$scope.thursday_from.id,from:$scope.thursday_from.display,to_id:$scope.thursday_to.id,to:$scope.thursday_to.display,isClosed:$scope.thursday_closed ? 1 : 0})
            }
            if($scope.friday_from){
                $scope.shopTimingObj.push({id:4,days:'friday',shop_id:$scope.friday_id,from_id:$scope.friday_from.id,from:$scope.friday_from.display,to_id:$scope.friday_to.id,to:$scope.friday_to.display,isClosed:$scope.friday_closed ? 1 : 0})
            }
            if($scope.saturday_from){
                $scope.shopTimingObj.push({id:4,days:'saturday',shop_id:$scope.saturday_id,from_id:$scope.saturday_from.id,from:$scope.saturday_from.display,to_id:$scope.saturday_to.id,to:$scope.saturday_to.display,isClosed:$scope.saturday_closed ? 1 : 0})
            }
            if($scope.sunday_from){
                $scope.shopTimingObj.push({id:4,days:'sunday',shop_id:$scope.sunday_id,from_id:$scope.sunday_from.id,from:$scope.sunday_from.display,to_id:$scope.sunday_to.id,to:$scope.sunday_to.display,isClosed:$scope.sunday_closed ? 1 : 0})
            }
            
            $http.post(Base_url+'Home/submitBasicDetails',{                    
                    shop_timing:$scope.shopTimingObj,
                    payment_mode:$scope.paymentMode,
                    is_display_hours:$scope.is_display_hours,
                    item_id : $state.params.id ? $state.params.id : null ,
                    step:'others'

                })
                .then(function(response){   
                $scope.isLoadingActive = false;            
                if(response.data.status){                    
                    if($state.params.id){
                        toastr.success('Successfully Updated');
                    }
                    $scope.step = 'keyword';                    
                }else{                    
                    toastr.error(response.data.msg);
                }                                 
                    
            });
    }
    $scope.submitKeywords = function(){

            $scope.isLoadingActive = true;            
            $http.post(Base_url+'Home/submitBasicDetails',{
                    keywords:$scope.keywordObject,                 
                    category_id:$scope.category_id,                 
                    item_id : $state.params.id ? $state.params.id : null ,
                    step:'keywords'
                })
                .then(function(response){   
                $scope.isLoadingActive = false;        
                if($state.params.id){
                    toastr.success('Successfully Updated');
                }
                console.log($state.params.id);
                if(!$state.params.id){
                    angular.element("#myModal").modal('show');            
                }
                $scope.step = 'upload';                    

                // if(response.data.status){                    
                //     $scope.step = 'others';
                // }else{                    
                //     toastr.error(response.data.msg);
                // }                                 
                    
            });
    }
    $scope.isVerificationActive = false; 
    $scope.item_verification_code = '';
    $scope.getVerificatioCode = function(){
        console.log($scope.item_verification_code);
            $http.post(Base_url+'Home/submitBasicDetails',{                    
                    step:'get_verification_code',
                    item_verification_code:$scope.item_verification_code ? $scope.item_verification_code : null
                })
                .then(function(response){   
                    
                if(response.data.status==2){                    
                    $scope.isVerificationActive = true;
                }else if(response.data.status==1){                    
                    toastr.success(response.data.msg);
                    angular.element("#myModal").modal('hide');            
                    $scope.item_verification_code = '';
                    
                    $timeout(function () {                    
                        $state.go('Home');
                    }, 500);

                }else{                    
                    toastr.error(response.data.msg);
                }                                 
                    
            });

    }

    $scope.readonlyFunc = function(){
        console.log('test');
        toastr.error('Please click on edit button');
    }

    ////////////////////////// EDIT LISTINGS
    $scope.isBusinessDetailsEdit = false;
    $scope.isContactDetailsEdit = false;
    $scope.isKeywordDetailsEdit = false;


    $scope.getItemByID = function(){        
        $scope.listingObject = [];
        $scope.listOfPayments = [];
        $scope.listOfHours = [];

        $http.post(Base_url+'Home/getEditItemByID',{ item_id:$state.params.id})
            .then(function(response){                
                if(response.data.status) {                      
                    $scope.listingObject = response.data.data.listings ;
                    $scope.listOfHours = response.data.data.shop_timming ;
                    $scope.listOfPayments = response.data.data.payment_mode ;
                    $scope.listingObject.contact_person = response.data.data.listings.first_name;
                    $scope.previewData = angular.copy(response.data.data.listing_images);                                        




                    
                    angular.forEach($scope.listOfHours, function (value, key) {                               

                        console.log(value);
                        if(value.days=='monday'){
                            $scope.monday_from      = $scope.workingHours[parseInt(value.from_id)+1];
                            $scope.monday_to        = $scope.workingHours[parseInt(value.to_id)+1];
                            $scope.monday_closed    =  value.is_closed==1 ? true : false ;
                            $scope.monday_id        =  value.shop_id;

                        }else if(value.days=='tuesday'){
                            $scope.tuesday_from     = $scope.workingHours[parseInt(value.from_id)+1];
                            $scope.tuesday_to       = $scope.workingHours[parseInt(value.to_id)+1];
                            $scope.tuesday_closed   =  value.is_closed==1 ? true : false ;
                            $scope.tuesday_id       =  value.shop_id;

                        }else if(value.days=='wednesday'){
                            $scope.wednesday_from   = $scope.workingHours[parseInt(value.from_id)+1];
                            $scope.wednesday_to     = $scope.workingHours[parseInt(value.to_id)+1];
                            $scope.wednesday_closed = value.is_closed==1 ? true : false ;
                            $scope.wednesday_id     =  value.shop_id;
                            
                        }else if(value.days=='thursday'){
                            $scope.thursday_from    = $scope.workingHours[parseInt(value.from_id)+1];
                            $scope.thursday_to      = $scope.workingHours[parseInt(value.to_id)+1];
                            $scope.thursday_closed  = value.is_closed==1 ? true : false ;
                            $scope.thursday_id      =  value.shop_id;
                        }else if(value.days=='friday'){
                            $scope.friday_from      = $scope.workingHours[parseInt(value.from_id)+1];
                            $scope.friday_to        = $scope.workingHours[parseInt(value.to_id)+1];
                            $scope.friday_closed    = value.is_closed==1 ? true : false ;
                            $scope.friday_id        =  value.shop_id;

                        }else if(value.days=='saturday'){
                            $scope.saturday_from    = $scope.workingHours[parseInt(value.from_id)+1];
                            $scope.saturday_to      = $scope.workingHours[parseInt(value.to_id)+1];
                            $scope.saturday_closed  = value.is_closed==1 ? true : false ;
                            $scope.saturday_id      =  value.shop_id;
                        }else if(value.days=='sunday'){
                            $scope.sunday_from      = $scope.workingHours[parseInt(value.from_id)+1];
                            $scope.sunday_to        = $scope.workingHours[parseInt(value.to_id)+1];
                            $scope.sunday_closed    = value.is_closed==1 ? true : false ;
                            $scope.sunday_id        = value.shop_id;
                        }

                        // if (($scope.listOfPayments.filter(function (item) {
                        //     return value.value == item.payment_mode 
                        // })).length > 0) {  
                        //     value.isChecked =true;
                        // }
                    });

                    

                    

                    // 
                    // 
                    // 
                    
                    
                    angular.forEach($scope.paymentMode, function (value, key) {                               
                        if($scope.listOfPayments){                            
                            if (($scope.listOfPayments.filter(function (item) {
                                return value.value == item.payment_mode 
                            })).length > 0) {  
                                value.isChecked =true;
                            }
                        }
                    });
                    
                    angular.element("#loader-for-page").addClass("loading-spiner-hide").removeClass("loading-spiner-show");
                    // toastr.success(response.data.message);
                    // $scope.itemDetailsByID = response.data.data.listing_items ;                    
                    // $scope.itemShopDetailsByIDObj = angular.copy(response.data.data.shop_timming);                    
                    // $scope.itemReviewsVO = angular.copy(response.data.data.reviews);                                        
                    // if($scope.itemDetailsByID.rating_avg){
                    //     $scope.starAvg = parseFloat($scope.itemDetailsByID.rating_avg);
                    // }                    

                    // if($scope.itemDetailsByID.rating){
                    //     $scope.rate = $scope.itemDetailsByID.rating ;
                    // }else{
                    //     $scope.rate = 0 ;
                    // }

                    // angular.forEach($scope.itemShopDetailsByIDObj, function (value) {                               
                    //     if(value.days=='monday'){
                    //         value.id=1;
                    //     }else if(value.days=='tuesday'){
                    //         value.id=2;
                    //     }else if(value.days=='wednesday'){
                    //         value.id=3;
                    //     }else if(value.days=='thursday'){
                    //         value.id=4;
                    //     }else if(value.days=='friday'){
                    //         value.id=5;
                    //     }else if(value.days=='saturday'){
                    //         value.id=6;
                    //     }else if(value.days=='sunday'){
                    //         value.id=7;
                    //     }
                        
                    //     $scope.itemShopDetailsByID.push({'id':value.id, 'day':value.days.charAt(0).toUpperCase()+ value.days.slice(1),'start_from':value.start_from,'start_to':value.start_to,'isChecked':value.is_closed});
                    // });
                    // var dayss = new Date();
                    // var dayNumber = dayss.getDay();
                    // $scope.todayDay = dayNumber;

                    // var today = new Date();
                    // var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
                    // // var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
                    // $scope.currenrtTime = today.getHours() + ":" + today.getMinutes();
                }
        });
    }
    if($state.params.id){
        $scope.getItemByID();
    }  
    $scope.place = {};
    
    $scope.search = function() {
        $scope.apiError = false;
        Map.search($scope.searchPlace)
        .then(
            function(res) { // success
                Map.addMarker(res);
                $scope.place.name = res.name;
                $scope.place.lat = res.geometry.location.lat();
                $scope.place.lng = res.geometry.location.lng();
            },
            function(status) { // error
                $scope.apiError = true;
                $scope.apiStatus = status;
            }
        );
    }
    
    $scope.send = function() {
        alert($scope.place.name + ' : ' + $scope.place.lat + ', ' + $scope.place.lng);    
    }
    
    //Map.init();

     


});
app.controller('profileCtrl', function($scope,$http,storageService,$state,toastr,$rootScope,$timeout) {

    angular.element("#loader-for-page").addClass("loading-spiner-hide").removeClass("loading-spiner-show");
    if(storageService.get('user_name')){
        $rootScope.mobile = storageService.get('mobile') ;
        $rootScope.user_name = storageService.get('user_name') ;
        $rootScope.user_id = storageService.get('user_id');
    }
    $rootScope.profile_image = Base_Url+'assets/img/welaska_dummy.png';
    $scope.step = 'personal';     
    $scope.profileImageSrc  = Base_Url+'assets/img/welaska_dummy.png';
    $scope.isVerificationActives = false ;

    $scope.imageCall = function(){
        angular.element('#prfileImage').trigger('click');            
    }

    $scope.citySelectedChange = citySelectedChange;
    function loadAllCityList(data) {
        var classMateAllStates = data;
        $scope.generateArray = [];
        angular.forEach(classMateAllStates, function (value, key) {                               
            if(value.city_name){                    
                $scope.generateArray.push({                        
                    'id': value.id.toLowerCase(),
                    'city':value.city_name,
                    'state':value.city_state,
                });                    
            }
        });
        return $scope.generateArray;
    }     
    $scope.innerHeaderQuerySearch = function (keyword) {            
        return $http
        .post(Base_url+'Home/getCityList',{keyword:keyword})
            .then(function(response){                                    
                $scope.classmateStats = loadAllCityList(response.data.data);                                       
                return $scope.classmateStats;
        });
    };

    function createFilterForClassmate(query) {
        var lowercaseQuery = query.toLowerCase();
        return function filterFn(state) {                
            return (state.name.indexOf(lowercaseQuery) === 0 );
        };

    }

    function innerHeaderTextChange(text) {
        $log.info('Text changed to ' + text);            
    }
    $scope.classmateData = '';

    function citySelectedChange(item) {
        console.log(item);        
        if(item){                       
            $scope.listingObject.address_city = item.city;
        }
    } 


    $scope.imageSrc = "";
    
    $scope.$on("fileProgress", function(e, progress) {
      $scope.progress = progress.loaded / progress.total;
    });
    $scope.isPersonalDetailsCompleted = false ;
    $scope.isAddressCompleted = false;
    $scope.getProfileDetails = function(){        
        $scope.listingObject = [];
        $scope.listingObjectAdd = [];        
        $scope.listingObjectDocument = [];
        $scope.previewData = [];
        
        $http.post(Base_url+'Home/getProfileDetails',{ item_id:$state.params.id})
            .then(function(response){                
                if(response.data.status) {                      
                    $scope.listingObject = response.data.data.profile ;
                    console.log($scope.listingObject.image);
                    $scope.listingObjectAdd = response.data.data.address;
                    $scope.listingObjectDocument = response.data.data.documents;
                    //$scope.previewData = response.data.data.documents;
                    
                    angular.forEach($scope.listingObjectDocument, function (value, key) {                                                       
                        $scope.previewData.push({                        
                            'name': value.url.split(/[/]+/).pop(),
                            'id':value.id,
                            'url':value.url                                                        
                        });                    
                        
                    });                    
                    //$scope.listingObject = response.data.data.profile ;
                    $scope.imageSrc = $scope.listingObject.image
                    if($scope.listingObject.image){
                        $timeout(function() {                            
                            $rootScope.profile_image  = $scope.listingObject.image;
                        },100);
                    }
                    if($scope.listingObject.first_name!='' && $scope.listingObject.last_name!='' && $scope.listingObject.mobile!='' && $scope.listingObject.image!=''){
                        $scope.isPersonalDetailsCompleted = true ;
                    }
                    if($scope.listingObjectAdd.length > 0){
                        $scope.isAddressCompleted = true;
                    }
                    if($scope.listingObjectDocument.length > 0){
                        $scope.isDocuemntsCompleted = true;
                    }
                    if($scope.isPersonalDetailsCompleted && $scope.isAddressCompleted && $scope.isDocuemntsCompleted){
                        $scope.isAllCompleted = true;   
                    }
 
                    
                    angular.element("#loader-for-page").addClass("loading-spiner-hide").removeClass("loading-spiner-show");
                  
                }
        });
    }
    $scope.getProfileDetails();

    $scope.submitPersonalDetails = function(step){
            $scope.isLoadingActive = true;                             
            
            var serialize = $scope.listingObject;
            serialize['step'] = step;            
            serialize['user_id'] = $state.params.id ;
            

            $http.post(Base_url+'Home/submitBasicDetails',serialize)
                .then(function(response){
                $scope.isLoadingActive = false;               
                if(response.data.status){                    
                    console.log($state.params.id);
                    if($state.params.id){
                        toastr.success('Successfully Updated');
                        $scope.getProfileDetails();
                    }
                    if(step=='personal'){
                        $scope.step = 'address';
                    }else if(step=='address'){
                        $scope.isAddressNew = false;
                        $scope.step = 'documents';
                    }else if(step=='documents'){
                        $scope.step = 'all';

                    }
                }else{                    
                    toastr.error(response.data.msg);
                }                                 
                    
            });
    }
    $scope.removeAddress = function(id){
        console.log(id);

        $http.post(Base_url+'Home/removeAddress',{id:id})
            .then(function(response){
                $scope.getProfileDetails();
                toastr.success(response.data.msg);
                $scope.getProfileDetails();
        });

    }
    $scope.checkMobileExist =  function(){
        $http.post(Base_url+'Home/checkMobileExist',{mobile:$scope.listingObj.update_mobile,user_id:$state.params.id})
                .then(function(response){  
                    if(response.data.status){
                        $scope.isMobileExist = true ;
                    }else{
                        $scope.isMobileExist = false ;
                    }
                });

    }
    $scope.isEmailExist = false ;
    $scope.checkEmailExist =  function(email){
        
        console.log($scope.listingObject.update_email);
        $http.post(Base_url+'Home/checkEmailExist',{email:email,user_id:$state.params.id})
                .then(function(response){  
                    if(response.data.status){
                        $scope.isEmailExist = true ;
                    }else{
                        $scope.isEmailExist = false ;
                    }                
                });

    }
    $scope.updateMobile =function(){        
        if(!$scope.isVerificationActives){
            $scope.listingObj.verification_code = null ;
        }
        
        $http.post(Base_url+'Home/updateMobile',{update_mobile:$scope.listingObj.update_mobile,verification_code:$scope.listingObj.verification_code,user_id:$state.params.id})
                .then(function(response){                                     
                    console.log(response.data);
                if(response.data.status==1){
                    angular.element("#mobileUpdateModal").modal('hide');
                    toastr.success(response.data.message);
                    $scope.listingObject.mobile = $scope.listingObj.update_mobile ;                    
                    $scope.listingObj = {};
                    $scope.isVerificationActives = false;                    
                    // storageService.set('user_name', response.data.result.user_name);
                    // storageService.set('mobile', response.data.result.mobile);
                    // storageService.set('user_id', response.data.result.user_id);
                    // $scope.mobile = response.data.result.mobile ;
                    // $scope.user_name = response.data.result.user_name;
                    // $scope.user_id = response.data.result.user_id;
                    // $scope.profile_image = Base_Url+'assets/img/welaska_dummy.png';                    
                }else if(response.data.status==2){                                    
                    $scope.isVerificationActives = true;
                }         
                
        });
    }
    $scope.updateEmail =function(){        
        if(!$scope.isVerificationActives){
            $scope.listingObj.verification_code = null ;
        }
        
        $http.post(Base_url+'Home/updateEmail',{update_email:$scope.listingObj.update_email,verification_code:$scope.listingObj.verification_code,user_id:$state.params.id})
                .then(function(response){                                     
                    console.log(response.data);
                if(response.data.status==1){
                    angular.element("#emailUpdateModal").modal('hide');
                    toastr.success(response.data.message);
                    $scope.listingObject.email = $scope.listingObj.update_email ;                    
                    $scope.listingObj = {};
                    $scope.isVerificationActives = false;                                     
                }else if(response.data.status==2){                                    
                    $scope.isVerificationActives = true;
                }         
                
        });
    }
    


});
app.controller('SignupCtrl', function() {});