@extends('layouts.core')

@section('title', 'Project Setup | Setup')

@section('content')
    <div class="row">
        <div class="col-md-3">
            @include('setup.sidebar')
        </div>
        <div class="col-md-6">

            <h1>Project Setup</h1>
            <hr/>
            <p>Next up, we will allow you to set up the project. We only need a project name for now.</p>

            @if($errors->any())
                <div class="alert alert-danger" role="alert">
                    <strong>Oops!</strong>
                    {{$errors->first()}}
                </div>
            @endif

            <form method="POST" action="/setup/3" files="true" enctype="multipart/form-data">
                <input name="_method" type="hidden" value="POST">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="projectTitle">Title of your project</label>
                    <input type="text" class="form-control" name="projectTitle" placeholder="e.g. Apps for Y 20XX"
                           value=
                           "<?php
                           if (Request::old('projectTitle')) {
                               echo Request::old('projectTitle');
                           } else {
                               echo $data["projectTitle"];
                           }
                           ?>"
                    >
                    <span id="helpBlock" class="help-block">This is the title of your project. We recommend keeping it short and sweet.</span>
                </div>
                <div class="form-group">
                    <label for="projectBrief">Brief description</label>
                    <input type="text" class="form-control" name="projectBrief" placeholder="e.g. Apps for Y is looking for coaches and a budget"
                           value=
                           "<?php
                           if (Request::old('projectBrief')) {
                               echo Request::old('projectBrief');
                           } else {
                               echo $data["projectBrief"];
                           }?>"
                    >
                    <span id="helpBlock" class="help-block">Explain in less than 255 characters what your project is all about.</span>
                </div>
            <hr/>

            <a class="btn btn-primary btn-sm" href="/setup/2">&larr; Back</a>
            <button type="submit" class="btn btn-primary btn-sm pull-right">Next &rarr;</button>
            </form>

        </div>
    </div>
@endsection