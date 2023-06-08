@extends('user/layout/post')

@section('content')
<form action="{{ route("user.message.store") }}" method="post">
    @csrf
    <div class="mb-3">
      <label for="" class="form-label">Content</label>
      <input type="text" name="content" id="" class="form-control" placeholder="Message" aria-describedby="helpId">
      <small id="helpId" class="text-muted">Tin nhắn muốn gửi cho admint</small>
    </div>
    <div class="mb-3">
        <input type="hidden" class="form-control" name="message_type_id" id="" placeholder="" value="2">
    </div>
    <div class="mb-3">
        <input type="hidden" class="form-control" name="user_id" id="" placeholder="" value="{{ auth()->user()->user_id }}">
    </div>
    <div class="mb-3">
        <input type="hidden" class="form-control" name="house_id" id="" placeholder="" value="{{ $house->id }}">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection
