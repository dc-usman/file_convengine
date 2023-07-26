<?php

namespace App\Http\Controllers;

use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Swagger\Client\Api\SplitDocumentApi;

class SplitController extends Controller
{
    public function SplitDocumentApi()
    {
        $config = $this->ApiAuthorize();
        $apiInstance = new SplitDocumentApi(new Client(), $config);
        return $apiInstance;
    }

    public function SplitDocumentDocx()
    {
        $apiInstance = $this->SplitDocumentApi();

        // dd($apiInstance);

        $input_file = storage_path('app\public\uploads\word_files\c386f-compare.docx'); // \SplFileObject | Input file to perform the operation on.
        $return_document_contents = true;

        try {
            $result = $apiInstance->splitDocumentDocx($input_file, $return_document_contents);
            print_r($result);
        } catch (Exception $e) {
            echo 'Exception when calling SplitDocumentApi->splitDocumentDocx: ', $e->getMessage(), PHP_EOL;
        }
    }

    // public function SplitDocument(){

    //     // return redirect()->route('split.res');
    //     return view('pages.split');
    // }


    public function SplitDocumentPdf()
    {
        $apiInstance = $this->SplitDocumentApi();

        $input_file = storage_path('app\public\uploads\Proposed Structure for GMSM Ulster modified - Tagged_watermark.pdf'); // \SplFileObject | Input file to perform the operation on.
        
        $return_document_contents = true; // bool | Set to true to directly return all of the document contents in the DocumentContents field; set to false to return contents as temporary URLs (more efficient for large operations).  Default is false.

        try {
            $result = $apiInstance->splitDocumentPdfByPage($input_file, $return_document_contents);
            print_r($result);
        } catch (Exception $e) {
            echo 'Exception when calling SplitDocumentApi->splitDocumentPdfByPage: ', $e->getMessage(), PHP_EOL;
        }
    }
}
