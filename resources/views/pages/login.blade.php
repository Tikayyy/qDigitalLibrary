@extends('layouts.auth-layout')

@section('title', 'Login')

@section('content')
    <form action="" method="post" class="text-center">
        @csrf
        <div class="mb-2">
            <input class="form-control" type="text" placeholder="Email" name="email" aria-label="default input example" @if(old('email')) value="{{ old('email') }}" @endif>
        </div>
        <div class="mb-2">
            <input class="form-control" type="password" placeholder="Password" name="password" aria-label="default input example">
        </div>
        <div class="d-grid gap-2">
            <button class="btn btn-primary p-0" type="submit">
                <span class="h4">LOG IN</span>
            </button>
            <a class="btn btn-secondary p-0" type="button" href="{{ route('register') }}">
                <span class="h4">SIGN UP</span>
            </a>
        </div>
    </form>
@endsection
