<?php
namespace App\Jobs;

use App\Models\Car;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessCarData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->data as $row) {
            Car::create([
                'car_name' => $row['car_name'] ?? null,
                'brand' => $row['brand_name'] ?? null,
                'engine_capacity' => $row['capacity'] ?? null,
                'fuel_type' => $row['fuel_type'] ?? null,
                'car_desc' => $row['car_desc'] ?? null,
                'car_mileage' => $row['car_mileage'] ?? null,
                'car_price_range' => $row['car_price_range'] ?? null,
                'transmission_type' => $row['transmission_type'] ?? null,
                'car_img' => $row['car_img'] ? 'photos/' . $row['car_img'] : null,
            ]);
        }
    }
}
