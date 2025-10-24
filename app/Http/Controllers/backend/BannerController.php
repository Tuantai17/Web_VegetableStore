<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class BannerController extends Controller
{
    public function index()
    {
        $list = Banner::orderBy('created_at', 'desc', 'image')->paginate(6);
        return view('backend.banner.index', compact('list'));
    }





    
    public function create()
    {
        return view('backend.banner.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'position' => 'nullable|string|max:255',
        ]);

        $banner = new Banner();
        $banner->name = $request->name;
        $banner->position = $request->position;
        $banner->sort_order = $request->sort_order ?? 1;
        $banner->created_by = Auth::id() ?? 1;
        $banner->status = 1;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '-' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('image', $filename, 'public');
            $banner->image = $path;
        }

        $banner->save();
        return redirect()->route('banner.index')->with('success', 'Thêm banner thành công!');
    }

    public function edit($id)
    {
        $banner = Banner::findOrFail($id);
        return view('backend.banner.edit', compact('banner'));
    }

    public function update(Request $request, $id)
{
    $banner = Banner::findOrFail($id);

    $banner->name = $request->name;
    // Ép kiểu position thành chuỗi trước khi lưu vào database
    $banner->position = (string) $request->position;
    $banner->sort_order = $request->sort_order ?? 1;
    $banner->updated_by = Auth::id();

    if ($request->hasFile('image')) {
        if ($banner->image && File::exists(public_path('storage/' . $banner->image))) {
            File::delete(public_path('storage/' . $banner->image));
        }

        $file = $request->file('image');
        $filename = Str::slug($request->name) . '-' . time() . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('image', $filename, 'public');
        $banner->image = $path;
    }

    $banner->status = $request->status ?? 1;
    $banner->save();

    return redirect()->route('banner.index')->with('success', 'Cập nhật banner thành công!');
}




    public function status($id)
    {
        $banner = Banner::findOrFail($id);
        $banner->status = $banner->status == 1 ? 0 : 1;
        $banner->updated_by = Auth::id();
        $banner->save();

        return redirect()->route('banner.index')->with('success', 'Đã cập nhật trạng thái.');
    }

    public function delete($id)
    {
        $banner = Banner::findOrFail($id);
        $banner->delete();

        return redirect()->route('banner.index')->with('success', 'Đã chuyển vào thùng rác.');
    }

    public function trash()
    {
        $list = Banner::onlyTrashed()->orderBy('created_at', 'desc')->paginate(10);
        return view('backend.banner.trash', compact('list'));
    }

    public function restore($id)
    {
        $banner = Banner::onlyTrashed()->findOrFail($id);
        $banner->restore();

        return redirect()->route('banner.trash')->with('success', 'Khôi phục thành công.');
    }

    public function destroy($id)
    {
        $banner = Banner::onlyTrashed()->findOrFail($id);

        if ($banner->image && File::exists(public_path('storage/' . $banner->image))) {
            File::delete(public_path('storage/' . $banner->image));
        }

        $banner->forceDelete();

        return redirect()->route('banner.trash')->with('success', 'Đã xóa vĩnh viễn.');
    }

    public function show($id)
{
    $banner = Banner::findOrFail($id);
    return view('backend.banner.show', compact('banner'));
}

}
