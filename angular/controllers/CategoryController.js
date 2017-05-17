angular
	.module('myApp')
	.controller('CategoryController', CategoryController);
/*	['$scope', '$http', '$state','$location', '$rootScope','Upload', 'inform',*/
function CategoryController($scope, $http, $state, $location, $rootScope, Upload, inform) {
	//console.log(data);
	if ($state.current.name == 'categories') {
		$http.get('/api/categories').then(function(response) {
			if (response.data.status == 'success') {
				$scope.categories = response.data.categories;
			}
		})

		$scope.deleteCategory = function(category_id) {
			console.log(category_id);
			var result = confirm('Are you sure?');
			console.log(result);
			if(!result){
				return false;
			}
			$http.delete('/api/delete-category/'+category_id+'', {id:category_id}).then(function(response){
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

	if($state.current.name == 'edit-category') {
		$http.get('/api/categories/'+$state.params.id).then(function(response) {
			if (response.data.status == 'success') {
				$scope.category = response.data.category;
			}
		})
		
		$scope.editCategory = function(category_id) {
			console.log($scope.new_name);
			$http.post('/api/categories/'+$state.params.id+'/edit', {id:category_id, new_category_name: $scope.new_name}).then(function(response){
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