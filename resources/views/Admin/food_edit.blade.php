@extends('Admin.admin_home')
@section('content')
    <div class="row w-50 mx-auto shadow-lg">
        <div class="col-md-12 grid-margin  ">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center text-primary">Food Update</h1>
                    @if (Session::has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{ session('success') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if (Session::has('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{ session('error') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <form class="forms-sample" action="{{ route('admin.food.update', $food->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputUsername1">Title</label>
                            <input type="text" name="title" class="form-control text-white"
                                value="{{ $food->title }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Price</label>
                            <input type="number" name="price" class="form-control text-white"
                                value="{{ $food->price }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Description</label>

                            <textarea name="description" class="form-control text-white" cols="30" rows="10"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputConfirmPassword1">Image</label>
                            <input type="file" name="image" class="form-control text-white"
                                value="{{ $food->image }}">
                        </div>
                        <div>
                            <img src="foodImage/{{ $food->image }}" height="200" width="200" alt="">
                        </div>
                        <button type="submit" class="btn btn-primary form-control  mt-3 ">Update</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
