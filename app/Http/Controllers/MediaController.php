<?php

namespace App\Http\Controllers;

use App\Models\Smlprod;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Settings;
use Spatie\PdfToText\Pdf;
use Spatie\PdfToImage\Pdf as ImgExt;


class MediaController extends Controller
{
    protected $randomString ;


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

       $randomString = substr(md5(rand()), 0, 5);

        // dd($wordFilePath);
        // Set PDF renderer path
        Settings::setPdfRendererPath('F:\dc projects\media_library\media-lib\vendor\tecnickcom\tcpdf');


        // Set PDF renderer name
        Settings::setPdfRendererName('TCPDF');

        // Load the Word file
        $phpWord = IOFactory::load($wordFilePath);



        // Save the Word file as PDF
        // $phpWord->save('..\..\..\storage\app\public\uploads\file.pdf', 'PDF');

        $phpWord->save('F:\dc projects\media_library\media-lib\public\storage\uploads\\' . $randomString . '.pdf', 'PDF');

        $downloadLink = asset('storage/uploads/' . $randomString . '.pdf');

        // dd($downloadLink);
        // dd('Word file has converted to PDF');
        return  $downloadLink;
    }

    public function createWord()
    {

        $randomString = substr(md5(rand()), 0, 5);

        // path to pdf file
        $pdfFile = 'F:\dc projects\media_library\media-lib\public\storage\uploads\h_cv.pdf';


        require_once('tcpdf/tcpdf.php');


        $pdf = new TCPDF();

// Set the path to your PDF file
// $pdfFile = 'path/to/your/pdf/file.pdf';

// Read the PDF file
$pdf->setSourceFile($pdfFile);

// Get the total number of pages in the PDF
$totalPages = $pdf->getNumPages();

// Loop through each page
for ($page = 1; $page <= $totalPages; $page++) {
    // Select the current page
    $pdf->setPage($page);

    // Get the image data for the current page
    $imageData = $pdf->getImageData();

    // Save the image to a file
    $imageFile = 'path/to/output/directory/image_' . $page . '.jpg';
    file_put_contents($imageFile, $imageData);

    // Display the path of the extracted image
    echo $imageFile . "\n";
}




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


        // $text = Pdf::getText($filename,'F:\xpdf-tools-win-4.04\xpdf-tools-win-4.04\bin64\pdftotext.exe');
        // path to binary file  'F:\xpdf-tools-win-4.04\xpdf-tools-win-4.04\bin64\pdftotext.exe'

        // $text = (new Pdf('F:\xpdf-tools-win-4.04\xpdf-tools-win-4.04\bin64\pdftotext.exe'))->setPdf($filename)->text();
        // GENERATRE WORD
        // $phpWord = new PhpWord();

        // $section = $phpWord->addSection();

        // $section->addTitle('My Document Title');
        // $section->addText($text);

        // $filename = 'my_document_new.docx';
        // $phpWord->save('F:\dc projects\media_library\media-lib\public\storage\uploads\\' . $filename);
    }
}
