angular.module("myApp").config(function($stateProvider, $urlRouterProvider) {
     
	$stateProvider
	.state('index', {
	    url: "/",
	    templateUrl: "views/home.html", 
	    controller: 'HomeController'  
    })
	.state('categories', {
		url: "/categories",
		templateUrl: "views/categories.html",
		controller: "CategoryController",
		resolve: {
			data : ['$http' , function($http)
            {
                return $http.get('/api/categories');
            }]
		}
	})
	.state('posts',{
		url: '/posts',
		templateUrl: 'views/posts.html',
		controller: 'PostController',

	})
	.state('edit-category', {
		url: '/categories/:id/edit',
		templateUrl: 'views/edit-category.html',
	})
	/*.state('editCategoory', {
		
	})*/
  	$urlRouterProvider.otherwise("/");
});