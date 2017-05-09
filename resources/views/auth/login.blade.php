<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
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
    <link rel="stylesheet" href="/css/font-awesome/css/font-awesome.min.css" type="text/css" />
    <link rel="stylesheet" href="/css/material-design-icons/material-design-icons.css" type="text/css" />
    <link rel="stylesheet" href="/css/ionicons/css/ionicons.min.css" type="text/css" />
    <link rel="stylesheet" href="/css/simple-line-icons/css/simple-line-icons.css" type="text/css" />
    <link rel="stylesheet" href="/css/bootstrap/dist/css/bootstrap.min.css" type="text/css" />

    <!-- build:css css/styles/app.min.css -->
    <link rel="stylesheet" href="/css/styles/app.css" type="text/css" />
    <link rel="stylesheet" href="/css/styles/style.css" type="text/css" />
    <!-- endbuild -->
    <link rel="stylesheet" href="/css/styles/font.css" type="text/css" />

    <!-- jQuery -->
    <script src="/libs/jquery/dist/jquery.js"></script>

    <link rel="stylesheet" href="/plugins/pnotify/pnotify.custom.min.css" type="text/css" />
    <script src="/plugins/pnotify/pnotify.custom.min.js"></script>

</head>
<body>
    <div class="app" id="app">

        <!-- ############ LAYOUT START-->

        <div class="padding" style="padding: 8%;">
            <div class="navbar">
                <div class="pull-center">
                    <!-- brand -->
                    <div class="text-center">
                        <img src="/images/logoProesthetic1.png" alt="...">
                    </div>
                    <!-- / brand -->
                </div>
            </div>
        </div>
        <div class="b-t">
            <div class="padding">
                <div class="row">
                    <div class="col-sm-4 offset-sm-4">
                        <div class="b-b b-primary nav-active-primary">
                            <ul class="nav nav-tabs">
                                <li class="nav-item" style="width: 50%; text-align: center;">
                                    <a class="nav-link active" href="#" data-toggle="tab" data-target="#tab4" aria-expanded="true">Usuario</a>
                                </li>
                                <li class="nav-item" style="width: 49%; text-align: center;">
                                    <a class="nav-link" href="#" data-toggle="tab" data-target="#tab5" aria-expanded="false">Doctor</a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content p-a m-b-md">
                            <div class="tab-pane animated fadeIn text-muted active" id="tab4" aria-expanded="true">
                                <div class="row">
                                    <div class="col-sm-10 offset-sm-1">
                                        <div>
                                            <form name="form" action="/login" method="post">
                                                {{ csrf_field() }}
                                                <div class="form-group">
                                                    <input type="text" class="form-control" placeholder="Usuario"  name="username">
                                                    @if ($errors->has('username'))
                                                    <span class="help-block">
                                                        <script type ="text/javascript">
                                                        $(function(){
                                                            new PNotify({
                                                                title : "Error",
                                                                text : "{{ $errors->first('username') }}",
                                                                type : "error"
                                                            });
                                                        });
                                                        </script>
                                                    </span>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <input type="password" class="form-control" placeholder="Contraseña"  name="password">
                                                    @if($errors->has('password'))
                                                    <span class="help-block">
                                                        <script type ="text/javascript">
                                                        $(function(){
                                                            new PNotify({
                                                                title : "Error",
                                                                text : "{{ $errors->first('password') }}",
                                                                type : "error"
                                                            });
                                                        });
                                                        </script>
                                                    </span>
                                                    @endif
                                                </div>
                                                <div class="row">
                                                    <div class="offset-sm-3">
                                                        <div class="m-b-md">
                                                            <label class="md-check">
                                                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> <i class="primary"></i>  Recordarme
                                                            </label>
                                                        </div>
                                                        <input type="hidden" name="lblTipo" value="empleado">
                                                        <button type="submit" class="btn btn-lg black p-x-lg">Entrar</button>
                                                    </div>
                                                </div>
                                            </form>
                                            <div class="row">
                                                <div class="offset-sm-6">
                                                    <div class="m-y">
                                                        <a href="/forgot-password.html" class="_600">¿Olvidaste tu contraseña?</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane animated fadeIn text-muted" id="tab5" aria-expanded="false">
                                <div class="row">
                                    <div class="col-sm-10 offset-sm-1">
                                        <div>
                                            <form name="form" action="/login" method="post">
                                                {{ csrf_field() }}
                                                <div class="form-group">
                                                    <input type="text" class="form-control" placeholder="Doctor"  name="username">
                                                </div>
                                                <div class="form-group">
                                                    <input type="password" class="form-control" placeholder="Contraseña" name="password">
                                                </div>
                                                <div class="row">
                                                    <div class="offset-sm-3">
                                                        <div class="m-b-md">
                                                            <label class="md-check">
                                                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> <i class="primary"></i>  Recordarme
                                                            </label>
                                                        </div>
                                                        <input type="hidden" name="lblTipo" value="doctor">
                                                        <button type="submit" class="btn btn-lg black p-x-lg">Entrar</button>
                                                    </div>
                                                </div>
                                            </form>
                                            <div class="row">
                                                <div class="offset-sm-6">
                                                    <div class="m-y">
                                                        <a href="/forgot-password.html" class="_600">¿Olvidaste tu contraseña?</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ############ LAYOUT END-->
        </div>

        <!-- build:js scripts/app.min.js -->

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
        <script src="/scripts/ui-taburl.js"></script>
        <script src="/scripts/app.js"></script>
        <script src="/scripts/ajax.js"></script>


        <!-- endbuild -->
    </body>
    </html>
