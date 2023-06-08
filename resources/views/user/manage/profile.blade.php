@extends('user/layout/post')
@section('content')
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
    <div class="all">
        <div class="leftt">
            <h5>Thông tin cá nhân</h5>
            <div> <img
                    class="img"
                    src="/storage/image/{{ $user->image->image }}" class="avatar avatar-lg"
                        alt="khong">
                    {{-- src="https://png.pngtree.com/png-clipart/20210608/ourlarge/pngtree-dark-gray-simple-avatar-png-image_3418404.jpg" --}}
                    </div>
            <h5 class="id">ID: {{ $user->id }}</h5>

        </div>
        <div class="rightt">
            <form method="POST" action="{{ route('manage.profile') }}" id="profile">
                @csrf
                @method('put')
                <div class="mb-3">
                    <label for="fullname" class="form-label">
                        <h6>Họ và tên</h6>
                    </label>
                    <input type="text" name="fullname" placeholder="EX: Trinh Huy Bang" class="form-control" required
                        value="{{ $user->fullname }}">
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">
                        <h6>Email</h6>
                    </label>
                    <input type="email" name="email" placeholder="EX: aaa@gmail.com" class="form-control" required
                        value="{{ $user->email }}">
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">
                        <h6>Số điện thoại</h6>
                    </label>
                    <input type="text" name="phone" placeholder="EX: 12321434" class="form-control" required
                        value="{{ $user->phone }}">
                </div>

                <div class="mb-3">
                    <label for="username" class="form-label">
                        <h6>Tên đăng nhập</h6>
                    </label>
                    <input type="text" name="username" placeholder="Username" class="form-control" required
                        value="{{ $user->username }}">
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">
                        <h6>Mật khẩu hiện tại</h6>
                    </label>
                    <input type="password" name="current_password" placeholder="Current password" class="form-control" required>
                </div>


                <div class="mb-3">
                    <label for="password" class="form-label">
                        <h6>Mật khẩu mới và xác nhận mật khẩu</h6>
                    </label>
                    <input type="password" name="new_password" placeholder="New password" class="form-control">
                </div>

                <div class="mb-3">
                    <input type="password" name="confirm_password" placeholder="Confirm password" class="form-control">
                </div>


            </form>
            <div class="action">
                <table>
                    <td>
                        <button class="btn btn-outline-primary" type="submit" form="profile"
                    onclick="return confirm('Bạn có chắc muốn sửa thông tin cá nhân không?')"> <span data-feather="check">
                    </span> Lưu</button>
                    </td>
                    <td>
                        <a href="{{ route('manage.post') }}"><button class="btn btn-secondary"><span data-feather="x"></span> Hủy
                            bỏ</button></a>
                    </td>
                    <td>
                        <form action="{{ route('manage.profile.delete', ['id' => $user->id]) }}" method="post">
                            @csrf
                            @method('delete')
                            <button style="background-color: red" type="submit" class="btn btn-secondary"
                                onclick="return confirm('Bạn có chắc muốn xóa tài khoản không ?')"> <span data-feather="trash"> </span> Xóa tài khoản   </button>
                        </form>
                    </td>

                </table>



                {{-- <button class="btn btn-secondary" style="background-color: red" type="submit"
                    onclick="return confirm('Bạn có chắc muốn xóa tài khoản không ?')"> <span data-feather="trash">
                    </span> Xóa tài khoản</button> --}}

            </div>


        </div>
    </div>

    <style>

        .leftt {
            margin-left: 3%;
            margin-top: 20px;
            width: 40%;
        }

        .rightt {
            left: 45%;
            top: 150px;
            width: 55%;
            margin: 1em
        }

        .mb-3 {
            width: 55%;
        }

        .action {
            right: 45%;
        }

        button {
            margin: 20px 0px 0px 20px;
        }

        .img {
            margin: 20px 0px 10px 70px;
            width: 150px;
            height: 150px;
            border-radius: 150px;
        }

        .id {
            margin: 10px 0px 10px 110px;
        }
        .all{
            display: flex;
            justify-content: space-around;
        }
    </style>
@endsection
