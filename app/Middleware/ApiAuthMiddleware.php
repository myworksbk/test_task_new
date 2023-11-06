<?php

namespace App\Middleware;

class ApiAuthMiddleware
{
    public function handle()
    {
        // Please provide a some auth logic
        
        $isValidToken = true;

        if (!$isValidToken) {
            $this->responseUnauthorized();
        }
    }

    private function responseUnauthorized(): void
    {
        http_response_code(401);

        echo "Unauthorized";
        
        exit();
    }
}
