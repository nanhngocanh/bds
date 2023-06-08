<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Bookmark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class BookmarkController extends Controller
{
    public function index(Request $request){
        $user = User::find(Auth::user()->user_id);
        $house = DB::select('select * from (bookmarks inner join houses on bookmarks.house_id = houses.id ) where bookmarks.user_id = ?', [$user->id]);
        // dd($house);
        $type = $request->type;
        if($select = $request->select){
            $house = DB::select('select * from (bookmarks inner join houses on bookmarks.house_id = houses.id ) where bookmarks.user_id = ? and title like ? or desciption like ?', [$user->id,'%'.$select.'%','%'.$select.'%']);
        }


        if ($type == 'Tất cả'){
            $house = DB::select('select * from (bookmarks inner join houses on bookmarks.house_id = houses.id ) where bookmarks.user_id = ?', [$user->id]);
        } elseif ($type == 'Bán'){
            $house = DB::select('select * from (bookmarks inner join houses on bookmarks.house_id = houses.id ) where bookmarks.user_id = ? and house_type_id = 1', [$user->id]);
        } elseif ($type == 'Cho thuê'){
            $house = DB::select('select * from (bookmarks inner join houses on bookmarks.house_id = houses.id ) where bookmarks.user_id = ? and house_type_id = 2', [$user->id]);
        }
        return view('user.book.bookmark', compact('house','type'));
    }

    public function destroy($id){
        $user = User::find(Auth::user()->user_id);
        try {
            Bookmark::where('house_id', $id)->where('user_id',$user->id)->delete();
        } catch (\Illuminate\Database\QueryException $ex) {
            return redirect()->back();
        }
        return redirect()->back();
    }

    public function create ($id){
        $user_id = Auth::user()->user_id;
        $book = Bookmark::where('user_id',$user_id)->where('house_id',$id)->get();
        // if(isset($book->items)){
        //     dd($book);
        // }
        if(isset($book[0])){
            
            Bookmark::where('house_id', $id)->where('user_id',$user_id)->delete();
        } else{
            $book = DB::insert('insert into bookmarks values (?,?)',[$user_id,$id]);
        }
        return redirect()->back();
    }
}
