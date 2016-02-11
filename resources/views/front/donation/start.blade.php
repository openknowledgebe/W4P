@extends('layouts.core')

@section('title', trans('generic.homepage'))

@section('content')
    <div class="project">
        <!-- Banner -->
        <div class="home-banner"
             @if (file_exists(public_path() . "/project/banner.png")) style="background-image: url('{{ URL::to("/project/banner.png") }}');" @endif>
        </div>
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
                </div>
            </div>
            <form method="POST" action="{{ URL::route('donate::details') }}" enctype="multipart/form-data">
                        <input name="_method" type="hidden" value="POST">
                        {{ csrf_field() }}

                @if ($project->currency > 0)
                    <div class="row">
                        <div class="col-md-2">
                            <p>Radial progress</p>
                        </div>
                        <div class="col-md-2">
                            <label>
                                {{ trans('backoffice.currency') }}
                            </label>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">

                                <input type="number" step="any"
                                       class="form-control" id="currency" name="currency"
                                       placeholder="Pledge amount" min="0">
                            </div>
                        </div>
                    </div>
                @endif
                @foreach ($donationTypes as $donationKind => $donationType)
                    <div class="row">
                        <div class="col-md-2">
                            <p>Radial progress</p>
                        </div>
                        <div class="col-md-10">
                            @foreach ($donationType as $key => $option)
                                <div class="about">
                                    Description: <i>{{ $option['description'] }}</i><br/>
                                    1x unit: <i>{{ $option['unit_description'] }}</i>
                                </div>
                                <div class="checkboxes_pledge_{{str_slug($option['id'])}}">
                                    @for ($i = 0; $i < $option["required_amount"]; $i++)
                                        @if ($i >= $percentages[$donationKind]["items"][$key]["total"] )
                                            <div class="checkbox"></div>@else<div class="checkbox disabled"></div>
                                        @endif
                                    @endfor
                                </div>
                                <a href="#" class="btn btn-default plus" data-key="{{ $option['id'] }}">+</a>
                                <a href="#" class="btn btn-default minus" data-key="{{ $option['id'] }}">-</a>
                                <input type="hidden" id="pledge_{{str_slug($option['id'])}}" name="pledge_{{str_slug($option['id'])}}">
                            @endforeach
                        </div>
                    </div>
                @endforeach
                <button type="submit" class="btn4 pull-right">{{ trans('setup.generic.next') }} &rarr;</button>
            </form>
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
@section('scripts')
    <script>
        var categories = {!! json_encode($percentages) !!};
    </script>
    <script src="{{ elixir("js/pledge.js") }}"></script>
@endsection