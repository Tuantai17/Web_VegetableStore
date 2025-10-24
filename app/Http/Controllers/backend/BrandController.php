<?php
namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Http\Requests\UpdateBrandRequest;

class BrandController extends Controller
{
    public function index()
    {
        $list = Brand::select('id', 'name', 'image', 'status')
            ->orderBy('created_at', 'desc')
            ->paginate(5);
        return view('backend.brand.index', compact('list'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.brand.create');
    }
    
 
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:brand,slug',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Thêm kiểm tra file ảnh
        ]);
    
        $brand = new Brand();
        $brand->name = $request->name;
        $brand->slug = $request->slug ?: Str::slug($request->name);
        $brand->status = 1;
        $brand->created_by = Auth::id() ?? 1;
    
        // Xử lý upload ảnh
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('assets/images/brand'), $fileName);
            $brand->image = $fileName;
        } else {
            $brand->image = null; // Đặt giá trị null nếu không có ảnh
        }
    
        $brand->save();
    
        return redirect()->route('brand.index')->with('success', 'Thêm thương hiệu thành công!');
    }
    
    
   
    // EDIT
    public function edit(string $id)
    {
        $brand = Brand::find($id);
    
        // Nếu không tìm thấy brand, có thể chuyển hướng hoặc báo lỗi
        if (!$brand) {
            return redirect()->route('brand.index')->with('error', 'Không tìm thấy thương hiệu!');
        }
    
        return view('backend.brand.edit', compact('brand'));
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBrandRequest $request, string $id)
    {
        $brand = Brand::find($id);
        if ($brand === null) {
            return redirect()->route('brand.index');
        }

        $slug = Str::slug($request->name, '-');
        $brand->name = $request->name;
        $brand->slug = $slug;

       // Xử lý ảnh mới nếu có upload
       if ($request->hasFile('image')) {
        $image_path = public_path('assets/images/brand/' . $brand->image);
        if (File::exists($image_path)) {
            File::delete($image_path);
        }

        $file = $request->file('image');
        $extension = $file->getClientOriginalExtension();
        $fileName = $slug . '.' . $extension;
        $file->move(public_path('assets/images/brand'), $fileName);
        $brand->image = $fileName;
    }

        $brand->status = $request->status;
        $brand->updated_by = Auth::id() ?? 1;
        $brand->updated_at = now();
        $brand->save();

        return redirect()->route('brand.index')->with('thongbao', 'Cập nhật thương hiệu thành công');
    }

    public function trash()
    {
        $list = Brand::onlyTrashed()->orderBy('created_at', 'desc')->paginate(5);
        return view('backend.brand.trash', compact('list'));
    }

    public function delete($id)
    {
        $brand = Brand::find($id);
        if ($brand === null) {
            return redirect()->route('brand.index');
        }
        $brand->delete(); // Khóa mềm
        return redirect()->route('brand.index');
    }

    public function status($id)
    {
        $brand = Brand::find($id);
        if ($brand == null) {
            return redirect()->route('brand.index');
        }

        $brand->status = $brand->status == 1 ? 0 : 1;
        $brand->updated_by = Auth::id();
        $brand->updated_at = now();
        $brand->save();

        return redirect()->route('brand.index');
    }

    public function restore($id)
    {
        $brand = Brand::onlyTrashed()->find($id);
        if ($brand === null) {
            return redirect()->route('brand.trash');
        }
        $brand->restore();
        return redirect()->route('brand.trash');
    }

    public function destroy($id)
    {
        $brand = Brand::onlyTrashed()->find($id);
        if ($brand === null) {
            return redirect()->route('brand.trash');
        }

      $image_path = public_path('assets/images/brand/' . $brand->thumbnail);
        if ($brand->forceDelete()) {
            if (File::exists($image_path)) {
                File::delete($image_path);
            }
        }
        return redirect()->route('brand.trash');
    }

    public function show(string $id)
    {
        $brand = Brand::find($id);
        if (!$brand) {
            return redirect()->route('brand.index')->with('error', 'Không tìm thấy thương hiệu');
        }
        return view('backend.brand.show', compact('brand'));
    }
}
