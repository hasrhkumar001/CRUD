<div class="container my-3">
    <div class="card">
        <div class="card-header justify-content-baseline">
            <div class="row">
           <div class="col"><h2>Cars List</h2></div>
           <div class="col">
           
           <a href="/add" wire:navigate  class=" btn btn-success float-end mx-2">Add New Car</a>
           
</div>
</div>
        </div>
        <div class="card-body ">
        <table class="table table-hover">
  <thead>
    <tr class="text-center">
      <th scope="col">Serial No.</th>
      <th scope="col">Car Image</th>
      <th scope="col">Car Name</th>
      <th scope="col">Brand Name</th>
      <th scope="col">Engine/Motor Capacity</th>
      <th scope="col">Fuel Type</th>
      <th scope="col">Transmission Type</th>
      <th scope="col">Mileage/Range</th>
      <th scope="col">Model Year</th>
      <th scope="col">Price</th>
      
      <th scope="col" colspan="2">Actions</th>
    </tr>
  </thead>
  <tbody>
      @foreach($cars as $item)
    <tr class="text-center">
      <th scope="row">{{$loop->iteration}}</th>
      <td ><img src="{{ 'public/photos/' . $item->car_img }}"  class="rounded shadow "  style="width: 75px; height:40px"alt="Uploaded Image"></td>
      <!-- <td>{{ 'public/photos/' . $item->car_img }}</td> -->
      <td >{{$item->car_name}}</td>
      <td >{{$item->brand}}</td>
      <td >@if($item->fuel_type == 'PETROL' || $item->fuel_type == 'DIESEL')
                {{$item->engine_capacity}} cc
          @else
                {{$item->engine_capacity}} KWh
          @endif
      </td>
      <td >{{$item->fuel_type}}</td>
      <td >{{$item->transmission_type}}</td>
      <td >{{$item->car_mileage}} 
            @if ($item->fuel_type == 'ELECTRIC')
                km
            @else
                kmpl
            @endif</td>
      <td >{{$item->model_year}}</td>
      <td >@php
            $price = $item->car_price;

            if (strlen($price) > 7) {
                $price = $price / 10000000; // dividing by 10 million (crore)
                $unit = 'crore';
            } elseif (strlen($price) > 5) {
                $price = $price / 100000; // dividing by 100 thousand (lakh)
                $unit = 'lakh';
            } elseif (strlen($price) > 3) {
                $price = $price / 1000; // dividing by 1 thousand (thousand)
                $unit = 'thousand';
            } else {
                $unit = '';
            }
        @endphp

        {{$price}} {{$unit}}</td>
      
      <td ><a  href="/edit/car/{{$item->id}}" wire:navigate  class="btn btn-primary btn-sm shadow" >EDIT</td>
      <td ><button class="btn btn-danger btn-sm shadow" wire:click="delete({{$item->id}})" wire:confirm="Are you sure you want to delete this? ">DELETE</button></td>
    </tr>
    @endforeach
    
  </tbody>
</table>
        </div>
    </div>

</div>
