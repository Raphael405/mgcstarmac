<div
    style=" background-image: url('{{ asset('uploads/bgbeach.png') }}'); background-size: cover; background-repeat: no-repeat;
background-position: center; 
position: relative; height:100vh;">

    <div wire:ignore.self class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="add"
        aria-hidden="true">
        <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="add">Add Service</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                
                <form action="{{ route('services.add') }}" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        <label for="">Name</label>
                        <input type="text" name="name" class="form-control">
                        @error('name')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                        <label for="">Service Type</label>
                        <select name="services_types_id" class="form-control" wire:model="type">
                            <option selected disabled>Please Select Service Type</option>
                            @foreach ($types as $t)
                                <option value="{{ $t->id }}">{{ $t->service_type }}</option>
                            @endforeach
                        </select>
                        @error('service_types_id')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                        <label for="">Description</label>
                        <textarea name="description" class="form-control" cols="30" rows="3"></textarea>
                        @error('description')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                        <label for="">Price</label>
                        <input type="number" name="price" class="form-control">
                        @if ($type == 6)
                            <label for="">Foodtype</label>
                            <select name="location" class="form-control">
                                <option value="Breakfast" selected>Breakfast</option>
                                <option value="Lunch">Lunch</option>
                                <option value="Dinner">Dinner</option>
                                <option value="Softdrink">Softdrink</option>
                                <option value="Dessert">Dessert</option>
                            </select>
                        @endif
                        @error('price')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                        <label for="">Add Images</label>
                        <input type="file" class="form-control" name="images[]" placeholder="address" multiple>
                        @error('images')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success ">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-2 d-flex ">
            <label for="" class="mr-4">Filter: </label>
            <select wire:model="filter" class="form-control" wire:change="sort">
                <option value="All" selected>ALL</option>
                @foreach ($types as $t)
                    <option value="{{ $t->id }}">{{ $t->service_type }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6">

        </div>

        <div class="col-md-4 d-flex justify-content-end">
            <button class="btn btn-primary mr-4" data-toggle="modal" data-target="#add">Add Amenities</button>
        </div>
    </div>
    <br>
    <div class="overflow-auto" style="max-height: 90%">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Image</th>
                    <th scope="col">Name</th>
                    <th scope="col">Type</th>
                    <th scope="col">Description</th>
                    <th scope="col">Price</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($services as $a)
                    <tr>
                        <td>
                            @if (count($a->images) != 0)
                                <button class="btn " data-toggle="modal"
                                    data-target="#images{{ $a->id }}"><img
                                        src="{{ asset($a->images->first()->location) }}" alt="" height="100px"
                                        width="100px"></button>
                                <div wire:ignore.self class="modal fade" id="images{{ $a->id }}" tabindex="-1"
                                    role="dialog" aria-labelledby="add" aria-hidden="true">
                                    <div class="modal-dialog  modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="add">Images</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div id="carouselExampleControls" class="carousel slide"
                                                    data-ride="carousel">
                                                    <div class="carousel-inner">
                                                        @foreach ($a->images as $im)
                                                            @if ($loop->index == 0)
                                                                <div class="carousel-item active">
                                                                    <a href="{{ asset($im->location) }}"><img
                                                                            class="d-block w-100"
                                                                            src="{{ asset($im->location) }}"></a>
                                                                </div>
                                                            @else
                                                                <div class="carousel-item">
                                                                    <a href="{{ asset($im->location) }}"><img
                                                                            class="d-block w-100"
                                                                            src="{{ asset($im->location) }}"></a>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                    <a class="carousel-control-prev" href="#carouselExampleControls"
                                                        role="button" data-slide="prev">
                                                        <h1 class="text-dark"><i class="fa-solid fa-arrow-left"></i>
                                                        </h1>
                                                        <span class="sr-only">Previous</span>
                                                    </a>
                                                    <a class="carousel-control-next" href="#carouselExampleControls"
                                                        role="button" data-slide="next">
                                                        <h1 class="text-dark"><i class="fa-solid fa-arrow-right"></i>
                                                        </h1>
                                                        <span class="sr-only">Next</span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <a href="{{ asset('uploads/default.png') }}"><img
                                        src="{{ asset('uploads/default.png') }}" alt="" height="100px"
                                        width="100px"></a>
                            @endif
                        </td>
                        <th scope="row">{{ $a->name }}</th>
                        <td>{{ $a->type->service_type }}</td>
                        <td>{{ $a->description }}</td>
                        <td> <i class="fa-solid fa-peso-sign"></i> {{ number_format($a->price, 2, '.', ',') }}</td>
                        <td><button class="btn btn-success " data-toggle="modal"
                                data-target="#edit{{ $a->id }}">EDIT</button></td>
                        <div wire:ignore.self class="modal fade" id="edit{{ $a->id }}" tabindex="-1"
                            role="dialog" aria-labelledby="add" aria-hidden="true">
                            <div class="modal-dialog  modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="add">Edit {{ $a->name }}</h5>
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('services.edit') }}" method="post"
                                        enctype="multipart/form-data">
                                        <div class="modal-body">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $a->id }}">
                                            <label for="">Name</label>
                                            <input type="text" name="name" class="form-control"
                                                value="{{ $a->name }}">
                                            @error('name')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                            <label for="">Description</label>
                                            <textarea name="description" class="form-control" cols="30" rows="3">{{ $a->description }}</textarea>
                                            @error('description')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                            <label for="">Price</label>
                                            <input type="number" name="price" class="form-control"
                                                value="{{ $a->price }}">
                                            @error('price')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                            <label for="">Add Images</label>
                                            <input type="file" class="form-control" name="images[]"
                                                placeholder="address" multiple>
                                            @error('images')
                                                <div class="text-danger mt-2">{{ $message }}</div>
                                            @enderror
                                            <div class="row">.
                                                @foreach ($a->images as $im)
                                                    <div class="col-md-3 text-center">
                                                        <a href="{{ asset($im->location) }}"><img
                                                                src="{{ asset($im->location) }}" alt=""
                                                                height="250px" width="250px"></a>
                                                        <button class="btn btn-danger "
                                                            wire:click="remove({{ $im->id }}) ">REMOVE</button>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary "
                                                data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-success ">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
