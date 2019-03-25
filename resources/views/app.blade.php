@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
    <aside class="sidebar-container ol-xl-3 col-md-3">
        <div class="sidebar">
                <header class="search">
                        <input type="text" name="search" id="search" />
                        <a href="#">+</a>
                </header>

                <div class="btn-group">
                    <a class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Tags
                    </a>
                    <div class="dropdown-menu scrollable-menu">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </div>

                <ul class="notes-container">
                        <li class="note">
                            <a href="#">
                                <h5>Lorem ipsum dolor sit amet</h5>
                                <p class="caption">Vivamus maximus at ipsum imperdiet luctus. Integer fermentum justo dolor,  </p>
                            </a>
                        </li>

                        <li class="note">
                            <a href="#">
                                <h5>Lorem ipsum dolor sit amet</h5>
                                <p class="caption">Vivamus maximus at ipsum imperdiet luctus. Integer fermentum justo dolor,  </p>
                            </a>
                        </li>

                        <li class="note">
                            <a href="#">
                                <h5>Lorem ipsum dolor sit amet</h5>
                                <p class="caption">Vivamus maximus at ipsum imperdiet luctus. Integer fermentum justo dolor,  </p>
                            </a>
                        </li>

                        <li class="note">
                            <a href="#">
                                <h5>Lorem ipsum dolor sit amet</h5>
                                <p class="caption">Vivamus maximus at ipsum imperdiet luctus. Integer fermentum justo dolor,  </p>
                            </a>
                        </li>

                        <li class="note">
                            <a href="#">
                                <h5>Lorem ipsum dolor sit amet</h5>
                                <p class="caption">Vivamus maximus at ipsum imperdiet luctus. Integer fermentum justo dolor,  </p>
                            </a>
                        </li>

                        <li class="note">
                                <a href="#">
                                        <h5>Lorem ipsum dolor sit amet</h5>
                                        <p class="caption">Vivamus maximus at ipsum imperdiet luctus. Integer fermentum justo dolor,  </p>
                                </a>
                        </li>

                        <li class="note">
                                <a href="#">
                                        <h5>Lorem ipsum dolor sit amet</h5>
                                        <p class="caption">Vivamus maximus at ipsum imperdiet luctus. Integer fermentum justo dolor,  </p>
                                </a>
                        </li>

                        <li class="note">
                                <a href="#">
                                        <h5>Lorem ipsum dolor sit amet</h5>
                                        <p class="caption">Vivamus maximus at ipsum imperdiet luctus. Integer fermentum justo dolor,  </p>
                                </a>
                        </li>

                        <li class="note">
                                <a href="#">
                                        <h5>Lorem ipsum dolor sit amet</h5>
                                        <p class="caption">Vivamus maximus at ipsum imperdiet luctus. Integer fermentum justo dolor,  </p>
                                </a>
                        </li>
                </ul>
        </div>

    </aside>
    <main class="ol-xl-9 col-md-9">
        <header class="toolbar">
                <ul class="left-tools">
                    <li><a href="#"><img title="Info" src="/images/icons/info.svg" alt="info"></a></li>
                    <li><a href="#"><img title="Favourite" src="/images/icons/pushpin.svg" alt="Favourite"></a></li>
                    <li><a href="#"><img title="Delete" src="/images/icons/bin.svg" alt="Delete"></a></li>
                    <li><a href="#"><img title="Encrypt" src="/images/icons/lock.svg" alt="Encrypt"></a></li>
                    <li><a href="#"><img title="Remind" src="/images/icons/alarm.svg" alt="Remind"></a></li>
                    <li><a href="#"><img title="History" src="/images/icons/history.svg" alt="History"></a></li>
                </ul>
                <div class="account">
                    <a href="#">Nick Klein</a>
                </div>
        </header>
        <div class="notes"></div>
    </main>
    </div>
</div>
@endsection
