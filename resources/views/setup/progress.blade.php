<div class="setup-progress">
    <ul>
        <li @if (!isset($step)) class="active" @endif>

                {{ trans('setup.steps.welcome') }}
        </li>
        <li @if (isset($step) && $step == 1) class="active" @endif>

                {{ trans('setup.steps.admin') }}
        </li>
        <li @if (isset($step) && $step == 2) class="active" @endif>
                {{ trans('setup.steps.platform') }}
        </li>
        <li @if (isset($step) && $step == 3) class="active" @endif>
                {{ trans('setup.steps.organisation') }}
        </li>
        <li @if (isset($step) && $step == 4) class="active" @endif>
                {{ trans('setup.steps.project') }}
        </li>
        <li @if (isset($step) && $step == 5) class="active" @endif>
                {{ trans('setup.steps.mail') }}
        </li>
        <li @if (isset($step) && $step == 6) class="active" @endif>
                {{ trans('setup.steps.finish') }}
        </li>
    </ul>
</div>
