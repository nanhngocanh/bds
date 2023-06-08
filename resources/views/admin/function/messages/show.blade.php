@extends('admin/home')

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
                            {{ $message->type->type }} about <a href="{{ route("manage.post.detail", ['id' => $message->user_rec->id]) }}">{{ $message->user_rec->title }}</a></h5>
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
        <br>
        <form action="{{ route('admin.reply.store') }}" method="post">
            @csrf
            <input type="hidden" name="message_id" value="{{ $message->id }}">
            <input type="hidden" name="admin_id" value="{{ auth('admin')->user()->admin_id }}">
            <div class="mb-3">
                <label for="" class="form-label">
                    <h5> Your Answer </h5>
                </label>
                <textarea class="form-control" name="message" id="" cols="30" rows="10" required></textarea>
            </div>
            <input type="submit" value="Post your answer">
        </form>
    </div>
@endsection
