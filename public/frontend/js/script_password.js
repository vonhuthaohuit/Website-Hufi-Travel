
function validatePassword(password) {
    if (!password) {
        return 'Mật khẩu không được để trống.';
    }
    if (password.length < 8) {
        return 'Mật khẩu phải có ít nhất 8 ký tự.';
    }
    if (!/[A-Z]/.test(password)) {
        return 'Mật khẩu phải chứa ít nhất một chữ cái in hoa.';
    }
    if (!/[a-z]/.test(password)) {
        return 'Mật khẩu phải chứa ít nhất một chữ cái thường.';
    }
    if (!/[0-9]/.test(password)) {
        return 'Mật khẩu phải chứa ít nhất một chữ số.';
    }
    if (!/[!@#$%^&*(),.?":{}|<>]/.test(password)) {
        return 'Mật khẩu phải chứa ít nhất một ký tự đặc biệt (!@#$%^&*...).';
    }
    return null;
}

function handleFormSubmit(event, passwordSelector) {
    const passwordInput = document.querySelector(passwordSelector);
    if (!passwordInput) {
        console.error(`Không tìm thấy trường mật khẩu với selector: ${passwordSelector}`);
        return;
    }
    const password = passwordInput.value;
    const errorMessage = validatePassword(password);
    if (errorMessage) {
        toastr.error(errorMessage, 'Lỗi');
        event.preventDefault();
    }
}
