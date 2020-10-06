var app = angular.module('App', ['ngAnimate','ngSanitize','ui.bootstrap','ui.router','ngMaterial', 'ngMessages','toastr']); 

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
                                
                                console.log(response.data);
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
app.controller('SingleItemCtrl', function($scope,$state,$http,$stateParams,$timeout,$q,$log,storageService,$rootScope,toastr) {

    angular.element("#loader-for-page").addClass("loading-spiner-show").removeClass("loading-spiner-hide");
    if(storageService.get('user_name')){
        $rootScope.mobile = storageService.get('mobile') ;
        $rootScope.user_name = storageService.get('user_name') ;
    }    
    $rootScope.profile_image = Base_Url+'assets/img/welaska_dummy.png';
    $scope.searchLocation = storageService.get('current_location') ;
    $scope.itemDetailsByID = [];    
    $scope.itemReviewsVO = [];
    $scope.todayDay = '';
    $scope.review = '';

    

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
                    if($scope.itemDetailsByID.rating_avg){
                        $scope.starAvg = parseFloat($scope.itemDetailsByID.rating_avg);
                    }                    

                    if($scope.itemDetailsByID.rating){
                        console.log($scope.itemDetailsByID.rating);
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
                        
                        $scope.itemShopDetailsByID.push({'id':value.id, 'day':value.days.charAt(0).toUpperCase()+ value.days.slice(1),'start_from':value.start_from,'start_to':value.start_to,'isChecked':value.is_closed});
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
        console.log(storageService.get('current_location'));
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


        

}); 
app.controller('freeListingCtrl', function($scope,$state,$http,$stateParams,$timeout,$q,$log,storageService,toastr,homeService,$rootScope) {

      
    $scope.listingObject    = {};
    $scope.selectObj        = {};
    
    angular.element("#loader-for-page").addClass("loading-spiner-show").removeClass("loading-spiner-hide");
    if(storageService.get('user_name')){
        $rootScope.mobile = storageService.get('mobile') ;
        $rootScope.user_name = storageService.get('user_name') ;
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

    function citySelectedChange(item) {
        console.log(item);
        if(item){         
              storageService.set('selected_city',item.city);
              storageService.set('selected_state',item.state);
        }else{
                storageService.set('selected_state');
                $scope.listingObject.state = '';    
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
            var serialize = $scope.listingObject;
            serialize['step'] = 'location';

            $http.post(Base_url+'Home/submitBasicDetails',serialize)
                .then(function(response){
                $scope.isLoadingActive = false;               
                if(response.data.status){                    
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
            $http.post(Base_url+'Home/submitBasicDetails',seriaLize)
                .then(function(response){   
                $scope.isLoadingActive = false;            
                if(response.data.status){                    
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
                $scope.shopTimingObj.push({id:0,days:'monday',from:$scope.monday_from.display,to:$scope.monday_to.display,isClosed:$scope.monday_closed ? 1 : 0})
            }
            if($scope.tuesday_from){
                $scope.shopTimingObj.push({id:1,days:'tuesday',from:$scope.tuesday_from.display,to:$scope.tuesday_to.display,isClosed:$scope.tuesday_closed ? 1 : 0})
            }
            if($scope.wednesday_from){
                $scope.shopTimingObj.push({id:2,days:'wednesday',from:$scope.wednesday_from.display,to:$scope.wednesday_to.display,isClosed:$scope.wednesday_closed ? 1 : 0})
            }
            if($scope.thursday_from){
                $scope.shopTimingObj.push({id:3,days:'thursday',from:$scope.thursday_from.display,to:$scope.thursday_to.display,isClosed:$scope.thursday_closed ? 1 : 0})
            }
            if($scope.friday_from){
                $scope.shopTimingObj.push({id:4,days:'friday',from:$scope.friday_from.display,to:$scope.friday_to.display,isClosed:$scope.friday_closed ? 1 : 0})
            }
            if($scope.saturday_from){
                $scope.shopTimingObj.push({id:4,days:'saturday',from:$scope.saturday_from.display,to:$scope.saturday_to.display,isClosed:$scope.saturday_closed ? 1 : 0})
            }
            if($scope.sunday_from){
                $scope.shopTimingObj.push({id:4,days:'sunday',from:$scope.sunday_from.display,to:$scope.sunday_to.display,isClosed:$scope.sunday_closed ? 1 : 0})
            }
            

            $http.post(Base_url+'Home/submitBasicDetails',{                    
                    shop_timing:$scope.shopTimingObj,
                    payment_mode:$scope.paymentMode,
                    is_display_hours:$scope.is_display_hours,
                    step:'others'
                })
                .then(function(response){   
                $scope.isLoadingActive = false;            
                if(response.data.status){                    
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
                    step:'keywords'
                })
                .then(function(response){   
                $scope.isLoadingActive = false;            
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


});
app.controller('SignupCtrl', function() {});