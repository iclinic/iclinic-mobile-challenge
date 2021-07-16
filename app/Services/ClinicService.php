<?php

namespace App\Services;

use App\Models\Clinic;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ClinicService extends BaseCrudService
{

    protected $model;

    public function __construct(Clinic $model)
    {
        $this->model = $model;
    }

    public function handleData(Request $request, Model $model)
    {
        if ($request->has('name') and !empty($request->name)) {
            $model->name = $request->name;
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

        return $model->paginate($perPage);

    }
}
