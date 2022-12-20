<?php

namespace App\Http\Controllers;

use App\Http\Requests\SatkerRequest;
use App\Services\SatkerService;
use Illuminate\Http\Request;
use Nette\Utils\Json;
use Response;

class SatkerController extends Controller
{
    protected SatkerService $service;

    function __construct(SatkerService $service)
    {
        $this->service = $service;
    }
    public function index()
    {
        $name = "Master Satker";
        return view("pblaset.master-form.master_satker",compact("name"));
    }
    public function create(SatkerRequest $request)
    {
        $this->service->Create($request);
        return redirect()->back();
    }
    public function read(Request $request)
    {
        return $this->service->GetMasterDataTable($request);
    }
    public function update(string $kode_satker,SatkerRequest $req)
    {
        $this->service->Update($kode_satker,$req);
        return redirect()->back();
    }
    public function delete(string $kode_satker)
    {
        $this->service->Delete($kode_satker);
        return Response()->json(["Message"=>"Update Success"],200);
    }
    public function list(string $nama)
    {
        return $this->service->RetrieveSatker($nama);
    }
    public function listAll()
    {
        return $this->service->RetrieveSatker("");
    }

}
