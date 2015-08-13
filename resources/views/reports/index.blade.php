@extends('app')

@section('content')

	<h1> Reports</h1>

	<hr/>

	@foreach($reports as $report)

	<article>

	<h2>
		<a href ="{{ url('/reports', $report->report_id) }}"> Report Number: {{ $report-> report_id }} </a>
	</h2>

	<div class ="body"> Status:  {{ $report-> status }} </div>

	</article>



	@endforeach

@stop