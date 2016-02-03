@extends('layouts.core')

@section('title', trans('generic.homepage'))

@section('content')
    <div class="project">
        <!-- Banner -->
        @if (file_exists(public_path() . "/project/banner.png"))
            <div class="home-banner" style="background-image: url('{{ URL::to("/project/banner.png") }}');"></div>
        @endif
        @if (!$donationsDisabled)
        <!-- Donation page -->
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- Donation header block -->
                    <h1>{{ trans('donation.title') }}</h1>
                    <p>{{ trans('donation.description') }}</p>
                    <hr/>
                </div>
                <div class="col-md-6 col-md-push-3">
                    @if($errors->any())
                        <div class="alert alert-danger" role="alert">
                            <strong>{{ trans('setup.generic.oops') }}</strong>
                            {{$errors->first()}}
                        </div>
                    @endif
                    <form method="POST" action="{{ URL::route('donate::details') }}" enctype="multipart/form-data">
                        <input name="_method" type="hidden" value="POST">
                        {{ csrf_field() }}

                        @if ($project->currency > 0)
                        <div class="form-group">
                            <label>
                                {{ trans('backoffice.currency') }}
                            </label>
                            <input type="number" step="any"
                                   class="form-control" id="currency" name="currency"
                                   placeholder="Pledge amount" min="0">
                        </div>
                        <hr/>
                        @endif

                        <div class="form-group">
                            <!-- Donation options -->
                            @foreach ($donationTypes as $donationType)
                                    <!-- Donation type -->
                            @foreach ($donationType as $option)
                                <label>
                                    {{ $option['name'] }} ({{ trans('backoffice.' . $option['kind']) }})
                                </label>
                                <p>
                                    <strong>Description</strong>: {{ $option['description'] }}<br/>
                                </p>
                                I am able to provide <input type="number" class="form-control" id="pledge_{{str_slug($option['id'])}}" name="pledge_{{str_slug($option['id'])}}"
                                        placeholder="Pledge amount" min="0"> units.
                            <p>
                                <strong>1 unit</strong>: {{ $option['unit_description'] }}
                            </p>
                            @endforeach
                            @endforeach
                        </div>
                        <button type="submit" class="btn4 pull-right">{{ trans('setup.generic.next') }} &rarr;</button>
                    </form>
                </div>
            </div>
        </div>
        @else
            <div class="row">
                <div class="col-md-6 col-md-push-3">
                    <h1>{{ trans('donation.no_donation_options.title') }}</h1>
                    <p>{{ trans('donation.no_donation_options.description') }}</p>
                </div>
            </div>
        @endif

    </div>
@endsection