@extends('user/layout/post')
@section('content')
    <div style="width:70%">
        <div style="background: rgb(6, 6, 113)">
            <h2 style="color: aliceblue">Thông báo</h2>
        </div>
        <hr>
        @foreach ($mess as $key => $item)
            <table style="border: 1">
                <tr>
                    <td style="width: 80%">
                        <a class="nav-link content_mess active" href="{{ route('mess_detail', ['id' => $item->id]) }}"
                            style="width: 50%">
                            {{ $item->id }}:
                            {{ $item->content }}
                        </a>
                    </td>
                    <td>
                        {{ $item->created_at }}
                    </td>
                    <td>
                        <div class="col">
                            <form action="{{ route('delete_message', ['id' => $item->id]) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-link"
                                    onclick="return confirm('Ban co chac chan xoa tin')"><i
                                        class="nav-link btndelete active"> <span data-feather="trash"></span></i></button>
                            </form>
                        </div>

                    </td>
                </tr>
            </table>
            <hr>
        @endforeach

    </div>

    <style>
        h2 {
            margin: 10px 10px 10px 10px;
        }

        table {
            background-color: aqua;
        }

        .btndelete {
            /* position: absolute; */
            margin: 10px 10px 10px 10px;
            /* right: 10px; */
        }

        .content_mess {
            margin: 10px 10px 10px 10px;
        }

        .content_mess:hover {
            text-decoration: underline;
        }
    </style>
@endsection
