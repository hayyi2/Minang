angular.module('myApp')
.controller('DataController', function($scope){
	$scope.input = {};
	$action = "create";
	$scope.message = "";

	$scope.data = [
		{name: 'John Doe', email: 'john@asaldadi.com'},
		{name: 'Mary Moe', email: 'mary@asaldadi.com'},
		{name: 'July Dooley', email: 'july@asaldadi.com'}
	];

	$scope.create = function(){
		$scope.title_modal = "Create New Data!";
		$scope.label_modal = "Input Data";
		$action = "create";

		$('#input-modal').modal('show');
	}

	$scope.update = function($edit_data){
		$scope.title_modal = "Update Data!";
		$scope.label_modal = "Edit Data";
		$action = "edit";

		$scope.input = $edit_data;

		$('#input-modal').modal('show');
	}

	$scope.save = function(){
		if ($action == "create") {
			$scope.data.push($scope.input);
			$scope.input = {};
			$('#input-modal').modal('hide');
			$scope.message = "Success create data.";
		}else if ($action == "edit") {
			$scope.message = "Success update data.";
		}
	}

	$scope.delete = function($edit_data){
		if (confirm("Apakah anda yakin menghapus?")) {
			$scope.data.splice($scope.data.indexOf($edit_data),1);
			$scope.message = "Success delete data.";
		}
	}

	$scope.close_alert = function(){
		$scope.message = "";
	}
});
