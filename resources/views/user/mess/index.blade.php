@extends('user/layout/post')
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
    </div>
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
                        <td><a
                                href="{{ route('manage.post.detail', ['id' => $message->user_rec->id]) }}">{{ $message->user_rec->title }}</a>
                        </td>
                        <td>{{ $message->type->type }}</td>
                        <td><a href="{{ route('user.message.show', ['id' => $message->id]) }}">Xem</a></td>
                        <td>
                            <div style="width: 150px; border-radius: 5px;"
                                class="text-center text-{{ $message->sloving ? 'success' : 'primary' }} border border-{{ $message->sloving ? 'success' : 'primary' }}">
                                <span>{{ $message->sloving ? 'Đã giải quết' : 'Chưa giải quết' }}</span>
                            </div>
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
