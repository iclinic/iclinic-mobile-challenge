<?php

namespace App\Services;

use App\Models\Clinic;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class BaseCrudService
{

    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function getById($id)
    {
        return $this->model->where('id', $id)->get();
    }

    public function getByFilters(Request $request)
    {
        return [];
    }

    public function store(Request $data)
    {
        $model = $this->handleData($data, $this->model);
        $model->save();

        return $model->toArray();
    }

    public function update($id, Request $request)
    {
        $model = $this->model->find($id);
        if(empty($model)){
            return [
                'error' => true,
                'messages' => 'Not Found'
            ];
        }
        $model = $this->handleData($request, $model);
        $model->save();
        return $model->toArray();
    }

    public function delete($id)
    {
        if ($this->model->where('id', $id)->delete()) {
            return [
                'error' => false,
                'messages' => 'Deleted on database'
            ];
        }
        return [
            'error' => false,
            'messages' => 'Not found'
        ];

    }

    protected function handleData(Request $request, Model $model)
    {
        return $model;
    }

    protected function filterWhere($field, Request $request, Model $model)
    {
        if ($request->has($field) and !empty($request->$field)) {
            $model = $model->where($field, $request->$field);
        }
        return $model;
    }

    protected function filterWhereLike($field, Request $request, Model $model)
    {
        if ($request->has($field) and !empty($request->$field)) {
            $model = $model->where($field, 'like', '%' . $request->$field . '%');
        }
        return $model;
    }

}
