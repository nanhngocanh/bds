<?php

namespace App\Http\Controllers\Admin\Functions;

use App\Http\Controllers\Controller;
use App\Models\House;
use Illuminate\Http\Request;

class HouseController extends Controller
{
    public function index(){
        $houses = House::handlerOrder()->search()->paginate(5);
        return view("admin.function.houses.index", compact('houses'));
    }

    public function update($id){
        $house = House::where('id', $id)->first();
        if($house  == null){
            return redirect()->route('admin.house.index')->with('error', 'Nhà không tồn tại');
        }

        if($house->post_state == false){
            House::where('id', $id)->update(['post_state' => true]);
        }else{
            House::where('id', $id)->update(['post_state' => false]);
        }
        ;
        return redirect()->route('admin.house.index')->with('status', 'Cập nhật thành công');
    }
}
