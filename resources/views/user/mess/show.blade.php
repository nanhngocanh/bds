@extends('user/layout/post')

@section('content')
    <div class="container">
        <div class="card mb-3" style="min-width: 1000px;margin: auto;">
            <div class="row g-0">
                <div class="col-md-4">
                    @php
                        $image = $message->user_send->image;
                    @endphp
                    <img src="/storage/image/{{ $image == null ? '' : $image->image }}"
                        class="img-fluid rounded-start avatar avatar-lg" alt="image">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title"><a href="#">{{ $message->user_send->email }}</a> want
                            {{ $message->type->type }} about <a href="">{{ $message->user_rec->title }}</a></h5>
                        <p class="card-text">{{ $message->content }}</p>
                        <p class="card-text"><small class="text-muted">{{ $message->updated_at }}</small></p>
                    </div>
                </div>
            </div>
        </div>
        <span style="font-size: 30px">{{ count($message->replies) }} Answer</span>
        @foreach ($message->replies as $reply)
            <div>
                <p>{{ $reply->message }}</p>
                <div class="">
                    <div class="row w-25" style="margin-left: auto; background-color: #5781f333">
                        <div class="col-4">
                            @php
                                $image = $reply->admin->image;
                            @endphp
                            <img src="/storage/image/{{ $image == null ? '' : $image->image }}"
                                class="img-fluid rounded-start avatar avatar-sm" alt="image">
                        </div>
                        <div class="col-8">
                            <p>{{ $reply->admin->email }}</p>
                            <p>Update at {{ $reply->updated_at }}</p>
                        </div>
                    </div>
                </div>
                <hr>
            </div>
        @endforeach
    @endsection
