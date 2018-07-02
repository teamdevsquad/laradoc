@extends('layouts.docs')

@section('sidebar')
    <section class="sidebar">
        <docs-menu page="{{ $page }}" version="{{ $version }}"></docs-menu>
    </section>
@endsection

@section('content')
    <article>
        {!! $content !!}
    </article>
@endsection
 