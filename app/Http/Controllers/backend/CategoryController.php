<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index()
    {
        $list = Category::select('id', 'name', 'slug', 'image', 'status')
            ->orderBy('created_at', 'desc')
            ->paginate(5);
        return view('backend.category.index', compact('list'));
    }

    public function create()
    {
        $list_category = Category::select('id', 'name')->orderBy('sort_order', 'asc')->get();
        return view('backend.category.create', compact('list_category'));
    }

   public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'slug' => 'nullable|string|max:255|unique:category,slug',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // ✅ Thêm validate ảnh
    ]);

    $category = new Category();
    $category->name = $request->name;
    $category->slug = Str::slug($request->name);
    $category->description = $request->description;
    $category->status = $request->status ?? 1;
    $category->parent_id = $request->parent_id ?? 0;
    $category->sort_order = $request->sort_order ?? 0;
    $category->created_by = Auth::id() ?? 1;

    // ✅ Xử lý upload ảnh
    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('assets/images/category'), $filename);
        $category->image = $filename;
    }

    $category->save();

    return redirect()->route('category.index')->with('success', 'Thêm danh mục thành công!');
}

    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        $list_parent = Category::where('id', '!=', $id)->get();
        return view('backend.category.edit', compact('category', 'list_parent'));
    }

    public function update(Request $request, string $id)
    {
        $category = Category::find($id);
        if (!$category) {
            return redirect()->route('category.index');
        }

        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->description = $request->description;
        $category->parent_id = $request->parent_id ?? 0;
        $category->sort_order = $request->sort_order ?? 0;
        $category->status = $request->status;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('assets/images/category'), $filename);
            $category->image = 'assets/images/category/' . $filename;
        }

        $category->save();
        return redirect()->route('category.index')->with('success', 'Cập nhật danh mục thành công!');
    }

    public function delete($id)
    {
        $category = Category::find($id);
        if ($category) {
            $category->delete();
        }
        return redirect()->route('category.index');
    }

    public function restore($id)
    {
        $category = Category::onlyTrashed()->find($id);
        if ($category) {
            $category->restore();
        }
        return redirect()->route('category.trash');
    }

    public function destroy($id)
    {
        $category = Category::onlyTrashed()->find($id);
        if ($category) {
            $category->forceDelete();
        }
        return redirect()->route('category.trash');
    }

    public function status($id)
    {
        $category = Category::find($id);
        if ($category) {
            $category->status = !$category->status;
            $category->save();
        }
        return redirect()->route('category.index');
    }


public function trash()
    {
        $list = Category::onlyTrashed()
            ->select('id', 'name', 'status', 'sort_order', 'parent_id')
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        return view('backend.category.trash', compact('list'));
    }





    public function show($id)
    {
        $category = Category::findOrFail($id);
        return view('backend.category.show', compact('category'));
    }
}
