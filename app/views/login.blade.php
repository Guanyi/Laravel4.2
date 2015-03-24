@extends('master')

@section('content')
    <div class="jumbotron" align="center">
        {{ Form::open(array('url' => 'login')) }}
        <h1>Login</h1>

        <!-- if there are login errors, show them here -->
        <p>
            {{ $errors->first('id') }}
            {{ $errors->first('password') }}

            <?php
            if(isset($errorMessage))
                echo $errorMessage;
            ?>
        </p>

        <p>
            {{ Form::label('id', 'Email Address') }}
            {{ Form::text('id', Input::old('id'), array('placeholder' => 'awesome@awesome.com')) }}
        </p>

        <p>
            {{ Form::label('password', 'Password') }}
            {{"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"}}
            {{ Form::password('password') }}
        </p>

        <p>{{ Form::submit('Login')}}</p>
        <a href="{{ URL::to('register'); }}">Register</a>
        <a href="{{ URL::to('forgotpassword'); }}">Forgot Password</a>

        {{ Form::close() }}
    </div>
@endsection