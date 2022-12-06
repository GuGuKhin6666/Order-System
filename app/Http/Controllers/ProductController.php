<?php

namespace App\Http\Controllers;
use Storage;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\RequestStack;

class ProductController extends Controller
{
    //direct product list page
    public function list()
    {
        $getdata = Product::select('products.*','categories.name as category_name')
        ->when(request('searchkey'),function($query){
            $query->where('products.name','like','%'.request('searchkey').'%');
        })
        ->orderBy('id','desc')
        // ->paginate(3)
        ->leftjoin('categories','products.category_id','categories.id')
        ->get();
        // $getdata->appends(request()->all());
        return view('product.list', compact('getdata'));
    }

    //create product item
    public function create()
    {
        $database = Category::get();
        return view('product.create', compact('database'));
    }

    //product view
    public function view($id)
    {
        $productdata = Product::where('id', $id)->first();
        return view('product.view', compact('productdata'));
    }

    //product edit
    public function edit($id)
    {
        $datas = Product::where('id', $id)->first();
        $category = Category::get();
        return view('product.edit', compact('datas','category'));
    }

    //product create from update data
    public function update(Request $request)
    {
        $this->checkvalidationproduct($request,'update');
        $updatedata = $this->add_data($request);

        if($request->hasfile('image')){
            $currentimage = Product::where('id',$request->productid)->first();
            $currentimage = $currentimage->image;
           
    
            if($request->hasFile('image')){
                Storage::delete('public/'.$currentimage);
            }

            $fileimage  = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public', $fileimage);
            $updatedata['image'] = $fileimage;
        }

        Product::where('id', $request->productid)->update($updatedata);
        return redirect()->route('product#list');
    }

    //update product item
    public function updateproduct(Request $request)
    {
        $this->checkvalidationproduct($request, 'create');
        $updatedata = $this->add_data($request);

        $fileimage  = uniqid() . $request->file('image')->getClientOriginalName();
        $request->file('image')->storeAs('public', $fileimage);
        $updatedata['image'] = $fileimage;

        Product::create($updatedata);
        return redirect()->route('product#list');
    }

    //delete product
    public function delete($id){
        Product::where('id',$id)->delete();
        return back();
    }


    //validation check in
    private function checkvalidationproduct($request, $action)
    {
        $validationrules = [
            'name' => 'required | min:5,'.$request->productid,
            'description' => 'required',
            'price' => 'required',
            'waitingtime' => 'required',
        ];
        $validationrules['image'] = $action == 'create' ? 'required | mimes:jpg,png,jpeg,webp|file' : 'mimes:jpg,png,jpeg,webp|file';
        Validator::make($request->all(), $validationrules)->validate();
    }

    //add product data in database
    private function add_data($request)
    {
        return [
            'category_id' => $request->category_id,
            'name' => $request->name,
            'description' => $request->description,
            'image' => $request->image,
            'price' => $request->price,
            'waitingtime' => $request->waitingtime,
        ];
    }
}
