@extends('Admin.admin_home')
@section('content')
    <div class="row w-50 mx-auto shadow-lg">
        <div class="col-md-12 grid-margin  ">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center text-primary">Food Upload</h1>
                    <form class="forms-sample" action="{{ route('admin.food.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputUsername1">Title</label>
                            <input type="text" name="title" class="form-control text-white" placeholder="food title">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Price</label>
                            <input type="number" name="price" class="form-control text-white" placeholder="price">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Description</label>

                            <textarea name="description" class="form-control text-white" placeholder="Description" cols="30" rows="10"></textarea>
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
                    <th>Title</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($foods as $key => $food)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $food->title }}</td>
                        <td>{{ $food->price }} </td>
                        <td> <img src="foodImage/{{ $food->image }}" alt=""> </td>
                        <td>{{ $food->description }}</td>
                        <td><a class="btn btn-sm btn-primary" href="{{ route('admin.food.edit', $food->id) }}">Edit</a></td>
                        <td><a class="btn btn-sm btn-danger" onclick="return confirm('Are you sure this Food delete')"
                                href="{{ route('admin.food.delete', $food->id) }}">Delete</a></td>
                    </tr>
                @endforeach


            </tbody>
        </table>
    </div>
@endsection
