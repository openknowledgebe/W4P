@extends('layouts.backoffice')

@section('title', trans('backoffice.dashboard'))

@section('content')
    <h1>{{ trans('backoffice.dashboard') }}</h1>
    <hr/>
    <div class="row">
        <div class="col-md-9">
            <h3>{{ trans('backoffice.dashboard_page.latest_donations') }}</h3>
            <hr/>
            <table class="table table-responsive">
                <thead>
                <tr>
                    <th>#</th>
                    <th>{{ trans('backoffice.dashboard_page.name') }}</th>
                    <th>{{ trans('backoffice.dashboard_page.units_donated') }}</th>
                    <th>{{ trans('backoffice.dashboard_page.amount_donated') }}</th>
                    <th>{{ trans('backoffice.dashboard_page.confirmed') }}</th>
                    <th>{{ trans('backoffice.dashboard_page.has_message') }}</th>
                    <th></th>
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
                            @if ($donation->confirmed != null)
                                ✓
                            @endif
                        </td>
                        <td>
                            @if ($donation->message != null)
                                ✓
                            @endif
                        </td>
                        <td>
                            <a class="btn btn-default btn-sm" href="{{ URL::route('donate::info', ['code' => $donation->secret_url, 'email' => $donation->email]) }}">Go to page</a>
                        </td>
                    </tr>
                @endforeach
                </thead>
            </table>
            <a class="btn btn-default" href="{{ URL::route('admin::donations') }}">{{ trans('backoffice.dashboard_page.show_all_donations') }}</a>
        </div>
        <div class="col-md-3">
            <h4>{{ trans('backoffice.dashboard_page.total_donors') }}</h4>
            <ul>
                <li>{{ $donorCount }} {{ trans('backoffice.dashboard_page.unique_donors') }}</li>
                <li><a href="{{ URL::route('admin::userExport') }}" class="btn btn-default btn-sm">Download CSV</a></li>
            </ul>

            <h4>{{ trans('backoffice.dashboard_page.total_contributed') }}</h4>
            <ul>
                <li>
                    €{{ $contributed }} ({{ trans('backoffice.dashboard_page.with_goal_of') }} €{{ $project->currency }})
                </li>
            </ul>
            <h4>{{ trans('backoffice.dashboard_page.goal_progress') }}</h4>
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