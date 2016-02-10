<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <ul>
                    <li><a href="{{ URL::route('home') }}">{{ trans('footer.homepage') }}</a></li>
                    <li><a href="">{{ trans('footer.howdoesitwork') }}</a></li>
                    <li><a href="">{{ trans('footer.press') }}</a></li>
                    <li><a href="">{{ trans('footer.termsofuse') }}</a></li>
                    <li><a href="">{{ trans('footer.privacypolicy') }}</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <ul>
                    <li><a href="{{ URL::route('admin::index') }}">{{ trans('footer.administration') }}</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <span class="text-muted">
                    {{ trans('footer.poweredby') }}
                    <br/>
                    <a href="https://github.com/openknowledgebe/W4P">
                        <img src="{{ URL::to('assets/logo/logo_w4p_small.png') }}" width="100" />
                    </a>
                </span>
            </div>
        </div>
    </div>
</footer>