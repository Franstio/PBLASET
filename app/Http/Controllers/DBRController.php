<?php

namespace App\Http\Controllers;

use App\Http\Requests\LokasiRequest;
use App\Services\AsetBarangService;
use App\Services\LokasiService;
use Illuminate\Http\Request;

class DBRController extends Controller
{
    //
    protected AsetBarangService $service;
    protected LokasiService $lokasiService;
    public function index(LokasiRequest $req,$year=null)
    {
        $data =$this->lokasiService->RetrieveLocation2($req);
        $listYear = $this->service->GetYears();
        return view("pblaset.DBR",compact("data","year","listYear"));
    }
    public function __construct(AsetBarangService $s,LokasiService $s2)
    {
        $this->service = $s;
        $this->lokasiService = $s2;
    }
    public function ReadDBR(Request $req)
    {

        return $this->service->GetDBR($req);
    }
    public function ExportDBR(Request $req)
    {
        $dbr = $this->service->GetRawDBR($req);
        return view("pblaset.printDBR",compact("dbr"));
    }

}
