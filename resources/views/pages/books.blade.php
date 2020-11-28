@extends('layout.app')
@section('content')

    <h3>Книги</h3>
    <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#createBook">Добавить книгу</button>
    <p></p>
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Image</th>
            <th scope="col">Title</th>
            <th scope="col">Price</th>
            <th scope="col">Count</th>
            <th scope="col">Views</th>
            <th scope="col">Date</th>
            <th scope="col"></th>

        </tr>
        </thead>
        <tbody>
        @foreach($books as $book)

        <tr>
            <th scope="row">{{++$i}}</th>
            <th scope="row" style="max-width: 10px"><img src="{{$book->image}}" style="max-width: 100%"/></th>
            <td>{{$book->title}}</td>
            <td>{{$book->price}}$</td>
            <td>{{$book->count}}</td>
            <td>{{$book->views}}</td>
            <td>{{date_format($book->created_at, 'jS M Y')}}</td>
            <td class="buttons">
                <button type="button"
                        class="btn btn-primary"
                        data-toggle="modal"
                        data-myid="{{$book->id}}"
                        data-mytitle="{{$book->title}}"
                        data-mydescription="{{$book->description}}"
                        data-myprice="{{$book->price}}"
                        data-mycount="{{$book->count}}"
                        data-myimage="{{$book->image}}"
                        data-target="#updateBook"
                        >
                    <i class="far fa-edit" style="color: white"></i>
                </button>

                <a class="btn btn-danger" href="{{route('book-delete', $book->id)}}"><i class="far fa-trash-alt" style="color: white"></i></a>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    {!! $books->links() !!}
    @include('modals.book.create')
    @include('modals.book.update')

@endsection
