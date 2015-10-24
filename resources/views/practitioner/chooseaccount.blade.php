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
    <h2> Please choose which account to log in to </h2>
    <br>
        <p style="display:inline-block"><a class="btn btn-success btn-lg"
          href="{{ url('admin/loginAsAdmin') }}"
          role="button">Administrator Account</a></p>

         <p style="display:inline-block"><a class="btn btn-primary btn-lg"
          href="{{ url('admin/loginAsPractitioner') }}"
          role="button">Practitioner Account</a></p>
          </div>



</body>
</html>
