angular.module('myApp')
.service('PostService', PostService);
PostService.$inject = ['$http'];

function PostService($http) {
	return  {
	    getPosts : getPosts
	};

	function getPosts(callback) {
		console.log('service');
		$http.get('/api/posts').then(function(response){
			if(response.data.status == 'success') {
				temp = response.data.posts;
				console.log(response.data.posts);
				return callback(temp);
			}
		});
	}	
}