<html>
<head>

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1">
    <title>Laravel QA - @yield('title')</title>

    <link href="{{url('css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{url('css/material-kit.css')}}" rel="stylesheet" type="text/css">
    <link href="{{url('css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{url('css/bootstrap-select.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{url('css/tokenize2.css')}}" rel="stylesheet" type="text/css">
    <script src="{{url('js/jquery.min.js')}}"></script>
    <script src="{{url('js/jquery-ui.min.js')}}"></script>
    <script src="{{url('js/moment.js')}}"></script>
    <script src="{{url('js/bootstrap.min.js')}}"></script>
    <script src="{{url('js/bootstrap-datepicker.js')}}"></script>
    <script src="{{url('js/bootstrap-select.js')}}"></script>
    <script src="{{url('js/material-kit.js')}}"></script>
    <script src="{{url('js/material.min.js')}}"></script>
    <script src="{{url('js/nouislider.min.js')}}"></script>
    <script src="{{url('js/tokenize2.js')}}"></script>
    <script>
        $(document).ready(function(){
            $( "[data-time-format]" ).each(function() {
                var el = $( this );
                switch(el.attr("data-time-format")) {
                    case "time-ago":
                        var timeValue = el.attr("data-time-value")
                        var strTimeAgo = moment.unix(timeValue).fromNow();
                        el.text(strTimeAgo);
                        break;
                }
            });
            $(document).keyup(function(e) {
                if (e.keyCode == 27) { // escape key maps to keycode `27`
                    $('.notification').hide();
                }
            });
//            setTimeout(function(){
//                $(".notification").fadeIn('slow');
//            }, 200);
//
//            setTimeout(function(){
//                $(".notification").fadeOut('slow');
//            }, 2000);
        });
    </script>
    <style>
        .tag:hover, .tag:visited{
            color: white;
        }
        .tags{
            line-height: 2.3em;
            font-size: .8em;
        }
        .notification{
            /*display: none;*/
            position: fixed;
            z-index: 9999;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            margin: 0 auto;
            transition: .5s;
        }
    </style>
    <script>

    </script>
</head>

<body style="overflow-x: hidden">
    @section('navbar') <!-- navbar-->
    <nav class="navbar navbar-fixed-top ">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{url('/')}}">Laravel QA</a>
            </div>

            <div class="collapse navbar-collapse" id="navigation-example">
                <ul class="nav navbar-nav navbar-right">
                    @if (Session::has('username'))
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <span class="fa fa-user-circle"></span>
                                {{Session::get('username')}} <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="{{url('/profile/'.Session::get('username'))}}"><span class="fa fa-user"></span> Profile</a></li>
                                {{--<li><a href="#"><span class="fa fa-lock"></span> Change password</a></li>--}}
                                <li><a href="{{url('/logout')}}"><span class="fa fa-sign-out"></span> Logout</a></li>
                            </ul>
                        </li>
                    @else
                        <li>
                            <a data-toggle="modal" data-target="#loginModal" href="#">
                                Login/Sign up
                            </a>
                        </li>
                    @endif
                    <li>
                        <a href="{{url('/about')}}">
                            About
                        </a>
                    </li>
                    <li>
                        <a href="https://sandunidilhara.blogspot.com/" target="_blank">
                            Blog
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    @show


    <div class="main main-raised">
        <div class="section">
            <div class="container">
                <div class="row">
                    <br/>
                    <br/>
                    <br/>
                    @section('notification')
                        @if(Session::has('notification'))
                            <div class="notification alert alert-{{Session::get('notification_type', 'info')}}">
                                <div class="container-fluid">
                                    <div class="alert-icon">
                                        <i class="fa fa-2x fa-info-circle"></i>
                                    </div>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true"><i class="fa fa-times"></i></span>
                                    </button>
                                    <b>Info alert:</b>
                                    <hr/>
                                    {{Session::get('notification_msg')}}
                                </div>
                            </div>
                        @endif
                    @show
                    @section('errors')
                        @if(count($errors) > 0)
                            <div class="notification alert alert-danger">
                                <div class="container-fluid">
                                    <div class="alert-icon">
                                        <i class="fa fa-2x fa-warning"></i>
                                    </div>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true"><i class="fa fa-times"></i></span>
                                    </button>
                                    <b>Validation error:</b>
                                    <hr/>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{$error}}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif
                    @show

                    <div class="col-md-9 col-sm-12">
                        @yield('content')
                    </div>

                    <div class="col-md-3 hidden-sm">
                        <br/>
                        @yield('sidebar')
                    </div>

                </div>
            </div>
        </div>
    </div>

    @section('footer')
        <footer class="footer">
            <div class="container">
                <nav class="pull-left">
                    <ul>
                        <li>
                            <a href="{{url('/')}}">
                                Laravel QA
                            </a>
                        </li>
                        <li>
                            <a href="{{url('/about')}}">
                                About
                            </a>
                        </li>
                        <li>
                            <a href="http://jackyef.com">
                                Blog
                            </a>
                        </li>
                    </ul>
                </nav>
                <div class="copyright pull-right">
                    &copy; {{date("Y")}} Jackyef. All rights reserved.
                </div>
                <div class="clearfix"></div>
                <div class="pull-right">
                    <a href="https://www.facebook.com/zhouyongchao" target="_blank" class="btn btn-fab btn-fab-mini btn-just-icon">
                        <i class="fa fa-facebook-square"></i>
                    </a>
                    <a href="https://www.instagram.com/jackyef_" target="_blank" class="btn btn-fab btn-fab-mini btn-just-icon">
                        <i class="fa fa-instagram"></i>
                    </a>
                    <a href="https://www.github.com/jackyef" target="_blank" class="btn btn-fab btn-fab-mini btn-just-icon">
                        <i class="fa fa-github"></i>
                    </a>
                </div>
                <div class="clearfix"></div>
            </div>
        </footer>
    @show


    <!-- Login Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-body">
                <div class="col-sm-12">
                    <div class="card card-raised card-nav-tabs">
                        <div class="header header-primary">
                            <!-- colors: "header-primary", "header-info", "header-success", "header-warning", "header-danger" -->
                            <div class="nav-tabs-navigation">
                                <div class="nav-tabs-wrapper">
                                    <ul class="nav nav-tabs" data-tabs="tabs">
                                        <li class="active" style="width: 50%">
                                            <a href="#login" data-toggle="tab">
                                                 <center><i class="fa fa-user"></i> Login</center>
                                            </a>
                                        </li>
                                        <li style="width: 50%">
                                            <a href="#signup" data-toggle="tab">
                                                 <center><i class="fa fa-edit"></i> Sign up</center>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="content">
                            <div class="tab-content">
                                <div class="tab-pane active" id="login">
                                    <form action="{{url('/login')}}" method="POST">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <div class="form-group label-floating">
                                            <label class="control-label" for="username">Username</label>
                                            <input class="form-control" type="text" name="username" />
                                            <span class="form-control-feedback">
                                                <i class="fa fa-check"></i>
                                            </span>
                                        </div>
                                        <div class="form-group label-floating">
                                            <label class="control-label" for="password">Password</label>
                                            <input class="form-control" type="password" name="password" />
                                        </div>

                                        <div class="form-group">
                                            <button class="btn btn-primary btn-block">Login</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane" id="signup">
                                    <form action="{{url('/signup')}}" method="POST">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <div class="form-group label-floating">
                                            <label class="control-label" for="email">Email</label>
                                            <input class="form-control" type="email" name="email" />
                                            <span class="form-control-feedback">
                                                <i class="fa fa-times"></i>
                                            </span>
                                        </div>
                                        <div class="form-group label-floating">
                                            <label class="control-label" for="username">Username</label>
                                            <input class="form-control" type="text" name="username" />
                                            <span class="form-control-feedback">
                                                <i class="fa fa-check"></i>
                                            </span>
                                        </div>
                                        <div class="form-group label-floating">
                                            <label class="control-label" for="password">Password</label>
                                            <input class="form-control" type="password" name="password" />
                                        </div>

                                        <div class="form-group label-floating">
                                            <label class="control-label" for="password2">Confirm password</label>
                                            <input class="form-control" type="password" name="password2" />
                                        </div>

                                        <div class="form-group">
                                            <button class="btn btn-success btn-block">Sign up</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--  End Modal -->

</body>
</html>