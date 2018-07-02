@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Category | {{ $category->text }} </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('categories.update', [ 'id' => $category->id ]) }}" aria-label="Update Category">
                        {{ method_field('PUT') }}
                        @csrf
                        
                        <div class="form-group row">
                            <label for="text" class="col-sm-4 col-form-label text-md-right">Text: </label>

                            <div class="col-md-6">
                                <input id="text" type="text" class="form-control{{ $errors->has('text') ? ' is-invalid' : '' }}" 
                                    name="text" value="{{ old('text') ?: $category->text }}"  autofocus>

                                @if ($errors->has('text'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('text') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Save
                                </button>

                                <a class="btn btn-link" href="{{ route('categories.index') }}">
                                    Back
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
