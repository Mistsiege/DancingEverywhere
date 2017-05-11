(function() {

	var app = angular.module('dancingEverywhere', []);

	app.controller('PanelOperator', ['$scope', '$http', function($scope, $http) {
		
		// Panel Variables ----------------------------------------------------------------------
		$scope.menuStatus = 1;
		$scope.searchStatus = 1;
		$scope.submitStatus = 0;
		$scope.visionStatus = 0;
		$scope.contactStatus = 0;
		
		// Menu Button Click --------------------------------------------------------------------
		$scope.menuClick = function(){
			if($scope.menuStatus == 1) {
				$scope.menuStatus = 0;
				if($scope.searchStatus == 1) {
					$scope.searchStatus = 0;
				} else if($scope.searchStatus == 2) {
					$scope.searchStatus = 1;
				}
			} else {
				$scope.menuStatus = 1;
				if($scope.searchStatus == 1) {
					$scope.searchStatus = 2;
				} else if($scope.searchStatus == 0) {
					$scope.searchStatus = 1;
				}
			}
		};
		
		// Search Button Click -----------------------------------------------------------------
		$scope.searchClick = function(){
			if($scope.menuStatus == 1 && $scope.searchStatus == 1) {
				$scope.searchStatus = 2;
			} else if($scope.menuStatus == 1 && $scope.searchStatus == 2) {
				$scope.searchStatus = 1;
			} else if($scope.menuStatus == 0 && $scope.searchStatus == 0) {
				$scope.searchStatus = 1;
			} else if($scope.menuStatus == 0 && $scope.searchStatus == 1) {
				$scope.searchStatus = 0;
			}
		};
		
		// Functionality to change between pages via the Panel links ---------------------------
		$scope.pageChange = function(pageID){
			switch(pageID){
				case 'dance':
					$scope.submitStatus = 0;
					$scope.visionStatus = 0;
					$scope.contactStatus = 0;
					break;
				case 'submit':
					$scope.submitStatus = 1;
					$scope.visionStatus = 0;
					$scope.contactStatus = 0;
					break;
				case 'vision':
					$scope.submitStatus = 0;
					$scope.visionStatus = 1;
					$scope.contactStatus = 0;
					break;
				case 'contact':
					$scope.submitStatus = 0;
					$scope.visionStatus = 0;
					$scope.contactStatus = 1;
					break;
				default:
					break;
			}
		}
	}]);
	
	app.controller('ContactController', function ($scope, $http) {
		$scope.result = 'hidden'
		$scope.resultMessage;
		$scope.formData; //formData is an object holding the name, email, subject, and message
		$scope.submitButtonDisabled = false;
		$scope.submitted = false; //used so that form errors are shown only after the form has been submitted
		$scope.submit = function(contactform) {
			$scope.submitted = true;
			$scope.submitButtonDisabled = true;
			if (contactform.$valid) {
				$http({
					method  : 'POST',
					url     : 'contact-form.php',
					data    : $.param($scope.formData),  //param method from jQuery
					headers : { 'Content-Type': 'application/x-www-form-urlencoded' }  //set the headers so angular passing info as form data (not request payload)
				}).success(function(data){
					console.log(data);
					if (data.success) { //success comes from the return json object
						$scope.submitButtonDisabled = true;
						$scope.resultMessage = data.message;
						$scope.result='bg-success';
					} else {
						$scope.submitButtonDisabled = false;
						$scope.resultMessage = data.message;
						$scope.result='bg-danger';
					}
				});
			} else {
				$scope.submitButtonDisabled = false;
				$scope.resultMessage = 'Failed :( Please fill out all the fields.';
				$scope.result='bg-danger';
			}
		}
	});

}());