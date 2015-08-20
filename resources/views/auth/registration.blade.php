@extends('app')

@section('content')
<div id="page-wrapper">

	<div class="container-fluid">
		
		<div class="col-md-8 col-md-offset-2">

			<ul class="nav nav-pills">
				<li class="active"><a data-toggle="tab" href="#practitioner"><h5>Assistive Technology Service provider?</h5></a></li>
				<li><a data-toggle="tab" href="#client"><h5>Looking for an Assistive Solution?</h5></a></li>

			</ul>


			<div class="tab-content">
				<div id="client" class="tab-pane fade"> 
					<!-- 1st tab -->
					<div class="panel panel-default">
						<div class="panel-heading">Client Register</div>
						<div class="panel-body">
							@if (count($errors) > 0)
							<div class="alert alert-danger">
								<strong>Whoops!</strong> There were some problems with your input.<br><br>
								<ul>
									@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
									@endforeach
								</ul>
							</div>
							@endif
							<form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/register') }}">
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
								<div class="form-group">
									<label class="col-md-4 control-label">Name</label>
									<div class="col-md-6">
										<input type="text" class="form-control" name="name" value="{{ old('name') }}">
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-4 control-label">E-Mail Address</label>
									<div class="col-md-6">
										<input type="email" class="form-control" name="email" value="{{ old('email') }}">
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-4 control-label">Password</label>
									<div class="col-md-6">
										<input type="password" class="form-control" name="password">
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-4 control-label">Confirm Password</label>
									<div class="col-md-6">
										<input type="password" class="form-control" name="password_confirmation">
									</div>
								</div>

								<div class="form-group">
									<div class="col-md-6 col-md-offset-4">
										<button type="submit" class="btn btn-default">
											Register
										</button>
									</div>
								</div>
							</form>

						</div>
					</div>


				</div>
				

				<div id="practitioner" class="tab-pane fade in active">  
					<!-- 2nd tab -->
					<div class="panel panel-default">
						<div class="panel-heading">Practitioner Register</div>
						<div class="panel-body">
							@if (count($errors) > 0)
							<div class="alert alert-danger">
								<strong>Whoops!</strong> There were some problems with your input.<br><br>
								<ul>
									@foreach ($errors as $error)
									<li>{{ $error }}</li>
									@endforeach
								</ul>
							</div>
							@endif

							<form class="form-horizontal" role="form" method="POST" action="{{ url('practitioner/register') }}">
								<input type="hidden" name="_token" value="{{ csrf_token() }}">

								<div class="form-group">
									<label class="col-md-4 control-label">Name</label>
									<div class="col-md-6">
										<input type="text" required class="form-control" name="name" value="{{ old('name') }}">
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-4 control-label">E-Mail Address</label>
									<div class="col-md-6">
										<input type="email" required class="form-control" name="email" value="{{ old('email') }}">
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-4 control-label">Password</label>
									<div class="col-md-6">
										<input type="password" required class="form-control" name="password">
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-4 control-label">Confirm Password</label>
									<div class="col-md-6">
										<input type="password" required class="form-control" name="password_confirmation">
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-6 col-md-offset-4">
										<button type="submit" class="btn btn-default">
											Register
										</button>
									</div>
								</div>
							</form>
						</div>

					</div>
				</div>
			</div>




		</div>
	</div>
</div>


@endsection
@stop