<?php

namespace App\Middleware;

class CORSMiddleware
{
    public function handle()
    {
    	header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Headers: *');
            
        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
            header('Access-Control-Allow-Methods: GET, POST, OPTIONS');

            exit(0);
        }
    }
}
