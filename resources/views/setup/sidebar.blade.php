<ul>
    <li>
        @if (!isset($step))<strong>@endif
        Welcome @if (isset($step)) &#10003; @endif
        @if (!isset($step))</strong>@endif
    </li>
    <li>
        @if (isset($step) && $step == 1)<strong>@endif
        Administration Setup @if(W4P\Models\Setting::exists('pwd')) &#10003; @endif
        @if (isset($step) && $step == 1)</strong>@endif
    </li>
    <li>
        @if (isset($step) && $step == 2)<strong>@endif
        Platform Setup
        @if (isset($step) && $step == 2)</strong>@endif
    </li>
    <li>
        @if (isset($step) && $step == 3)<strong>@endif
        Project Setup
        @if (isset($step) && $step == 3)</strong>@endif
    </li>
    <li>
        Get Started
    </li>
</ul>