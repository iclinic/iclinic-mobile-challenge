<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasRelationships;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory,HasRelationships;

    protected $fillable = [
        'clinic_id',
        'physician_id',
        'patient_id',
        'text'
    ];

//    public function clinic()
//    {
//        return $this->belongsTo(Clinic::class,'clinic_id','id');
//    }
}
