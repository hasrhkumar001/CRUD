<div class="container my-3">
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
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
    <tr class="text-center align-middle">
      <th scope="col">Serial No.</th>
      <th scope="col">Car Image</th>
      <th scope="col">Car Name</th>
      <th scope="col">Brand Name</th>
      <th scope="col">Engine/Motor Capacity</th>
      <th scope="col">Fuel Type</th>
      <th scope="col">Transmission Type</th>
      <th scope="col">Mileage/Range</th>
      <th scope="col">Price Range</th>
      
      <th scope="col" colspan="2">Actions</th>
    </tr>
  </thead>
  <tbody>
      @foreach($cars as $item)
    <tr class="text-center align-middle">
      <th scope="row">{{$loop->iteration}}</th>
      <td ><img src="{{ 'public/photos/' . $item->car_img }}"  class="rounded shadow "  style="width: 75px; height:40px"alt="Uploaded Image"></td>
      <!-- <td>{{ 'public/photos/' . $item->car_img }}</td> -->
      <td >{{$item->car_name}}</td>
      <td >{{$item->brand}}</td>
      <td >@if (str_contains($item->fuel_type, 'PETROL') || str_contains($item->fuel_type, 'DIESEL') || str_contains($item->fuel_type, 'HYBRID'))
              {{$item->engine_capacity}} cc
          @elseif (str_contains($item->fuel_type, 'ELECTRIC'))
              {{$item->engine_capacity}} KWh
          @else
              {{$item->engine_capacity}}
          @endif
      </td>
      <td >{{$item->fuel_type}}</td>
      <td >{{$item->transmission_type}}</td>
      <td >{{$item->car_mileage}} 
            @if (str_contains($item->fuel_type, 'ELECTRIC'))
                km
            @else
                kmpl
            @endif</td>
      
      <td >@php
        // Extract the price range values
        $priceRange = $item->car_price_range;

        // Initialize default values
        $formattedMinPrice = '0';
        $formattedMaxPrice = '0';
        $unit = '';

        // Check if the price range contains a hyphen
        if (strpos($priceRange, '-') !== false) {
            // Split the price range into min and max
            list($minPrice, $maxPrice) = explode('-', $priceRange, 2);

            // Ensure the prices are numeric and convert to float
            $minPrice = is_numeric($minPrice) ? (float)$minPrice : 0;
            $maxPrice = is_numeric($maxPrice) ? (float)$maxPrice : 0;

            // Function to format price with units
            function formatPrice($price) {
                if ($price >= 10000000) {
                    return [number_format($price / 10000000, 2), 'crore'];
                } elseif ($price >= 100000) {
                    return [number_format($price / 100000, 2), 'lakh'];
                } elseif ($price >= 1000) {
                    return [number_format($price / 1000, 2), 'thousand'];
                } else {
                    return [number_format($price, 2), ''];
                }
            }

            // Format both min and max prices
            list($formattedMinPrice, $minUnit) = formatPrice($minPrice);
            list($formattedMaxPrice, $maxUnit) = formatPrice($maxPrice);

            // Handle units
            $unit = $minUnit === $maxUnit ? $minUnit : '';
        } else {
            // Handle cases where price range is not in the expected format
            $formattedMinPrice = $priceRange; // Just display the original range
        }
    @endphp

    {{ $formattedMinPrice }} {{ $unit }} - {{ $formattedMaxPrice }} {{ $unit }}</td>
      
          <td ><button wire:click="viewCarModels({{ $item->id }})" class="btn btn-primary btn-sm shadow">Models</button></td>
          <td ><a  href="/edit/car/{{$item->id}}" wire:navigate  class="btn btn-warning btn-sm shadow" >Edit</td>
          <td ><button class="btn btn-danger btn-sm shadow" wire:click="delete({{$item->id}})" wire:confirm="Are you sure you want to delete this? ">Delete</button></td>
      
    </tr>
    @endforeach
    
  </tbody>
</table>
        </div>
    </div>

</div>
