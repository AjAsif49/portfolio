@extends('admin.index') 
 
@section('content')

<div class="col-lg-12">
    <div class="card card-default">
        <div class="card-header card-header-border-bottom">
            <h2>Edit hero</h2>
        </div>
        <div class="card-body">
            <form action="{{ url('hero/update/'.$heros->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="old_image" value="{{ $heros->image }}">
                <div class="form-group">
                    <label for="exampleFormControlInput1">Update Name</label>
                    <input type="text" name='name' class="form-control" id="exampleFormControlInput1" value="{{ $heros -> name }}">
                </div>

                <div class="form-group">
                    <label for="exampleFormControlInput1">Update Role</label>
                    <input type="text" name='role' class="form-control" id="exampleFormControlInput1" value="{{ $heros -> role }}">
                </div>
                

                <div class="form-group">
                    <img src="{{ asset($heros->image) }}" style="width: 400px; height:200px;">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlFile1">Update Image</label>
                    <input type="file" name='image' class="form-control-file" id="exampleFormControlFile1">
                </div>
                <div class="form-footer pt-4 pt-5 mt-4 border-top">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>

@endsection