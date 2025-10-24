<x-layout-site>
    <x-slot:title>Đăng ký</x-slot:title>

    <style>
        .register-container {
            max-width: 450px;
            margin: 50px auto;
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
            padding: 30px;
            font-family: 'Segoe UI', sans-serif;
        }

        .register-title {
            font-size: 28px;
            font-weight: 700;
            text-align: center;
            margin-bottom: 25px;
            color: #333;
        }

        .input-field {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 10px;
            font-size: 15px;
            transition: all 0.3s ease;
        }

        .input-field:focus {
            border-color: #4CAF50;
            box-shadow: 0 0 5px rgba(76, 175, 80, 0.4);
            outline: none;
        }

        .register-btn {
            width: 100%;
            padding: 14px;
            background: linear-gradient(45deg, #22c55e, #16a34a);
            color: white;
            font-size: 16px;
            font-weight: 600;
            border-radius: 12px;
            border: none;
            cursor: pointer;
            transition: all 0.3s;
        }

        .register-btn:hover {
            background: linear-gradient(45deg, #16a34a, #15803d);
            transform: translateY(-2px);
        }

        .alert-box {
            padding: 12px;
            border-radius: 10px;
            margin-bottom: 15px;
            font-size: 14px;
        }

        .alert-error {
            background: #fee2e2;
            color: #b91c1c;
            border: 1px solid #fca5a5;
        }

        .alert-success {
            background: #dcfce7;
            color: #166534;
            border: 1px solid #86efac;
        }

        .form-group {
            margin-bottom: 18px;
        }
    </style>

    <main class="register-container">
        <h2 class="register-title">Đăng ký tài khoản</h2>

        @if (session('error'))
            <div class="alert-box alert-error">
                {{ session('error') }}
            </div>
        @endif

        @if (session('success'))
            <div class="alert-box alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('user.register') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <input type="text" name="name" placeholder="Họ và tên" class="input-field" required>
            </div>

            <div class="form-group">
                <input type="text" name="username" placeholder="Tên đăng nhập" class="input-field" required>
            </div>

            <div class="form-group">
                <input type="email" name="email" placeholder="Email" class="input-field" required>
            </div>

            <div class="form-group">
                <input type="password" name="password" placeholder="Mật khẩu" class="input-field" required>
            </div>

            <div class="form-group">
                <input type="password" name="password_confirmation" placeholder="Nhập lại mật khẩu" class="input-field" required>
            </div>

            <div class="form-group">
                <input type="text" name="phone" placeholder="Số điện thoại" class="input-field" required>
            </div>

            <div class="form-group">
                <input type="text" name="address" placeholder="Địa chỉ" class="input-field" required>
            </div>

            <div class="form-group">
                <input type="file" name="avatar" class="input-field" accept="image/*" required>
            </div>

            <button type="submit" class="register-btn">Đăng ký</button>
        </form>
    </main>
</x-layout-site>
