<?
//     if (session_id() === '') session_start();
// // Phuong thuc tu dong load cac class tuong ung
//     spl_autoload_register(
//         function($className) {
//         $dirRoot = dirname(__DIR__);
//             $fileName = strtolower($className) . "php";
//             require $dirRoot . "/clases/{$fileName}";
//         }
//     );
//     require dirname(__DIR__) . "/config.php";
?>
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
?>