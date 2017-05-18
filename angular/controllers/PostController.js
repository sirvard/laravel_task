angular
	.module('myApp')
	.controller('PostController', PostController);
PostController.$inject = ['$scope', '$http', '$state','$location', '$rootScope','Upload', 'inform', 'PostService'];
function PostController($scope, $http, $state, $location, $rootScope, Upload, inform, PostService) {
	var vm = this;
	

	if($state.current.name == 'posts'){
		PostService.getPosts(function(result){
			vm.posts = result;
		});

		vm.deletePost = function(post_id){
			//console.log(post_id);
			var result = confirm('Are you sure');
			//console.log(result);

			if(!result){
				return false;
			};
			$http.delete('/api/delete-post/'+post_id, {id: post_id}).then(function(response){

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
				vm.post = response.data.post;
			}
		})

		vm.editPost = function(post_id) {
			//console.log(post_id);
			$http.post('/api/posts/'+$state.params.id+'/edit', {id:post_id, new_post: vm.new_post}).then(function(response){

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
}