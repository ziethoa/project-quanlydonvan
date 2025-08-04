<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập Chuyên Nghiệp - Minh Khôi Logistics</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/login.css">
</head>

<body>
    <div class="login-container">
        <div class="login-box">
            <div class="logo">
                <img src="{{ asset('images/newlogo2-removebg.png') }}" alt="Miền Tây Express Logo">
                <h1>Đăng nhập tài khoản</h1>
            </div>
            <form id="loginForm" method="POST" action="{{ route('login') }}">
                @csrf
                <div class="input-group">
                    <span class="input-icon"><i class="fa-regular fa-envelope"></i></span>
                    <input type="email" name="email" id="email" placeholder=" " value="{{ old('email') }}" required>
                    <label for="email">Địa chỉ Email</label>
                    @error('email')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                    <span class="error-message" style="color: red; display: none; position: absolute;"></span>
                </div>
                <div class="input-group">
                    <span class="input-icon"><i class="fa-solid fa-lock"></i></span>
                    <input type="password" name="password" id="password" placeholder=" " required>
                    <label for="password">Mật khẩu</label>
                    <span class="eye-icon" id="togglePassword"><i class="fa-regular fa-eye"></i></span>
                </div>
                <div>
                    <label for="remember">
                        <input type="checkbox" id="remember" name="remember"> Ghi nhớ tôi
                    </label>
                </div>
                <a href="#" class="forgot-password">Quên mật khẩu?</a>
                <button type="submit" class="login-btn">
                    <span>Đăng nhập</span>
                    <i class="fas fa-arrow-right"></i>
                </button>
            </form>
            <div class="info">
                <p>Bằng việc đăng nhập, bạn đồng ý với <a href="#">Điều khoản</a> & <a href="#">Chính sách</a>.</p>
            </div>
            <div class="separator">
                <span>Hoặc đăng nhập với</span>
            </div>
            <div class="social-links">
                <a href="#" class="social-icon facebook" aria-label="Đăng nhập bằng Facebook">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="#" class="social-icon line" aria-label="Đăng nhập bằng Line">
                    <i class="fab fa-line"></i>
                </a>
            </div>
            <div class="footer">
                <p>Trao uy tín - Nhận thành công</p>
                <p class="copyright">© 2025 Minh Khôi Logistics. All rights reserved.</p>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('loginForm').addEventListener('submit', function (event) {
            event.preventDefault();
            const button = this.querySelector('.login-btn');
            button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Đang xử lý...';
            button.disabled = true;

            const formData = new FormData(this);

            fetch('{{ route('login') }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                button.innerHTML = '<span>Đăng nhập</span><i class="fas fa-arrow-right"></i>';
                button.disabled = false;

                if (data.success) {
                    localStorage.setItem('isLoggedIn', 'true');
                    window.location.href = data.redirect;
                } else {
                    // const errorContainer = document.querySelector('.input-group input[name="email"]').parentElement;
                    // let errorElement = errorContainer.querySelector('span');
                    // if (!errorElement) {
                    //     errorElement = document.createElement('span');
                    //     errorElement.style.color = 'red';
                    //     errorContainer.appendChild(errorElement);
                    // }
                    // errorElement.textContent = data.errors.email[0];

                    const emailInput = document.querySelector('input[name="email"]');
                    const passwordInput = document.querySelector('input[name="password"]');
                    const errorContainer = emailInput.parentElement;
                    const errorElement = errorContainer.querySelector('.error-message');

                    // Reset password field
                    passwordInput.value = '';

                    // Show error message
                    errorElement.style.display = 'block';
                    errorElement.textContent = 'Email hoặc mật khẩu sai';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                button.innerHTML = '<span>Đăng nhập</span><i class="fas fa-arrow-right"></i>';
                button.disabled = false;

                const emailInput = document.querySelector('input[name="email"]');
                const passwordInput = document.querySelector('input[name="password"]');
                const errorContainer = emailInput.parentElement;
                const errorElement = errorContainer.querySelector('.error-message');

                // Reset password field
                passwordInput.value = '';

                // Show error message
                errorElement.style.display = 'block';
                errorElement.textContent = 'Email hoặc mật khẩu sai';
            });
        });

        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const eyeIcon = togglePassword ? togglePassword.querySelector('i') : null;

        if (togglePassword && passwordInput && eyeIcon) {
            togglePassword.addEventListener('click', function () {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                eyeIcon.classList.toggle('fa-eye', type === 'password');
                eyeIcon.classList.toggle('fa-eye-slash', type !== 'password');
            });
        }
    </script>
</body>

</html>