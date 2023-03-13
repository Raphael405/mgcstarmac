<div
    style=" background-image: url('{{ asset('uploads/beach.png') }}'); background-size: cover; background-repeat: no-repeat;
background-position: center; 
position: relative; height:100vh;">
    <div class="row ">
        <div class="col-md-3"></div>
        <div class="col-md-2">
            <label for="" class="pr-4">Search: </label>
            <input type="text" wire:model="search" class="form-control">
        </div>
        <div class="col-md-2">
            <label for="" class="pr-4">Status: </label>
            <select class="form-control" wire:model="status">
                <option value="">All</option>
                <option value="Request">Request</option>
                <option value="Ongoing">Ongoing</option>
                <option value="Finished">Finished</option>
            </select>
        </div>
        <div class="col-md-2">
            <label for="" class="pr-4">Type: </label>
            <select class="form-control" wire:model="type">
                <option value="">All</option>
                <option value="Online">Online</option>
                <option value="Walkin">Cash</option>
            </select>
        </div>
    </div>
    <br>
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Total</th>
                <th scope="col">Date</th>
                <th scope="col">Payment</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bookings as $b)
                <tr>
                    <th scope="row">{{ $b->user->fullname() }}</th>
                    <td><i class="fa-solid fa-peso-sign"></i> {{ number_format($b->total, 2, '.', ',') }}</td>
                    <td>{{ $b->date }}</td>
                    <td>{{ $b->reason }}</td>
                    <td>{{ $b->status }}</td>
                    <td>
                        <a href="{{ route('book.check', $b->id) }}"><button class="btn btn-success ">CHECK</button></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
