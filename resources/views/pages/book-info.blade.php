@extends('layouts.page-layout')

@section('title', 'Library')

@section('content')
    <div>
        <div class="row bg bg-dark p-2">
            {{ Breadcrumbs::render('info', $book_id) }}
        </div>
        <div style="height: 600px">
            <figure>
                <blockquote class="blockquote">
                    <p class="h3">{{ $book->volumeInfo->title }}</p>
                </blockquote>
                @foreach($book->volumeInfo->authors as $author)
                    <figcaption class="blockquote-footer">
                            <span>{{ $author }}</span>
                    </figcaption>
                @endforeach
            </figure>
            <div class="overflow-auto h-50">
                {{ $book->volumeInfo->description ?? 'This book don`t have description'}}
            </div>
        </div>
    </div>
@endsection
