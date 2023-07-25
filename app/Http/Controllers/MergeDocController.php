<?php

namespace App\Http\Controllers;

use Exception;
use GuzzleHttp\Client;
use Swagger\Client\Configuration;
use Illuminate\Http\Request;
use Swagger\Client\Api\MergeDocumentApi;


class MergeDocController extends Controller
{
    public function ApiAuthorize(){

        $config = Configuration::getDefaultConfiguration()->setApiKey('Apikey', config('services.cloud_mersive.key'));

        return $config;

    }

    // Merge Api Key

    public function MergeDocumentApi(){
        $config = $this->ApiAuthorize();
        $apiInstance = new MergeDocumentApi(new Client(),$config);
        return $apiInstance;
    }

    public function mergeDocumentDocx(){

        $apiInstance = $this->MergeDocumentApi();

        $input_file1 = storage_path('app\public\uploads\word_files\Best Essay Writing Service Ireland.docx'); // \SplFileObject | First input file to perform the operation on.
        $input_file2 = storage_path('app\public\uploads\word_files\website changes cvwritingservice.docx'); // \SplFileObject | Second input file to perform the operation on (more than 2 can be supplied).

    try {
    $result = $apiInstance->mergeDocumentDocx($input_file1, $input_file2);
    print_r($result);
    } catch (Exception $e) {
    echo 'Exception when calling MergeDocumentApi->mergeDocumentDocx: ', $e->getMessage(), PHP_EOL;
    }

    }
}
