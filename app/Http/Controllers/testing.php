<?php

namespace App\Http\Controllers;

use App\Models\MasterAsetBarang;
use App\Services\AsetBarangService;
use Illuminate\Http\Request;

class testing extends Controller
{
    protected AsetBarangService $service;
    function __construct(AsetBarangService $_service)
    {
        $this->service = $_service;
    }
    public function index(Request $req)
    {
        echo $req->get("k").$req->get("n").$req->get("m");
        echo $this->service->CreateManual($req->get('k'),$req->get('n'),$req->get('m'));
    }

}
