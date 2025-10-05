<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Customer::class;
    protected static $seq = 1;

    public function definition(): array
    {
        $code = 'MTS' . str_pad(self::$seq++, 4, '0', STR_PAD_LEFT);
        return [
            'customer_code' => $code,
            'name' => $this->faker->company,
            'address' => $this->faker->address,
            'phone' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->safeEmail,
            'created_by' => 1,
        ];
    }
}
