<?
    $plaintext_password = 'abc123';
    
    // Tạo mã hash cho mật khẩu
    $hashed_password = password_hash($plaintext_password, PASSWORD_DEFAULT);
    
    // In mã hash ra màn hình
    echo "Mã hash: " . $hashed_password;
?>