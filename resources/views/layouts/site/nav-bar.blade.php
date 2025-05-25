<nav class="navbar navbar-expand-lg navbar-light my-bg-light mx-auto" style="padding-top: 20px; padding-bottom: 20px;">
    <a class="navbar-brand">
        <img src="{{ asset('images/anardoni-logo-78x21.png') }}" alt="anardoni">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">

        <ul class="navbar-nav ml-auto mt-xs-3 mt-sm-3 mt-md-3 mt-lg-0 mt-xl-0 mb-xs-3 mb-sm-3 mb-md-3 mb-lg-0 mb-xl-0">


            @foreach($mainMenus as $mainMenu)
                @if($mainMenu->is_active ==  \App\Enums\IsActive::Yes)
                    <li class="nav-item px-2 py-xs-2 py-sm-2 py-md-2 py-lg-0 py-xl-0 active">
                        <a class="nav-link font-size-14" href="{{ $mainMenu->value }}" target="_blank">{{ $mainMenu->key }}<span
                                class="sr-only">
                            @if($mainMenu->id == 1)
                                    (current)
                                @endif
                        </span></a>
                    </li>
                @endif
            @endforeach

        </ul>


        <ul class="navbar-nav ml-auto">
            <li class="nav-item mr-lg-3 mr-xl-3 align-self-center">

                <a class="nav-link my-btn-danger px-4 text-center " target="_blank" href="https://developer.anardoni.com/sign-up">
                    ایجاد حساب کاربری توسعه دهنده</a>
            </li>
            <li class="nav-item ml-2 mt-sm-2 mt-2 mt-md-2 mt-lg-0 mt-xl-0 align-self-center">

                <a class="nav-link my-btn-light px-4 text-center text-grey-6" target="_blank" href="https://developer.anardoni.com/sign-in">
                    ورود به حساب کاربری
                </a>
            </li>
        </ul>

    </div>
</nav>
