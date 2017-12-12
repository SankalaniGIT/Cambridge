
<div class="dropdown" id="dropdown" style="z-index: 50;float: right;margin-right: 1007px">
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