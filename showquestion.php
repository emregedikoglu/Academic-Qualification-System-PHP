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
<h3>Question:</h3>
<?php

$db = new mysqli("servername", "username", "password", "dbname");
$id = $_GET['id'];

$query_str = $db->query("select question_id, question_title, question_text from questions
                                    where question_id = $id");

echo "<table border = 1> ";//style='border:1px'>";
echo "	<tr>"; //<th>";
echo "		<td> ID </td>";
echo "      <td> Title </td>";
echo "      <td> Question </td>";
echo "	</tr>";//</th>";

while ($row = $query_str->fetch_assoc()) {

    $qId = $row["question_id"];
    $qTitle = $row["question_title"];
    $qText = $row["question_text"];
    echo "<tr>";
    echo "	<td> $qId </td>";
    echo "  <td> $qTitle </td>";
    echo "  <td> $qText </td>";//<br>";
    echo "</tr>";
    $count++;
}
echo "</table>";

?>

<form method='post'>
    <br>
    <h4>Enter answer</h4>
    <input name="qAnswer" placeholder="Answer"> </input> <br>
    <input type="submit" value="Answer Question"/>
</form>

<?php
$field_names = array("qAnswer");
$n_fields = 1;
$count = 0;
for ($i = 0; $i < $n_fields; $i++) {
    $field_name = $field_names[$i];
    if (array_key_exists($field_name, $_POST)) {
        $count++;
    }
}

if ($count == $n_fields) {
    $db = new mysqli("servername", "username", "password", "dbname");
    $qAnswer = $_POST["qAnswer"];
    $id = $_GET['id'];

    $query_str = "select question_id, question_title, question_text, answer from questions
                                    where question_id = $id";
    $result = $db->query($query_str);
    $row = mysqli_fetch_assoc($result);
    $answer = $row["answer"];

    session_start();
    $row2 = $_SESSION["loggedUser"];
    $uId = $row2['user_id'];

    $query_str2 = "select question_id, user_id from solvedby
                                    where question_id = $id and user_id = $uId";
    $result2 = $db->query($query_str2);
    $row3 = mysqli_fetch_assoc($result2);

    if($qAnswer == $answer) {
        if($row3 == null) {
            $query_str3 = $db->query("insert into solvedby(question_id, user_id) 
                    values('$id','$uId')");

            $p = $db->query("select point from users where user_id = $uId");
            $row4 = mysqli_fetch_assoc($p);
            $point = $row4['point'];
            $point = $point+1;
            $uPoint = $db->query("update users set point = $point where user_id = $uId");
            echo "True Answer";
        }
        else {

            echo "You have already answered this question!";
        }
    }
    else {
        if($row3 == null) {
            $query_str3 = $db->query("insert into solvedby(question_id, user_id) 
                    values('$id','$uId')");

            $p = $db->query("select point from users where user_id = $uId");
            $row4 = mysqli_fetch_assoc($p);
            $point = $row4['point'];
            $point = $point-1;
            $uPoint = $db->query("update users set point = $point where user_id = $uId");
            echo "False Answer";
        }
        else
            echo "You have already answered this question!";
    }
}
?>
</body>
</html>
