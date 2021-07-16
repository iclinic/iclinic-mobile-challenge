<?php

namespace Database\Factories;

use App\Models\Prescription;
use Illuminate\Database\Eloquent\Factories\Factory;

class PrescriptionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Prescription::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'clinic_id' => $this->faker->numberBetween(1, \App\Models\Clinic::count()),
            'patient_id' => $this->faker->numberBetween(1, \App\Models\Patient::count()),
            'physician_id' => $this->faker->numberBetween(1, \App\Models\Physician::count()),
            'text' => $this->faker->text(),
        ];
    }

}
