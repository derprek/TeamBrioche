@if ($errors-> any())
	@foreach ($errors->all() as $error)
		@if($error === "Invalid Credentials! Please try again")
			<script>
                $(document).ready(function () {
                    $("#clientlogin").modal('show');
                });
            </script>
		@elseif($error === "Invalid Credentials. Please try again!")
			<script>
                $(document).ready(function () {
                    $("#praclogin").modal('show');
                });
            </script>
		@endif
	@endforeach
@endif

