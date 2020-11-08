@extends('layout.app')
@section('content')

    <h3>Комментарии</h3>
    <p></p>
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Comment</th>
            <th scope="col">Date</th>
            <th scope="col"></th>

        </tr>
        </thead>
        <tbody>
        @foreach($comments as $comment)

            <tr>
                <th scope="row">{{++$i}}</th>
                <td>{{$comment->user->name}}</td>
                <td>{{$comment->comment}}</td>
                <td>{{date_format($comment->created_at, 'jS M Y')}}</td>
                <td class="buttons">
                    <a class="btn btn-danger" href="{{route('comment-delete', $comment->id)}}"><i class="far fa-trash-alt" style="color: white"></i></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {!! $comments->links() !!}

@endsection

