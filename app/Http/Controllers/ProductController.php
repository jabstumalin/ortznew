<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class ProductController extends Controller
{

    public function page1(){
        return view('page1');
    }
    public function page2(){
         return view('page2');
    }
    public function index(){
        $products = Product::where('status', 'active')->orderBy('created_at', 'DESC')->get();
        return view('products.index', compact('products'));
    }
    public function create(){
        return view('products.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required|string|max:255',
            'price'=>'required|string',
            'product_code'=>'required|string',
            'description'=>'required|string',
        ]);

        Product::create([
            'title' => $request->input('title'),
            'price' => $request->input('price'),
            'product_code' => $request->input('product_code'),
            'description' => $request->input('description'),
            'users_id'=> Auth::id(),
        ]);
        return redirect()->route('products')->with('success', 'Product created successfully');

    }
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }
    public function update(Request $request, string $id)
    {
       $product = Product::findOrFail($id);

       $request->validate([
        'title'=>'required|string|max:255',
        'price'=>'required|string',
        'product_code'=>'required|string',
        'description'=>'required|string',

    ]);

    $product->update($request->all());
    return redirect()->route('products')->with('success', 'Product update successfully!');
    }
    public function destroy(Request $request, string $id)
    {
       $product = Product::findOrFail($id);

       $product->update([
        'title'=>$product->title,
        'price'=>$product->price,
        'product_code'=>$product->product_code,
        'description'=>$product->description,
        'status'=>'inactive',
         'users_id'=> Auth::id(),


         ]);
         return redirect()->route('products')->with('success', 'Product deleted successfully!');
    }
}
