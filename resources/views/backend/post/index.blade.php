<x-layout-admin title="Danh Sách Bài Viết">
    <div class="container mx-auto p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-pink-600">Danh Sách Bài Viết</h1>
            <div class="flex gap-2">
                <a href="{{ route('post.create') }}" class="px-4 py-2 bg-green-500 hover:bg-green-600 text-white rounded shadow transition">
                    ➕ Thêm mới
                </a>
                <a href="{{ route('post.trash') }}" class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded shadow transition">
                    🗑️ Thùng rác
                </a>
            </div>
        </div>

        {{-- Thông báo --}}
        @if (session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif

        {{-- Bảng bài viết --}}
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white rounded shadow text-sm">
                <thead>
                    <tr class="bg-pink-100 text-pink-700">
                        <th class="px-4 py-2 border">ID</th>
                        <th class="px-4 py-2 border">Ảnh</th>
                        <th class="px-4 py-2 border">Tiêu đề</th>
                        <th class="px-4 py-2 border">Slug</th>
                        <th class="px-4 py-2 border">Loại</th>
                        <th class="px-4 py-2 border">Chức năng</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($list as $key => $item)
                        <tr class="hover:bg-pink-50">
                            <td class="px-4 py-2 border text-center">{{ $list->firstItem() + $key }}</td>
                            <td class="px-4 py-2 border text-center">
                         <!-- ảnh -->
                            <div class="w-full flex justify-center">
    <img 
        src="{{ asset('asset/image/post/' . $item->thumbnail) }}" 
        class="rounded-xl shadow-md w-20 h-20 object-cover"
    >
</div>

<!--  -->
                            <td class="px-4 py-2 border">{{ $item->title }}</td>
                            <td class="px-4 py-2 border">{{ $item->slug }}</td>
                            <td class="px-4 py-2 border">{{ $item->type }}</td>
                            <td class="px-4 py-2 border text-center space-x-2">
                                {{-- Nút bật/tắt --}}
                                <a href="{{ route('post.status', $item->id) }}"
                                   class="inline-flex items-center justify-center w-16 h-8 rounded-full
                                   {{ $item->status == 1 ? 'bg-green-500 hover:bg-green-600' : 'bg-red-500 hover:bg-red-600' }}
                                   text-white font-semibold transition">
                                    {{ $item->status == 1 ? 'Bật' : 'Tắt' }}
                                </a>

                                {{-- Nút sửa --}}
                                <a href="{{ route('post.edit', $item->id) }}"
                                   class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-blue-500 hover:bg-blue-600 text-white transition">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <a href="{{ route('post.delete', $item->id)}}" class="text-[rgb(246,81,119)] px-2 py-2 rounded-xl mx-1 font-semibold hover:text-[rgb(244,8,8)]">
                        <i class="fa fa-trash"></i>
                    </a>
                                <a href="{{ route('post.show', ['post' => $item->id]) }}">
                                <i class="fa fa-eye text-2xl text-gray-600"></i>
                            </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $list->links('pagination::tailwind') }}
        </div>
    </div>
</x-layout-admin>
