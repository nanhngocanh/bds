@extends('admin/home')

@section('content')
    <div class="container">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <h1 class="text-center">Quản lý khiếu nại</h1>
        <br>
        <table class="table table-borderless">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Message</th>
                    <th scope="col">House</th>
                    <th scope="col">User</th>
                    <th scope="col">Type</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @php
                    $id = 1;
                @endphp
                @foreach ($messages as $message)
                    <tr>
                        <th scope="row">{{ $id++ }}</th>
                        <td>{{ $message->content }}</td>
                        <td><a href="{{ route('manage.post.detail', ['id' => $message->user_rec->id]) }}">{{ $message->user_rec->title }}</a></td>
                        <td><a href="">{{ $message->user_send->email }}</a></td>
                        <td>{{ $message->type->type }}</td>
                        <td><a href="{{ route('admin.message.show', ['id' => $message->id]) }}">Trả lời</a></td>
                        <td>
                            <form action="{{ route('admin.message.slove', ['id' => $message->id]) }}" method="post">
                                @csrf
                                <input type="submit" value="{{ $message->sloving ? 'Giải quết' : 'Chưa giải quết' }}"
                                    class="btn btn-outline-{{ $message->sloving ? 'success' : 'primary' }}"
                                    style="min-width: 150px;">
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div>
            {{ $messages->appends(request()->all())->links() }}
        </div>
    </div>
@endsection
