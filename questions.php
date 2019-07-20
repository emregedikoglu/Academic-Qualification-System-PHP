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
<h3>Questions:</h3>
<?php

$db = new mysqli("servername", "username", "password", "dbname");

$query_all = $db->query("select question_id, question_title from questions");

echo "<table border = 1> ";//style='border:1px'>";
echo "	<tr>"; //<th>";
echo "		<td> ID </td>";
echo "      <td> Title </td>";
echo "	</tr>";//</th>";

while ($row = $query_all->fetch_assoc()) {

    $qId = $row["question_id"];
    $qTitle = $row["question_title"];
    echo "<tr>";
    echo "	<td> $qId </td>";
    echo "  <td> $qTitle </td>";//<br>";
    echo "</tr>";
    $count++;
}
echo "</table>";

?>

<form method='post'>
    <br>
    <h4>Enter question ID to show question:</h4>
    <input name="qId" placeholder="Question ID"> </input> <br>
    <input type="submit" value="Show Question"/>
</form>

<?php
$field_names = array("qId");
$n_fields = 1;
$count = 0;
for ($i = 0; $i < $n_fields; $i++) {
    $field_name = $field_names[$i];
    if (array_key_exists($field_name, $_POST)) {
        $count++;
    }
}

if ($count == $n_fields) {
    $qId = $_POST["qId"];
    header("Location: http://localhost:8090/labproject/showquestion.php?id=".$qId);
}
?>
</body>
</html>
