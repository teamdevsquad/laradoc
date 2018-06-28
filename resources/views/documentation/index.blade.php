@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    Documentations
                    <a href="/admin/docs/create" class="btn btn-primary btn-sm float-right">
                        <i class="fa fa-plus"></i>
                    </a>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
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
            </div>
        </div>
    </div>
</div>
@endsection
