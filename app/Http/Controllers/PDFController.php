<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persona;

class PDFController extends Controller
{
    public function PDF(Persona $persona){
        
        $pdf = \PDF::loadView('descarga', compact('persona'));
        return $pdf->download('persona.pdf');
    }
}
