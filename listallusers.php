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
<h3>All Users</h3>
<?php

$db = new mysqli("servername", "username", "password", "dbname");
$query_all = $db->query("select user_id, username, email, favourite_ide, favourite_pl, user_type from users");

echo "<table border = 1> ";//style='border:1px'>";
echo "	<tr>"; //<th>";
echo "		<td> User ID </td>";
echo "		<td> Username </td>";
echo "      <td> Email </td>";
echo "		<td> Favourite ide </td>";
echo "		<td> Favourite pl </td>";
echo "		<td> User type </td>";
echo "	</tr>";//</th>";

while ($row = $query_all->fetch_assoc()) {
    $userid = $row["user_id"];
    $username = $row["username"];
    $email = $row["email"];
    $ide = $row["favourite_ide"];
    $pl = $row["favourite_pl"];
    $utype = $row["user_type"];
    echo "<tr>";
    echo "	<td> $userid </td>";
    echo "	<td> $username </td>";
    echo "  <td> $email </td>";
    echo "  <td> $ide </td>";
    echo "	<td> $pl </td>";
    echo "	<td> $utype </td>";//<br>";
    echo "</tr>";
    $count++;
}
echo "</table>";
?>

<form method='post'>
    <br>
    <h4>Enter user ID and set admin:</h4>
    <input name="uId" placeholder="User ID"> </input> <br>
    <input type="submit" value="Set Admin"/>
</form>

<?php
$field_names = array("uId");
$n_fields = 1;
$count = 0;
for ($i = 0; $i < $n_fields; $i++) {
    $field_name = $field_names[$i];
    if (array_key_exists($field_name, $_POST)) {
        $count++;
    }
}

if ($count == $n_fields) {
    $userId = $_POST["uId"];
    $db = new mysqli("servername", "username", "password", "dbname");

    $queryUser = $db->query("update users set user_type = 'admin' where user_id = $userId");
    echo "The selected user setted as admin.";

    session_destroy();
}
?>
</body>
</html>
