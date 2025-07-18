<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();

        return view("product.index", compact("products"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("product.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required|string",
            "sku" => "required|string",
            "hsn_code" => "required|string",
            "description" => "required|string",
            "short_description" => "required|string",
            "image" => "required|mimes: jpg,png|max:2048",
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);

        }
        $product = new Product();
        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->hsn_code = $request->hsn_code;
        $product->short_description = $request->short_description;
        $product->description = $request->description;
        $product->image = 'images/' . $imageName;
        $product->save();

        return redirect()->route('product.index')->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::find($id);
        return view("product.edit", compact("product"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required|string",
            "sku" => "required|string",
            "hsn_code" => "required|string",
            "description" => "required|string",
            "short_description" => "required|string",
            "image" => "required|mimes: jpg,png|max:2048",
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);

        }
        $product = Product::find($id);
        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->hsn_code = $request->hsn_code;
        $product->short_description = $request->short_description;
        $product->description = $request->description;
        $product->image = 'images/' . $imageName;
        $product->save();

        return redirect()->route('product.index')->with('success', 'Product updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);

        unlink($product->image);

        $product = $product->delete();

        return back()->with('success', 'Product Deleted successfully.');
    }

    public function order(Request $request)
    {
        $request->validate([
            "user_id" => "required|numeric",
            "product_id" => "required|numeric",
            "customer_name" => "required|string",
            "quantity" => "required|numeric",
            "address" => "required|string"
        ]);

        $product = Product::find($request->product_id);
        if (!$product) {
            return back()->with("error", "Product Not found");
        }

        $order = new Order();
        $order->user_id = $request->user_id;
        $order->product_id = $request->product_id;
        $order->customer_name = $request->customer_name;
        $order->quantity = $request->quantity;
        $order->shipping_address = $request->address;
        $order->save();

        return back()->with("success", "You have successfully placed your order");


    }

    public function orderTable()
    {
        $orders = Order::all();
        return view("order-list", compact("orders"));
    }

    public function orderDetails(Request $request)
    {
        $order = Order::find($request->order_id);
        if (!$order) {
            return back()->with("error", "No order found");
        }
        $product = Product::find($order->product_id);
        $user = User::find($order->user_id);
        return view("order-detail", compact("order", "product", "user"));
    }
}
