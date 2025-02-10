<?php
namespace App\Controllers;

class PageController {
    
    public function show($page) {
        $viewPath = __DIR__ . "/../Views/$page.html";

        if (file_exists($viewPath)) {
            readfile($viewPath);
        } else {
            http_response_code(404);
            echo "Page non trouvée.";
        }
    }
}