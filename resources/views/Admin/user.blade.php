@extends('Admin.admin_home')
@section('content')
<div class="main-panel  ">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">User Table</h4>
                    @if (Session::has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                         <strong>{{session('success')}}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                    @endif
                    
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>Sl</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @forelse ($users as $key=>$user)
                          <tr>
                            <td>{{++$key}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}} </td>
                           @if ($user->usertype=='1')
                           <td class="  text-info"> Not allow </td>
                               
                           @else
                              <td>  <a class="btn btn-sm btn-danger" onclick="return confirm('Are you sure to delete this user')"  href="{{route('user.delete' ,$user->id)}}">Delete</a> </td>  
                           @endif
                          </tr>
                          @empty
                             <h1>No User </h1> 
                          @endforelse
                             
                          
                           
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
        </div>
    </div>
</div>
@endsection
 