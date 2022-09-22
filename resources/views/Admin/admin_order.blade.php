@extends('Admin.admin_home')

@section('content')
    <form action="{{route('admin.search')}}" method="GET">
        @csrf
        <label for="">Search Data</label>
        <input type="text" name="search" class="text-danger" placeholder="search by name of foodname">
        <input type="submit" value="search" class="btn btn-sm btn-success">
    </form>
    <div class="my-5">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Sl</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Foodname</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total_price</th>
                        {{-- <th>Action</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @forelse ($order as $key => $order)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $order->name }}</td>
                        <td>{{ $order->phone }}</td>
                        <td>{{ $order->address }}</td>
                        <td>{{ $order->foodname }}</td>
                        <td>{{ $order->price }}</td>
                        <td>{{ $order->quantity }}</td>
                        <td>{{ $order->quantity * $order->price }}</td>


                        {{-- <td><a class="btn btn-sm btn-primary" href="{{ route('admin.food.edit', $order->id) }}">Edit</a>
                        </td>
                        <td><a class="btn btn-sm btn-danger" onclick="return confirm('Are you sure this Food delete')"
                                href="{{ route('admin.food.delete', $order->id) }}">Delete</a></td> --}}
                    </tr>
                    @empty
                    <h1>Oreder Empty</h1>
                        
                    @endforelse
                  


                </tbody>
            </table>
        </div>
    </div>
@endsection
