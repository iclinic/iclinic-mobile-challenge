<?php

namespace App\Services;

use App\Models\Prescription;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class PrescriptionService extends BaseCrudService
{

    protected $model;

    public function __construct(Prescription $model)
    {
        $this->model = $model;
    }

    public function handleData(Request $request, Model $model)
    {
        if ($request->has('clinic_id') and !empty($request->clinic_id)) {
            $model->clinic_id = $request->clinic_id;
        }
        if ($request->has('physician_id') and !empty($request->physician_id)) {
            $model->physician_id = $request->physician_id;
        }
        if ($request->has('patient_id') and !empty($request->patient_id)) {
            $model->patient_id = $request->patient_id;
        }
        if ($request->has('text') and !empty($request->text)) {
            $model->text = $request->text;
        }
        return $model;
    }

    public function getByFilters(Request $request)
    {
        $requestArray = $request->all();
        $perPage = $requestArray['per_page'] ?? 10;
        $clinicId = $requestArray['clinic_id'] ?? null;
        $physicianId = $requestArray['physician_id'] ?? null;
        $patientId = $requestArray['patient_id'] ?? null;
        $text = $requestArray['text'] ?? null;
        $patientOrPhysicianName = $requestArray['patient_or_physician_name'] ?? null;

        $result = Prescription::getQuery()
            ->selectRaw(
               'prescriptions.id   AS id,
                prescriptions.text AS text,
                clinics.id         AS clinics_id,
                clinics.name       AS clinics_name,
                patients.id        AS patients_id,
                patients.name      AS patients_name,
                patients.email     AS patients_email,
                patients.phone     AS patients_phone,
                physicians.id      AS physicians_id,
                physicians.name    AS physicians_name,
                physicians.crm     AS physicians_crm,
                null               AS resource' // BUG Laravel ResourceCollection
            )
            ->join('clinics', 'clinics.id', '=', 'prescriptions.clinic_id')
            ->join('physicians', 'physicians.id', '=', 'prescriptions.physician_id')
            ->join('patients', 'patients.id', '=', 'prescriptions.patient_id')
            ->when($clinicId, function ($query, $value) {
                return $query->where(
                    'clinics.id',
                    $value
                );
            })
            ->when($physicianId, function ($query, $value) {
                return $query->where(
                    'physicians.id',
                    $value
                );
            })
            ->when($patientId, function ($query, $value) {
                return $query->where(
                    'patients.id',
                    $value
                );
            })
            ->when($text, function ($query, $value) {
                return $query->where(
                    'prescriptions.text',
                    'LIKE',
                    '%' . $value . '%'
                );
            })
            ->when($patientOrPhysicianName, function ($query, $value) {
                return $query->where(
                    'physicians.name',
                    'LIKE',
                    '%' . $value . '%'
                );
            })
            ->when($patientOrPhysicianName, function ($query, $value) {
                return $query->orWhere(function ($query) use ($value) {
                    $query->where('patients.name',
                        'LIKE',
                        '%' . $value . '%');
                });
            });

        return $result->paginate($perPage);
    }

}
