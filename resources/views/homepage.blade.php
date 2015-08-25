@extends('master')

@section('content')
<!-- Header -->
<header>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <img class="img-responsive" src="img/logo.png" alt="">
                <div class="intro-text">
                    <span class="name">A T E S T </span>
                    <hr class="star-light">
                    <span class="skills">Assitive Technology Evaluation and Selection Tool</span>
                </div><br>
                <a href="auth/registration" class="btn btn-primary" role="button">Register to use the ATEST</a> 
                <a href="login/login" class="btn btn-primary" role="button">Sign In</a>   


            </div>
        </div>
    </div>
</header>

<!-- ABOUT -->
<section id="about">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2>About Us </h2>
                <hr class="star-primary">
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 text-center">
                <h3> to be added</h3>
            </div>

        </div>
    </div>
</section>

<!-- About Section -->
<section class="success" id="mission">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2>Our Mission</h2>
                <hr class="star-light">
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-lg-offset-2">
                <p>ATEST is an online assistive Tool</p>
            </div>
            <div class="col-lg-4">
                <p> This project will assist many people with disabilities who require assistive technologies to match their lifestyle and needs. At the present moment people who need assistive technologies have to go through a system to attain these technologies which can take up to a year. This process despite its length does not guarantee that people are matched with the appropriate assistive technology. The application asks the users questions in order to generate a report.  </p>
            </div>
        </div>
    </div>
</section>


<!-- Footer -->
<footer class="text-center">
    <div class="footer-below">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    Copyright &copy; Team Brioche
                </div>
            </div>
        </div>
    </div>
</footer>

@endsection

@stop