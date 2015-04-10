@extends('master')

@section('content')

    <div class="jumbotron" align="center">
        <?php
        if(isset($errorMessage))
            echo $errorMessage;
        ?>
        {{ Form::open(array('url' => 'processingregistration'))}}

        <h1>Register</h1>
        <p>
        {{ Form::label('id', 'Email Address')}}
        {{"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"}}
        {{ Form::text('id', Input::old('id'), array('placeholder' => 'awesome@awesome.com')) }}
        </p>
        <p>
        {{ Form::label('password', 'Password')}}
        {{"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"}}
        {{ Form::password('password')}}
        </p>
        <p>
        {{ Form::label('password_confirmation', 'Password Confirmation')}}
        {{ Form::password('password_confirmation')}}
        </p>
        <p>
            {{ Form::label('code', 'Code Below') }}
            {{"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"}}
            {{ Form::text('code') }}<br>
            <img src="<?php echo $builder->inline(); ?>" />
        </p>
        {{ Form::submit('Register')}} or
        <a href="{{ URL::to('/'); }}">Login</a>
    </div>

@endsection