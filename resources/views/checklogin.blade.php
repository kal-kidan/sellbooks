@yield('content')
<?php
use Auth;
if (Auth()->guest()) {
   return redirect('/login');
}

 ?>
