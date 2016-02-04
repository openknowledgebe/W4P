@extends('layouts.backoffice')

@section('title', trans('backoffice.dashboard'))

@section('content')
    <h1>{{ trans('backoffice.donations') }}</h1>
    <hr/>
    <table class="table table-responsive">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Units pledged</th>
                <th>Transaction ID</th>
                <th>Amount pledged</th>
                <th>Transaction Status</th>
                <th>Confirmed</th>
            </tr>
            @foreach ($donations as $donation)
                <tr>
                    <td>{{ $donation->id }}</td>
                    <td>{{ $donation->first_name }} {{ $donation->last_name }}</td>
                    <td>{{ $donation->email }}</td>
                    <td></td>
                    <td>{{ $donation->payment_id }}</td>
                    <td>
                        @if ($donation->currency > 0)
                            €{{ $donation->currency }}
                        @else
                            —
                        @endif
                    </td>
                    <td>
                        @if ($donation->currency > 0)
                            {{ trans('donation.payment_status.' . $donation->payment_status) }}
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

@endsection