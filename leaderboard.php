<html>
<body>
<?php
$db = new mysqli("servername", "username", "password", "dbname");

session_start();
$row = $_SESSION["loggedUser"];

if ($row == null)
    header("Location: http://localhost:8090/labproject/login.php");
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
<h3>Leaderboard</h3>
<?php

$db = new mysqli("servername", "username", "password", "dbname");

$query_all = $db->query("select user_id, username, point from users order by point desc");

echo "<table border = 1> ";//style='border:1px'>";
echo "	<tr>"; //<th>";
echo "		<td> User ID </td>";
echo "      <td> Username </td>";
echo "		<td> Point </td>";
echo "	</tr>";//</th>";

while ($row = $query_all->fetch_assoc()) {

    $userId = $row["user_id"];
    $username = $row["username"];
    $point = $row["point"];
    echo "<tr>";
    echo "	<td> $userId </td>";
    echo "  <td> $username </td>";
    echo "  <td> $point </td>"; //<br>";
    echo "</tr>";
    $count++;
}
echo "</table>";
?>
</body>
</html>
