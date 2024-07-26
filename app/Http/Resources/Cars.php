<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Cars extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);

        return [
            'id' => $this->id,
            'car_name'=> $this->car_name,
            'brand_name'=> $this->brand,
            'engine_capacity'=> $this->engine_capacity,
            'fuel_type'=> $this->fuel_type,
            'car_img'=> $this->car_img,
            'car_mileage'=> $this->car_mileage,
            'car_price'=> $this->car_price,
            'car_desc'=> $this->car_desc,
            'model_year'=>$this->model_year,
            'transmission_type'=>$this->transmission_type,
            'created_at' => $this->created_at,
        ];
    }
}
