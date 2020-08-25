var app = angular.module('App', ['ui.bootstrap','ui.router']); 

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
        });
  
    // Redirect to home page if url does not  
    // matches any of the three mentioned above 
    $urlRouterProvider.otherwise("/home"); 
}); 

app.controller('MainCtrl', function() {}); 
app.controller('HomeCtrl', function($scope,homeService) {
    
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
    })
    
}); 
app.controller('LoginCtrl', function() {}); 
app.controller('ListingCtrl', function($scope,$state,$http,$stateParams) {

    console.log($stateParams.location);
    console.log($stateParams.categoryId);
    $scope.listingObj = {};    
    
    $scope.listingDataVO = [];
    $scope.getListingByCategoryID = function(){        
        $http.post(Base_url+'Home/categoryListing',{category_id:$stateParams.categoryId,location:$stateParams.location})
            .then(function(response){                
                if(response.data.status) {  
                    console.log(response.data.data);
                    // toastr.success(response.data.message);
                    $scope.listingDataVO = response.data.data ;
                 
                }
        });
    }
    $scope.getListingByCategoryID();

    

}); 
app.controller('SingleItemCtrl', function($scope,$state,$http,$stateParams) {

    console.log($stateParams.itemId);
        
    $scope.itemDetailsByID = [];
    $scope.getItemByID = function(){        
        $http.post(Base_url+'Home/getItemByID',{item_id:$stateParams.itemId})
            .then(function(response){                
                if(response.data.status) {  
                    console.log(response.data.data);
                    // toastr.success(response.data.message);
                    $scope.itemDetailsByID = response.data.data ;
                 
                }
        });
    }
    $scope.getItemByID();

        

}); 
app.controller('SignupCtrl', function() {});