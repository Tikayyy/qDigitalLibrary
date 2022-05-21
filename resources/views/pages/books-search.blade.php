@extends('layouts.page-layout')

@section('title', 'Books search')

@section('content')
    <div>
        <form class="row bg bg-dark p-2">
            <div class="col">
                <input type="text" class="form-control" name="search" placeholder="Search" @if(request()->get('search')) value="{{ request()->get('search') }}" @endif>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                    </svg>
                </button>
            </div>
        </form>
        @php $inc = 1 @endphp
        @foreach($books as $book)
            <div class="d-flex align-items-center row justify-content-md-center bg bg-secondary p-1 border-top border-bottom border-3 border-light p-2">
                <div class="col col-sm-1">
                    <span>{{ $inc++ }}</span>
                </div>
                <div class="col text-truncate text-light">
                    {{ $book->volumeInfo->title }}
                </div>
                <div class="col col-sm-2">
                    <form action="{{ route('books.add', ['book_id' => $book->id]) }}" method="post">
                        @csrf
                        <input type="button" class="btn btn-sm btn-success" value="ADD" data-bs-toggle="modal" data-bs-target="#confirmModal{{ $book->id }}">

                        <div class="modal fade" id="confirmModal{{ $book->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Add book</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you wat to add book "{{ $book->volumeInfo->title }}"?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-success">Yes</button>
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">No</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
@endsection
