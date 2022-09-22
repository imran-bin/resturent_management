@extends('Admin.admin_home')
@section('content')
    <div class="row w-50 mx-auto shadow-lg">
        <div class="col-md-12 grid-margin  ">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center text-primary">Chefs Upload</h1>
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
                    <form class="forms-sample" action="{{ route('admin.chefs.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputUsername1">Name</label>
                            <input type="text" name="name" class="form-control text-white" placeholder="name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Specialsity</label>
                            <input type="text" name="specialsity" class="form-control text-white" placeholder="Specialsity">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputConfirmPassword1">Image</label>
                            <input type="file" name="image" class="form-control text-white" placeholder="image">
                        </div>

                        <button type="submit" class="btn btn-primary w-25 mx-auto">Upload</button>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Sl</th>
                    <th>Name</th>
                    <th>Specialsity</th>
                    <th>Image</th>
                   
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($chefs as $key => $chefs)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $chefs->name }}</td>
                    
                        <td> <img src="chefsImage/{{ $chefs->image }}" alt=""> </td>
                  
                        <td><a class="btn btn-sm btn-primary" href="{{ route('admin.chefs.edit', $chefs->id) }}">Edit</a></td>
                        <td><a class="btn btn-sm btn-danger" onclick="return confirm('Are you sure this chefs delete')"
                                href="{{ route('admin.chefs.delete', $chefs->id) }}">Delete</a></td>
                    </tr>
                @endforeach


            </tbody>
        </table>
    </div>
@endsection
