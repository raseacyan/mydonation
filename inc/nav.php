<nav>
    <a href="index.php">Home</a> |
    <a href="donations.php">Donations</a> |
    <a href="register.php">Register</a> |
    <a href="login.php">Login</a>|
    <a href="logout.php">Logout</a>
</nav>
<?php if(isLoggedIn()){showLoggedInUser();}?>