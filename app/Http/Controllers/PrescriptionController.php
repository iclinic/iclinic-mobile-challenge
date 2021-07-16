<?php

namespace App\Http\Controllers;


use App\Http\Requests\PrescriptionGetOrDeleteRequest;
use App\Http\Requests\PrescriptionStoreRequest;
use App\Http\Requests\PrescriptionUpdateRequest;
use App\Http\Resources\PrescriptionResource;
use App\Models\Prescription;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Services\PrescriptionService;

class PrescriptionController extends Controller
{

    protected $service;

    public function __construct(PrescriptionService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $pagination = $this->service->getByFilters($request);
        $result = new PrescriptionResource($pagination);
        return $result;
    }

    public function getById($id)
    {
        return $this->service->getById($id);
    }

    public function store(PrescriptionStoreRequest $request)
    {
        return $this->service->store($request);
    }

    public function update($id, PrescriptionUpdateRequest $request)
    {
        return $this->service->update($id, $request);
    }

    public function delete($id)
    {
        return $this->service->delete($id);
    }
}
