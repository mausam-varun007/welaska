var app = angular.module('App', ['ui.bootstrap','ui.router','ngMaterial', 'ngMessages']); 

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
                        $http.post(Base_url+'Home/getSearchItems',{keyword:keyword,location:$state.params.location,category_id:$state.params.categoryId})
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

app.config(function($stateProvider, $locationProvider,  
                                $urlRouterProvider) { 
    
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
app.controller('HomeCtrl', function($scope,homeService,$state,$log,$http) {
    
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
        console.log('k');
        angular.element('.glyphicon-chevron-left').trigger('click'); 
    }

    $scope.listingObj = {};
    $scope.test = 'jo';
    $scope.cityList = 0;
    $scope.cityList = [{id:1,value:'Indore'} ,{id:2,value:'Bangalore'} ,{id:3,value:'Jabalpur'} ,{id:4,value:'Pune'} ,{id:5,value:'Delhi'} ,{id:6,value:'Ahmedabed'} ,{id:7,value:'Chennai'}];     
    
    $scope.listingObj.searchLocation = $scope.cityList[0].value;

    homeService.getCategoryList().then(function(response){
         $scope.category = angular.copy(response); 
    });

    
    $scope.searchObj = {};   
    $scope.searchLocation =  $state.params.location ;    
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
        .post(Base_url+'Home/getSearchItems',{keyword:keyword,location:$scope.listingObj.searchLocation,category_id:$state.params.categoryId})
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
        $log.info('Text changed to ' + text);            
    }
    $scope.classmateData = '';

    function innerHeaderChange(item) {
      
    }
    $scope.reditectToPage = function(item){
            console.log(item);
            if(item.type=='category_type'){
                $state.go('listing',{'location':$scope.listingObj.searchLocation,'categoryId':item.category_id})
            }else if(item.type=='item_type'){                    
                storageService.set('current_location',$state.params.location);                
                $state.go('singleItem',{'itemId':item.item_id});
            }
    }
    

    
    
}); 
app.controller('LoginCtrl', function() {}); 
app.controller('ListingCtrl', function($scope,$state,$http,$stateParams,$timeout,$q,$log,storageService) {

    window.scrollTo(0, 0);      
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
                    $scope.listingDataVO = response.data.selectedAllData ;
                    $scope.allListCount = response.data.allCount;
                 
                }else{
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
        .post(Base_url+'Home/getSearchItems',{keyword:keyword,location:$state.params.location,category_id:$state.params.categoryId})
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
                $state.go('listing',{'location':$state.params.location,'categoryId':item.category_id})
            }else if(item.type=='item_type'){                    
                storageService.set('current_location',$state.params.location);                
                $state.go('singleItem',{'itemId':item.item_id});
            }
    }





    

    

}); 
app.controller('SingleItemCtrl', function($scope,$state,$http,$stateParams,$timeout,$q,$log,storageService) {

    
    $scope.searchLocation = storageService.get('current_location') ;
    console.log($scope.searchLocation);
    $scope.itemDetailsByID = [];
    $scope.getItemByID = function(){        

        $http.post(Base_url+'Home/getItemByID',{ item_id:$stateParams.itemId})
            .then(function(response){                
                if(response.data.status) {  
                    console.log(response.data.data);
                    // toastr.success(response.data.message);
                    $scope.itemDetailsByID = response.data.data ;
                 
                }
        });
    }
    $scope.getItemByID();

    $scope.rate = 7;
      $scope.max = 5;
      $scope.isReadonly = false;

      $scope.hoveringOver = function(value) {
        $scope.overStar = value;
        $scope.percent = 100 * (value / $scope.max);
      };
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
        .post(Base_url+'Home/getSearchItems',{keyword:keyword,location:$state.params.location,category_id:$state.params.categoryId})
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
app.controller('freeListingCtrl', function($scope,$state,$http,$stateParams,$timeout,$q,$log,storageService) {

    $scope.listingObject = {};
    $scope.step = 'location';
    console.log($scope.step);

    $scope.submitBasicDetails = function(){
            console.log($scope.listingObject);
            $state.go('detailForm');
    }

});
app.controller('SignupCtrl', function() {});