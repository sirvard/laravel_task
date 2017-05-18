angular.module("myApp")
.config(config);


function config($stateProvider, $urlRouterProvider) {
     
	$stateProvider
	.state('index', {
	    url: "/",
	    templateUrl: "views/home.html", 
	    controller: 'HomeController' ,
	    controllerAs: 'home'
    })
	.state('categories', {
		url: "/categories",
		templateUrl: "views/categories.html",
		controller: "CategoryController",
		controllerAs: 'cat'
		
	})
	.state('posts',{
		url: '/posts',
		templateUrl: 'views/posts.html',
		controller: 'PostController',
		controllerAs: 'postCtrl'

	})
	.state('edit-category', {
		url: '/categories/:id',
		templateUrl: 'views/edit-category.html',
		controller: 'CategoryController',
		controllerAs: 'cat'
	})
	.state('edit-post', {
		url: '/posts/:id',
		templateUrl: 'views/edit-post.html',
		controller: 'PostController',
		controllerAs: 'post'
	})
	
  	$urlRouterProvider.otherwise("/");
}