<?php

namespace App\Http\Controllers;


use App\Http\Requests\ClinicStoreRequest;
use App\Http\Requests\ClinicUpdateRequest;
use App\Http\Resources\ClinicResource;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Services\ClinicService;

class ClinicController extends Controller
{

    protected $service;

    public function __construct(ClinicService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $pagination = $this->service->getByFilters($request);
        $result = new ClinicResource($pagination);
        return $result;
    }

    public function getById($id)
    {
        return $this->service->getById($id);
    }

    public function store(ClinicStoreRequest $request)
    {
        return $this->service->store($request);
    }

    public function update($id, ClinicUpdateRequest $request)
    {
        return $this->service->update($id, $request);
    }

    public function delete($id)
    {
        return $this->service->delete($id);
    }
}
