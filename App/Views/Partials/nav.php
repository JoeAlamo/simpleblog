<nav>
    <a href="/">Home</a>
<?php
    if (\Core\Session::isLoggedIn()):
?>
   <a href="/admin">Admin</a>
   <form action="/logout" method="post">
       <input type="submit" value="Logout">
   </form>
<?php
    else:
?>
    <form action="/login" method="post">
        <label for="username">Username</label>
        <input type="text" name="username" id="username">

        <label for="password">Password</label>
        <input type="password" name="password" id="password">

        <input type="submit" value="Login">
    </form>
<?php
    endif;
?>
</nav>