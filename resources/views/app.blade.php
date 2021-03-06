@extends('layouts.app')

@section('title', 'Notes')

@section('content')

<aside class="sidebar-wrapper animate slideInSidebar">
    <notes-sidebar-search></notes-sidebar-search>
    <notes-sidebar-notes></notes-sidebar-notes>
</aside>
<main class="main-wrapper animate slideOutMain">
        <header class="toolbar">
            <notes-main-toolbar></notes-main-toolbar>

            <div class="account col-xl-3 col-lg-6 col-md-12 col-sm-12">
                <div class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        <img src="/images/profile_full.jpg">
                        <span class="caret"></span>
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
</main>
<create-note></create-note>

@endsection