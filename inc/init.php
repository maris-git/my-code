<?
    // Khởi tạo session
    if (session_id() === '') session_start();
    
    // Phương thức tự động load các class tương ứng
    spl_autoload_register(
        function($className) {
            $dirRoot = dirname(__DIR__);
            $fileName = strtolower($className) . ".php";
            require $dirRoot . "/classes/{$fileName}";
        }
    );
    // Gọi tập tin config
    require dirname(__DIR__) . "/config.php";

    // Quản lí lỗi và exception
    
    // hàm quản lý lỗi
    function errorHandler($level, $message, $file, $line) {
        throw new errorException($message, 0, $level, $file, $line);
    }
    // Ham quan ly exception
    function exceptionHandler($ex) {
        if (DEBUG) {
            echo "<h2>Lỗi</h2>";
            echo "<p>Exception: " . get_class($ex) . "</p>";
            echo "<p>Nội dung: " . $ex->getMessage() . "</p>";
            echo "<p>Tệp tin: " . $ex->getFile() . " dòng thứ: " . $ex->getLine() . "</p>";
        } else {
            echo "<h2>Lỗi. Vui lòng thử lại</h2>";
            // sau này sẽ gọi trang 404 ở đây
        }
        exit();
    }
    // Đăng ký với PHP
    set_error_handler('errorHandler');
    set_exception_handler('exceptionHandler');
?>