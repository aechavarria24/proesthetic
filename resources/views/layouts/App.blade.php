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
  <link rel="stylesheet" href="/css/font-awesome/css/font-awesome.min.css" type="text/css" />
  <link rel="stylesheet" href="/css/material-design-icons/material-design-icons.css" type="text/css" />
  <link rel="stylesheet" href="/css/ionicons/css/ionicons.min.css" type="text/css" />
  <link rel="stylesheet" href="/css/simple-line-icons/css/simple-line-icons.css" type="text/css" />
  <link rel="stylesheet" href="/css/bootstrap/dist/css/bootstrap.min.css" type="text/css" />
  <link rel="stylesheet" href="/plugins/pnotify/pnotify.custom.min.css" type="text/css" />
  <link rel="stylesheet" href="/plugins/dataTables/datatables.min.css"/>

  <!-- build:css css/styles/app.min.css -->
  <link rel="stylesheet" href="/css/styles/app.css" type="text/css" />
  <link rel="stylesheet" href="/css/styles/style.css" type="text/css" />
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
          <a href="/index.html" class="navbar-brand">
            <div data-ui-include="'images/logo.svg'"></div>
            <img src="/images/logo.png" alt="." class="hide">
            <span class="hidden-folded inline">aside</span>
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
                      <a href="#" class="b-success" title="Empleado">
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
                            <a href="{{$padre['url']}}">
                              <span class="nav-text">{{ $padre['nombre'] }}</span>
                            </a>
                          </li>
                        @endif
                      @endforeach
                      </ul>
                    </li>
                    <!-- / Panel -->
                  @endif
                @endforeach
              @endif
              <!-- / Panel -->
              <li>
                <a href="#" class="b-success" title="Empleado">
                  <span class="nav-icon text-white no-fade">
                    <i class="fa fa-users"></i>
                  </span>
                  <span class="nav-text">Empleado</span>
                </a>
                <!-- / opciones -->
                <ul class="nav-sub nav-mega nav-mega-3">
                  <li>
                    <a href="/ui.arrow.html">
                      <span class="nav-text">Arrow</span>
                    </a>
                  </li>
                  <li>
                    <a href="/ui.box.html">
                      <span class="nav-text">Box</span>
                    </a>
                  </li>
                  <li>
                    <a href="/ui.button.html">
                      <span class="nav-text">Button</span>
                    </a>
                  </li>
                  <li>
                    <a href="/ui.color.html">
                      <span class="nav-text">Color</span>
                    </a>
                  </li>
                  <li>
                    <a href="/ui.dropdown.html">
                      <span class="nav-text">Dropdown</span>
                    </a>
                  </li>
                  <li>
                    <a href="/ui.grid.html">
                      <span class="nav-text">Grid</span>
                    </a>
                  </li>
                  <li>
                    <a href="/ui.icon.html">
                      <span class="nav-text">Icon</span>
                    </a>
                  </li>
                  <li>
                    <a href="/ui.label.html">
                      <span class="nav-text">Label</span>
                    </a>
                  </li>
                  <li>
                    <a href="/ui.list.html">
                      <span class="nav-text">List Group</span>
                    </a>
                  </li>
                  <li>
                    <a href="/ui.modal.html">
                      <span class="nav-text">Modal</span>
                    </a>
                  </li>
                  <li>
                    <a href="/ui.nav.html">
                      <span class="nav-text">Nav</span>
                    </a>
                  </li>
                  <li>
                    <a href="/ui.progress.html">
                      <span class="nav-text">Progress</span>
                    </a>
                  </li>
                  <li>
                    <a href="/ui.social.html">
                      <span class="nav-text">Social</span>
                    </a>
                  </li>
                  <li>
                    <a href="/ui.sortable.html">
                      <span class="nav-text">Sortable</span>
                    </a>
                  </li>
                  <li>
                    <a href="/ui.streamline.html">
                      <span class="nav-text">Streamline</span>
                    </a>
                  </li>
                  <li>
                    <a href="/ui.timeline.html">
                      <span class="nav-text">Timeline</span>
                    </a>
                  </li>
                  <li>
                    <a href="/map.vector.html">
                      <span class="nav-text">Vector Map</span>
                    </a>
                  </li>
                  <li>
                    <a href="/ui.widget.html">
                      <span class="nav-text">Widget</span>
                    </a>
                  </li>
                </ul>
              </li>
              <!-- / Panel -->
              <li>
                <a href="/app.inbox.html" class="b-info">
                  <span class="nav-icon text-white no-fade">
                    <i class="ion-email"></i>
                  </span>
                  <span class="nav-text">Inbox</span>
                </a>
              </li>
              <li>
                <a href="/app.message.html" class="b-default">
                  <span class="nav-label">
                    <b class="label label-xs rounded danger"></b>
                  </span>
                  <span class="nav-icon">
                    <i class="ion-chatbubble-working"></i>
                  </span>
                  <span class="nav-text">Messages</span>
                </a>
              </li>
              <li>
                <a href="/app.contact.html" class="b-default">
                  <span class="nav-icon">
                    <i class="ion-person"></i>
                  </span>
                  <span class="nav-text">Contacts</span>
                </a>
              </li>

              <li class="nav-header hidden-folded m-t">
                <span class="text-xs">UI Elements</span>
              </li>
              <li>
                <a>
                  <span class="nav-caret">
                    <i class="fa fa-caret-down"></i>
                  </span>
                  <span class="nav-icon">
                    <i class="ion-plus-circled"></i>
                  </span>
                  <span class="nav-text">UI kit</span>
                </a>
                <ul class="nav-sub nav-mega nav-mega-3">
                  <li>
                    <a href="/ui.arrow.html">
                      <span class="nav-text">Arrow</span>
                    </a>
                  </li>
                  <li>
                    <a href="/ui.box.html">
                      <span class="nav-text">Box</span>
                    </a>
                  </li>
                  <li>
                    <a href="/ui.button.html">
                      <span class="nav-text">Button</span>
                    </a>
                  </li>
                  <li>
                    <a href="/ui.color.html">
                      <span class="nav-text">Color</span>
                    </a>
                  </li>
                  <li>
                    <a href="/ui.dropdown.html">
                      <span class="nav-text">Dropdown</span>
                    </a>
                  </li>
                  <li>
                    <a href="/ui.grid.html">
                      <span class="nav-text">Grid</span>
                    </a>
                  </li>
                  <li>
                    <a href="/ui.icon.html">
                      <span class="nav-text">Icon</span>
                    </a>
                  </li>
                  <li>
                    <a href="/ui.label.html">
                      <span class="nav-text">Label</span>
                    </a>
                  </li>
                  <li>
                    <a href="/ui.list.html">
                      <span class="nav-text">List Group</span>
                    </a>
                  </li>
                  <li>
                    <a href="/ui.modal.html">
                      <span class="nav-text">Modal</span>
                    </a>
                  </li>
                  <li>
                    <a href="/ui.nav.html">
                      <span class="nav-text">Nav</span>
                    </a>
                  </li>
                  <li>
                    <a href="/ui.progress.html">
                      <span class="nav-text">Progress</span>
                    </a>
                  </li>
                  <li>
                    <a href="/ui.social.html">
                      <span class="nav-text">Social</span>
                    </a>
                  </li>
                  <li>
                    <a href="/ui.sortable.html">
                      <span class="nav-text">Sortable</span>
                    </a>
                  </li>
                  <li>
                    <a href="/ui.streamline.html">
                      <span class="nav-text">Streamline</span>
                    </a>
                  </li>
                  <li>
                    <a href="/ui.timeline.html">
                      <span class="nav-text">Timeline</span>
                    </a>
                  </li>
                  <li>
                    <a href="/map.vector.html">
                      <span class="nav-text">Vector Map</span>
                    </a>
                  </li>
                  <li>
                    <a href="/ui.widget.html">
                      <span class="nav-text">Widget</span>
                    </a>
                  </li>
                </ul>
              </li>

              <li>
                <a>
                  <span class="nav-caret">
                    <i class="fa fa-caret-down"></i>
                  </span>
                  <span class="nav-icon">
                    <i class="ion-ios-photos"></i>
                  </span>
                  <span class="nav-text">Pages</span>
                </a>
                <ul class="nav-sub nav-mega">
                  <li>
                    <a href="/profile.html">
                      <span class="nav-text">Profile</span>
                    </a>
                  </li>
                  <li>
                    <a href="/setting.html">
                      <span class="nav-text">Setting</span>
                    </a>
                  </li>
                  <li>
                    <a href="/search.html">
                      <span class="nav-text">Search</span>
                    </a>
                  </li>
                  <li>
                    <a href="/faq.html">
                      <span class="nav-text">FAQ</span>
                    </a>
                  </li>
                  <li>
                    <a href="/gallery.html">
                      <span class="nav-text">Gallery</span>
                    </a>
                  </li>
                  <li>
                    <a href="/invoice.html">
                      <span class="nav-text">Invoice</span>
                    </a>
                  </li>
                  <li>
                    <a href="/price.html">
                      <span class="nav-text">Price</span>
                    </a>
                  </li>
                  <li>
                    <a href="/blank.html">
                      <span class="nav-text">Blank</span>
                    </a>
                  </li>
                  <li>
                    <a href="/signin.html">
                      <span class="nav-text">Sign In</span>
                    </a>
                  </li>
                  <li>
                    <a href="/signup.html">
                      <span class="nav-text">Sign Up</span>
                    </a>
                  </li>
                  <li>
                    <a href="/forgot-password.html">
                      <span class="nav-text">Forgot Password</span>
                    </a>
                  </li>
                  <li>
                    <a href="/lockme.html">
                      <span class="nav-text">Lockme Screen</span>
                    </a>
                  </li>
                  <li>
                    <a href="/404.html">
                      <span class="nav-text">Error 404</span>
                    </a>
                  </li>
                  <li>
                    <a href="/505.html">
                      <span class="nav-text">Error 505</span>
                    </a>
                  </li>
                </ul>
              </li>

              <li>
                <a>
                  <span class="nav-caret">
                    <i class="fa fa-caret-down"></i>
                  </span>
                  <span class="nav-icon">
                    <i class="ion-checkmark-circled"></i>
                  </span>
                  <span class="nav-text">Form</span>
                </a>
                <ul class="nav-sub">
                  <li>
                    <a href="/form.layout.html">
                      <span class="nav-text">Form Layout</span>
                    </a>
                  </li>
                  <li>
                    <a href="/form.element.html">
                      <span class="nav-text">Form Element</span>
                    </a>
                  </li>
                  <li>
                    <a href="/form.validation.html">
                      <span class="nav-text">Form Validation</span>
                    </a>
                  </li>
                  <li>
                    <a href="/form.select.html">
                      <span class="nav-text">Select</span>
                    </a>
                  </li>
                  <li>
                    <a href="/form.editor.html">
                      <span class="nav-text">Editor</span>
                    </a>
                  </li>
                  <li>
                    <a href="/form.picker.html">
                      <span class="nav-text">Picker</span>
                    </a>
                  </li>
                  <li>
                    <a href="/form.wizard.html">
                      <span class="nav-text">Wizard</span>
                    </a>
                  </li>
                  <li>
                    <a href="/form.dropzone.html" class="no-ajax">
                      <span class="nav-text">File Upload</span>
                    </a>
                  </li>
                  <li>
                    <a href="/form.calendar.html">
                      <span class="nav-text">Calendar</span>
                    </a>
                  </li>
                </ul>
              </li>

              <li>
                <a>
                  <span class="nav-caret">
                    <i class="fa fa-caret-down"></i>
                  </span>
                  <span class="nav-icon">
                    <i class="ion-ios-grid-view"></i>
                  </span>
                  <span class="nav-text">Tables</span>
                </a>
                <ul class="nav-sub">
                  <li>
                    <a href="/static.html">
                      <span class="nav-text">Static table</span>
                    </a>
                  </li>
                  <li>
                    <a href="/datatable.html">
                      <span class="nav-text">Datatable</span>
                    </a>
                  </li>
                  <li>
                    <a href="/footable.html">
                      <span class="nav-text">Footable</span>
                    </a>
                  </li>
                </ul>
              </li>
              <li>
                <a>
                  <span class="nav-caret">
                    <i class="fa fa-caret-down"></i>
                  </span>
                  <span class="nav-icon">
                    <i class="ion-pie-graph"></i>
                  </span>
                  <span class="nav-text">Charts</span>
                </a>
                <ul class="nav-sub">
                  <li>
                    <a href="/chart.html">
                      <span class="nav-text">Chart</span>
                    </a>
                  </li>
                  <li>
                    <a href="/chartjs.html">
                      <span class="nav-text">Chartjs</span>
                    </a>
                  </li>
                  <li>
                    <a>
                      <span class="nav-caret">
                        <i class="fa fa-caret-down"></i>
                      </span>
                      <span class="nav-text">Echarts</span>
                    </a>
                    <ul class="nav-sub">
                      <li>
                        <a href="/echarts-line.html">
                          <span class="nav-text">line</span>
                        </a>
                      </li>
                      <li>
                        <a href="/echarts-bar.html">
                          <span class="nav-text">Bar</span>
                        </a>
                      </li>
                      <li>
                        <a href="/echarts-pie.html">
                          <span class="nav-text">Pie</span>
                        </a>
                      </li>
                      <li>
                        <a href="/echarts-scatter.html">
                          <span class="nav-text">Scatter</span>
                        </a>
                      </li>
                      <li>
                        <a href="/echarts-radar-chord.html">
                          <span class="nav-text">Radar &amp; Chord</span>
                        </a>
                      </li>
                      <li>
                        <a href="/echarts-gauge-funnel.html">
                          <span class="nav-text">Gauges &amp; Funnel</span>
                        </a>
                      </li>
                      <li>
                        <a href="/echarts-map.html">
                          <span class="nav-text">Map</span>
                        </a>
                      </li>
                    </ul>
                  </li>
                </ul>
              </li>
            </ul>
          </nav>
        </div>
        <div data-flex-no-shrink>
          <div class="nav-fold dropup">
            <a data-toggle="dropdown">
              <div class="pull-left">
                <div class="inline"><span class="avatar w-40 grey">JR</span></div>
                <img src="/images/a0.jpg" alt="..." class="w-40 img-circle hide">
              </div>
              <div class="clear hidden-folded p-x">
                <span class="block _500 text-muted">Jean Reyes</span>
                <div class="progress-xxs m-y-sm lt progress">
                  <div class="progress-bar info" style="width: 15%;">
                  </div>
                </div>
              </div>
            </a>
            <div class="dropdown-menu w dropdown-menu-scale ">
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
              <a class="dropdown-item" href="/docs.html">
                Need help?
              </a>
              <a class="dropdown-item" href="/signin.html">Sign out</a>
            </div>
          </div>
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
            @yield('titulo')</div>
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
                    <img src="/images/a3.jpg" class="w-full rounded" alt="...">
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
                  <a class="dropdown-item" href="/docs.html">
                    Need help?
                  </a>
                  <a class="dropdown-item" href="/signin.html">Sign out</a>
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
    <script src="/scripts/ui-taburl.js"></script>
    <script src="/scripts/app.js"></script>
    <script src="/scripts/ajax.js"></script>
    <script src="/plugins/pnotify/pnotify.custom.min.js"></script>
    <script src="/plugins/dataTables/datatables.min.js"></script>
    <script src="/plugins/jqueryValidation/jquery.validate.js"></script>
    <script src="/plugins/jqueryValidation/localization/messages_es.js"></script>
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
