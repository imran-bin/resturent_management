@extends('Admin.admin_home')
@section('content')
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
          @foreach ($reservations as $key=>$reservation)
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
              
              
             <td><a class="btn btn-sm btn-primary" href="{{route('admin.food.edit',$reservation->id)}}">Edit</a></td>
             <td><a class="btn btn-sm btn-danger" onclick="return confirm('Are you sure this Food delete')" href="{{route('admin.food.delete',$reservation->id)}}">Delete</a></td>
            </tr>
              
          @endforeach
        
         
      </tbody>
    </table>
  </div>
    
@endsection