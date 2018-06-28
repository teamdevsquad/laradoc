@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">New Documentation</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('docs.store') }}" aria-label="New Documentation">
                        @csrf
                        
                        <div class="form-group row">
                            <label for="category_id" class="col-sm-4 col-form-label text-md-right">Category: </label>

                            <div class="col-md-6">
                                <select name="category_id" id="category_id" class="form-control{{ $errors->has('category') ? ' is-invalid' : '' }}" >
                                    @foreach ($categories as $item)
                                        <option value="{{ $item->id }}" 
                                            {{ $item->id == old('category_id') ? 'selected' : '' }} 
                                        >
                                            {{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('category_id'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('category_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="title" class="col-sm-4 col-form-label text-md-right">Title: </label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" 
                                    name="title" value="{{ old('title') }}"  autofocus>

                                @if ($errors->has('title'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="documentation" class="col-md-4 col-form-label text-md-right">Documentation:</label>

                            <div class="col-md-6">
                                <textarea id="documentation" class="form-control{{ $errors->has('documentation') ? ' is-invalid' : '' }}" 
                                    name="documentation" rows="10" ></textarea>

                                @if ($errors->has('documentation'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('documentation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Save
                                </button>

                                <a class="btn btn-link" href="{{ route('docs.index') }}">
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
