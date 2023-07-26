<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Swagger\Client\Configuration;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function ApiAuthorize(){
        $config = Configuration::getDefaultConfiguration()->setApiKey('ApiKey', config('services.cloud_mersive.key') );

        return $config;
    }
}
