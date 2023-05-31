@extends("layouts.app")
@section('title')
    Posts
@endsection
@section('content')
    <a href="{{route('posts.create')}}">Create Post</a>
    @if(request()->has('view_deleted'))
        <a href="{{ route('posts.index') }}" class="btn btn-info">View All Users</a>
        <a href="{{ route('posts.restore.all') }}" class="btn btn-success">Restore All</a>
    @else
        <a href="{{ route('posts.deleted', ['view_deleted' => 'DeletedRecords']) }}" class="btn btn-primary">View Delete Records</a>
    @endif
    <table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Posted By</th>
            <th scope="col">Created At</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
    @foreach($posts as $post)

        <tr>
            <th scope="row">{{$post['id']}}</th>
            <td>{{$post['title']}}</td>
            <td>{{$post['posted_by']}}</td>
            <td>{{ \Carbon\Carbon::parse($post->created_at)->format('Y-m-d') }}</td>
            <td>
                <a href="{{route('posts.show',$post['id'])}}" type="submit" class="btn btn-info">View</a>
                <a href="{{route('posts.edit',$post['id'])}}" type="submit" class="btn btn-primary">Edit</a>

                @if(request()->has('view_deleted'))
                    <a href="{{ route('posts.restore', $post['id']) }}" class="btn btn-success">Restore</a>
                @else
                    <form method="post"  action="{{route('posts.destroy', $post['id'])}}">
                        @method('delete')
                        @csrf
                        <input name="_method" class="btn btn-danger" type="hidden" value="Delete">
                        <button type="submit" class="btn btn-xs btn-danger btn-flat show-alert-delete-box btn-sm" data-toggle="tooltip" title='Delete'>Delete</button>
                    </form>
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script type="text/javascript">
        $('.show-alert-delete-box').click(function(event){
            var form =  $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            swal({
                title: "Are you sure you want to delete this record?",
                text: "If you delete this, it will be gone forever.",
                icon: "warning",
                type: "warning",
                buttons: ["Cancel","Yes!"],
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((willDelete) => {
                if (willDelete) {
                    form.submit();
                }
            });
        });
    </script>
@endsection
