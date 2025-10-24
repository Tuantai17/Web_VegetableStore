<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::select('id', 'user_id', 'name', 'email', 'phone', 'title', 'content', 'reply_id', 'reply_content', 'status')
            ->orderBy('created_at', 'desc')
            ->paginate(5);
    
        return view('backend.contact.index', compact('contacts'));
    }
    
    

   
    public function edit(string $id)
    {
        $contact = Contact::findOrFail($id);
        return view('backend.contact.edit', compact('contact'));
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $contact = Contact::findOrFail($id);
    
        $contact->update($request->only(['name', 'email', 'phone', 'message'])); // tuỳ thuộc vào cột bạn có
    
        return redirect()->route('contact.index')->with('success', 'Cập nhật thành công!');
    }
    public function status($id)
{
    $contact = Contact::findOrFail($id);
    $contact->status = $contact->status == 1 ? 0 : 1;
    $contact->save();

    return redirect()->route('contact.index')->with('success', 'Cập nhật trạng thái thành công!');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete(); // hoặc softDelete tùy logic
        return redirect()->route('contact.index')->with('success', 'Xóa thành công!');
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function create()
    {
        return view('contact.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'title' => 'required|string|max:255', // CHÚ Ý: bạn validate 'title' chứ không phải 'subject'
            'content' => 'required|string',       // CHÚ Ý: bạn validate 'content' chứ không phải 'message'
        ]);
    
        Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone ?? null,    // nếu có phone thì lấy, không thì null
            'title' => $request->title,
            'content' => $request->content,
            'status' => 0,
            'reply_id' => 0,
            'created_by' => auth()->id() ?? 0,     // QUAN TRỌNG: thêm dòng này
        ]);
    
        return redirect()->route('contact.index')->with('success', 'Gửi liên hệ thành công.');
    }
    
    public function trash()
    {
        $list = Contact::onlyTrashed()
            ->orderBy('deleted_at', 'desc')
            ->paginate(5);

        return view('backend.contact.trash', compact('list'));
    }
    
    /*delete---------------------------------------------------------*/

    public function delete($id)
    {
        $brand = Contact::find($id);
        if ($brand === null) {
            return redirect()->route('contact.index');
        }
        $brand->delete(); // Khóa mềm
        return redirect()->route('contact.index');
    }
  

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $contact = Contact::findOrFail($id);
        return view('backend.contact.show', compact('contact'));
    }
    
    
    // public function delete($id)
    // {
    //     $contact = Contact::withTrashed()->findOrFail($id);
    //     $contact->forceDelete();
    
    //     return redirect()->route('contact.trash')->with('success', 'Xóa vĩnh viễn liên hệ thành công!');
    // }
    



// Hiển thị form trả lời
// XÓA:

// Xử lý lưu trả lời
public function replySave(Request $request, $id)
{
    $contact = Contact::findOrFail($id);
    $contact->reply_content = $request->reply_content;
    $contact->reply_id = auth()->id(); // người trả lời (admin đang login)
    $contact->status = 1; // ví dụ: 1 = đã trả lời
    $contact->save();
    $list = Contact::with('reply')->whereNull('reply_id')->paginate(10);

    return redirect()->route('contact.index')->with('success', 'Đã trả lời liên hệ thành công.');
}

// Hiển thị form trả lời
public function reply(Request $request, $id)
{
    $contact = Contact::findOrFail($id);
    $contact->reply_content = $request->reply_content;
    $contact->reply_id = auth()->id(); // ID của người trả lời
    $contact->save();

    return redirect()->back()->with('success', 'Đã trả lời liên hệ thành công.');
}

}
