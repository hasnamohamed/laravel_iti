{{--@extends('layouts.app')--}}

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
    <form action="{{route('comments.store')}}" method="post" id="comment">
        @csrf
        <section style="background-color: #eee;">
            <div class="container my-5 py-5">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-12 col-lg-10 col-xl-8">
                        <div class="card">
                            <input type="hidden" name="post_id" value="{{$post['id']}}">
                            <div class="card-footer py-3 border-0" style="background-color: #f8f9fa;">
                                <div class="d-flex flex-start w-100">
                                    <div class="form-outline w-100">
                              <textarea name="comment" class="form-control" id="textAreaExample" rows="4"
                              style="background: #fff;"></textarea>
                                        <label class="form-label" for="textAreaExample">Message</label>
                                    </div>
                                </div>
                                <div class="float-end mt-2 pt-1">
                                    <button type="submit" class="btn btn-primary btn-sm">Post comment</button>
                                    <button type="button" class="btn btn-outline-primary btn-sm">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </form>
    <section style="background-color: #eee;">
        <div class="container my-5 py-5">
            <div class="row d-flex justify-content-center">
                <div class="col-md-12 col-lg-10 col-xl-8">
                    <div class="card">
                        @if($post->comments)
                        @foreach($post->comments as $comment)
                        <div class="card-body">
                                <div class="d-flex flex-start align-items-center">
                                    <img class="rounded-circle shadow-1-strong me-3"
                                         src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(19).webp" alt="avatar" width="60"
                                         height="60" />
                                    <div>
                                        <h6 class="fw-bold text-primary mb-1">{{$comment->commentable->name}}</h6>
                                        <p class="text-muted small mb-0">
                                            Shared publicly - {{$comment['created_at']}}
                                        </p>
                                    </div>
                                </div>

                                <p class="mt-3 mb-4 pb-2">
                                    {{$comment['comment']}}
                                </p>
                            </div>
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        jQuery( document ).ready( function( $ ) {
            $( '#comment' ).on( 'submit', function() {
                // get the form data
                // there are many ways to get this data using jQuery (you can use the class or id also)
                var formData = {
                    'comment'             : $('comment').val()
                };
                // process the form
                $.ajax({
                    type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
                    url         : host + '/comments/create', // the url where we want to POST
                    data        : formData, // our data object
                    dataType    : 'json', // what type of data do we expect back from the server
                    encode          : true,
                    error: function(xhr, textStatus, thrownError) {
                        alert('Something went to wrong.Please Try again later...');
                    }
                })
                    // using the done promise callback
                    .done(function(data) {
                        // log data to the console so we can see
                        console.log(data);
                        // here we will handle errors and validation messages
                    });
                // stop the form from submitting the normal way and refreshing the page
                event.preventDefault();
            } );
        });
    </script>
@endsection
