@extends('master')

@section('content')
<br>
<br>
<br>
<br>
<br>
<br>


<div ng-app="myApp">
	<div ng-controller="TodosController">

		<h1>
		Todos
		<small ng-if="remaining()"> @{{remaining()}} remaining </small>
		</h1>

		<input type ="text" placeholder ="search" ng-model="search">
		<br>
		<br>
		<ul>
			<li ng-repeat="todo in todos | filter:search">
				<input type ="checkbox" ng-model="todo.published">
				@{{ todo.id }} 
				@{{ todo.status }} 
			</li>
		</ul>

		<form ng-submit="addTodo()">
			<input type = "text" placeholder="Add Task" ng-model="newTodoText">
			<button type ="submit">Add Task</button>

		</form>
	</div>
</div>

@endsection
@stop