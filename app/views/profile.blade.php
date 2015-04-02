@extends('master')
<script>
    function clearRow(rowName) {
        var row = document.getElementsByName(rowName);
        row.value = "";
    }
</script>

@section('content')
    <h1>{{$user->id}}</h1>
    {{ Form::open(array('url' => 'logout')) }}
    {{ Form::submit('Logout')}}
    {{ Form::close() }}

    <hr>

    {{ Form::open(array('url' => 'profile', 'files' => true)) }}
    <h1>Notes</h1>

    <p>
        {{ Form::textarea('notes', $user->notes) }}
    </p>

    <h1>TBD</h1>
    <p>
        {{ Form::textarea('tbd', $user->tbd) }}
    </p>

    <h1>Websites</h1>

    <table border='0' class='col-lg-12'>
        <tr class="">
            <td width='40px' style = 'text-align:center'>1</td>
            <td>{{ Form::text('hyperlink1', $user->hyperlink1, ['maxlength' => '100', 'style' => 'display:table-cell; width:100%']) }}</td>
            <td width='90px' style = 'text-align:left' onclick='clearRow("hyperlink1")'><button>Clear</button></td>
        </tr>

        <tr class="">
            <td width='40px' style = 'text-align:center'>2</td>
            <td>{{ Form::text('hyperlink2', $user->hyperlink2, ['maxlength' => '100', 'style' => 'display:table-cell; width:100%']) }}</td>
            <td width='90px' style = 'text-align:left' onclick='clearRow("hyperlink2")'><button>Clear</button></td>
        </tr>

        <tr class="">
            <td width='40px' style = 'text-align:center'>3</td>
            <td>{{ Form::text('hyperlink3', $user->hyperlink3, ['maxlength' => '100', 'style' => 'display:table-cell; width:100%']) }}</td>
            <td width='90px' style = 'text-align:left' onclick='clearRow("hyperlink3")'><button>Clear</button></td>
        </tr>

        <tr class="">
            <td width='40px' style = 'text-align:center'>4</td>
            <td>{{ Form::text('hyperlink4', $user->hyperlink4, ['maxlength' => '100', 'style' => 'display:table-cell; width:100%']) }}</td>
            <td width='90px' style = 'text-align:left' onclick='clearRow("hyperlink4")'><button>Clear</button></td>
        </tr>

        <tr class="">
            <td width='40px' style = 'text-align:center'>5</td>
            <td>{{ Form::text('hyperlink5', $user->hyperlink5, ['maxlength' => '100', 'style' => 'display:table-cell; width:100%']) }}</td>
            <td width='90px' style = 'text-align:left' onclick='clearRow("hyperlink5")'><button>Clear</button></td>
        </tr>

        <tr class="">
            <td width='40px' style = 'text-align:center'>6</td>
            <td>{{ Form::text('hyperlink6', $user->hyperlink6, ['maxlength' => '100', 'style' => 'display:table-cell; width:100%']) }}</td>
            <td width='90px' style = 'text-align:left' onclick='clearRow("hyperlink6")'><button>Clear</button></td>
        </tr>

        <tr class="">
            <td width='40px' style = 'text-align:center'>7</td>
            <td>{{ Form::text('hyperlink7', $user->hyperlink7, ['maxlength' => '100', 'style' => 'display:table-cell; width:100%']) }}</td>
            <td width='90px' style = 'text-align:left' onclick='clearRow("hyperlink7")'><button>Clear</button></td>
        </tr>

        <tr class="">
            <td width='40px' style = 'text-align:center'>8</td>
            <td>{{ Form::text('hyperlink8', $user->hyperlink8, ['maxlength' => '100', 'style' => 'display:table-cell; width:100%']) }}</td>
            <td width='90px' style = 'text-align:left' onclick='clearRow("hyperlink8")'><button>Clear</button></td>
        </tr>
    </table>

    <h1>Images</h1>

    <p>
        {{ "Image 1" . Form::file('image1') . "Check and save to delete  " . Form::checkbox('deleteImage1', 'v1', false) . "<br><br>" }}
        {{ "Image 2" . Form::file('image2') . "Check and save to delete  " . Form::checkbox('deleteImage2', 'v2', false) . "<br><br>" }}
        {{ "Image 3" . Form::file('image3') . "Check and save to delete  " . Form::checkbox('deleteImage3', 'v3', false) . "<br><br>" }}
        {{ "Image 4" . Form::file('image4') . "Check and save to delete  " . Form::checkbox('deleteImage4', 'v4', false) . "<br><br>" }}
    </p>

    <p>{{ Form::submit('Save')}}</p>

    <?php
        $user = Session::get('user');

        if( $user->image1 != null ) {
            $imagepath = "data:image/jpeg;base64,$user->image1";
            echo "<br>Image 1<br>";
            echo "<img src=$imagepath >";
        }

        if( $user->image2 != null ) {
            echo "<br>Image 2<br>";
            $imagepath = "data:image/jpeg;base64,$user->image2";
            echo "<img src=$imagepath >";
        }

        if( $user->image3 != null ) {
            echo "<br>Image 3<br>";
            $imagepath = "data:image/jpeg;base64,$user->image3";
            echo "<img src=$imagepath >";
        }

        if( $user->image4 != null ) {
            echo "<br>Image 4<br>";
            $imagepath = "data:image/jpeg;base64,$user->image4";
            echo "<img src=$imagepath >";
        }
    ?>

    {{ Form::close() }}

@endsection
