<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
class MenuController extends Controller
{
    public function index()
    {
        $list = Menu::select('id', 'name', 'link', 'parent_id', 'sort_order', 'type', 'position','status')
            ->orderBy('sort_order', 'asc')
            ->paginate(5);
        return view('backend.menu.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $menus = Menu::where('parent_id', 0)->get(); // Để hiển thị danh sách menu cha
        return view('backend.menu.create', compact('menus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'link' => 'nullable|string|max:255',
            'parent_id' => 'nullable|integer',
            'sort_order' => 'nullable|integer', // sửa lại tên đúng
            'type' => 'nullable|in:category,brand,page,topic,custom',
            'position' => 'nullable|in:mainmenu,footer',
        ]);
    
        $menu = new Menu();
        $menu->name = $request->name;
        $menu->link = $request->link ?? '';
        $menu->parent_id = $request->parent_id ?? 0;
        $menu->sort_order = $request->sort_order ?? 0;
        $menu->type = $request->type ?? 'custom';
        $menu->position = $request->position ?? 'mainmenu';
        $menu->created_by = Auth::id() ?? 1;
        $menu->status = $request->status ?? 1;
        $menu->save();
    
        return redirect()->route('menu.index')->with('success', 'Thêm menu thành công!');
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $menu = Menu::find($id);
        $menus = Menu::where('id', '!=', $id)
            ->orderBy('name', 'asc')
            ->get();
    
        return view('backend.menu.edit', compact('menu', 'menus'));
    }
    
    public function update(Request $request, string $id)
{
    $menu = Menu::find($id);
    if (!$menu) {
        return redirect()->route('menu.index');
    }


    $menu->name = $request->name;
 
    $menu->position = $request->position;
    $menu->parent_id = $request->parent_id;
    $menu->link = $request->link;
    $menu->status = $request->status;
    $menu->updated_by = Auth::id() ?? 1;
    $menu->updated_at = now();
    $menu->save();

    return redirect()->route('menu.index')->with('thongbao', 'Cập nhật menu thành công');
}

public function trash()
{
    $list = Menu::onlyTrashed()
        ->orderBy('created_at', 'desc')
        ->paginate(5);
    return view('backend.menu.trash', compact('list'));
}

public function delete($id)
{
    $menu = Menu::find($id);
    if (!$menu) {
        return redirect()->route('menu.index');
    }
    $menu->delete(); // Soft delete
    return redirect()->route('menu.index')->with('thongbao', 'Đã chuyển vào thùng rác');
}

public function status($id)
{
    $menu = Menu::find($id);
    if ($menu === null) {
        return redirect()->route('menu.index');
    }

    $menu->status = ($menu->status == 1) ? 0 : 1;
    $menu->updated_at = now();
    $menu->updated_by = Auth::id() ?? 1;
    $menu->save();

    return redirect()->route('menu.index');
}
public function restore($id)
{
    $menu = Menu::onlyTrashed()->find($id);
    if (!$menu) {
        return redirect()->route('menu.trash');
    }
    $menu->restore();
    return redirect()->route('menu.trash')->with('thongbao', 'Khôi phục menu thành công');
}

public function destroy(string $id)
{
    $menu = Menu::onlyTrashed()->find($id);
    if (!$menu) {
        return redirect()->route('menu.trash');
    }
    $menu->forceDelete(); // Xóa vĩnh viễn
    return redirect()->route('menu.trash')->with('thongbao', 'Xóa vĩnh viễn menu thành công');
}

public function show($id)
{
    $menu = Menu::findOrFail($id);
    return view('backend.menu.show', compact('menu'));
}

}
