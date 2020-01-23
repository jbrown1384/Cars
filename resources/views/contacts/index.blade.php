@extends('layouts.app')

@section('content')
    <!-- Intro Header -->
    <header class="intro">
        <div class="intro-body">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <h1 class="brand-heading">Challenge</h1>
                        <p class="intro-text">Code Something Awesome.
                            <br>We &lt;3 PHP Developers.</p>
                        <a href="#about" class="btn btn-circle page-scroll">
                            <i class="fa fa-angle-double-down animated"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- About Section -->
    <section id="about" class="container content-section text-center">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <h2>About This Challenge</h2>
                <p>We make awesome things at Dealer Inspire.  We'd like you to join us.  That's why we made this page.  Are you ready to join the team?</p>
                <p>To take the code challenge, visit <a href="https://bitbucket.org/dealerinspire/php-contact-form">this Git Repo</a> to clone it and start your work.</p>
            </div>
        </div>
    </section>

    <section id="coffee" class="content-section text-center">
        <div class="download-section">
            <div class="container">
                <div class="col-lg-8 col-lg-offset-2">
                    <h2>Coffee Break?</h2>
                    <p>Take a coffee break.  You deserve it.</p>
                    <a href="https://www.youtube.com/dealerinspire" class="btn btn-default btn-lg">or Watch YouTube</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="container content-section text-center">
        <div class="col-lg-8 col-lg-offset-2">
            <h2>Contact Guy Smiley</h2>
            <p>Remember Guy Smiley?  Yeah, he wants to hear from you.</p>
            <form action="/contact/#contact" enctype="multipart/form-data" method="post">
                @csrf   
                <!-- Full Name -->
                <div class="form-group">
                    <label for="name" class="col-md-4 col-form-label text-left">{{ __('Full Name') }}</label>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="off" placeholder="John Doe">

                    @error('name')
                    <small class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </small>
                    @enderror
                </div>

                <!-- Email -->
                <div class="form-group">
                    <label for="email" class="col-md-4 col-form-label text-left">{{ __('Email') }}</label>
                    <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="off" placeholder="email@example.com">

                    @error('email')
                    <small class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </small>
                    @enderror
                </div>   
                
                <!-- Phone -->
                <div class="form-group">
                    <label for="phone" class="col-md-4 col-form-label text-left">{{ __('Phone #') }}</label>
                    <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" autocomplete="off" placeholder="12334567890">

                    @error('phone')
                    <small class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </small>
                    @enderror
                </div>                                   

                <!-- Message -->
                <div class="form-group">
                    <label for="message" class="col-md-4 col-form-label text-left">{{ __('Message') }}</label>
                    <textarea id="message" class="form-control @error('message') is-invalid @enderror" name="message" autocomplete="off" placeholder="Hello! How are you?">{{ old('message') }}</textarea>

                    @error('message')
                    <small class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </small>
                    @enderror
                </div>  

                <div class="send-container">
                    <button class="btn btn-default btn-lg">Send Email</button>
                </div>
                
                @if (Session::has('success'))
                    <div class="success-container">
                        <div class="alert alert-success">{{ Session::get('success') }}</div>
                    </div>
                @endif                     

            </form>
        </div>
    </section>

    <!-- Map Section -->
    <div id="map"></div>
@endsection
