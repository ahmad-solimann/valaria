@extends('users.layouts.app')
@section('content')

    <section id="hero" class="d-flex align-items-center">
        <div class="container position-relative" data-aos="fade-up" data-aos-delay="500">

            <h1>Welcome To Shar AL-Sharq</h1>
            <h2>We are team designers</h2>
            <a href="{{route('questionnaires.index')}}" class="btn-get-started scrollto">Get Started</a>
        </div>
    </section>

    @endsection