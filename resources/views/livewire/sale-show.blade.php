<div
    style=" background-image: url('{{ asset('uploads/bgbeach1.png') }}'); background-size: cover; background-repeat: no-repeat;
background-position: center; 
position: relative; height:100vh;">
    <br>
    <button class="btn btn-primary" onClick="window.print()">Print Sales</button>
    
    <div class="row pt-5">
        <div class="col-md-3 d-flex">
            <label for="" class="pr-4">Type: </label>
            <select class="form-control" id="" wire:model="type">
                <option value="" selected>All</option>
                <option value="Online">Online</option>
                <option value="Walkin">Walk-in</option>
            </select>
        </div>
        <div class="col-md-3 d-flex">
            <label for="" class="pr-4">From: </label>
            <input type="date" class="form-control" wire:model="from">
        </div>
        <div class="col-md-3 d-flex">
            <label for="" class="pr-4">To: </label>
            <input type="date" class="form-control" wire:model="to" min="{{ $from }}">
        </div>
        <div class="col-md-3 d-flex">
            <label for="" class="pr-4">Amenity: </label>
            <select class="form-control" id="" wire:model="service">
                <option value="" selected>All</option>
                @foreach ($service_types as $s)
                    <option value="{{ $s->service_type }}">{{ $s->service_type }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <br>
    <div class="overflow-auto"style="max-height: 500px">
        <table class="table table-dark">
            <thead>
                <tr>
                    <th>Customer</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Date</th>
                    <th>Subtotal</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($details as $d)
                    <tr>
                        <td>{{ $d->booking->user->fullname() }}</td>
                        <td>{{ $d->service->name }}</td>
                        <td><i class="fa-solid fa-peso-sign"></i>
                            {{ number_format($d->subtotal / $d->quantity, 2, '.', ',') }}</td>
                        <td>{{ $d->quantity }}</td>
                        <td>{{ date('F d, Y', strtotime($d->date)) }}</td>
                        <td><i class="fa-solid fa-peso-sign"></i> {{ number_format($d->subtotal, 2, '.', ',') }} </td>
                        <td> {{ $d->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <br>
    <div class="d-flex justify-content-center mb-5">
        <h4>Total: <i class="fa-solid fa-peso-sign"></i> {{ number_format($sales, 2, '.', ',') }}</h4>
    </div>


    <div class="overflow-auto"style="max-height: 500px">
        <div class="row">
            <div class="col-md-3">
                Name
            </div>
            <div class="col-md-3">
                Orders
            </div>
            <div class="col-md-2">
                Quantity
            </div>
            <div class="col-md-2">
                Price
            </div>
            <div class="col-md-2">
                Date
            </div>

            @foreach ($bookings as $b)
                <div class="col-md-3">
                    {{ $b->user->fullname() }}
                </div>
                <div class="col-md-3">
                    ROOM
                </div>
                <div class="col-md-2">
                    {{ $b->room_quan() }}
                </div>
                <div class="col-md-2">
                    <i class="fa-solid fa-peso-sign"></i> {{ number_format($b->room_total(), 2, '.', ',') }}
                </div>
                <div class="col-md-2">
                    {{ date('M d, Y', strtotime($b->date)) }}
                </div>

                <div class="col-md-3">

                </div>
                <div class="col-md-3">
                    COTTAGE
                </div>
                <div class="col-md-2">
                    {{ $b->cottages_quan() }}
                </div>
                <div class="col-md-2">
                    <i class="fa-solid fa-peso-sign"></i> {{ number_format($b->cottages_total(), 2, '.', ',') }}
                </div>
                <div class="col-md-2">
                    {{ date('M d, Y', strtotime($b->date)) }}
                </div>

                <div class="col-md-3"></div>

                <div class="col-md-3">
                    FOOD
                </div>
                <div class="col-md-2">
                    {{ $b->food_quan() }}
                </div>
                <div class="col-md-2">
                    <i class="fa-solid fa-peso-sign"></i> {{ number_format($b->food_total(), 2, '.', ',') }}
                </div>
                <div class="col-md-2">
                    {{ date('M d, Y', strtotime($b->date)) }}
                </div>

                <div class="col-md-3">

                </div>
                <div class="col-md-3">
                    ACTIVITIES
                </div>
                <div class="col-md-2">
                    {{ $b->activities_quan() }}
                </div>
                <div class="col-md-2">
                    <i class="fa-solid fa-peso-sign"></i> {{ number_format($b->activities_total(), 2, '.', ',') }}
                </div>
                <div class="col-md-2">
                    {{ date('M d, Y', strtotime($b->date)) }}
                </div>
                <div class="col-md-6"></div>
                <div class="col-md-2 mb-5 d-flex justify-content-end">
                    Total:
                </div>
                <div class="col-md-2 mb-5">
                    <i class="fa-solid fa-peso-sign"></i> {{ number_format($b->total, 2, '.', ',') }}
                </div>
            @endforeach
        </div>

    </div>
    <div>
        <div class="text-center mt-5 ">
            <h1 class="text-bold" style="font-family:'Courier New', Courier, monospace">Sales Chart {{ date('Y') }}
            </h1>
        </div>
        <div id="myChart" style="width:100%; height:500px;"></div>
    </div>
</div>

<br>


<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>
    google.charts.load('current', {
        packages: ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        // Set Data
        $.ajax({
            url: "/chart",
            type: "GET",
            dataType: "json",
            data: {

            },
            success: function(data) {
                console.log(data);
                var data = google.visualization.arrayToDataTable(data);
                // Set Options
                var options = {
                    title: '',
                    hAxis: {
                        title: 'Month'
                    },
                    vAxis: {
                        title: 'Sales'
                    },
                    legend: 'none'
                };
                // Draw Chart
                var chart = new google.visualization.ColumnChart(document.getElementById('myChart'));
                chart.draw(data, options);
            },
            error: function(error) {
                console.log("Error:");
                console.log(error);
            }
        });

    }
</script>
