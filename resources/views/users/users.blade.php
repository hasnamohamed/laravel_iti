@extends("layouts.app")
@section('title')
    Index
@endsection
@section('content')
<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Created At</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <th scope="row">{{$user['id']}}</th>
            <td>{{$user['name']}}</td>
            <td>{{$user['email']}}</td>
            <td>{{$user['created_at']}}</td>
            <td>
                <button type="submit" class="btn btn-info">View</button>
                <button type="submit" class="btn btn-primary">Edit</button>
                <button type="submit" class="btn btn-danger">Delete</button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
<h5>Pagination</h5>
{{ $users->links() }}
@endsection
