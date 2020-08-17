var app = angular.module('App', [ "ui.router" ]); 

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
        });
  
    // Redirect to home page if url does not  
    // matches any of the three mentioned above 
    $urlRouterProvider.otherwise("/home"); 
}); 

app.controller('MainCtrl', function() {}); 
app.controller('HomeCtrl', function($scope) {
    
    $scope.listingObj = {};
    $scope.test = 'jo';
    $scope.cityList = 0;
    $scope.cityList = [{id:1,value:'Indore'} ,{id:2,value:'Bangalore'} ,{id:3,value:'Jabalpur'} ,{id:4,value:'Pune'} ,{id:5,value:'Delhi'} ,{id:6,value:'Ahmedabed'} ,{id:7,value:'Chennai'}];     
    
    $scope.listingObj.searchLocation = $scope.cityList[0].value;
    
}); 
app.controller('LoginCtrl', function() {}); 
app.controller('ListingCtrl', function($scope,$http,$stateParams) {

    console.log($stateParams.location);
    console.log($stateParams.categoryId);
    $scope.listingObj = {};    
    
    $scope.getListingByCategoryID - function(){        
        $http.post(Base_url+'SearchJobController/acceptScheduleInterview',{category_id:$stateParams.categoryId,location:$stateParams.location})
            .then(function(response){                
                if(response.data.status) {  
                    console.log();
                    // toastr.success(response.data.message);
                 
                }
        });
    }

}); 
app.controller('SignupCtrl', function() {});