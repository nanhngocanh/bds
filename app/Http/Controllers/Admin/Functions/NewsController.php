<?php

namespace App\Http\Controllers\Admin\Functions;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\NewsRequest;
use App\Models\Image;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    //
    public function index()
    {
        $news = News::handlerOrder()->search()->paginate(10);
        return view('admin.function.news.index', compact('news'));
    }

    // method: GET create new news
    public function create()
    {
        return view('admin.function.news.create');
    }

    // method: POST create new news
    public function store(NewsRequest $request)
    {

        $rules = [
            'images' => "required",
        ];
        $messages = [
            "required" => "Truong :attribute khong duoc de trong",
        ];
        $attributes = [
            'images' => "anh",
        ];

        $request->validate($rules, $messages, $attributes);

        $data = $request->only([
            'title',
            'content',
            'auther',
        ]);
        $data['admin_id'] = Auth::guard('admin')->user()->admin_id;
        $news = News::create($data);
        if ($request->has('images')) {
            foreach ($request->file("images") as $image) {
                $image_name = $request->title . time() . rand(1, 1000) . '.' . $image->extension();
                $image->move(public_path('storage/image'), $image_name);
                Image::create([
                    'news_id' => $news->id,
                    'image' => $image_name,
                ]);
            }
        }
        return redirect()->route('admin.news')->with('status', 'Them tin moi thanh cong');
    }

    public function show($id)
    {
        $news = News::find($id);
        return view('admin.function.news.show', compact('news'));
    }

    public function edit($id)
    {
        $news = News::find($id);
        return view('admin.function.news.edit', compact('news'));
    }

    public function update(NewsRequest $request, $id)
    {

        $news = News::find($id);

        $data = $request->except("_token");
        News::where('id', $id)->update($data);

        if ($request->has('images')) {
            foreach ($request->file("images") as $image) {
                $image_name = $request->title . time() . rand(1, 1000) . '.' . $image->extension();
                $image->move(public_path('storage/image'), $image_name);
                Image::create([
                    'news_id' => $news->id,
                    'image' => $image_name,
                ]);
            }
        }

        return redirect()->route("admin.news.edit", ['id' => $id])->with("status", "Sua ban tin thanh cong");
    }

    public function destroy($id)
    {
        $images = Image::where('news_id', $id)->get();
        foreach($images as $image){
            $image->deleteFileAndModel();
        }
        News::where('id', $id)->delete();
        return redirect()->route('admin.news')->with("status", "Xoa tin thanh cong");
    }
}
