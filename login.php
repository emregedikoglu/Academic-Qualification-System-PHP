<html>
<body>
<form method='post'>
    <h3>Login</h3><br>
    <label> Username: </label> <input name="user"> </input> <br>
    <label> Password: </label> <input name="pass" type="password"> </input> <br>
    <input type="submit" value="Login"/>
</form>
<?php
$field_names = array("user", "pass");
$n_fields = 2;
$count = 0;
for ($i = 0; $i < $n_fields; $i++) {
    $field_name = $field_names[$i];
    if (array_key_exists($field_name, $_POST)) {
        $count++;
    }
}

if ($count == $n_fields) {
    echo "Posted sth.";
    $db = new mysqli("servername", "username", "password", "dbname");

    $user_name = $_POST["user"];
    $password = $_POST["pass"];
    $query_str = "select * from users where username = \"" . $user_name . "\" and password = \"" . $password . "\" LIMIT 1";

    $result = $db->query($query_str);

    $n_rows = $result->num_rows;

    if ($n_rows == 1) {
        echo "Login successful.";
        $row = mysqli_fetch_assoc($result);

        session_start();
        $_SESSION["loggedUser"] = $row;

        if ($row['user_type'] == "admin")
            header("Location: http://localhost:8090/labproject/admin.php");
        else
            header("Location: http://localhost:8090/labproject/home.php");
    } else {
        echo "password or username mismatch";
    }
}

?>
</body>
</html>
