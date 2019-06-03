@extends('layouts.app')

@section('title', 'Notes')

@section('content')

<create-note></create-note>
<div class="container-fluid">
    <div class="container-row row">
    <aside class="sidebar-container animate">
        <div class="sidebar">
                <search-sidebar></search-sidebar>
                <notes-sidebar></notes-sidebar>
        </div>
    </aside>
    <main class="main-wrap animate">
        <header class="toolbar row">
            <notes-toolbar></notes-toolbar>

            <div class="account col-xl-2 col-md-2 col-sm-4">
                <div class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->email }}<span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-bottom" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="">
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
            <notes-tags></notes-tags>
        </div>
        <div class="notes-container">
            <div class="content">
                <notes-tinymce></notes-tinymce>
            </div>
        </div>
    </main>
    </div>
</div>
@endsection
