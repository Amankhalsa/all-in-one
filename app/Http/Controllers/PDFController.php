<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use Illuminate\Support\Str;
class PDFController extends Controller
{
    //
    public function generatePDF(){
        $data = [
            'title' => 'Welcome to Testing app'
        ];
          
        $pdf = PDF::loadView('generate_pdf', $data);
      

        $random = Str::random(10);

        return $pdf->download(strtoupper($random).'.pdf');
    }

    public function Invoice()
    {
        $pdf = PDF::loadView('invoice_pdf');
        $random = Str::random(10);
        return $pdf->download(strtoupper($random).'.pdf');
    }



    public function resume(){
                $pdf = PDF::loadView('cv');
        $random = Str::random(10);
        return $pdf->download(strtoupper($random).'.pdf');
    }
}
