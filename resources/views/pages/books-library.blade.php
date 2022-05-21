@extends('layouts.page-layout')

@section('title', 'Library')

@section('content')
    <script type="text/javascript">
        function submitForm(action, method) {
            var form = document.getElementById('actionsForm');
            form.action = action;
            form.method = method;
            form.submit();
        }
    </script>

    <div>
        <div class="row bg bg-dark p-2">
            @if(request()->get('favorite'))
                {{ Breadcrumbs::render('favorite') }}
            @else
                {{ Breadcrumbs::render('library') }}
            @endif
        </div>
        @php $inc = 1 @endphp
        @foreach($books as $book)
            <div class="d-flex align-items-center row justify-content-md-center bg bg-secondary p-1 p-2 @if($book->favorite) border-5 border-start border-success mt-1 @else border-top border-bottom border-3 border-light @endif">
                <div class="col col-sm-1">
                    <span>{{ $inc++ }}</span>
                </div>
                <div class="col text-truncate">
                    {{ $book->title }}
                </div>
                <div class="col col-auto p-0">
                    <form method="post" class="form-inline" id="actionsForm">
                        @csrf
                        <input type="button" class="btn btn-sm btn-success" onclick="submitForm('{{ route('books.change.favorite', ['book_id' => $book->id]) }}', 'post')" @if($book->favorite) value="UF" @else value="F" @endif>
                        <input type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#confirmModal{{ $book->id }}" value="D">
                        <input type="button" class="btn btn-sm btn-primary" onclick="submitForm('{{ route('books.info', ['book_id' => $book->id]) }}', 'get')" value="I">

                        <div class="modal fade" id="confirmModal{{ $book->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Delete book</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to delete book "{{ $book->title }}"?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" onclick="submitForm('{{ route('books.delete', ['book_id' => $book->id]) }}', 'post')" class="btn btn-success">Yes</button>
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
