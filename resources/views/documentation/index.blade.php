@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <form action="{{ request()->fullUrl() }}" method="GET" >
                    <div class="card-header">
                        Documentations
                        
                        <a href="/admin/docs/create" class="btn btn-primary btn-sm float-right">
                            <i class="fa fa-plus"></i>
                        </a>
                    
                        <div class="input-group col-md-4 float-right input-group-sm">
                            <input type="text" class="form-control" placeholder="Search..." name="search"
                                aria-label="Search Category" aria-describedby="search-category" value="{{ request('search') }}">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="submit" id="search-category">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>

                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Category</th>
                            <th>Title</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($docs as $doc)
                            <tr>
                                <td>{{ optional($doc->category)->name }}</td>
                                <td>{{ $doc->title }}</td>
                                <td style="white-space: nowrap;" width="10%">
                                    <a href="/admin/docs/{{ $doc->id }}/edit" class="btn btn-secondary btn-sm mr-2 float-left">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <form action=" {{ route('docs.destroy', ['id' => $doc->id ]) }}" method="POST" class="ml-4 mr-4" >
                                        {{ method_field('DELETE') }}
                                        @csrf
                                        <input type="hidden" name="__method" value="DELETE">
                                        <button class="btn btn-danger btn-sm" type="submit">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @if( $docs->hasPages() )
                    <div class="card-footer">
                        <div class="row justify-content-md-center">
                            <div class="col-md-10 col-lg-6">
                                {{ $docs->appends(request()->only('search'))->links() }}
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
