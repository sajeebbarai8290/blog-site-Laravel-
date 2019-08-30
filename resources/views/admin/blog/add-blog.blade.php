@extends('admin.master')
@section('title')
    Add Blog
@endsection
@section('body')
<div class="row">
    <div class="col-lg-12">
        <h3 class="text-center text-success">{{Session::get('message')}}</h3>
        <hr/>
        <div class="well">
            {!!Form::open(['route'=>'/new-blog','method'=>'POST','class'=>'form-horizontal','enctype'=>'multipart/form-data'])!!}
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Category Name</label>
                <div class="col-sm-10">
                    <select name="categoryId" class="form-control">
                        @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->categoryName}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Blog Title</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="blogTitle">
                    <span class="text-danger">{{$errors->has('blogTitle')?$errors->first('blogTitle'):''}}</span>
                </div>
            </div>
            <div class="form-group">
                <label for="inputpassword3" class="col-sm-2 control-label">Blog Short Description</label>
                <div class="col-sm-10">
                    <textarea class="form-control" name="blogShortDescription" rows="4"></textarea>
                    <span class="text-danger">{{$errors->has('blogShortDescription')?$errors->first('blogShortDescription'):''}}</span>
                </div>
            </div>
            <div class="form-group">
                <label for="inputpassword3" class="col-sm-2 control-label">Blog Long Description</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="editor" name="blogLongDescription" rows="10"></textarea>
                    <span class="text-danger">{{$errors->has('blogLongDescription')?$errors->first('blogLongDescription'):''}}</span>
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Blog Image</label>
                <div class="col-sm-10">
                    <input type="file"  name="blogImage" accept="image/*"/>
                </div>
            </div>
            <div class="form-group">
                <label for="inputpassword3" class="col-sm-2 control-label">Publication Status</label>
                <div class="col-sm-10 radio">
                    <label><input type="radio" checked name="publicationStatus" value="1"/>Published</label>
                    <label><input type="radio"  name="publicationStatus" value="0"/>Unpublished</label>
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-offset-2 col-lg-10">
                    <input type="submit" name="btn" class="btn btn-success btn-block " value="Save Blog Info"/>
                </div>
            </div>
            {!!Form::close()!!}
        </div>
    </div>
    
</div>
@endsection