angular.module('myApp').controller('CategoryController',
	['$scope', '$http', '$state','$location', '$rootScope','Upload', 'inform',
	function($scope, $http, $state, $location, $rootScope, Upload, inform, data) {
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
		/*if($state.current.name == 'edit-category') {
			
		}*/

}])