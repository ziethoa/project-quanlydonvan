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
                <img src="../images/newlogo2-removebg.png" alt="Miền Tây Express Logo">
                <h1>Đăng nhập tài khoản</h1>
            </div>
            <form id="loginForm">
                <div class="input-group">
                    <span class="input-icon"><i class="fa-regular fa-envelope"></i></span>
                    <input type="email" id="email" placeholder=" " required>
                    <label for="email">Địa chỉ Email</label>
                </div>
                <div class="input-group">
                    <span class="input-icon"><i class="fa-solid fa-lock"></i></span>
                    <input type="password" id="password" placeholder=" " required>
                    <label for="password">Mật khẩu</label>
                    <span class="eye-icon" id="togglePassword"><i class="fa-regular fa-eye"></i></span>
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

            setTimeout(() => {
                localStorage.setItem('isLoggedIn', 'true');

                const redirectUrl = localStorage.getItem('redirectAfterLogin');
                if (redirectUrl) {
                    localStorage.removeItem('redirectAfterLogin');
                    window.location.href = redirectUrl;
                } else {
                    window.location.href = '/';
                }
            }, 1500);
        });

        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const eyeIcon = togglePassword ? togglePassword.querySelector('i') : null;

        if (togglePassword && passwordInput && eyeIcon) {
            togglePassword.addEventListener('click', function () {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);

                if (type === 'password') {
                    eyeIcon.classList.remove('fa-eye-slash');
                    eyeIcon.classList.add('fa-eye');
                } else {
                    eyeIcon.classList.remove('fa-eye');
                    eyeIcon.classList.add('fa-eye-slash');
                }
            });
        }
    </script>
</body>

</html>