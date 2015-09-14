@if ($errors-> any())
    @foreach ($errors->all() as $error)

        	<div class="alert alert-danger">
				<strong>Whoops!</strong> There were some problems with your input.<br><br>
				<ul>
					@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>

     @endforeach
@endif	