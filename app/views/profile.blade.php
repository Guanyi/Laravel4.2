@extends('master')

@section('content')

    <h1>{{$user->id}}</h1>
    <hr>

    {{ Form::open(array('url' => 'profile')) }}
    <h1>Notes</h1>

    <p>
        {{ Form::textarea('notes', Input::old('notes')) }}
    </p>

    <h1>TBD</h1>
    <p>
        {{ Form::textarea('tbd', Input::old('tbd')) }}
    </p>

    <h1>Websites. Click to open</h1>

    <table border="1">
        <tr>
            <td></td>
        </tr>
    </table>

    <p>{{ Form::submit('Save')}}</p>

    {{ Form::close() }}


@endsection