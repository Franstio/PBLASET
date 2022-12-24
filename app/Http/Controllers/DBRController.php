<?php

namespace App\Http\Controllers;

use App\Services\AsetBarangService;
use Illuminate\Http\Request;

class DBRController extends Controller
{
    //
    protected AsetBarangService $service;
    public function index()
    {
        return view("pblaset.DBR");
    }
    public function __construct(AsetBarangService $s)
    {
        $this->service = $s;
    }
    public function ReadDBR(Request $req)
    {
        return $this->service->GetDBR($req);
    }

}
