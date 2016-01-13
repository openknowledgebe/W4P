@extends('layouts.core')

@section('title', 'Platform Setup | Setup')

@section('content')
    <div class="row">
        <div class="col-md-3">
            @include('setup.sidebar')
        </div>
        <div class="col-md-6">

            <h1>Platform Setup</h1>
            <hr/>
            <p>Now, we will allow you to set up the information about the platform itself.</p>

            @if($errors->any())
                <div class="alert alert-danger" role="alert">
                    <strong>Oops!</strong>
                    {{$errors->first()}}
                </div>
            @endif

            <form method="POST" action="/setup/2">
                <input name="_method" type="hidden" value="POST">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="platformOwnerName">Platform owner</label>
                    <input type="text" class="form-control" name="platformOwnerName" placeholder="Platform owner name (e.g. Open Belgium)"
                           value=
                           "<?php
                           if (Request::old('platformOwnerName')) {
                               echo Request::old('platformOwnerName');
                           } else {
                               echo $data["platformOwnerName"];
                           }
                           ?>"
                    >
                    <span id="helpBlock" class="help-block">Who is responsible for this crowdfunding/gathering initiative?</span>
                </div>
                <div class="form-group">
                    <label for="platformOwnerLogo">Platform owner logo</label>
                    <input type="file" class="form-control" name="platformOwnerLogo" id="platformOwnerLogo">
                    <span id="helpBlock" class="help-block">You can upload a transparent logo here (required format: PNG).</span>
                </div>
                <div class=""></div>
                <div class="form-group">
                    <label for="GAID">Google Analytics ID</label>
                    <input type="text" class="form-control" name="analyticsId" placeholder="UA-XXXXXXX-X"
                           value=
                           "<?php
                           if (Request::old('analyticsId')) {
                               echo Request::old('analyticsId');
                           } else {
                               echo $data["analyticsId"];
                           }
                           ?>"
                    >
                    <span id="helpBlock" class="help-block">If you want to use Google Analytics you can enter your API key here.</span>
                </div>
                <div class="form-group">
                    <label for="password">Mollie API key</label>
                    <input type="text" class="form-control" name="mollieApiKey" placeholder="XXXX_XXXXXXXXXXXXXXXXXXX"
                           value="<?php
                           if (Request::old('mollieApiKey')) {
                               echo Request::old('mollieApiKey');
                           } else {
                               echo $data["mollieApiKey"];
                           }
                           ?>"
                    >
                    <span id="helpBlock" class="help-block">If you are going to accept payments, you will need to request a Mollie API key.</span>
                </div>
            <hr/>

            <a class="btn btn-primary btn-sm" href="/setup/1">&larr; Back</a>
            <button type="submit" class="btn btn-primary btn-sm pull-right">Next &rarr;</button>
            </form>

        </div>
    </div>
@endsection