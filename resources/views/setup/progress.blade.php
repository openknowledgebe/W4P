<ul>
    <li>
        @if (!isset($step))<strong>@endif
        {{ trans('setup.steps.welcome') }} @if (isset($step)) &#10003; @endif
        @if (!isset($step))</strong>@endif
    </li>
    <li>
        @if (isset($step) && $step == 1)<strong>@endif
            {{ trans('setup.steps.admin') }} @if(W4P\Models\Setting::exists('pwd')) &#10003; @endif
        @if (isset($step) && $step == 1)</strong>@endif
    </li>
    <li>
        @if (isset($step) && $step == 2)<strong>@endif
            {{ trans('setup.steps.platform') }}
            @if(
                W4P\Models\Setting::exists('platform.name'))
                &#10003;
            @endif
        @if (isset($step) && $step == 2)</strong>@endif
    </li>
    <li>
        @if (isset($step) && $step == 3)<strong>@endif
            {{ trans('setup.steps.project') }}
            @if(
                W4P\Models\Setting::exists('project.title')
                && W4P\Models\Setting::exists('project.brief'))
                &#10003;
            @endif
        @if (isset($step) && $step == 3)</strong>@endif
    </li>
    <li>
        @if (isset($step) && $step == 4)<strong>@endif
            {{ trans('setup.steps.mail') }}
            @if(
                W4P\Models\Setting::exists('mail.valid'))
                &#10003;
            @endif
            @if (isset($step) && $step == 4)</strong>@endif
    </li>
    <li>
        @if (isset($step) && $step == 5)<strong>@endif
        {{ trans('setup.steps.finish') }}
            @if (isset($step) && $step == 5)</strong>@endif
    </li>
</ul>