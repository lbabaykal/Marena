@extends('layouts.main')
@section('title', $title . \Illuminate\Support\Facades\Auth::user()->username)
@section('content')

    PROFILE

@endsection
