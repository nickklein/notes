<aside class="col-4">
    <ul>
        <li class="{{ Request::is('settings/account') ? 'active' : '' }}">
        <a href="{{route('settings/account')}}">Account</a>
        </li>
        <li class="{{ Request::is('settings/password') ? 'active' : '' }}">
            <a href="{{route('settings/password')}}">Password</a>
        </li>
    </ul>
</aside>

