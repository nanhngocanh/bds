<?php

namespace App\Http\Controllers\user\manage;

use App\Events\NoticeEvent;
use App\Http\Controllers\Admin\Functions\AdminNoticeController;
use App\Http\Controllers\Controller;
use App\Http\Requests\admin\PostsRequest;
use App\Models\Bookmark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\House;
use App\Models\News;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\Constraint\IsEmpty;

use function PHPUnit\Framework\isEmpty;
use App\Models\HouseImage;
class PostController extends Controller
{


    public function index(Request $request)
    {
        $user = Auth::user();
        // $user = User::find(Auth::user()->user_id);
        //dd($request);
        //dd($request->select);
        $house = House::where('user_id', $user->user_id)->orderBy('created_at', 'DESC')->paginate(5);
        // if ($type = $request->type){
        //     if ($type == 'sell'){

        //     }
        // }
        if ($select = $request->select) {
            $house = House::where('title', 'like', '%' . $select . '%')->where('user_id', $user->user_id)->orderBy('created_at', 'DESC')->paginate(5);
        }
        $state = $request->state;
        $type = $request->type;
        if ($state == "Tất cả") {
            if ($type == "Tất cả") {
                $house = House::where('user_id', $user->user_id)->orderBy('created_at', 'DESC')->paginate(5);
            } elseif ($type == "Bán") {
                $house = House::where('user_id', $user->user_id)->Where('house_type_id', 1)->orderBy('created_at', 'DESC')->paginate(5);
            } elseif ($type == "Cho thuê") {
                $house = House::where('user_id', $user->user_id)->Where('house_type_id', 2)->orderBy('created_at', 'DESC')->paginate(5);
            }
        } else if ($state == "Đang hiển thị") {
            if ($type == "Tất cả") {
                $house = House::where('user_id', $user->user_id)->Where('post_state', 1)->orderBy('created_at', 'DESC')->paginate(5);
            } elseif ($type == "Bán") {
                $house = House::where('user_id', $user->user_id)->Where('post_state', 1)->Where('house_type_id', 1)->orderBy('created_at', 'DESC')->paginate(5);
            } elseif ($type == "Cho thuê") {
                $house = House::where('user_id', $user->user_id)->Where('post_state', 1)->Where('house_type_id', 2)->orderBy('created_at', 'DESC')->paginate(5);
            }
        } elseif ($state == "Chờ hiển thị") {
            if ($type == "Tất cả") {
                $house = House::where('user_id', $user->user_id)->Where('post_state', 0)->orderBy('created_at', 'DESC')->paginate(5);
            } elseif ($type == "Bán") {
                $house = House::where('user_id', $user->user_id)->Where('post_state', 0)->Where('house_type_id', 1)->orderBy('created_at', 'DESC')->paginate(5);
            } elseif ($type == "Cho thuê") {
                $house = House::where('user_id', $user->user_id)->Where('post_state', 0)->Where('house_type_id', 2)->orderBy('created_at', 'DESC')->paginate(5);
            }
        }

        // $house = DB::table('houses')
        // ->join('house_kinds', 'houses.house_kind_id', '=', 'house_kinds.id')
        // ->join('house_types', 'houses.house_type_id', '=', 'house_types.id')
        // ->select('houses.*', 'house_kinds.kind', 'house_types.type')
        // ->where('user_id','=', $user->user_id)
        // ->get();
        //dd($house);
        return view('user.manage.showpost', compact('house', 'state', 'type'));
    }


    public function create()
    {

        return view('user.manage.createpost');
    }

    public function store(PostsRequest $request)
    {
        //dd($request);

        // // dd($request->file("images"));

        // $rules = [
        //     'images' => "required|array|between:3,3",
        // ];
        // $messages = [
        //     'between' => "Khong du so luong :attribute",
        //     "required" => "Truong :attribute khong duoc de trong",
        // ];
        // $attributes = [
        //     'images' => "anh",
        // ];

        //$request->validate($rules, $messages, $attributes);

        $data = $request->except(['images']);
        if($data['house_kind'] == 'Chung cư'){
            $data['house_kind_id'] = 1;
        } else {
            $data['house_kind_id'] = 2;
        }

        if ($data['house_type'] == 'Bán') {
            $data['house_type_id'] = 1;
        } else {
            $data['house_type_id'] = 2;
        }

        if ($data['livingroom'] == null) {
            $data['livingroom'] = 0;
        }

        if ($data['kitchen'] == null) {
            $data['kitchen'] = 0;
        }

        if ($data['toilet'] == null) {
            $data['toilet'] = 0;
        }

        if ($data['bedroom'] == null) {
            $data['bedroom'] = 0;
        }

        if ($data['bathroom'] == null) {
            $data['bathroom'] = 0;
        }

        if ($data['address'] == null) {
            $data['address'] = "";
        }

        if ($data['furniture'] == null || $data['furniture'] == 'Không có') {
            $data['furniture'] = false;
        } else {
            $data['furniture'] = true;
        }



        // $images = array();

        // foreach($request->file("images") as $image){
        //     $images[] = $image->store("images", "public");
        // }

        // $data['images'] = json_encode($images);
        // // dd($data['images']);

        $data['user_id'] = Auth::user()->user_id;
        $house = House::create($data);
        if ($request->has('images')) {
            foreach ($request->file("images") as $image) {
                $image_name = $request->title . time() . rand(1, 1000) . '.' . $image->extension();
                $image->move(public_path('storage/image'), $image_name);
                HouseImage::create([
                    'house_id' => $house->id,
                    'image' => $image_name,
                ]);
            }
        }
        $notice = [
            'title' => "Tạo bài viểt ".$house->title,
            'message' => $house->desciption,
            'src' => route('manage.post.detail', ['id' => $house->id]),
            'user_id' => auth()->user()->user_id,
        ];
        (new AdminNoticeController)->store($notice);
        return redirect()->route('manage.post')->with('status', 'Them tin moi thanh cong');
    }

    public function detail($id)
    {
        $house = House::find($id);
        $user_id = $house->user_id;
        $user = User::find($user_id);
        return view('user.manage.postdetail', compact('house','user'));
    }

    public function edit($id)
    {
        $house = House::find($id);
        //dd($house);
        return view('user.manage.editpost', compact('house', 'id'));
    }

    public function update(PostsRequest $request, $id)
    {

        $house = House::find($id);

        // if($request->file('images') != null){
        //     foreach($request->file('images') as $key => $value){
        //         Storage::delete('public/'.$images[$key]);
        //         $images[$key] = $value->store("images", "public");
        //     }
        // }

        $data = $request->except('_token', 'house_kind', 'house_type');

        if ($request->house_kind == 'Chung cư') {
            $data['house_kind_id'] = 1;
        } else {
            $data['house_kind_id'] = 2;
        }

        if ($request->house_type == 'Bán') {
            $data['house_type_id'] = 1;
        } else {
            $data['house_type_id'] = 2;
        }

        if ($data['livingroom'] == null) {
            $data['livingroom'] = 0;
        }

        if ($data['kitchen'] == null) {
            $data['kitchen'] = 0;
        }

        if ($data['toilet'] == null) {
            $data['toilet'] = 0;
        }

        if ($data['bedroom'] == null) {
            $data['bedroom'] = 0;
        }

        if ($data['bathroom'] == null) {
            $data['bathroom'] = 0;
        }

        if ($data['address'] == null) {
            $data['address'] = "";
        }

        if ($data['furniture'] == null || $data['furniture'] == 'Không có') {
            $data['furniture'] = false;
        } else {
            $data['furniture'] = true;
        }
        //$data['images'] = json_encode($images);
        House::where('id', $id)->update($data);
        if ($request->has('images')) {
            foreach ($request->file("images") as $image) {
                $image_name = $request->title . time() . rand(1, 1000) . '.' . $image->extension();
                $image->move(public_path('storage/image'), $image_name);
                HouseImage::create([
                    'house_id' => $id,
                    'image' => $image_name,
                ]);
            }
        }
        $notice = [
            'title' => "Cập nhật bài viểt ".$request->title,
            'message' => $request->desciption,
            'src' => route('manage.post.detail', ['id' => $id]),
            'user_id' => auth()->user()->user_id,
        ];
        (new AdminNoticeController)->store($notice);
        return redirect()->route("manage.post", ['id' => $id])->with("status", "Sua ban tin thanh cong");
    }

    public function destroy($id)
    {
        $house = House::find($id);
        //dd($house);
        try {
            $house = House::find($id);
            $images = HouseImage::where('house_id', $id)->get();
            foreach($images as $image){
                $image->deleteFileAndModel();
            }
            House::where('id', $id)->delete();
        } catch (\Illuminate\Database\QueryException $ex) {
            return redirect()->back()->with("error", "Xoa tin that bai");
        }
        return redirect()->route('manage.post')->with("status", "Xoa tin thanh cong");
    }

    public function main()
    {
        $latest = News::latest()->limit(1)->get();
        //$latest = DB::table('news') -> latest()->limit(1)->get();
        $news = News::latest()->limit(5)->get();
        // dd($news);
        $posts = House::where('post_state', 1)->latest()->limit(4)->get();
        return view('user.post.mainpage', compact('latest', 'news', 'posts'));
    }

    public function saleSearch(Request $request)
    {
        // $houses = House::where('house_type_id',1)->where('post_state',1)->latest()->paginate(5);
        // if($request->);
        // dd($request);
        $price_start = 0;
        $price_end = 999999999;
        $size_start = 0;
        $size_end = 99999999;
        $city = "";
        if (isset($request->key)) {

            $key = $request->key;
            $houses = House::where('house_type_id', 1)->where('post_state', 1)->where('title', 'like', '%' . $key . '%')->latest()->paginate(5);
            return view('user.post.saleSearch', compact('houses'));
        }

        if (
            $request->kind == null && $request->add == null && $request->price_start == null && $request->price_end == null
            && $request->size_start == null && $request->size_end == null && $request->bedroom == null
        ) {
            $houses = House::where('house_type_id', 1)->where('post_state', 1)->latest()->paginate(5);
        } else {
            if ($request->price_start != null) {
                $price_start = $request->price_start;
            }

            if ($request->price_end != null) {
                $price_end = $request->price_end;
            }

            if ($request->size_start != null) {
                $size_start = $request->size_start;
            }

            if ($request->size_end != null) {
                $size_end = $request->size_end;
            }

            if ($request->add != "Tất cả") {
                $city = $request->add;
            }


            if ($request->kind != null) {
                if ($request->kind == "Tất cả") {
                    if ($request->bedroom == null) {
                        $houses = House::where('house_type_id', 1)->where('post_state', 1)->where('city', 'like', '%' . $city . '%')->where('price', '>=', $price_start)->where('price', '<=', $price_end)->where('size', '>=', $size_start)->where('size', '<=', $size_end)->latest()->paginate(5);
                    } else {
                        $bed = $request->bedroom;
                        $houses = House::where('house_type_id', 1)->where('post_state', 1)->where('city', 'like', '%' . $city . '%')->where('price', '>=', $price_start)->where('price', '<=', $price_end)->where('size', '>=', $size_start)->where('size', '<=', $size_end)->where('bedroom',$bed)->latest()->paginate(5);
                    }
                } elseif($request->kind == "Chung cư"){
                    if ($request->bedroom == null) {
                        $houses = House::where('house_type_id', 1)->where('post_state', 1)->where('house_kind_id',1)->where('city', 'like', '%' . $city . '%')->where('price', '>=', $price_start)->where('price', '<=', $price_end)->where('size', '>=', $size_start)->where('size', '<=', $size_end)->latest()->paginate(5);
                    } else {
                        $bed = $request->bedroom;
                        $houses = House::where('house_type_id', 1)->where('post_state', 1)->where('house_kind_id',1)->where('city', 'like', '%' . $city . '%')->where('price', '>=', $price_start)->where('price', '<=', $price_end)->where('size', '>=', $size_start)->where('size', '<=', $size_end)->where('bedroom',$bed)->latest()->paginate(5);
                    }
                } else{
                    if ($request->bedroom == null) {
                        $houses = House::where('house_type_id', 1)->where('post_state', 1)->where('house_kind_id',2)->where('city', 'like', '%' . $city . '%')->where('price', '>=', $price_start)->where('price', '<=', $price_end)->where('size', '>=', $size_start)->where('size', '<=', $size_end)->latest()->paginate(5);
                    } else {
                        $bed = $request->bedroom;
                        $houses = House::where('house_type_id', 1)->where('post_state', 1)->where('house_kind_id',2)->where('city', 'like', '%' . $city . '%')->where('price', '>=', $price_start)->where('price', '<=', $price_end)->where('size', '>=', $size_start)->where('size', '<=', $size_end)->where('bedroom',$bed)->latest()->paginate(5);
                    }
                }
            } else {
                if ($request->bedroom == null) {
                    $houses = House::where('house_type_id', 1)->where('post_state', 1)->where('city', 'like', '%' . $city . '%')->where('price', '>=', $price_start)->where('price', '<=', $price_end)->where('size', '>=', $size_start)->where('size', '<=', $size_end)->latest()->paginate(5);
                } else {
                    $bed = $request->bedroom;
                    $houses = House::where('house_type_id', 1)->where('post_state', 1)->where('city', 'like', '%' . $city . '%')->where('price', '>=', $price_start)->where('price', '<=', $price_end)->where('size', '>=', $size_start)->where('size', '<=', $size_end)->where('bedroom',$bed)->latest()->paginate(5);
                }
            }
        }
        // ->where('post_state', 1)

        return view('user.post.saleSearch', compact('houses'));
    }

    public function rentSearch(Request $request)
    {
        $price_start = 0;
        $price_end = 999999999;
        $size_start = 0;
        $size_end = 99999999;
        $city = "";
        if (isset($request->key)) {

            $key = $request->key;
            $houses = House::where('house_type_id', 2)->where('post_state', 1)->where('title', 'like', '%' . $key . '%')->latest()->paginate(5);
            return view('user.post.rentSearch', compact('houses'));
        }

        if (
            $request->kind == null && $request->add == null && $request->price_start == null && $request->price_end == null
            && $request->size_start == null && $request->size_end == null && $request->bedroom == null
        ) {
            $houses = House::where('house_type_id', 2)->where('post_state', 1)->latest()->paginate(5);
        } else {
            if ($request->price_start != null) {
                $price_start = $request->price_start;
            }

            if ($request->price_end != null) {
                $price_end = $request->price_end;
            }

            if ($request->size_start != null) {
                $size_start = $request->size_start;
            }

            if ($request->size_end != null) {
                $size_end = $request->size_end;
            }

            if ($request->add != "Tất cả") {
                $city = $request->add;
            }


            if ($request->kind != null) {
                if ($request->kind == "Tất cả") {
                    if ($request->bedroom == null) {
                        $houses = House::where('house_type_id', 2)->where('post_state', 1)->where('city', 'like', '%' . $city . '%')->where('price', '>=', $price_start)->where('price', '<=', $price_end)->where('size', '>=', $size_start)->where('size', '<=', $size_end)->latest()->paginate(5);
                    } else {
                        $bed = $request->bedroom;
                        $houses = House::where('house_type_id', 2)->where('post_state', 1)->where('city', 'like', '%' . $city . '%')->where('price', '>=', $price_start)->where('price', '<=', $price_end)->where('size', '>=', $size_start)->where('size', '<=', $size_end)->where('bedroom',$bed)->latest()->paginate(5);
                    }
                } elseif($request->kind == "Chung cư"){
                    if ($request->bedroom == null) {
                        $houses = House::where('house_type_id', 2)->where('post_state', 1)->where('house_kind_id',1)->where('city', 'like', '%' . $city . '%')->where('price', '>=', $price_start)->where('price', '<=', $price_end)->where('size', '>=', $size_start)->where('size', '<=', $size_end)->latest()->paginate(5);
                    } else {
                        $bed = $request->bedroom;
                        $houses = House::where('house_type_id', 2)->where('post_state', 1)->where('house_kind_id',1)->where('city', 'like', '%' . $city . '%')->where('price', '>=', $price_start)->where('price', '<=', $price_end)->where('size', '>=', $size_start)->where('size', '<=', $size_end)->where('bedroom',$bed)->latest()->paginate(5);
                    }
                } else{
                    if ($request->bedroom == null) {
                        $houses = House::where('house_type_id', 2)->where('post_state', 1)->where('house_kind_id',2)->where('city', 'like', '%' . $city . '%')->where('price', '>=', $price_start)->where('price', '<=', $price_end)->where('size', '>=', $size_start)->where('size', '<=', $size_end)->latest()->paginate(5);
                    } else {
                        $bed = $request->bedroom;
                        $houses = House::where('house_type_id', 2)->where('post_state', 1)->where('house_kind_id',2)->where('city', 'like', '%' . $city . '%')->where('price', '>=', $price_start)->where('price', '<=', $price_end)->where('size', '>=', $size_start)->where('size', '<=', $size_end)->where('bedroom',$bed)->latest()->paginate(5);
                    }
                }
            } else {
                if ($request->bedroom == null) {
                    $houses = House::where('house_type_id', 2)->where('post_state', 1)->where('city', 'like', '%' . $city . '%')->where('price', '>=', $price_start)->where('price', '<=', $price_end)->where('size', '>=', $size_start)->where('size', '<=', $size_end)->latest()->paginate(5);
                } else {
                    $bed = $request->bedroom;
                    $houses = House::where('house_type_id', 2)->where('post_state', 1)->where('city', 'like', '%' . $city . '%')->where('price', '>=', $price_start)->where('price', '<=', $price_end)->where('size', '>=', $size_start)->where('size', '<=', $size_end)->where('bedroom',$bed)->latest()->paginate(5);
                }
            }
        }
        //

        return view('user.post.rentSearch', compact('houses'));
    }

    public function search(Request $request){
        $add = "";
        if($request->key != null){
            $add = $request->key;
        }

        if($request->type == "1"){
            $houses = House::where('house_type_id', 1)->where('post_state', 1)->where('city','like','%'.$add.'%')->latest()->paginate(5);
            return view('user.post.saleSearch', compact('houses'));
        } else {
            $houses = House::where('house_type_id', 2)->where('post_state', 1)->where('city','like','%'.$add.'%')->latest()->paginate(5);
            return view('user.post.rentSearch', compact('houses'));
        }
    }
}
