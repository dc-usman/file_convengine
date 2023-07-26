<?php

namespace App\Http\Controllers;

use Exception;
use GuzzleHttp\Client;
use Swagger\Client\Configuration;
use Illuminate\Http\Request;
use Swagger\Client\Api\MergeDocumentApi;


class MergeController extends Controller
{
    protected $randomString;

    public function __construct()
    {
        $this->randomString = substr(md5(rand()), 0, 5);

    }

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

        $output_file = "F:\dc projects\media_library\media-lib\public\storage\uploads\word_files\\" . $this->randomString . "-merge.docx";

    try {
    $result = $apiInstance->mergeDocumentDocx($input_file1, $input_file2);
    // print_r($result);
    // $result = $apiInstance->compareDocumentDocx($input_file1, $input_file2);

    $file = fopen($output_file, "wb");

    // Write the raw data into the file
    fwrite($file, $result);

    // Close the file
    fclose($file);


    } catch (Exception $e) {
    echo 'Exception when calling MergeDocumentApi->mergeDocumentDocx: ', $e->getMessage(), PHP_EOL;
    }

    }

    public function mergePdf(){
            $apiInstance = $this->MergeDocumentApi();

            $input_file1 = storage_path('app\public\uploads\AbbasZohairResume web intern.pdf');

            $input_file2 = storage_path('app\public\uploads\ANUS-CV-BSCS web intern.pdf');

            $output_file = storage_path('app\public\uploads\pdf_files\\'.$this->randomString.'-merge.pdf');

            // "F:\dc projects\media_library\media-lib\public\storage\uploads\word_files\\" . $this->randomString . "-merge.docx";
            // F:\dc projects\media_library\media-lib\public\storage\uploads\AbbasZohairResume web intern.pdf
            // F:\dc projects\media_library\media-lib\public\storage\uploads\ANUS-CV-BSCS web intern.pdf
            try{

                $result = $apiInstance->mergeDocumentPdf($input_file1,$input_file2);

                $file = fopen($output_file, "wb");

                // Write the raw data into the file
                fwrite($file, $result);

                // Close the file
                fclose($file);
    
            }catch(Exception $e){
                echo 'Exception when calling MergeDocumentApi->mergeDocumentPdf: ', $e->getMessage(), PHP_EOL;
            }

    }

}
