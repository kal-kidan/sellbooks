<?php
use App\User;

if (!Auth()->guest()) {
  $id=Auth::user()->id;
  if (isset($id)) {
    $user=User::find($id);
    $profile_image=$user->images[0]->path;
  }
}


?>
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Sell Books') }}</title>



    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="/css/w3.css">
        @yield('head')
    <!-- Styles -->

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <!-- <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a> -->

                @if(Auth()->check())
                <div class="" style="color:rgba(0,0,0,.5)">
                  <img class="navbar-brand mr-3"  src="/images/logo.jpg" alt="" width="30px" >
                  <span class="mr-2" style="color:rgba(0,0,0,.5);cursor:pointer">
                    <span class="bg bg-primary w3-circle " id="message-tag"
                    style="padding:0px 3px 0px 3px;color:white;position:absolute;top:25% ;margin-left:7px;font-size:11px"></span>
                     <a href="/showmessages"><i class="fa fa-envelope"></i></a>
                  </span>
                  <span style="color:rgba(0,0,0,.5);cursor:pointer">
                    <span class="bg bg-primary w3-circle " id="notif-tag"
                    style="padding:0px 3px 0px 3px;color:white;position:absolute;top:17px;margin-left:7px;font-size:11px"></span>
                    <a href="/shownotification"><i class="fa fa-bell"></i></a>
                  </span>

                  <span class="fa fa-search ml-2" style="cursor:pointer" id="searchIcon" onclick="showSearch()">
                  </span>
                </div>


                <div id="searchInput" class="ml-3" style="display:none">
                  <form class="" action="/search" method="post">
                    @csrf
                     <input type="text" id="searchText" name="searchText" value="" style="border:none;border-bottom:1px solid black;outline:none;">
                     <button type="submit" name="button" class="btn btn-primary fa fa-search mt-2"></button>
                  </form>

                </div>

                <button class="navbar-toggler w3-hide-medium" type="button" onclick="showSidebar()">
                      <span class="navbar-toggler-icon" style="width:20px;"></span>
                </button>
              @endif
                <div class="w3-hide-small" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto"></ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav" style="list-style:none;">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown"  onclick="dropdown()" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                  <img  src="<?php echo  $profile_image ?? '/images/user.png'; ?>" alt="" width="40px" height="40px" style="border-radius:100%"> {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div id="logout" class="dropdown-menu dropdown-menu-left" aria-labelledby="navbarDropdown" style="display:none">
                                    <a href="{{ route('home') }}" class="dropdown-item " >Home</a>
                                    <a href="{{ route('post') }}" class="dropdown-item " >Post</a>
                                    <a href="{{url('myposts')}}" class="dropdown-item ">Post History</a>
                                    <a href="{{ route('account') }}" class="dropdown-item " >My Account</a>
                                    <a   class="dropdown-item " href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>

                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        @if(Auth()->check())
        <div id="sidebar-content" class="w3-hide-large w3-hide-medium w3-bar  w3-center" style="display:none;float:left">
            <a href="{{ route('home') }}" class="w3-bar-item w3-bottombar mr-1 w3-center" >Home</a>
            <a href="{{ route('post') }}" class="w3-bar-item w3-bottombar mr-1 w3-center" >Post</a>
            <a href="{{url('myposts/'.Auth::user()->id)}}" class="w3-bar-item w3-bottombar mr-1">Post History</a>
            <a href="{{ route('account') }}" class="w3-bar-item w3-bottombar mr-1" >My Account</a>
            <a  href="{{ route('logout') }}" class="w3-bar-item w3-bottombar mr-1"
               onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                @csrf
            </form>
        </div>
      @endif
        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <input type="hidden" name="" value="" id="details">
    <script type="text/javascript" src="/js/jquery.min.js"> </script>
    <script src="/js/jquery-editable-select.js"></script>
    <script type="text/javascript" src="/js/bootstrap.min.js"> </script>
    <script type="text/javascript">
    function dropdown(){
      var div=document.getElementById("logout") ;
      if (document.getElementById("logout").style.display=="none") {
        document.getElementById("logout").style.display="block";
      }
      else {
        document.getElementById("logout").style.display="none";
      }
    }
    function showSearch(){
      var div=document.getElementById("searchInput") ;
      if (document.getElementById("searchInput").style.display=="none") {
        document.getElementById("searchInput").style.display="block";
        document.getElementById("searchIcon").style.display="none";
        document.getElementById("searchText").focus();
      }
    }
    function notificationResponse(){
      var xmlhttp=new XMLHttpRequest();
      xmlhttp.onreadystatechange=function(){
         if (xmlhttp.readyState == 4 && xmlhttp.status==200) {
           var response=JSON.parse(xmlhttp.responseText);
           document.getElementById("details").value=xmlhttp.responseText;
           var len=response.length;
           if (len>0) {
             // document.getElementById("notif-tag").style.display="block";
              document.getElementById("notif-tag").innerHTML=String(len);
           }
           else {
             document.getElementById("notif-tag").innerHTML='';
             // document.getElementById("notif-tag").style.display="none";
           }


          }
        }

        xmlhttp.open('GET','/notification',true);
        xmlhttp.send();
    }


    function checkNewMessage(){
      var xmlhttp=new XMLHttpRequest();
      xmlhttp.onreadystatechange=function(){
         if (xmlhttp.readyState == 4 && xmlhttp.status==200) {
           var unseen_count=Number(xmlhttp.responseText);
           if (unseen_count>0) {
             // document.getElementById("notif-tag").style.display="block";
              document.getElementById("message-tag").innerHTML=String(unseen_count);
           }
           else {
             document.getElementById("message-tag").innerHTML='';
             // document.getElementById("notif-tag").style.display="none";
           }


          }
        }

        xmlhttp.open('GET','/unseen',true);
        xmlhttp.send();
    }

      setInterval(checkNewMessage,2000);
      setInterval(notificationResponse,2000);
   function showSidebar(){
     var check=document.getElementById("sidebar-content").style.display;
     if (check=="none") {
        document.getElementById("sidebar-content").style.display="block";
     }
     else {
        document.getElementById("sidebar-content").style.display="none";
     }

    }
    </script>
     @yield('script')
</body>
</html>
