<?php
namespace App\Http\Controllers;

use App\Http\Requests\PatientStoreRequest;
use App\Http\Requests\PatientUpdateRequest;
use App\Http\Resources\PatientResource;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Services\PatientService;

class PatientController extends Controller
{

    protected $service;

    public function __construct(PatientService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $pagination = $this->service->getByFilters($request);
        $result = new PatientResource($pagination);
        return $result;
    }

    public function getById($id)
    {
        return $this->service->getById($id);
    }

    public function store(PatientStoreRequest $request)
    {
        return $this->service->store($request);
    }

    public function update($id, PatientUpdateRequest $request)
    {
        return $this->service->update($id, $request);
    }

    public function delete($id)
    {
        return $this->service->delete($id);
    }
}
