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
      <td >@if (str_contains($item->fuel_type, 'Petrol') || str_contains($item->fuel_type, 'Diesel') || str_contains($item->fuel_type, 'Hybrid'))
              {{$item->engine_capacity}} cc
          @elseif (str_contains($item->fuel_type, 'Electric'))
              {{$item->engine_capacity}} KWh
          @else
              {{$item->engine_capacity}}
          @endif
      </td>
      <td >{{$item->fuel_type}}</td>
      <td >{{$item->transmission_type}}</td>
      <td >{{$item->car_mileage}} 
            @if (str_contains($item->fuel_type, 'Electric'))
                km
            @else
                kmpl
            @endif</td>
      
      <td >
        {{$item->car_price_range}}
        
      </td>
      
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
