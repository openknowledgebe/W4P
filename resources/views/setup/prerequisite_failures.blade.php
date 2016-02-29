@extends('layouts.setup_simple')
@section('title', trans('setup.steps.admin') . " | " . trans('setup.generic.wizard'))
@section('content')
<div class="row">
    <div class="col-md-6 col-md-push-3">
        <h2>{{ trans('setup.preq.prerequisite_page_title') }}</h2>
        <p>{{ trans('setup.preq.prerequisite_page_description') }}</p>
        <hr/>
        <table class="table">
            <thead>
                <tr>
                    <th width="40%">{{ trans('setup.preq.prerequisite') }}</th>
                    <th width="60%">{{ trans('setup.preq.status') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($preqs as $preq)
                    <tr @if ($preq->fails) class="danger" @else class="success" @endif>
                        <td><strong>{{ $preq->title }}</strong></td>
                        <td>
                            {!! $preq->description !!}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection