@extends('layouts.app')

@section('content')

<create-note></create-note>
<div class="container-fluid">
    <div class="container-row row">
    <aside class="sidebar-container col-xl-2 col-lg-3 col-md-4 col-sm-4">
        <div class="sidebar">
                <search-sidebar></search-sidebar>
                <notes-sidebar></notes-sidebar>
        </div>
    </aside>
    <main class="col-xl-10 col-lg-9 col-md-8 col-sm-8">
        <header class="toolbar row">
            <toolbar></toolbar>

            <div class="account col-xl-2 col-md-2 col-sm-4">
                <div class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        <img src="/images/profile_full.jpg" alt="nick klein"> <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
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
            <tags></tags>
        </div>
        <div class="notes-container">
            <div class="content">
                <tinymce></tinymce>
            </div>
        </div>
    </main>
    </div>
</div>
@endsection
