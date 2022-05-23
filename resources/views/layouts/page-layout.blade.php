<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <title>@yield('title')</title>
</head>
<body>
<div class="container">
    <div class="w-25 mx-auto">
        @if($errors->any())
            <div class="alert alert-danger">
                {{ $errors->first() }}
            </div>
        @endif
        @if(Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif
        <div class="p-2 d-flex justify-content-around">
            <a href="{{ route('books.library') }}" class="btn btn-primary  btn-sm">Library</a>
            <a href="{{ route('books.search') }}" class="btn btn-primary  btn-sm">Search</a>
            <a href="{{ route('books.library', ['favorite'  => true]) }}" class="btn btn-primary  btn-sm">Favorite</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-primary btn-sm" type="submit">Logout</button>
            </form>
        </div>
        <div class="mx-auto">
            @yield('content')
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
        crossorigin="anonymous"></script>
</body>
</html>
