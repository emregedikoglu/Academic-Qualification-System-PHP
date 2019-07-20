<html>
<body>
<?php
$db = new mysqli("servername", "username", "password", "dbname");

session_start();
$row = $_SESSION["loggedUser"];

if ($row == null)
    header("Location: http://localhost:8090/labproject/login.php");
else if ($row['user_type'] == "admin")
    header("Location: http://localhost:8090/labproject/admin.php");
else if ($row != null) {
    $uName = $row['username'];
    echo $uName;
}
?>

<div class="navbar-collapse collapse">
    <ul class="nav navbar-nav" method="get">
        <li><a runat="server" href="/labproject/home.php">Home</a></li>
        <li><a runat="server" href="/labproject/listallusers.php">List All Users</a></li>
        <li><a runat="server" href="/labproject/leaderboard.php">Leaderboard</a></li>
        <li><a runat="server" href="/labproject/questions.php">List Questions</a></li>
    </ul>
</div>

</body>
</html>
