<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Topic;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateTopicRequest;

class TopicController extends Controller
{
    public function index()
    {
        $list = Topic::select('id', 'name', 'slug', 'description', 'status')
            ->orderBy('created_at', 'desc')
            ->paginate(5);
        return view('backend.topic.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.topic.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'slug' => 'nullable|string|max:255|unique:topic,slug',
    ]);

    $topic = new Topic();
    $topic->name = $request->name;
    $topic->slug = $request->slug ?: Str::slug($request->name);
    $topic->created_by = Auth::id() ?? 1; // Dùng Auth thay vì auth() để tránh IDE warning
    $topic->status = $request->status ?? 1;
    $topic->save();

    return redirect()->route('topic.index')->with('success', 'Thêm chủ đề thành công!');
}



    /**
     * Display the specified resource.
     */
    public function edit(string $id)
    {
        $topic = Topic::find($id);
        if (!$topic) {
            return redirect()->route('topic.index')->with('error', 'Không tìm thấy chủ đề');
        }
        return view('backend.topic.edit', compact('topic'));
    }

    public function update(UpdateTopicRequest $request, string $id)
{
    $topic = Topic::find($id);
    if (!$topic) {
        return redirect()->route('topic.index');
    }

    $topic->name = $request->name;
    $topic->slug = Str::slug($request->name);
    $topic->status = $request->status;
    $topic->updated_by = Auth::id();
    $topic->updated_at = now();
    $topic->save();

    return redirect()->route('topic.index')->with('thongbao', 'Cập nhật thành công');
}



    public function trash()
    {
        $list = Topic::onlyTrashed()
            ->orderBy('created_at', 'desc')
            ->paginate(5);
    
        return view('backend.topic.trash', compact('list'));
    }
    
    public function delete($id)
    {
        $topic = Topic::find($id);
        if ($topic === null) {
            return redirect()->route('topic.index');
        }
        $topic->delete(); // Soft delete (xóa mềm)
        return redirect()->route('topic.index');
    }
    
    public function status($id)
    {
        $topic = Topic::find($id);
        if ($topic == null) {
            return redirect()->route('topic.index');
        }
    
        $topic->status = ($topic->status == 1) ? 0 : 1;
        $topic->updated_at = now();
        $topic->updated_by = Auth::id();
        $topic->save();
    
        return redirect()->route('topic.index');
    }
    
    public function restore($id)
    {
        $topic = Topic::onlyTrashed()->find($id);
        if ($topic === null) {
            return redirect()->route('topic.trash');
        }
        $topic->restore();
        return redirect()->route('topic.trash');
    }
    
    public function destroy(string $id)
    {
        $topic = Topic::onlyTrashed()->find($id);
        if ($topic === null) {
            return redirect()->route('topic.trash');
        }
    
        $topic->forceDelete(); // Xóa vĩnh viễn
        return redirect()->route('topic.trash');
    }
    
    public function show($id)
    {
        $topic = Topic::findOrFail($id);
    
        return view('backend.topic.show', compact('topic'));
    }
    
    
    
}

