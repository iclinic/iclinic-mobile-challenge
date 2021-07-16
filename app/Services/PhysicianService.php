<?php

namespace App\Services;

use App\Models\Physician;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class PhysicianService extends BaseCrudService
{

    protected $model;

    public function __construct(Physician $model)
    {
        $this->model = $model;
    }

    public function handleData(Request $request, Model $model)
    {
        if ($request->has('name') and !empty($request->name)) {
            $model->name = $request->name;
        }
        if ($request->has('crm') and !empty($request->crm)) {
            $model->crm = $request->crm;
        }
        else {
            $model->crm = 'CRM-' . uniqid();
        }

        return $model;
    }

    public function getByFilters(Request $request)
    {
        $requestArray = $request->all();
        $perPage = $requestArray['per_page'] ?? 10;
        $model = $this->model;
        $model = $this->filterWhere('id', $request, $model);
        $model = $this->filterWhereLike('name', $request, $model);
        $model = $this->filterWhereLike('crm', $request, $model);

        return $model->paginate($perPage);
    }
}
