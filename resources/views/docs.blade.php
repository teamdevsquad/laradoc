@extends('layouts.docs')

@section('sidebar')
    <section class="sidebar">
        <docs-menu page="{{ $page }}"></docs-menu>
    </section>
@endsection

@section('content')
    <article>
        {!! $content !!}
    </article>    
@endsection
 