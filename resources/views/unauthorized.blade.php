<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> A T E S T</title>

    @include('cssreferences')
    @include('jsreferences')

</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <a class="navbar-brand" href="#">A T E S T</a>
        </div>     
    </nav>

    <div class="center_text">
    <h2><i class="fa fa-exclamation-triangle"></i> You do not have access to this page.</h2>
    <hr>
    <h4> You may contact Emily Steele at <a>emilysteele@gmail.com</a> for any enquiries.</h4>
    <br>

      @if($usertype === 'practitioner')

        <p style="display:inline-block"><a class="btn btn-success btn-lg"
          href="{{ url('practitioner/dashboard') }}"
          role="button">Back Home</a></p>

      @elseif($usertype === 'client')
        <p style="display:inline-block"><a class="btn btn-success btn-lg"
          href="{{ url('/../home') }}"
          role="button">Back Home</a></p>

      @elseif($usertype === 'guest')

       <p style="display:inline-block"><a class="btn btn-success btn-lg"
          href="{{ url('/../') }}"
          role="button">Back Home</a></p>

            @endif

</body>
</html>
