<div class="setup-progress">
    <ul>
        <li @if (!isset($step)) class="active" @endif><a href="/setup/">{{ trans('setup.steps.welcome') }}</a></li>
        <li @if (isset($step) && $step == 1) class="active" @endif><a href="/setup/1">{{ trans('setup.steps.admin') }}</a></li>
        <li @if (isset($step) && $step == 2) class="active" @endif><a href="/setup/2">{{ trans('setup.steps.platform') }}</a></li>
        <li @if (isset($step) && $step == 3) class="active" @endif><a href="/setup/3">{{ trans('setup.steps.organisation') }}</a></li>
        <li @if (isset($step) && $step == 4) class="active" @endif><a href="/setup/4">{{ trans('setup.steps.project') }}</a></li>
        <li @if (isset($step) && $step == 5) class="active" @endif><a href="/setup/5">{{ trans('setup.steps.mail') }}</a></li>
        <li @if (isset($step) && $step == 6) class="active" @endif><a href="/setup/6">{{ trans('setup.steps.finish') }}</a></li>
    </ul>
</div>
