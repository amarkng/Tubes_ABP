@extends('layouts.app')

@section('content')
    <style>
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .upload-section {
            margin-right: 20px;
        }

        .uploaded-photo {
            max-width: 300px;
            max-height: 300px;
        }
    </style>
    {{-- Error and Status Card --}}

    @if (Session::has('message'))
        <div class="alert alert-info alert-dismissible fade show m-3" role="alert">
            <strong>{{ Session::get('message') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
                <strong>{{ $error }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endforeach
    @endif

    <div class="container">
        <div class="row">
            {{-- Uplode form and picture  --}}
            <div class="col-lg-6">
                <div class="card shadow rounded">
                    <div class="card-body">
                        <h3 class="text-primary">Upload Image</h3><br>
                        {!! Form::open([
                            'action' => 'App\Http\Controllers\Firebase\ImageController@store',
                            'method' => 'POST',
                            'files' => true,
                        ]) !!}

                        <div class="form-group">
                            {!! Form::label('image', 'Uplode Picture') !!}
                            <br>
                            {!! Form::file('image', null, ['class' => 'form-control']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::submit('Upload', ['class' => 'btn btn-primary']) !!}
                        </div>

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
            {{-- Display uploaded picture --}}
            <div class="col-lg-6">
                <div class="card shadow rounded">
                    <div class="card-body">
                        <h3 class="text-primary">Uploaded Image</h3><br>
                        <img id="uploadedImage" src="#" alt="Uploaded Image" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
