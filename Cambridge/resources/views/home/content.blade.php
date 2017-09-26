<button type="button" class="hamburger is-closed" data-toggle="offcanvas">
    <span class="hamb-top"></span>
    <span class="hamb-middle"></span>
    <span class="hamb-bottom"></span>
</button>

<div class="container">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2" style="">

            <div class="dropdown" id="dropdown" style="z-index: 50;">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="userid" role="button" aria-expanded="false">
                    {{ Auth::user()->name }} <span class="caret"></span>
                </a>

                <ul class="dropdown-menu" id="logoutid" role="menu">
                    <li>
                        <a id="logout" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">
                            Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul>
            </div>
            <div class="address">
                <h2 class="head1">Cambridge International School</h2>
                <p class="head2">148 Aluthmawatha Rd, Colombo 00130</p>
                <p class="head3"> 011 4 618705</p>
                <img src="{{asset('assets/image/home/logo.png')}}" class="logo">
            </div>

        </div>
    </div>
</div>