<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Интерфейс для заявителей | @yield('title')</title>
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <!-- #CSS Links -->
    <!-- Basic Styles -->
    {!! Html::style('css/bootstrap.min.css') !!}
    {!! Html::style('css/font-awesome.min.css') !!}

    <!-- SmartAdmin Styles : Caution! DO NOT change the order -->

    {!! Html::style('css/smartadmin-production-plugins.min.css') !!}

    {!! Html::style('css/smartadmin-production.min.css') !!}

    {!! Html::style('css/smartadmin-skins.min.css') !!}

    <!-- SmartAdmin RTL Support -->
    {!! Html::style('css/smartadmin-rtl.min.css') !!}

    {!! Html::style('/js/plugin/daterangepicker/daterangepicker.css') !!}


    <!-- We recommend you use "your_style.css" to override SmartAdmin
         specific styles this will also ensure you retrain your customization with each SmartAdmin update.
    <link rel="stylesheet" type="text/css" media="screen" href="css/your_style.css"> -->


    {!! Html::style('/js/plugin/sweetalert/sweetalert.css') !!}

    {!! Html::style('/js/plugin/jquery-treeview-master/jquery.treeview.css') !!}

    @yield('css')

<!-- #FAVICONS -->
    <link rel="shortcut icon" href="{{ url('img/favicon/favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ url('img/favicon/favicon.ico') }}" type="image/x-icon">

    <!-- #GOOGLE FONT -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700">

    <script type="text/javascript">
        var SITE_URL = "{{url('/')}}";
    </script>

</head>

<!--

TABLE OF CONTENTS.

Use search to find needed section.

===================================================================

|  01. #CSS Links                |  all CSS links and file paths  |
|  02. #FAVICONS                 |  Favicon links and file paths  |
|  03. #GOOGLE FONT              |  Google font link              |
|  04. #APP SCREEN / ICONS       |  app icons, screen backdrops   |
|  05. #BODY                     |  body tag                      |
|  06. #HEADER                   |  header tag                    |
|  07. #PROJECTS                 |  project lists                 |
|  08. #TOGGLE LAYOUT BUTTONS    |  layout buttons and actions    |
|  09. #MOBILE                   |  mobile view dropdown          |
|  10. #SEARCH                   |  search field                  |
|  11. #NAVIGATION               |  left panel & navigation       |
|  12. #MAIN PANEL               |  main panel                    |
|  13. #MAIN CONTENT             |  content holder                |
|  14. #PAGE FOOTER              |  page footer                   |
|  15. #SHORTCUT AREA            |  dropdown shortcuts area       |
|  16. #PLUGINS                  |  all scripts and plugins       |

===================================================================

-->

<!-- #BODY -->
<!-- Possible Classes

    * 'smart-style-{SKIN#}'
    * 'smart-rtl'         - Switch theme mode to RTL
    * 'menu-on-top'       - Switch to top navigation (no DOM change required)
    * 'no-menu'			  - Hides the menu completely
    * 'hidden-menu'       - Hides the main menu but still accessable by hovering over left edge
    * 'fixed-header'      - Fixes the header
    * 'fixed-navigation'  - Fixes the main menu
    * 'fixed-ribbon'      - Fixes breadcrumb
    * 'fixed-page-footer' - Fixes footer
    * 'container'         - boxed layout mode (non-responsive: will not work with fixed-navigation & fixed-ribbon)
-->
<body class="">

<!-- #HEADER -->
<header id="header">
    <div id="logo-group">

        <!-- PLACE YOUR LOGO HERE -->
        <span id="logo"> <img src="{{ url('img/logo.png') }}" alt="SmartAdmin"> </span>
        <!-- END LOGO PLACEHOLDER -->

        <!-- Note: The activity badge color changes when clicked and resets the number to 0
             Suggestion: You may want to set a flag when this happens to tick off all checked messages / notifications -->

    </div>
    <!-- END AJAX-DROPDOWN -->
    </div>

    </div>
    <!-- end projects dropdown -->

    <!-- #TOGGLE LAYOUT BUTTONS -->
    <!-- pulled right: nav area -->
    <div class="pull-right">

        <!-- collapse menu button -->
        <div id="hide-menu" class="btn-header pull-right">
            <span> <a href="javascript:void(0);" data-action="toggleMenu" title="Collapse Menu"><i
                            class="fa fa-reorder"></i></a> </span>
        </div>
        <!-- end collapse menu -->

        <!-- logout button -->
        <div id="logout" class="btn-header transparent pull-right">
            <span> <a href="/logout" title="Sign Out" data-action="userLogout"
                      data-logout-msg="Вы можете улучшить свою безопасность после выхода из системы, закрыв этот открытый браузер"><i
                            class="fa fa-sign-out"></i></a> </span>
        </div>
        <!-- end logout button -->

        <!-- fullscreen button -->
        <div id="fullscreen" class="btn-header transparent pull-right">
            <span> <a href="javascript:void(0);" data-action="launchFullscreen" title="Full Screen"><i
                            class="fa fa-arrows-alt"></i></a> </span>
        </div>
        <!-- end fullscreen button -->

    </div>
    <!-- end pulled right: nav area -->

</header>
<!-- END HEADER -->

<!-- #NAVIGATION -->
<!-- Left panel : Navigation area -->
<!-- Note: This width of the aside area can be adjusted through LESS variables -->
<aside id="left-panel">

    <!-- User info -->
    <div class="login-info">
		<span> <!-- User image size is adjusted inside CSS, it should stay as it -->

			<a href="javascript:void(0);" id="show-shortcut" data-action="toggleShortcut">
				<img src="{{ Auth::user()->avatar ? asset('public/uploads/users/' . Auth::user()->avatar) : asset('public/user.png') }}"
                     alt="me" class="online"/>
				<span>
					{{ Auth::user()->name }}
				</span>
			</a>

		</span>
    </div>
    <!-- end user info -->

    <nav>
        <!--
        NOTE: Notice the gaps after each icon usage <i></i>..
        Please note that these links work a bit different than
        traditional href="" links. See documentation for details.
        -->

        <ul>

            <li {!! Request::is('admin') ? ' class="active"' : '' !!}>
                <a href="{{ URL::route('frontend.performer.applications') }}"><i class="fa fa-fw fa-book"></i> Мои заявки</a>
            </li>



        </ul>
    </nav>

    <span class="minifyme" data-action="minifyMenu"><i class="fa fa-arrow-circle-left hit"></i></span>

</aside>
<!-- END NAVIGATION -->

<!-- MAIN PANEL -->
<div id="main" role="main">

    <!-- RIBBON -->
    <div id="ribbon">

        <!-- You can also add more buttons to the
        ribbon for further usability

        Example below:

        <span class="ribbon-button-alignment pull-right">
        <span id="search" class="btn btn-ribbon hidden-xs" data-title="search"><i class="fa-grid"></i> Change Grid</span>
        <span id="add" class="btn btn-ribbon hidden-xs" data-title="add"><i class="fa-plus"></i> Add</span>
        <span id="search" class="btn btn-ribbon" data-title="search"><i class="fa-search"></i> <span class="hidden-mobile">Search</span></span>
        </span> -->

    </div>
    <!-- END RIBBON -->

    <!-- MAIN CONTENT -->
    <div id="content">

        @yield('content')

    </div>
    <!-- END MAIN CONTENT -->

</div>
<!-- END MAIN PANEL -->

<!-- PAGE FOOTER -->
<div class="page-footer">
    <div class="row">
        <div class="col-xs-12 col-sm-6">
            <span class="txt-color-white">Журнал простоев оборудования © {{ date("Y") }}</span>
        </div>

    </div>
</div>
<!-- END PAGE FOOTER -->


<!--================================================== -->

@include('layouts.admin_common.script')

@yield('js')

</body>

</html>