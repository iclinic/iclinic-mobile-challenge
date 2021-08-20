<?php

namespace App\Http\Resources;


use Illuminate\Http\Resources\Json\ResourceCollection;

class PrescriptionResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $result = $this->collection->map(function ($item, $key) {
            return [
                "id" => $item->id,
                "text" => $item->text,
                "clinic" => [
                    'id' => $item->clinics_id,
                    'name' => $item->clinics_name,
                ],
                "patient" => [
                    'id' => $item->patients_id,
                    'name' => $item->patients_name,
                    'email' => $item->patients_email,
                    'phone' => $item->patients_phone,
                ],
                "physician" => [
                    'id' => $item->physicians_id,
                    'name' => $item->physicians_name,
                    'crm' => $item->physicians_crm,
                ],
            ];
        });

        return $result;
    }
}
