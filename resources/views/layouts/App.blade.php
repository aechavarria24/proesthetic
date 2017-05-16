<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8"/>
    <title>Proesthetic</title>
    <meta name="description" content="Responsive, Bootstrap, BS4" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimal-ui" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- for ios 7 style, multi-resolution icon of 152x152 -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-barstyle" content="black-translucent">
    <link rel="apple-touch-icon" href="/images/logo.png">
    <meta name="apple-mobile-web-app-title" content="Flatkit">
    <!-- for Chrome on Android, multi-resolution icon of 196x196 -->
    <meta name="mobile-web-app-capable" content="yes">
    <link rel="shortcut icon" sizes="196x196" href="/images/logo.png">

    <!-- style -->
    <link rel="stylesheet" href="/css/animate.css/animate.min.css" type="text/css" />
    <link rel="stylesheet" href="/css/glyphicons/glyphicons.css" type="text/css" />
    <link rel="stylesheet" href="/plugins/font-awesome/css/font-awesome.min.css" type="text/css" />
    <link rel="stylesheet" href="/css/material-design-icons/material-design-icons.css" type="text/css" />
    <link rel="stylesheet" href="/css/ionicons/css/ionicons.min.css" type="text/css" />
    <link rel="stylesheet" href="/css/simple-line-icons/css/simple-line-icons.css" type="text/css" />
    <link rel="stylesheet" href="/css/bootstrap/dist/css/bootstrap.min.css" type="text/css" />
    <link rel="stylesheet" href="/plugins/pnotify/pnotify.custom.min.css" type="text/css" />
    <link rel="stylesheet" href="/plugins/dataTables/datatables.min.css"/>
    <link rel="stylesheet" href="/plugins/select2/css/select2.min.css"/>
    <link rel="stylesheet" href="/css/styles/app.css" type="text/css" />
    <link rel="stylesheet" href="/css/styles/style.css" type="text/css" />
    <link rel="stylesheet" href="/plugins/bootstrapdatepicker/css/bootstrap-datepicker.min.css"/>
    <link rel="stylesheet" href="/plugins/alert2/sweetalert2.min.css"/>


    <!-- endbuild -->
    <link rel="stylesheet" href="/css/styles/font.css" type="text/css" />
</head>

<body>
    <div class="app" id="app">

        <!-- ############ LAYOUT START-->

        <!-- aside -->
        <div id="aside" class="app-aside fade nav-dropdown black">
            <!-- fluid app aside -->
            <div class="navside dk" data-layout="column">
                <div class="navbar no-radius">
                    <!-- brand -->
                    <a href="/home" class="navbar-brand">
                        <span class="fa fa-home inline"></span>
                    </a>
                    <!-- / brand -->
                </div>
                <div data-flex class="hide-scroll">
                    <nav class="scroll nav-stacked nav-stacked-rounded nav-color">

                        <ul class="nav" data-ui-nav>
                            <li class="nav-header hidden-folded">
                                <span class="text-xs">Main</span>
                            </li>
                            <!-- / Panel -->
                            @if(session("permisos") != null)
                            @foreach(session("permisos") as $value)
                            @if($value["padre"] == 0)
                            <!-- / Panel -->
                            <li>
                                <a href="#" class="b-default" title="{{ $value['nombre']}}">
                                    <span class="nav-icon text-white no-fade">
                                        <i class="{{$value['icono']}}"></i>
                                    </span>
                                    <span class="nav-text">{{ $value["nombre"] }}</span>
                                </a>
                                <!-- / opciones -->
                                <ul class="nav-sub nav-mega nav-mega-3">
                                    @foreach(session("permisos") as $padre)
                                    @if($value["id"] == $padre["padre"])
                                    <li>
                                        <a href= "javascript:window.location='{{ $padre['url'] }}';">
                                            {{ $padre['nombre'] }}
                                        </a>
                                    </li>
                                    @endif
                                    @endforeach
                                </ul>
                            </li>
                            <!-- / Panel -->
                            @endif
                            @endforeach
                                @else
                                <script type="text/javascript">
                                setTimeout(function(){
                                    document.getElementById('logout-form').submit();
                                },100)
                                </script>
                                @endif
                                <!-- / Panel -->
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <!-- / -->

    <!-- content -->
    <div id="content" class="app-content box-shadow-z2 bg pjax-container" role="main">


        <div class="app-header white bg b-b">
            <div class="navbar" data-pjax>
                <a data-toggle="modal" data-target="#aside" class="navbar-item pull-left hidden-lg-up p-r m-a-0">
                    <i class="ion-navicon"></i>
                </a>
                <div class="navbar-item pull-left h5" id="pageTitle">
                    @yield('titulo')
                </div>
                    <!-- nabar right -->
                    <ul class="nav navbar-nav pull-right">
                        <li class="nav-item dropdown pos-stc-xs">
                            <a class="nav-link" data-toggle="dropdown">
                                <i class="ion-android-search w-24"></i>
                            </a>
                            <div class="dropdown-menu text-color w-md animated fadeInUp pull-right">
                                <!-- search form -->
                                <form class="navbar-form form-inline navbar-item m-a-0 p-x v-m" role="search">
                                    <div class="form-group l-h m-a-0">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search projects...">
                                            <span class="input-group-btn">
                                                <button type="submit" class="btn white b-a no-shadow"><i class="fa fa-search"></i></button>
                                            </span>
                                        </div>
                                    </div>
                                </form>
                                <!-- / search form -->
                            </div>
                        </li>
                        <li class="nav-item dropdown pos-stc-xs">
                            <a class="nav-link clear" data-toggle="dropdown">
                                <i class="ion-android-notifications-none w-24"></i>
                                <span class="label up p-a-0 danger"></span>
                            </a>
                            <!-- dropdown -->
                            <div class="dropdown-menu pull-right w-xl animated fadeIn no-bg no-border no-shadow">
                                <div class="scrollable" style="max-height: 220px">
                                    <ul class="list-group list-group-gap m-a-0">
                                        <li class="list-group-item dark-white box-shadow-z0 b">
                                            <span class="pull-left m-r">
                                                <img src="/images/a0.jpg" alt="..." class="w-40 img-circle">
                                            </span>
                                            <span class="clear block">
                                                Use awesome <a href="/#" class="text-primary">animate.css</a><br>
                                                <small class="text-muted">10 minutes ago</small>
                                            </span>
                                        </li>
                                        <li class="list-group-item dark-white box-shadow-z0 b">
                                            <span class="pull-left m-r">
                                                <img src="/images/a1.jpg" alt="..." class="w-40 img-circle">
                                            </span>
                                            <span class="clear block">
                                                <a href="/#" class="text-primary">Joe</a> Added you as friend<br>
                                                <small class="text-muted">2 hours ago</small>
                                            </span>
                                        </li>
                                        <li class="list-group-item dark-white text-color box-shadow-z0 b">
                                            <span class="pull-left m-r">
                                                <img src="/images/a2.jpg" alt="..." class="w-40 img-circle">
                                            </span>
                                            <span class="clear block">
                                                <a href="/#" class="text-primary">Danie</a> sent you a message<br>
                                                <small class="text-muted">1 day ago</small>
                                            </span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- / dropdown -->
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link clear" data-toggle="dropdown">
                                <span class="avatar w-32">
                                    <img src="/images/logo.png" class="w-full rounded" alt="..." title="Opciones">
                                </span>
                            </a>
                            <div class="dropdown-menu w dropdown-menu-scale pull-right">
                                <a class="dropdown-item" href="/profile.html">
                                    <span>Profile</span>
                                </a>
                                <a class="dropdown-item" href="/setting.html">
                                    <span>Settings</span>
                                </a>
                                <a class="dropdown-item" href="/app.inbox.html">
                                    <span>Inbox</span>
                                </a>
                                <a class="dropdown-item" href="/app.message.html">
                                    <span>Message</span>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a  class="dropdown-item" href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                class="">Cerrar Sesión</a>
                                <form id="logout-form" action="{{route('logout')}}" method="post" style="display:none;">
                                    {{csrf_field()}}
                                </form>
                            </div>
                        </li>
                    </ul>
                    <!-- / navbar right -->
                </div>
            </div>
            <div class="app-footer white bg p-a b-t">
                <div class="pull-right text-sm text-muted">Version 1.0.1</div>
                <span class="text-sm text-muted">&copy; Copyright.</span>
            </div>
            <div class="app-body">

                <!-- ############ PAGE START-->
                <!-- only need a height for layout 4 -->
                @yield('contenedor')
                <!-- ############ PAGE END-->

            </div>
        </div>
        <!-- / -->


        <!-- ############ SWITHCHER START-->

        <!-- ############ SWITHCHER END-->

        <!-- ############ LAYOUT END-->
    </div>

    <!-- build:js scripts/app.min.js -->
    <!-- jQuery -->
    <script src="/libs/jquery/dist/jquery.js"></script>
    <!-- Bootstrap -->
    <script src="/libs/tether/dist/js/tether.min.js"></script>
    <script src="/libs/bootstrap/dist/js/bootstrap.js"></script>
    <!-- core -->
    <script src="/libs/jQuery-Storage-API/jquery.storageapi.min.js"></script>
    <script src="/libs/PACE/pace.min.js"></script>
    <script src="/libs/jquery-pjax/jquery.pjax.js"></script>
    <script src="/libs/blockUI/jquery.blockUI.js"></script>
    <script src="/libs/jscroll/jquery.jscroll.min.js"></script>

    <script src="/scripts/config.lazyload.js"></script>
    <script src="/scripts/ui-load.js"></script>
    <script src="/scripts/ui-jp.js"></script>
    <script src="/scripts/ui-include.js"></script>
    <script src="/scripts/ui-device.js"></script>
    <script src="/scripts/ui-form.js"></script>
    <script src="/scripts/ui-modal.js"></script>
    <script src="/scripts/ui-nav.js"></script>
    <script src="/scripts/ui-list.js"></script>
    <script src="/scripts/ui-screenfull.js"></script>
    <script src="/scripts/ui-scroll-to.js"></script>
    <script src="/scripts/ui-toggle-class.js"></script>
    <script src="/plugins/dataTables/datatables.min.js"></script>
    <script src="/scripts/ui-taburl.js"></script>
    <script src="/scripts/app.js"></script>
    <script src="/scripts/ajax.js"></script>
    <script src="/plugins/pnotify/pnotify.custom.min.js"></script>
    <script src="/plugins/select2/js/select2.full.min.js"></script>
    <script src="/plugins/bootstrapdatepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="/plugins/jqueryValidation/jquery.validate.min.js"></script>
    <script src="/plugins/jqueryValidation/additional-methods.js"></script>
    <script src="/plugins/jqueryValidation/localization/messages_es.min.js"></script>
    <script src="/plugins/alert2/sweetalert2.min.js"></script>



    @if (Session::has('notifier.notice'))
    <script>
    new PNotify({!! Session::get('notifier.notice') !!});
    </script>
    @endif
    <!-- escript propia de casa pagina -->
    @yield('script')

</script>
<!-- endbuild -->
</body>

</html>
