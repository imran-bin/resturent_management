@extends('Admin.admin_home')
@section('content')
<div class="main-panel  ">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">User Table</h4>
                    
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
                            @foreach ($users as $key=>$user)
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
                                
                            @endforeach
                          
                           
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
 