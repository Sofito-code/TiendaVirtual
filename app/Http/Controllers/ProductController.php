<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SaveProductRequest;
use App\Product;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index', 'show');
    }

    public function index()
    {
        return view('product.index', ['products' => Product::latest()->paginate()]);
    }

    public function show(Product $product)
    {
        return view('product.show', ['product' => $product]);
    }

    public function create()
    {
        return view('product.create', ['product' => new Product]);
    }

    public function store(SaveProductRequest $request)
    {
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $name = $file->getClientOriginalName();
            $file->move('images/products', $name);
        }
        $product = Product::create($request->validated());
        $product->image = $name;
        $product->save();
        return redirect()->route('product.index')->with('status', 'El producto fue creado satisfactoriamente');
    }

    public function edit(Product $product)
    {
        return view('product.edit', ['product' => $product]);
    }

    public function update(Product $product, SaveProductRequest $request)
    {
        $product->update($request->validated());
        return redirect()->route('product.show', $product)->with('status', 'El producto fue actualizado satisfactoriamente');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('product.index')->with('status', 'El producto fue eliminado satisfactoriamente');
    }
}