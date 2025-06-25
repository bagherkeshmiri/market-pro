<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
        <a class="navbar-brand" href="{{ route('site.home') }}">پیکسل دونی</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
                aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="icon icon-menu"></span>
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active"><a href="{{ route('site.home') }}" class="nav-link">خانه</a></li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">محصولات</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown04">
                        @foreach($menus as $menu)
                            @if($menu->children->isNotEmpty())
                                <div class="dropdown-submenu">
                                    <a class="dropdown-item dropdown-toggle" href="#">{{ $menu->name }}</a>
                                    <div class="dropdown-menu">
                                        @foreach($menu->children as $child)
                                            @if($child->children->isNotEmpty())
                                                <div class="dropdown-submenu">
                                                    <a class="dropdown-item dropdown-toggle" href="#">{{ $child->name }}</a>
                                                    <div class="dropdown-menu">
                                                        @foreach($child->children as $grandchild)
                                                            <a class="dropdown-item" href="{{ route('site.products',['category' => $menu->id]) }}">{{ $grandchild->name }}</a>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @else
                                                <a class="dropdown-item" href="{{ route('site.products',['category' => $menu->id]) }}">{{ $child->name }}</a>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            @else
                                <a class="dropdown-item" href="{{ route('site.products',['category' => $menu->id]) }}">{{ $menu->name }}</a>
                            @endif
                        @endforeach
                    </div>
                </li>
                <li class="nav-item"><a href="#" class="nav-link">درباره با ما</a></li>
                <li class="nav-item"><a href="{{ route('site.contact') }}" class="nav-link">تماس با ما</a></li>

            </ul>

            <ul class="navbar-nav ">
                <li class="nav-item cta cta-colored"><a href="#" class="nav-link"><span class="icon-shopping_cart"></span></a></li>
                <li class="nav-item">
                    <a href="#" class="nav-link"> ورود / عضویت</a>
                </li>
            </ul>

        </div>
    </div>
</nav>
