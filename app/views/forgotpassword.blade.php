@extends('master')

@section('content')
    <div class="jumbotron" align="center">
        {{ Form::open(array('url' => 'emailpasswordremainder')) }}
        <h1>Reset Your Password</h1>
        {{'Type your email address in the text box below. A new password will be sent to your email address.' }}

        <p>
            {{ Form::label('id', 'Email Address') }}
            {{ Form::text('id', Input::old('id')) }}
        </p>

        <p>{{ Form::submit('Email New Password') }}</p>

        {{ Form::close() }}
    </div>

@endsection