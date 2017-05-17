angular
	.module('myApp').controller('PostController',
		['$scope', '$http', '$state','$location', '$rootScope','Upload', 'inform',
		function($scope, $http, $state, $location, $rootScope, Upload, inform) {
			if($state.current.name == 'posts'){
				$http.get('/api/posts').then(function(response){
					if(response.data.status == 'success') {
						$scope.posts = response.data.posts;
					}
				})

				$scope.deletePost = function(post_id){
					console.log(post_id);
					var result = confirm('Are you sure');
					console.log(result);
					if(!result){
						return false;
					};
					$http.delete('/api/delete-post/'+post_id+'', {id: post_id}).then(function(response){
						if(response.data.status == 'success') {
		            		inform.add(response.data.message, {
		            		    "type": "success"
		            		});
		            	} else if(response.data.status == 'error') {
		            		inform.add(response.data.message, {
		            		    "type": "danger"
		            		});
		            	}
					})
				}
			}

			if($state.current.name == 'edit-post') {
				$http.get('/api/posts/'+$state.params.id).then(function(response) {
					if (response.data.status == 'success') {
						$scope.post = response.data.post;
					}
				})

				$scope.editPost = function(post_id) {
					console.log(post_id);
					$http.post('/api/posts/'+$state.params.id+'/edit', {id:post_id, new_post: $scope.new_post}).then(function(response){
					if(response.data.status == 'success') {
						inform.add(response.data.message, {
							"type": "success" 
						})
					} else if (response.data.message == 'error') {
						inform.add(response.data.message, {
							"type" : "danger"
						})
					}
				})

				}
			}
		}])