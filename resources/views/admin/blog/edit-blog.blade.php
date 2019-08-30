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
            {!!Form::open(['route'=>'/update-blog','method'=>'POST','class'=>'form-horizontal','enctype'=>'multipart/form-data','name'=>'editForm'])!!}
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
                    <input type="text" class="form-control" name="blogTitle" value="{{$blog->blogTitle}}">
                    <input type="hidden" class="form-control" name="id" value="{{$blog->id}}">
                    <span class="text-danger">{{$errors->has('blogTitle')?$errors->first('blogTitle'):''}}</span>
                </div>
            </div>
            <div class="form-group">
                <label for="inputpassword3" class="col-sm-2 control-label">Blog Short Description</label>
                <div class="col-sm-10">
                    <textarea class="form-control" name="blogShortDescription" rows="4">{{$blog->blogShortDescription}}</textarea>
                    <span class="text-danger">{{$errors->has('blogShortDescription')?$errors->first('blogShortDescription'):''}}</span>
                </div>
            </div>
            <div class="form-group">
                <label for="inputpassword3" class="col-sm-2 control-label">Blog Long Description</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="editor" name="blogLongDescription" rows="10">{{$blog->blogLongDescription}}</textarea>
                    <span class="text-danger">{{$errors->has('blogLongDescription')?$errors->first('blogLongDescription'):''}}</span>
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Blog Image</label>
                <div class="col-sm-10">
                    <input type="file"  name="blogImage" accept="image/*"/>
                    <img src="{{asset($blog->blogImage)}}" alt="" height="100" width="120"/>
                </div>
            </div>
            <div class="form-group">
                <label for="inputpassword3" class="col-sm-2 control-label">Publication Status</label>
                <div class="col-sm-10 radio">
                    <label><input type="radio"  name="publicationStatus"  value="1"{{$blog->publicationStatus == 1 ? 'checked':''}}/>Published</label>
                    <label><input type="radio"  name="publicationStatus" value="0"{{$blog->publicationStatus == 0 ? 'checked':''}}/>Unpublished</label>
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-offset-2 col-lg-10">
                    <input type="submit" name="btn" class="btn btn-success btn-block " value="Update Blog Info"/>
                </div>
            </div>
            {!!Form::close()!!}
        </div>
    </div>
    
</div>
<script>
    document.forms['editForm'].elements['categoryId'].value='{{$blog->categoryId}}';
</script>
@endsection
