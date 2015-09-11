@if ($errors-> any())
    @foreach ($errors->all() as $error)
        @if($error === "Invalid Credentials. Please try again!")
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    <li>{{ $error }}</li>    
                </ul>
            </div>
        @elseif($error === "Invalid Credentials! Please try again")
	         <div class="alert alert-danger">
	            <strong>Whoops!</strong> There were some problems with your input.<br><br>
	            <ul>
	                <li>{{ $error }}</li>    
	            </ul>
	        </div>
        @else
        	<div class="alert alert-danger">
				<strong>Whoops!</strong> There were some problems with your input.<br><br>
				<ul>
					@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif
     @endforeach
@endif	