<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Product;

class ProductController extends Controller
{

    public function index()
    {

        $products = product::all();
        return inertia('Products/index', ['products' => $products]); //ตั้งpop ชื่อ product เพื่อไปใช้หน้า index
        // return Inertia::render('Products/index', ['products' => $this->products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)


    {

        $product = Product::findOrFail($id); //ใช้ตรวจสอบ id สินค้า ถ้าไม่พบจะแสดงข้อความ 404 error
         if (!$product) {
            abort(404, 'Product not found');
         }
        return inertia('Products/Show', ['product' => $product]); // ถ้ามีจะส่ง pop ไปหน้า index
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
