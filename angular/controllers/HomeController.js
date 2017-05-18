angular
	.module('myApp')
	.controller('HomeController', HomeController);
HomeController.$inject = ['$scope', '$http', '$state','$location', '$rootScope','Upload', 'inform', '$window']
function HomeController($scope, $http, $state, $location, $rootScope, Upload, inform, $window) {
	var vm = this;

	if($state.current.name == 'index'){   
      	$http.get('/api/index').then(function(response) {
      		if (response.data.status == 'success') {
      			vm.user = response.data.user;
      			$rootScope.user = response.data.user;
      			vm.categories = response.data.categories;
                //console.log(vm.categories);
      		}
        })  

        vm.uploadPic = function(file) {
            if (file) {
                file.upload = Upload.upload({
                    url: '/api/user',
                    data: {image: file, id: vm.user.id },
                });

                file.upload.then(function (response) {
                	if(response.data.status == 'success') {
                		inform.add(response.data.message, {
                		    "type": "success"
                		});
                		//console.log(response.config.data.image);
                	} else if (response.data.status == 'error') {
                		inform.add(response.data.message, {
                		    "type": "danger"
                		});
                	}
                   /* $state.go('posts');*/
                }, function(error) {
	    			if (error.status === 422) {
		               messages = error.data;
		               console.log(messages);
		               for (i in messages) {
		                   for (j in messages[i]) {
		                       	inform.add(messages[i][j], {
		                           	"type": "danger"
		                       	});
		                   }
		                } 
		            }
                });

            }
            else {
            	inform.add('Please choose file!', {
            	    "type": "danger"
            	});
            }  
        }

        vm.addCategory = function(){
        	$http.post('/api/add-category', {category: vm.category_name}).then(function(response) {
        		if(response.data.status == 'success') {
            		inform.add(response.data.message, {
            		    "type": "success"
            		});
            	} else if(response.data.status == 'error') {
            		inform.add(response.data.message, {
            		    "type": "danger"
            		});
            	}
    		}, function(error) {
    			if(error.status === 422) {
	               	messages = error.data;
	               	console.log(messages);
	               	for(i in messages) {
	                   	for(j in messages[i]){
	                       	inform.add(messages[i][j], {
	                           	"type": "danger"
	                       	});
	                   	}
	                } 
	            }
    		}); 
        }

        $rootScope.logout = function() {
        	$http.get('/api/logout').then(function(response) {
        		if(response.data.status == 'success') {
        			$window.location.href = 'http://blog.dev';
        		}
        	}, function(error) {

        	});
        }

        vm.addPost = function(){
            //console.log(vm.category_id);
        	/*console.log($scope.category_id);
        	return false;*/
        	$http.post('/api/add-post', {category: vm.category_id, post: vm.post}).then(function(response){
        		//console.log(response);
        		if (response.data.status == 'success') {
        			inform.add(response.data.message, {
        				'type' : 'success'
        			});
        		}else if(response.data.status == 'error') {
        			inform.add(response.data.message, {
        				"type": 'danger'
        			});
        		}
	        }, function(error) {
    			if(error.status === 422) {
	               	messages = error.data;
	               	//console.log(messages);
	               	for(i in messages) {
	                   	for(j in messages[i]){
	                       	inform.add(messages[i][j], {
	                           	"type": "danger"
	                       	});
	                   	}
	                } 
	            }
    		});
        }	        
  	}
}