@extends('admin.master')
@section('title')
    Edit Category
@endsection
@section('body')
<div class="row">
    <div class="col-lg-12">
        <h3 class="text-center text-success">{{Session::get('message')}}</h3>
        <hr/>
        <div class="well">
            {!!Form::open(['route'=>'/update-category','method'=>'POST','class'=>'form-horizontal'])!!}
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Category Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="categoryName" value="{{$category->categoryName}}">
                    <input type="hidden" class="form-control" name="id" value="{{$category->id}}">
                    <span class="text-danger">{{$errors->has('categoryName')?$errors->first('categoryName'):''}}</span>
                </div>
            </div>
            <div class="form-group">
                <label for="inputpassword3" class="col-sm-2 control-label">Category Description</label>
                <div class="col-sm-10">
                    <textarea class="form-control" name="categoryDescription" rows="8">{{$category->categoryDescription}}</textarea>
                    <span class="text-danger">{{$errors->has('categoryDescription')?$errors->first('categoryDescription'):''}}</span>
                </div>
            </div>
            <div class="form-group">
                <label for="inputpassword3" class="col-sm-2 control-label">Publication Status</label>
                <div class="col-sm-10 radio">
                    <label><input type="radio" {{$category->publicationStatus == 1 ? 'checked':''}} name="publicationStatus" value="1"/>Published</label>
                    <label><input type="radio" {{$category->publicationStatus == 0 ? 'checked':''}} name="publicationStatus" value="0"/>Unpublished</label>
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-offset-2 col-lg-10">
                    <input type="submit" name="btn" class="btn btn-success btn-block " value="Update Category Info"/>
                </div>
            </div>
            {!!Form::close()!!}
        </div>
    </div>
    
</div>
@endsection

