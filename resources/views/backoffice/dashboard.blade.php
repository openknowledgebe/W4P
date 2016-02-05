@extends('layouts.backoffice')

@section('title', trans('backoffice.dashboard'))

@section('content')
    <h1>{{ trans('backoffice.dashboard') }}</h1>
    <hr/>
    <div class="row">
        <div class="col-md-9">
            <h3>Latest 5 donations</h3>
            <hr/>
            <table class="table table-responsive">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Units pledged</th>
                    <th>Amount pledged</th>
                    <th>Confirmed</th>
                </tr>
                @foreach ($donations as $donation)
                    <tr>
                        <td>{{ $donation->id }}</td>
                        <td>{{ $donation->first_name }} {{ $donation->last_name }}<br/>
                            {{ $donation->email }}
                        </td>
                        <td>
                            @foreach ($donation->donationContents() as $kind => $kindContent)
                                <strong>{{ trans('backoffice.' . $kind) }}</strong><br/>
                                @foreach ($kindContent as $item)
                                    {{ $item["count"] }}x {{ $item["name"] }}<br/>
                                @endforeach
                            @endforeach
                        </td>
                        <td>
                            @if ($donation->currency > 0)
                                €{{ $donation->currency }}
                            @else
                                —
                            @endif
                        </td>
                        <td>
                            {{ $donation->confirmed }}
                        </td>
                    </tr>
                @endforeach
                </thead>
            </table>
            <a class="btn btn-default" href="{{ URL::route('admin::donations') }}">Show all donations</a>
        </div>
        <div class="col-md-3">
            <h3>Total € contributed</h3>
            <hr/>
            <ul>
                <li>
                    €{{ $contributed }} (with a goal of €{{ $project->currency }})
                </li>
            </ul>
            <h3>Goal progress</h3>
            <hr/>
            <ul>
                @if ($project->currency > 0)
                    <li>
                        <strong>{{ trans("backoffice.currency") }}</strong> ({{$contributedPercentage}}% {{ trans('home.complete') }})
                    </li>
                @endif
                @foreach ($donationKinds as $kind)
                    @if ($kind != "currency" && isset($donationTypes[$kind]) && count($donationTypes[$kind]) > 0)
                        <li>
                            <strong>{{ trans("backoffice." . $kind) }}</strong>
                            ({{ $percentages[$kind]["percentage"] }}% {{ trans('home.complete') }})
                            <ul>
                                @foreach ($percentages[$kind]['items'] as $item)
                                <li>
                                    <strong>{{ $item["type"] }}</strong>
                                    <br/> {{ $item["total"] }} / {{ $item["goal"] }}
                                </li>
                                @endforeach
                            </ul>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>

    </div>

@endsection