@extends('layouts.app')

@section('content')

<a href="#" id="add-more">+</a>
<div class="container-fluid">
    <div class="container-row row">
    <aside class="sidebar-container ol-xl-2 col-md-2">
        <div class="sidebar">
                <search-sidebar></search-sidebar>
                <notes-sidebar></notes-sidebar>
        </div>

    </aside>
    <main class="ol-xl-10 col-md-10">
        <header class="toolbar row">
                <ul class="left-tools ol-xl-10 col-md-10">
                    <li><a href="#"><img title="Info" src="{{url('/')}}/images/icons/info.svg" alt="info"></a></li>
                    <li><a href="#"><img title="Favourite" src="{{url('/')}}/images/icons/pushpin.svg" alt="Favourite"></a></li>
                    <li><a href="#"><img title="Delete" src="{{url('/')}}/images/icons/bin.svg" alt="Delete"></a></li>
                    <li><a href="#"><img title="Encrypt" src="{{url('/')}}/images/icons/lock.svg" alt="Encrypt"></a></li>
                    <?php /*
                    <li><a href="#"><img title="Remind" src="{{url('/')}}/images/icons/alarm.svg" alt="Remind"></a></li>
                    <li><a href="#"><img title="History" src="{{url('/')}}/images/icons/history.svg" alt="History"></a></li>
                    */ ?>
                </ul>
                <div class="account ol-xl-2 col-md-2">
                    <a href="#" class="pull-right"><img src="{{url('/')}}/images/profile_full.jpg" alt="nick klein"></a>
                </div>
        </header>
        <div class="tags">
            <tags></tags>
        </div>
        <div class="notes-container">
                <div class="content">
                    <notes-title></notes-title>
                    <tinymce></tinymce>
                </div>
        </div>
    </main>
    </div>
</div>
@endsection
