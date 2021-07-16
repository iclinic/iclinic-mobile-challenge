<?php

namespace App\Services;

use App\Models\Patient;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class PatientService extends BaseCrudService
{

    protected $model;

    public function __construct(Patient $model)
    {
        $this->model = $model;
    }

    public function handleData(Request $request, Model $model)
    {
        if ($request->has('name') and !empty($request->name)) {
            $model->name = $request->name;
        }
        if ($request->has('email') and !empty($request->email)) {
            $model->email = $request->email;
        }
        if ($request->has('phone') and !empty($request->phone)) {
            $model->phone = $request->phone;
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
        $model = $this->filterWhereLike('email', $request, $model);
        $model = $this->filterWhereLike('phone', $request, $model);

        return $model->paginate($perPage);
    }
}
