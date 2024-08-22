<div>
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
        <div class="container my-3">
    <div class="card">
        <div class="card-header justify-content-baseline">
            <div class="row">
           <div class="col"> @if($carId)
                @php
                    $selectedCar = $cars->firstWhere('id', $carId);
                @endphp

                <h2>Car Models for {{ $selectedCar ? $selectedCar->car_name : 'Selected Car' }}:</h2>
                </div>
                <div class="col">
                     <a href="{{ url('/add/carmodel/' . $carId) }}" wire:navigate  class=" btn btn-success float-end mx-2">Add Model</a>
                </div>
                @if(count($carModels) > 0)
            
           
    </div>
            </div>
            <div class="card-body ">
            <table class="table table-hover">
                <thead>
                    <tr class="text-center align-middle">
                        <th scope="col">Serial No.</th>
                        <th scope="col">Model Name</th>
                        <th scope="col">Transmission Type</th>
                        <th scope="col">Engine Capacity</th>
                        <th scope="col">Fuel Type</th>
                        <th scope="col">Description</th>
                        <th scope="col">Mileage</th>
                        <th scope="col">Price</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($carModels as $model)
                        <tr class="text-center align-middle">
                            <th scope="row">{{$loop->iteration}}</th>
                            <td>{{ $model->model_name }}</td>
                            <td>{{ $model->transmission_type }}</td>
                            <td>{{ $model->engine_capacity }}</td>
                            <td>{{ $model->fuel_type }}</td>
                            <td>{{ $model->car_desc }}</td>
                            <td>{{ $model->car_mileage }}</td>
                            <td>{{ $model->car_price }}</td>
                            <td>
                                <button wire:click="editModel({{ $model->id }})" class="btn btn-warning">Edit</button>
                                <button wire:click="deleteModel({{ $model->id }})" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this model?');">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
           
                    @else
                        <div class="card-body ">
                            <p>No car models found for the selected car.</p>
                        </div>
                    @endif
                    @else
                        <div class="card-body ">
                            <p>Select a car to view its models.</p>
                        </div>
                    @endif
                </tbody>
            </div>
    </div>
    </div>
</div>
