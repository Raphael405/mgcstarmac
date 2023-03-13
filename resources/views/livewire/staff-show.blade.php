<div>
    @if (count($errors) > 0)
        <div class="bg-danger p-3 rounded-lg mb-1 text-white text-center">
            Front Desk not Added
        </div>
    @endif
    @if (session('status'))
        <div class="bg-success p-3 rounded-lg mb-1 text-white text-center">
            {{ session('status') }}
        </div>
    @endif
    <button class="btn btn-primary btn-lg mb-4 rounded-pill" data-toggle="modal" data-target="#add">Add Front Desk</button>
    <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="add" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="add">Add Front Desk</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('staff.add') }}" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        <div class="input-group mb-3">
                            <input name="username" type="text" class="form-control" placeholder="Username"
                                value="{{ old('username') }}">
                        </div>
                        @error('username')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                        <div class="input-group mb-3">
                            <input name="password" type="password" class="form-control" placeholder="Password">
                        </div>
                        <div class="input-group mb-3">
                            <input name="password_confirmation" type="password" class="form-control"
                                placeholder="Retype password">
                        </div>
                        @error('password')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                        <div class="input-group mb-3">
                            <input name="fname" type="text" class="form-control" placeholder="First Name"
                                value="{{ old('fname') }}">
                        </div>
                        @error('fname')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                        <div class="input-group mb-3">
                            <input name="mname" type="text" class="form-control" placeholder="Middle Name"
                                value="{{ old('mname') }}">
                        </div>
                        @error('mname')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                        <div class="input-group mb-3">
                            <input name="lname" type="text" class="form-control" placeholder="Last Name"
                                value="{{ old('lname') }}">
                        </div>
                        @error('lname')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                        <div class="input-group mb-3">
                            <input name="address" type="text" class="form-control" placeholder="Address"
                                value="{{ old('address') }}">
                        </div>
                        @error('address')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                        <div class="input-group mb-3">
                            <input name="contact_number" type="number" class="form-control"
                                placeholder="Contact Number" value="{{ old('contact_number') }}">
                        </div>
                        @error('contact_number')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                        <div class="input-group mb-3">
                            <input name="email" type="email" class="form-control" placeholder="Email"
                                value="{{ old('email') }}">
                        </div>
                        @error('email')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                        <label for="">Upload Valid ID</label>
                        <div class="input-group mb-3">
                            <input name="valid_id" type="file" class="form-control">
                        </div>
                        @error('valid_id')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary rounded-pill" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success rounded-pill">Add Front Desk</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css"
        integrity="sha256-2XFplPlrFClt0bIdPgpz8H7ojnk10H69xRqd9+uTShA=" crossorigin="anonymous" />
    <div class="">
        <div class="text-dark">
            <div class="row mb-4">
                <div class="col-md-2 d-flex">
                    <h1 class="text-bold"
                        style="font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif">
                        Front Desks</h1>
                </div>
                <div class="col-md-8 d-flex">
                    <h2 for="" style="font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif"
                        class="mr-5">Search: </h2>
                    <input type="text" wire:model="search" class="form-control" placeholder="SEARCH"
                        wire:keyup="sort">
                </div>
                <div class="col-md-2">
                    <select wire:model="filter" class="form-control" wire:change="sort">
                        <option value="Verified" selected>Verified</option>
                        <option value="Unverified" selected>Unverified</option>
                    </select>
                </div>
            </div>
            <div class="row overflow-auto " style="max-height: 800px; overflow-y; scroll">
                @foreach ($staffs as $eng)
                    <div class="col-sm-6 col-lg-3 mb-4">
                        <div class="candidate-list candidate-grid">
                            <div class="candidate-list-image text-center">
                                <a href="{{ asset($eng->valid_id) }} "><img class=""
                                        src="{{ asset($eng->valid_id) }} " height="400px" width="400px"
                                        alt=""></a>
                            </div>
                            <div class="candidate-list-details">
                                <div class="candidate-list-info">
                                    <div class="candidate-list-title text-center">
                                        <h5><a href="#" class="btn text-dark rounded-pill">{{ $eng->fullname() }}</a></h5>
                                    </div>
                                    <div class="card mb-4 mb-lg-0">
                                        <div class="card-body p-0">
                                            <ul class="list-group list-group-flush rounded-3">
                                                <li class="list-group-item d-flex  pr-3">
                                                    <button class="btn rounded-pill"><i
                                                            class="fas fa-location-dot fa-lg text-warning"></i></button>
                                                    <p class="mb-0 pt-1">{{ $eng->address }}</p>
                                                </li>
                                                <li class="list-group-item d-flex  pr-3">
                                                    <button class="btn rounded-pill"><i class="fa-regular fa-envelope fa-lg"
                                                            style="color: #333333;"></i></button>
                                                    <p class="mb-0 pt-1">{{ $eng->email }}</p>
                                                </li>
                                                <li class="list-group-item d-flex  pr-3">
                                                    <button class="btn rounded-pill"><i class="fas fa-hashtag fa-lg"
                                                            style="color: #55acee;"></i></button>
                                                    <p class="mb-0 pt-1">{{ $eng->contact_number }}
                                                    </p>
                                                </li>
                                                @if ($eng->verified === 'Unverified')
                                                    <li class="list-group-item d-flex text-center pr-3">
                                                        <button class="btn btn-primary btn-block rounded-pill" data-toggle="modal"
                                                            data-target="#verify{{ $eng->id }}"><i
                                                                class="fa-solid fa-circle-check"></i>VERIFY</button>
                                                        <div class="modal fade" id="verify{{ $eng->id }}"
                                                            tabindex="-1" role="dialog" aria-labelledby="add"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="add">Verify
                                                                            User
                                                                        </h5>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <form action="{{ route('customer.verify') }}"
                                                                        method="post" enctype="multipart/form-data">
                                                                        <div class="modal-body">
                                                                            @csrf
                                                                            <input type="hidden"
                                                                                value="{{ $eng->id }}"
                                                                                name="id">
                                                                            <input type="hidden" name="user" value="staff">
                                                                            Are you sure you want to verify,
                                                                            {{ $eng->fullname() }}
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button"
                                                                                class="btn btn-secondary rounded-pill"
                                                                                data-dismiss="modal">Close</button>
                                                                            <button type="submit"
                                                                                class="btn btn-success rounded-pill">Verify</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                @endif
                                                @if ($eng->verified === 'Verified')
                                                <li class="list-group-item d-flex text-center pr-3">
                                                    <button class="btn btn-warning btn-block rounded-pill" data-toggle="modal"
                                                        data-target="#verify{{ $eng->id }}"><i
                                                            class="fa-solid fa-circle-check"></i>Unverify</button>
                                                    <div class="modal fade" id="verify{{ $eng->id }}"
                                                        tabindex="-1" role="dialog" aria-labelledby="add"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="add">Unverify
                                                                        User
                                                                    </h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <form action="{{ route('customer.unverify') }}"
                                                                    method="post" enctype="multipart/form-data">
                                                                    <div class="modal-body">
                                                                        @csrf
                                                                        <input type="hidden"
                                                                            value="{{ $eng->id }}"
                                                                            name="id">
                                                                        <input type="hidden" name="user" value="staff">
                                                                        Are you sure you want to unverify,
                                                                        {{ $eng->fullname() }}
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button"
                                                                            class="btn btn-secondary rounded-pill"
                                                                            data-dismiss="modal">Close</button>
                                                                        <button type="submit"
                                                                            class="btn btn-warning rounded-pill">Unverify</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endif
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
