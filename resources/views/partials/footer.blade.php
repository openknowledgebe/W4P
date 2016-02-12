<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-3">

            </div>
            <div class="col-md-3">
                <ul>
                    <li class="subtitle">About</li>
                    <li><a href="{{ URL::route('home') }}">{{ trans('footer.homepage') }}</a></li>
                    <li><a href="{{ URL::route('how') }}">{{ trans('footer.howdoesitwork') }}</a></li>
                    <li><a href="">{{ trans('footer.press') }}</a></li>
                    <li><a href="">{{ trans('footer.termsofuse') }}</a></li>
                    <li><a href="">{{ trans('footer.privacypolicy') }}</a></li>
                </ul>
            </div>
            <div class="col-md-3">
                <ul>
                    <li class="subtitle">Projects</li>
                    <li>Previous projects</li>
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
                <p class="gray">&copy; {{ date('Y') }}</p>
            </div>
        </div>
    </div>
</footer>