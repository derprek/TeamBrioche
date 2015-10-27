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
    <h3><i class="fa fa-lock"></i></i> You do not have access to this page.</h3>
    <hr style="width:70%;">
    <p> You may contact Emily Steele at <a>emilysteele@gmail.com</a> for any enquiries.</p>
    <br><br>

      @if($usertype === 'admin')

        <p style="display:inline-block"><a class="btn btn-info btn-lg"
          href="{{  url('/admin/dashboard') }}"
          role="button">Take me back to my dashboard</a></p>

      @elseif($usertype === 'practitioner')

          <button class="btn btn-info btn-lg" onclick="redirectBack()"> Take me back to the previous page </button>

      @elseif($usertype === 'client')

         <button class="btn btn-info btn-lg" onclick="redirectBack()"> Take me back to the previous page </button>

      @elseif($usertype === 'guest')

        <p style="display:inline-block"><a class="btn btn-info btn-lg"
          href="{{ url('/../') }}"
          role="button">Take me to the home page</a></p>

      @endif

      <script>

        function redirectBack()
        {
          history.go(-1);
        }

      </script>

</body>
</html>
