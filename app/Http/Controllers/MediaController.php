<?php

namespace App\Http\Controllers;

use App\Models\Smlprod;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Settings;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\PdfToText\Pdf;
use Spatie\PdfToImage\Pdf as ImgExt;
use Swagger\Client\Api\CompareDocumentApi;
use Swagger\Client\Api\EmailApi;
use Swagger\Client\Configuration;
use Swagger\Client\Api\ConvertDocumentApi;
use TCPDF;

class MediaController extends Controller
{
    protected $randomString;

    public function __construct()
    {
        $this->randomString =  substr(md5(rand()), 0, 5);

    }

    public function index()
    {
        $pds = Smlprod::all();

        return view('pages.home', compact('pds'));
    }

    public function store(Request $request)
    {

        $pd = Smlprod::create($request->all());
        $pd->addMediaFromRequest('file')->toMediaCollection();
        // $pd->registeredMediaConversions('file');

        // dd($pd->getPath());
    }

    public  function wordtoPdfForm()
    {

        return view('pages.wtpForm');
    }

    public function wordtoPdfConv(Request $request)
    {

        $file = $request->file('file');
        $fileName = $file->getClientOriginalName();
        $filePath = $file->storeAs('uploads', $fileName, 'public');

        $wordFilePath = 'F:\dc projects\media_library\media-lib\public\storage\uploads\\' . $fileName;

        // dd($wordFilePath);

        $downloadLink =  $this->convertToPdf($wordFilePath);

        return redirect()->back()->with(['dlink' => $downloadLink]);
    }


    public function convertToPdf($wordFilePath)
    {



        // dd($wordFilePath);
        // Set PDF renderer path
        Settings::setPdfRendererPath('F:\dc projects\media_library\media-lib\vendor\tecnickcom\tcpdf');


        // Set PDF renderer name
        Settings::setPdfRendererName('TCPDF');

        // Load the Word file
        $phpWord = IOFactory::load($wordFilePath);



        // Save the Word file as PDF
        // $phpWord->save('..\..\..\storage\app\public\uploads\file.pdf', 'PDF');

        $phpWord->save('F:\dc projects\media_library\media-lib\public\storage\uploads\\' . $this->randomString . '.pdf', 'PDF');

        $downloadLink = asset('storage/uploads/' . $this->randomString . '.pdf');

        // dd($downloadLink);
        // dd('Word file has converted to PDF');
        return  $downloadLink;
    }

    public function pdftoWordForm()
    {
        return view('pages.ptwForm');
    }


    public function pdftoWordConv(Request $request)
    {
        $file = $request->file('file');
        $fileName = $file->getClientOriginalName();
        $filePath = $file->storeAs('uploads', $fileName, 'public');

        $pdfFilePath = 'F:\dc projects\media_library\media-lib\public\storage\uploads\\' . $fileName;

        $downloadLink = $this->converttoWord($pdfFilePath);

        // return $downloadLink;
        // dd($downloadLink);
        return redirect()->back()->with(['dlink' => $downloadLink]);
    }


    public function converttoWord($filePath)
    {

        // $randomString = substr(md5(rand()), 0, 5);

        // require_once('tcpdf/tcpdf.php');

        /*-------------applying tcpdf package to extract images------------------*/
        // $pdfFile = 'F:\dc projects\media_library\media-lib\public\storage\uploads\h_cv.pdf';

        //         $pdf = new TCPDF();

        // // Set the path to your PDF file
        // $pdfFile = 'path/to/your/pdf/file.pdf';

        // // Read the PDF file
        // $pdf->setSourceFile($pdfFile);

        // // Get the total number of pages in the PDF
        // $totalPages = $pdf->getNumPages();

        // // Loop through each page
        // for ($page = 1; $page <= $totalPages; $page++) {
        //     // Select the current page
        //     $pdf->setPage($page);

        //     // Get the image data for the current page
        //     $imageData = $pdf->getImageData();

        //     // Save the image to a file
        //     $imageFile = 'path/to/output/directory/image_' . $page . '.jpg';
        //     file_put_contents($imageFile, $imageData);

        //     // Display the path of the extracted image
        //     echo $imageFile . "\n";
        // }

        /*----------------------------------------------*/


        /*----------- Extracting image via spatie-media-image extractor needs imagick extention -------*/
        // $pdf = new ImgExt($filename);

        // $pdf = new Pdf('path/to/your/pdf/file.pdf');

        // Set the output directory where the extracted images will be saved
        // $pdf->setOutputDirec('F:\dc projects\media_library\media-lib\public\storage\uploads');

        // Set the desired format of the extracted images (e.g., jpg, png)
        // $pdf->setOutputFormat('png');

        // Extract the images from the PDF
        // $pdf->saveAllPagesAsImages('F:\dc projects\media_library\media-lib\public\storage\uploads',$randomString);

        // Get the paths of the extracted images
        // $imagePaths = $pdf->getImagePaths();

        // Display the paths of the extracted images
        // foreach ($imagePaths as $imagePath) {
        //     echo $imagePath . "\n";
        // }

        /*-------------------------------------------------------*/

        /*---------- extracting text via spatie media text extractor --------------*/


        // path to pdf file
        // $filename = 'F:\dc projects\media_library\media-lib\public\storage\uploads\h_cv.pdf';

        // $text = Pdf::getText($filename, 'F:\xpdf-tools-win-4.04\xpdf-tools-win-4.04\bin64\pdftotext.exe');
        // // path to binary file  'F:\xpdf-tools-win-4.04\xpdf-tools-win-4.04\bin64\pdftotext.exe'

        // $text = (new Pdf('F:\xpdf-tools-win-4.04\xpdf-tools-win-4.04\bin64\pdftotext.exe'))->setPdf($filename)->text();
        // // GENERATRE WORD
        // $phpWord = new PhpWord();

        // $section = $phpWord->addSection();

        // $section->addTitle('My Document Title');
        // $section->addText($text);

        // $filename = $randomString . '.docx';
        // $phpWord->save('F:\dc projects\media_library\media-lib\public\storage\uploads\\' . $filename);

        // $config = Configuration::getDefaultConfiguration()->setApiKey('Apikey', config('services.cloud_mersive.key'));

        // $apiInstance = new EmailApi(


        //     new Client(),
        //     $config
        // );
        // $email = "support@cloudmersive.com"; // string | Email address to validate, e.g. \"support@cloudmersive.com\".    The input is a string so be sure to enclose it in double-quotes.

        // try {
        //     $result = $apiInstance->emailFullValidation($email);
        //     print_r($result);
        // } catch (Exception $e) {
        //     echo 'Exception when calling EmailApi->emailFullValidation: ', $e->getMessage(), PHP_EOL;
        // }



        // Configure API key authorization: Apikey




        $config = Configuration::getDefaultConfiguration()->setApiKey('Apikey', config('services.cloud_mersive.key'));



        $apiInstance = new ConvertDocumentApi(new Client(), $config);


        // $filePath = "F:\dc projects\media_library\media-lib\public\storage\uploads\h_cv.pd"; // \SplFileObject | Input file to perform the operation on.
        $output_file = "F:\dc projects\media_library\media-lib\public\storage\uploads\word_files\\" . $this->randomString . "outfile.docx";

        try {
            $result = $apiInstance->convertDocumentPdfToDocx($filePath);
            // print_r($result);
            // dd($result);

            $file = fopen($output_file, "wb");

            // Write the raw data into the file
            fwrite($file, $result);

            // Close the file
            fclose($file);


            // echo "Raw data saved as a binary file.\n";

        } catch (Exception $e) {

            echo 'Exception when calling ConvertDocumentApi->convertDocumentPdfToDocx: ', $e->getMessage(), PHP_EOL;
        }

        return asset('storage/uploads/word_files/') . '/' . $this->randomString . '-output.docx';
    }


    /*--------trying aspose.word cloud services--------*/


    public function pdftoImgConv(Request $request)
    {

        // $pdfFile = $request->file('pdf');

        // $pdfFile = asset('storage/uploads/h_cv.pdf');
        $pdfFile = 'F:\dc projects\media_library\media-lib\public\storage\uploads\h_cv.pdf';
        $media = new Smlprod();

        $media->create([
            'name' => 'Mufasa',
            'title' => 'set any title from factory indeed',
            'body' => 'This is text,sole purpose is for testing some features',
        ]);

        $media->addMedia($pdfFile)
            ->toMediaCollection('Pdfs');


        // $media->conversions()->add('pdf_to_image')->performOnCollections('default');

        $media->addMediaConversion('pdf_to_image')
            ->format('png')
            ->performOnCollections('default');

        dd($media);

        // return response()->json([
        //     'message' => 'PDF uploaded and conversion started.',
        //     'media_id' => $media->id,
        // ]);
        $this->getMediaUrl($media);

        // return $media->getUrl();
    }


    public function getMediaUrl($media)
    {

        // dd($media);        // $url = $media->getUrl();

        $url = Media::findorFail('1')->getUrl();

        dd($url);
    }



    // compare doc files

    public function compareDocFiles()
    {
        $config = $this->apiAuthorization();
        $apiInstance = new CompareDocumentApi(new Client(), $config);

        $input_file1 = storage_path('app\public\uploads\word_files\Best Essay Writing Service Ireland.docx'); // \SplFileObject | First input file to perform the operation on.
        // F:\dc projects\media_library\media-lib\public\storage\uploads\word_files\Best Essay Writing Service Ireland.docx
        $input_file2 = storage_path('app\public\uploads\word_files\website changes cvwritingservice.docx');
        // $input_file2 = "/path/to/file.txt"; // \SplFileObject | Second input file to perform the operation on (more than 2 can be supplied).

        $output_file = "F:\dc projects\media_library\media-lib\public\storage\uploads\word_files\\" . $this->randomString . "-compare.docx";

        try {
            $result = $apiInstance->compareDocumentDocx($input_file1, $input_file2);

            $file = fopen($output_file, "wb");

            // Write the raw data into the file
            fwrite($file, $result);

            // Close the file
            fclose($file);

            // print_r($result);
        } catch (Exception $e) {
            echo 'Exception when calling CompareDocumentApi->compareDocumentDocx: ', $e->getMessage(), PHP_EOL;
        }
    }


    public function ConvertToJpg(){

      $apiInstance =  $this->ConvertDocumentApi();

       $input_file = storage_path('app\public\uploads\Syed Faraz Shahid Resume_removed web intern.pdf'); // \SplFileObject | Input file to perform the operation on.

       $quality = 56; // int | Optional; Set the JPEG quality level; lowest quality is 1 (highest compression), highest quality (lowest compression) is 100; recommended value is 75. Default value is 75.

    //    dd($apiInstance);
        try {
             $result = $apiInstance->convertDocumentAutodetectToJpg($input_file, $quality);
             print_r($result);
            } catch (Exception $e) {
                echo 'Exception when calling ConvertDocumentApi->convertDocumentAutodetectToJpg: ', $e->getMessage(), PHP_EOL;
            }

    }


    public function ConvertToPng(){

        $apiInstance =  $this->ConvertDocumentApi();

        $input_file = storage_path('app\public\uploads\Syed Faraz Shahid Resume_removed web intern.pdf'); // \SplFileObject | Input file to perform the operation on.

        try {
            $result = $apiInstance->convertDocumentAutodetectToPngArray($input_file);
            // print_r($result);
            foreach ($result['png_result_pages'] as $png){
                dd($png['url']);
            }
            // dd($result['png_result_pages'][0]['url']);

        } catch (Exception $e) {
            echo 'Exception when calling ConvertDocumentApi->convertDocumentAutodetectToPngArray: ', $e->getMessage(), PHP_EOL;
        }

    }

    // function to handle api authorization
    public function apiAuthorization()
    {
        $config = Configuration::getDefaultConfiguration()->setApiKey('Apikey', config('services.cloud_mersive.key'));

        return $config;
    }

    //call to parent api referred as convertDocumnetApi
    public function ConvertDocumentApi(){
        $config = $this->apiAuthorization();

        $apiInstance = new ConvertDocumentApi(
            // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
            // This is optional, `GuzzleHttp\Client` will be used as default.
            new Client(),
            $config
        );

        return $apiInstance;

    }


    // merge two documents

   
}
