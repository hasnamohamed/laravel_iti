@extends("layouts.navbar")
@section('title')
    Create
@endsection
@section('content')
    <div class="card" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title">{{$post['title']}}</h5>
            <p class="card-text">{{$post['description']}}</p>
            <a href="{{route('users.show',$post['posted_by'])}}">{{$post['posted_by']}}</a>
        </div>
    </div>
@endsection
