(function(){

	var myApp = angular.module('myApp',['angular-loading-bar']);


		myApp.controller('ReportsController', ['$scope','$http', function($scope,$http) {
		 /* $scope.todolist =[
			{ body:'Go to store',completed:true },
			{ body:'Finish Laravel',completed:false },
			{ body:'Kiss Linkai',completed:false }
			]; */
			
			$http.get('/getAllReports').success(function(fetchAllReports){

				$scope.AllReports = fetchAllReports;
			});

	

			$scope.remaining = function(){
				var count =0;

				angular.forEach($scope.todos, function(todo) {
					count += todo.published ? 0 :1;

				});

				return count;
			}

			$scope.addTodo = function(){
				var todo ={

					body:$scope.newTodoText,
					published:false
				};

				$scope.todos.push(todo);
				$http.post('todos', todo);
			};

		}

		myApp.controller('ProgressReportsController', ['$scope','$http', function($scope,$http) {
		 /* $scope.todolist =[
			{ body:'Go to store',completed:true },
			{ body:'Finish Laravel',completed:false },
			{ body:'Kiss Linkai',completed:false }
			]; */
			
			$http.get('/getProgressReports').success(function(fetchProgressReports){

				$scope.ProgressReports = fetchProgressReports;
			});

		}

		myApp.controller('ProgressReportsController', ['$scope','$http', function($scope,$http) {
		 /* $scope.todolist =[
			{ body:'Go to store',completed:true },
			{ body:'Finish Laravel',completed:false },
			{ body:'Kiss Linkai',completed:false }
			]; */
			
			$http.get('/getProgressReports').success(function(fetchProgressReports){

				$scope.ProgressReports = fetchProgressReports;
			});

		}


		]);

})();