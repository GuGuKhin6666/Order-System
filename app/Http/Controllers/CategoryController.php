<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //direct list page
    public function listpage(){
       $importdata =  Category::when(request('searchkey'),function($query){
            $query->where('name','like','%'.request('searchkey').'%');
       })
       ->orderBy('id','desc')
       ->paginate(5);
       $importdata->appends(request()->all());
        return view('admin.category.list',compact('importdata'));
    }

    public function createcategory(){
        return view('admin.category.create');
    }

    //category create
    public function upload(Request $request){
        $this->checkcategoryvalidation($request);
        $data= $this->result($request);
        Category::create($data);
        return redirect()->route('list#page');
    }

    //edit category
    public function edit($id){
        $edit = Category::where('id',$id)->first();
        return view('admin.category.edit',compact('edit'));
    }

    //category delete
    public function delete($id){
        Category::where('id',$id)->delete();
        return redirect()->route('list#page')->with(['deletemessage'=>'Delete Success..']);
    }


    //Category update
    public function update(Request $request){
        $this->checkcategoryvalidation($request);
        $data= $this->result($request);
        Category::where('id',$request->userid)->update($data);
        return redirect()->route('list#page');
    }

    //check validation
    private function checkcategoryvalidation($request){
        Validator::make($request->all(),[
            'categoryname'=>'required | unique:categories,name,'.$request->userid,
        ])->validate();
    }

    //storage data
    private function result($request){
        return[
            'name'=>$request->categoryname,
        ];
    }
}
