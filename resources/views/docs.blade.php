@extends('layouts.docs')

@section('sidebar')
    <section class="sidebar">
        <docs-menu></docs-menu>
    </section>
@endsection

@section('content')
    <article>
        {!! $content !!}
    </article>    
@endsection
 