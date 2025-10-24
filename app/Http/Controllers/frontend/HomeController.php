<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Menu;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Brand;

use Illuminate\Support\Facades\Auth;

use App\Models\Topic;

class HomeController extends Controller
{
    // Hàm khởi tạo dùng chung menu cho tất cả action
    private $menu_list = [];

    public function __construct()
    {
        $this->menu_list = [
            ['title' => 'Home', 'url' => url('/')],
            ['title' => 'About', 'url' => url('/about')],
            ['title' => 'Product', 'url' => url('/san-pham')],
            ['title' => 'Contact', 'url' => url('/lien-he')],
            ['title' => 'Register', 'url' => url('/register')],
            ['title' => 'Post', 'url' => url('/post')],

        ];
        $menuParents = Menu::where('parent_id', 0)->orderBy('sort_order')->get();
return view('frontend.home', compact('menuParents'));

    }

    // Trang Chủ
    public function index()
{
    $categories = Category::where('parent_id', 3)->where('status', 1)->get(); // Ví dụ lấy danh mục con nổi bật
    $posts = Post::latest()->take(1)->get();
    $topics = Topic::latest()->take(1)->get();

    return view('frontend.home', compact('categories', 'posts', 'topics'));
}

    // Trang đăng nhập
    public function login()
    {
        return view('frontend.login', [
            'menu_list' => $this->menu_list
        ]);
    }

    // Trang đăng ký
    public function register()
    {
        return view('frontend.register', [
            'menu_list' => $this->menu_list
        ]);
    }

    // Trang giới thiệu
    public function about()
    {
        return view('frontend.about', [
            'menu_list' => $this->menu_list
        ]);
    }

    // Trang mới
    public function newpage()
    {
        return view('frontend.newpage', [
            'menu_list' => $this->menu_list
        ]);
    }


    //lấy tất cả bài vết
    public function allPosts()
    {
        $posts = Post::latest()->paginate(6); // lấy mới nhất và phân trang
        return view('frontend.post-all', compact('posts'));
    }
    

// chi tiết bài viết
public function detail($slug)
{
    $post = Post::where('slug', $slug)->firstOrFail();

    // Bài viết khác cùng chủ đề
    $relatedPosts = Post::where('topic_id', $post->topic_id)
                        ->where('id', '!=', $post->id)
                        ->take(3)
                        ->get();

    return view('frontend.post-detail', compact('post', 'relatedPosts'));
}

public function submitContact(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'phone' => 'required|string|max:255',
        'title' => 'required|string|max:1000',
        'content' => 'required|string',
    ]);

    Contact::create([
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'title' => $request->title,
        'content' => $request->content,
        'reply_id' => 0,
        'created_by' => 0, // 👈 bắt buộc có, thay bằng auth()->id() nếu dùng đăng nhập
        'status' => 0,
    ]);

    return redirect()->back()->with('success', 'Cảm ơn bạn đã liên hệ với chúng tôi!');
}


public function showContactForm()
{
    return view('frontend.contact'); // thay tên view nếu bạn dùng tên khác
}


public function contact()
{
    return view('frontend.contact'); // thay bằng đúng tên view của bạn
}
// tìm kiếm
public function searchProduct(Request $request)
{
    $keyword = $request->input('keyword');

    $products = Product::where('name', 'like', "%$keyword%")
        ->orWhere('description', 'like', "%$keyword%")
        ->get();

    return view('frontend.search', compact('products', 'keyword'));
}


// taaif khoan
public function accountInfo()
{
    $user = Auth::user();
    return view('frontend.account', compact('user'));
}
public function updateAccount(Request $request)
{
    $user = Auth::user();

    if ($request->hasFile('avatar')) {
        $path = $request->file('avatar')->store('avatars', 'public');
        $user->avatar = $path;
    }

    // Nếu bạn có thêm các input như name, phone,...
    $user->name = $request->input('name');
    $user->phone = $request->input('phone');
    // ...

    $user->save();

    return redirect()->route('user.account')->with('success', 'Cập nhật tài khoản thành công!');
}
public function byCategory($slug)
{
    $category = Category::where('slug', $slug)->firstOrFail();

    $products = Product::where('category_id', $category->id)
                ->where('status', 1)
                ->paginate(12);

    $brand = Brand::whereHas('products', function($query) use ($category) {
        $query->where('category_id', $category->id)
              ->where('status', 1);
    })->get();

    $category_list = Category::where('parent_id', $category->id)->get();

    return view('frontend.by-category', compact('category', 'products', 'brand', 'category_list', 'category_slug'));
}

//------ bài viết mới

}
