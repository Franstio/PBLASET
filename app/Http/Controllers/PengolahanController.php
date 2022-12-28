<?php

namespace App\Http\Controllers;

use App\Services\AsetBarangService;
use App\Services\AsetGedungService;
use Illuminate\Http\Request;

class PengolahanController extends Controller
{
    private AsetBarangService $service;

    private AsetGedungService $service2;
    public function list(Request $request,$year =null)
    {
        $listYear = $this->service->GetYears();
        return view("pblaset.pengelolaan",compact("year","listYear"));
    }
    public function __construct(AsetBarangService $service,AsetGedungService $service2)
    {
        $this->service = $service;
        $this->service2 = $service2;
    }
    public function listGedung(Request $req,$year= null)
    {
        $listYear = $this->service2->GetYears();
        return view("pblaset.pengelolaan-gedung",compact("year","listYear"));
    }
}
