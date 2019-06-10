<div class="main-menu">

    <div class="main-menu__content">

        <ul class="main-menu__menu-left">
            <li>
                <a href="/" class="main-menu__item main-menu__item--menu">{{ trans('navbar.ourMenu') }}</a>
            </li>
        </ul>

        <ul class="main-menu__menu-middle">
            <li>
                <button class="main-menu__item main-menu__item--wrote-us">{{ trans('navbar.wroteUs') }}</button>
            </li>
            <li>
                <a href="/order" class="main-menu__item main-menu__item--order">{{ trans('navbar.order') }}</a>
            </li>
        </ul>
        <ul class="main-menu__menu-right">
            <li>
                <div class="language-switcher">
                    <ul class="language-switcher-in">
                        <li class="language-switcher__clicker"></li>
                        @foreach(config('translatable.locales') as $lang)
                            <li class="language-switcher__item @if(App::getLocale() == $lang) language-switcher__item--selected @endif">
                                <a href="{{url('language/'.$lang)}}">{{$lang}}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </li>
            <li>
                <a class="main-menu__item main-menu__item--logout" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    {{ trans('navbar.logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
    <div class="main-menu__mobile-btn">
        <div class="main-menu__mobile-btn-line"></div>
        <div class="main-menu__mobile-btn-line"></div>
        <div class="main-menu__mobile-btn-line"></div>
    </div>
</div>
