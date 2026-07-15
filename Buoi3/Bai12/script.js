document.getElementById('registerForm').addEventListener('submit', function(e) {
    let isValid = true;

    // Lấy giá trị từ các ô input
    const username = document.getElementById('username').value.trim();
    const email = document.getElementById('email').value.trim();
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirm_password').value;

    // 1. Kiểm tra Username
    if (username.length < 3 || username.length > 20) {
        document.getElementById('usernameErr').style.display = 'block';
        isValid = false;
    } else {
        document.getElementById('usernameErr').style.display = 'none';
    }

    // 2. Kiểm tra Email bằng Regex
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        document.getElementById('emailErr').style.display = 'block';
        isValid = false;
    } else {
        document.getElementById('emailErr').style.display = 'none';
    }

    // 3. Kiểm tra Mật khẩu
    if (password.length < 6) {
        document.getElementById('passwordErr').style.display = 'block';
        isValid = false;
    } else {
        document.getElementById('passwordErr').style.display = 'none';
    }

    // 4. Kiểm tra Xác nhận mật khẩu
    if (password !== confirmPassword || confirmPassword === '') {
        document.getElementById('confirmPasswordErr').style.display = 'block';
        isValid = false;
    } else {
        document.getElementById('confirmPasswordErr').style.display = 'none';
    }

    // Nếu có bất kỳ lỗi nào, ngăn không cho form submit sang PHP
    if (!isValid) {
        e.preventDefault();
    }
});