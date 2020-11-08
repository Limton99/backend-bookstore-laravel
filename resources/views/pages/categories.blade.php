@extends('layout.app')
@section('content')

    <h3>Жанры</h3>
    <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#createCategory">Добавить Жанр</button>
    <p></p>
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Date</th>
            <th scope="col"></th>

        </tr>
        </thead>
        <tbody>
        @foreach($categories as $category)

            <tr>
                <th scope="row">{{++$i}}</th>
                <td>{{$category->name}}</td>
                <td>{{date_format($category->created_at, 'jS M Y')}}</td>
                <td class="buttons">
                    <button type="button"
                            class="btn btn-primary"
                            data-toggle="modal"
                            data-myid="{{$category->id}}"
                            data-myname="{{$category->name}}"
                            data-target="#updateCategory"
                    >
                        <i class="far fa-edit" style="color: white"></i>
                    </button>



                    <a class="btn btn-danger" href="{{route('category-delete', $category->id)}}"><i class="far fa-trash-alt" style="color: white"></i></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {!! $categories->links() !!}
    @include('modals.category.create')
    @include('modals.category.update')

@endsection
