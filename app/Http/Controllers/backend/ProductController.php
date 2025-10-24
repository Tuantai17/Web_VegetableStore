<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = Product::select(
            'product.id',
            'product.name',
            'category.name as categoryname',
            'brand.name as brandname',
            'thumbnail',
            'product.status'
        )
            ->join('category', 'product.category_id', '=', 'category.id')
            ->join('brand', 'product.brand_id', '=', 'brand.id')
            ->orderBy('product.created_at', 'desc')
            ->paginate(5);

        return view('backend.product.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $list_category = Category::select('name', 'id')->orderBy('sort_order', 'asc')->get();
        $list_brand = Brand::select('name', 'id')->orderBy('sort_order', 'asc')->get();

        return view('backend.product.create', compact('list_category', 'list_brand'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $product = new Product();
        $product->name = $request->name;
        $product->slug = Str::of($request->name)->slug('-');
        $product->detail = $request->detail;
        $product->description = $request->description;
        $product->price_root = $request->price_root;
        $product->price_sale = $request->price_sale;
        $product->qty = $request->qty;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;

        // Upload file
        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $extension = $file->getClientOriginalExtension();
            $filename = $product->slug . '.' . $extension;
            $file->move(public_path('assets/images/product'), $filename);
            $product->thumbnail = $filename;
        }

        $product->status = $request->status;
        $product->created_at = now();
        $product->created_by = Auth::id() ?? 1;
        $product->save();

        return redirect()->route('product.index')->with('thongbao', 'Thêm thành công');
    }



    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::find($id);
        $list_category = Category::select('id', 'name')->orderBy('sort_order', 'asc')->get();
        $list_brand = Brand::select('id', 'name')->orderBy('sort_order', 'asc')->get();

        return view('backend.product.edit', compact('list_category', 'list_brand', 'product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, string $id)
    {
        $product = Product::find($id);
        if ($product == null) {
            return redirect()->route('product.index');
        }

        $slug = Str::of($request->name)->slug('-');
        $product->name = $request->name;
        $product->slug = $slug;
        $product->detail = $request->detail;
        $product->description = $request->description;
        $product->price_root = $request->price_root;
        $product->price_sale = $request->price_sale;
        $product->qty = $request->qty;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;

        // Xử lý ảnh mới nếu có upload
        if ($request->hasFile('thumbnail')) {
            $image_path = public_path('assets/images/product/' . $product->thumbnail);
            if (File::exists($image_path)) {
                File::delete($image_path);
            }

            $file = $request->file('thumbnail');
            $extension = $file->getClientOriginalExtension();
            $fileName = $slug . '.' . $extension;
            $file->move(public_path('assets/images/product'), $fileName);
            $product->thumbnail = $fileName;
        }

        $product->status = $request->status;
        $product->updated_by = Auth::id() ?? 1;
        $product->updated_at = now();
        $product->save();

        return redirect()->route('product.index')->with('thongbao', 'Cập nhật thành công');
    }

     



    public function trash()
    {
        $list = Product::select('product.id', 'thumbnail', 'product.name', 'category.name as categoryname', 'brand.name as brandname', 'product.status')
            ->join('category', 'product.category_id', '=', 'category.id')
            ->join('brand', 'product.brand_id', '=', 'brand.id')
            ->orderBy('product.created_at', 'desc')
            ->onlyTrashed()
            ->paginate(5);
        return view('backend.product.trash', compact('list'));
    }

    public function delete($id)
    {
        $product = Product::find($id);
        if ($product === null) {
            return redirect()->route('product.index');
        }
        $product->delete(); // khóa mềm
        return redirect()->route('product.index');
    }

    public function status($id)
    {
        $product = Product::find($id);
        if ($product == null) 
        {
            return redirect()->route('product.index');
        }
        $product->status = ($product->status == 1) ? 0 : 1;
        $product->updated_at = date('Y-m-d H:i:s');
        $product->updated_by = Auth::id();
        $product->save(); // lưu cấp nhật
        return redirect()->route('product.index');
    }

    public function restore($id)
    {
        $product = Product::onlyTrashed()->find($id);
        if ($product == null) {
            return redirect()->route('product.index');
        }
        $product->restore(); // Khôi phục
        return redirect()->route('product.trash');
    }

    public function destroy(string $id)
    {
        $product = Product::onlyTrashed()->find($id);
        if ($product === null) {
            return redirect()->route('product.trash');
        }
        $image_path = public_path('assets/images/product/' . $product->thumbnail);
        if ($product->forceDelete()) {
            if (File::exists($image_path)) {
                File::delete($image_path);
            }
        }
        return redirect()->route('product.trash');
    }

    public function show($id)
    {
        $product = Product::with(['category', 'brand'])->findOrFail($id);
        return view('backend.product.show', compact('product'));
    }
    
    
public function detail($slug)
    {
        $product = Product::where('slug', $slug)->first();

        if (!$product) {
            abort(404);
        }

        return view('frontend.product-detail', compact('product'));
    }

}







