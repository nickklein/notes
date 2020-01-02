@extends('layouts.app')

@section('title', 'Notes')

@section('content')

<aside class="sidebar-wrapper">
    <notes-sidebar-search></notes-sidebar-search>
    <notes-sidebar-notes></notes-sidebar-notes>
</aside>
<main class="main-wrapper">
        <header class="toolbar row">
            <notes-main-toolbar></notes-main-toolbar>

            <div class="account">
                <div class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->email }}<span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-bottom" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('settings/account') }}">
                            Settings
                        </a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </header>

        <div class="tags">
            <notes-main-tags></notes-main-tags>
        </div>

        <div class="notes-container">
           <notes-main-tiptap></notes-main-tiptap>
        </div>
        <create-note></create-note>
</main>
@endsection