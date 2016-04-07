<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                @if (property_exists($settings, 'legal'))
                    <div class="small-legal">
                        <strong>{{ $settings->org }}</strong><br/>
                        <br/>
                        <strong>{{ trans('generic.address') }}:</strong><br/> {!! nl2br($settings->legal->address) !!}<br/>
                        <strong>{{ trans('generic.vat') }}:</strong> {{ $settings->legal->vat }}<br/>
                        <strong>{{ trans('generic.contact') }}:</strong> {{ $settings->legal->email }}
                    </div>
                @endif
            </div>
            <div class="col-md-3">
                <ul>
                    <li class="subtitle">{{ trans('footer.about') }}</li>
                    <li><a href="{{ URL::route('home') }}">{{ trans('footer.homepage') }}</a></li>
                    <li><a href="{{ URL::route('how') }}">{{ trans('footer.howdoesitwork') }}</a></li>
                    <li><a href="{{ URL::route('press') }}">{{ trans('footer.press') }}</a></li>
                    <li><a href="{{ URL::route('terms') }}">{{ trans('footer.termsofuse') }}</a></li>
                    <li><a href="{{ URL::route('privacy') }}">{{ trans('footer.privacypolicy') }}</a></li>
                </ul>
            </div>
            <div class="col-md-3">
                <ul>
                    <li class="subtitle">{{ trans('footer.projects') }}</li>
                    @if ($archived_count > 0)
                    <li><a href="{{ URL::route('previous') }}">{{ trans('footer.previous_projects') }}</a></li>
                    @endif
                    <li><a href="{{ URL::route('admin::index') }}">{{ trans('footer.administration') }}</a></li>
                </ul>
            </div>
            <div class="col-md-3">
                <ul>
                    <li class="subtitle">{{ trans('footer.poweredby') }}</li>
                    <li><a href="https://github.com/openknowledgebe/W4P">
                            <img src="{{ URL::to('assets/logo/logo_w4p_small.png') }}" width="130" />
                        </a></li>
                </ul>
                <span class="text-muted">
                    <br/>
                </span>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                @if ($settings->copyright == null)
                    <p class="gray">&copy; {{ date('Y') }} {{ $settings->org }}</p>
                @else
                    {{ $settings->copyright }}
                @endif
            </div>
        </div>
    </div>
</footer>