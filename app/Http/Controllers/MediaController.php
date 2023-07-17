<?php

namespace App\Http\Controllers;

use App\Models\Smlprod;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Settings;

class MediaController extends Controller
{

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

    public  function wordtoPdfForm(){

        return view('pages.wtpForm');
    }

    public function wordtoPdfConv(Request $request)
    {

        $file = $request->file('file');
        $fileName = $file->getClientOriginalName();
        $filePath = $file->storeAs('uploads', $fileName, 'public');

        $wordFilePath = 'F:\dc projects\media_library\media-lib\public\storage\uploads\\'.$fileName;

        // dd($wordFilePath);

        $downloadLink =  $this->convertToPdf($wordFilePath);

        return redirect()->back()->with(['dlink' => $downloadLink]);

    }


    public function convertToPdf($wordFilePath)
    {

        $randomString = substr(md5(rand()),0,5);

        // dd($wordFilePath);
        // Set PDF renderer path
        Settings::setPdfRendererPath('F:\dc projects\media_library\media-lib\vendor\tecnickcom\tcpdf');


        // Set PDF renderer name
        Settings::setPdfRendererName('TCPDF');

        // Load the Word file
        $phpWord = IOFactory::load($wordFilePath);



        // Save the Word file as PDF
        // $phpWord->save('..\..\..\storage\app\public\uploads\file.pdf', 'PDF');

        $phpWord->save('F:\dc projects\media_library\media-lib\public\storage\uploads\\'.$randomString.'.pdf', 'PDF');

        $downloadLink = asset('storage/uploads/'.$randomString.'.pdf');

        // dd($downloadLink);
        // dd('Word file has converted to PDF');
        return  $downloadLink ;
    }
}
