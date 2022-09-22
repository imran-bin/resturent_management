@extends('Admin.admin_home')
@section('content')
@if (Session::has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
     <strong>{{session('success')}}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif
@if (Session::has('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
     <strong>{{session('error')}}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif
<div class="table-responsive">
    <table class="table">
      <thead>
        <tr>
          <th>Sl</th>
          <th>Name</th>
          <th>Guest</th>
          <th>Date</th>
          <th>Time</th>
          <th>phone</th>
          <th>email</th>
          <th>Message</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($reservations as $key=>$reservation)
        <tr>
          <td>{{++$key}}</td>
          <td>{{$reservation->name}}</td>
          <td>{{$reservation->guest}}</td>
          <td>{{$reservation->date}}</td>
          <td>{{$reservation->time}}</td>
          <td>{{$reservation->phone}}</td>
          <td>{{$reservation->email}}</td>
          <td>{{$reservation->message}}</td>
          @if ($reservation->status=='pending')
         
              <td><a class="btn btn-sm btn-info" href="{{route('admin.status',$reservation->id)}}">pending</a></td>
          @else
          <td class="text-warning">{{$reservation->status}}</td>
          @endif
          
          
       
         <td><a class="btn btn-sm btn-danger" onclick="return confirm('Are you sure this Food delete')" href="{{route('admin.food.delete',$reservation->id)}}">Delete</a></td>
        </tr>  
        @empty
            <h1>Empty Reservation</h1>
        @endforelse
         
        
         
      </tbody>
    </table>
  </div>
    
@endsection