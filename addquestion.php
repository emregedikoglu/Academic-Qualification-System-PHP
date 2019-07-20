<html>
<body>
<?php
$db = new mysqli("servername", "username", "password", "dbname");

session_start();
$row = $_SESSION["loggedUser"];

if ($row == null)
    header("Location: http://localhost:8090/labproject/login.php");
else if ($row['user_type'] == "user")
    header("Location: http://localhost:8090/labproject/home.php");
else if ($row != null) {
    $uName = $row['username'];
    echo $uName;
}
?>

<div class="navbar-collapse collapse">
    <ul class="nav navbar-nav">
        <li><a runat="server" href="/labproject/admin.php">Home-Admin</a></li>
        <li><a runat="server" href="/labproject/listallusers.php">List All Users</a></li>
        <li><a runat="server" href="/labproject/leaderboard.php">Leaderboard</a></li>
        <li><a runat="server" href="/labproject/questions.php">List Questions</a></li>
        <li><a runat="server" href="/labproject/addquestion.php">Add Question</a></li>
        <li>
            <asp:Label Style="color: white; font-size: 30px;" ID="LabelWelcome" runat="server" Text=""
                       Visible="false"></asp:Label>
        </li>
    </ul>
</div>

<form method='post'>
    <br>
    <h3>Add Question</h3> <br>
    Question Title:<br>
    <input name="qTitle" placeholder="Question Title"> </input> <br>
    Question Text:<br>
    <input name="qText" placeholder="Question Text"> </input> <br>
    Answer:<br>
    <input name="answer" placeholder="Answer"> </input> <br>
    <input type="submit" value="Add Question"/>
</form>

<?php
$field_names = array("qTitle", "qText", "answer");
$n_fields = 3;
$count = 0;
for ($i = 0; $i < $n_fields; $i++) {
    $field_name = $field_names[$i];
    if (array_key_exists($field_name, $_POST)) {
        $count++;
    }
}

if ($count == $n_fields) {

    $db = new mysqli("servername", "username", "password", "dbname");

    $title = $_POST["qTitle"];
    $question = $_POST["qText"];
    $answer = $_POST["answer"];

    $row = $_SESSION["loggedUser"];
    $userId = $row['user_id'];

    $query_str = "insert into questions(user_id, question_text, answer, question_title) 
                    values('$userId','$question','$answer','$title')";

    $result = $db->query($query_str);
    $n_rows = $result->num_rows;
    echo $n_rows;
    if ($n_rows != 1) {
        echo "Question added.";
        header("Location: http://localhost:8090/labproject/addquestion.php");
    } else {
        echo "Fail";
    }
}
?>

</body>
</html>