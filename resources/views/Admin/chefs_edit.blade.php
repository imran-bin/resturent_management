@extends('Admin.admin_home');
@section('content')
    
    <div class="row w-50 mx-auto shadow-lg">
        <div class="col-md-12 grid-margin  ">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center text-primary">Chefs Upload</h1>
                    <form class="forms-sample" action="{{ route('admin.chefs.update',$chefs->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputUsername1">Name</label>
                            <input type="text" name="name" value="{{$chefs->name}}" class="form-control text-white" placeholder="name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Specialsity</label>
                            <input type="text" name="special" value="{{$chefs->specialsity}}" class="form-control text-white" placeholder="Specialsity">
                        </div>
                           <div>
                            <p>old image</p>
                            <img height="200px" width="300px" src="chefsImage/{{$chefs->image}}" alt="">
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
@endsection
