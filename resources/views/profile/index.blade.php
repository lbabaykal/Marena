@extends('layouts.main_without_footer')
@section('title', $title . \Illuminate\Support\Facades\Auth::user()->username)
@section('content')

    PROFILE

@endsection
