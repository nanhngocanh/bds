<?php
namespace App\Http\Controllers\User;


use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function newsList(){
        $latest = News::latest()->limit(1)->get();
        //$latest = DB::table('news') -> latest()->limit(1)->get();
        $newslast = News::latest()->limit(5)->get();
        $news = News::latest()->paginate(5);
        return view('user.post.newsList',compact('latest','newslast','news'));
    }

    public function newsSearch(Request $request){
        $news = News::latest()->paginate(5);
        if(isset($request->key)){
            $key = $request->key;
            $news = News::where('title','like', '%'.$key.'%')->orWhere('content','like', '%'.$key.'%')->orWhere('auther','like', '%'.$key.'%')->latest()->paginate(5);
        }
        return view('user.post.newsSearch',compact('news'));
    }

    public function newsDetail($id){
        $news = News::find($id);
        return view('user.post.newsDetail',compact('news'));
    }
}

?>
