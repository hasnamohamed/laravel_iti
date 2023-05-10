@extends("layouts.app")
@section('title')
    Create
@endsection
@section('content')
    <div class="container">
        <form action="{{route('posts.update',$post['id'])}}" method="post">
            @csrf
            @method('put')
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Title</label>
                <input name="title" value="{{$post['title']}}" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                @error('title')
                <p>{{$message}}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Description</label>
                <input name="description" value="{{$post['description']}}" type="text" class="form-control" id="exampleInputPassword1">
                @error('description')
                <p>{{$message}}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="disabledSelect" class="form-label">Post Creator</label>
                <select name="posted_by" id="disabledSelect" class="form-select">
                    @foreach($users as $user)
                        @if($user['id']==$post['posted_by'])
                        <option value="{{$user['id']}}" selected>{{$user['name']}}</option>
                        @else
                            <option value="{{$user['id']}}">{{$user['name']}}</option>
                        @endif
                    @endforeach
                </select>
                @error('posted_by')
                <p>{{$message}}</p>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
