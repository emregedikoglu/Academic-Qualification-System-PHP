<html>
<body>
<form method='post'>
    <h3>Register</h3> <br>
    <input name="user" placeholder="Username"> </input> <br>
    <input name="pass" type="password" placeholder="Password"> </input> <br>
    <input name="email" placeholder="Email"> </input> <br>
    <input name="favIde" placeholder="Favourite IDE"> </input> <br>
    <input name="favPl" placeholder="Favourite PL"> </input> <br>
    <input type="submit" value="Register"/>
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
    $email = $_POST["email"];
    $favIde = $_POST["favIde"];
    $favPl = $_POST["favPl"];
    $userType = "user";
    $isActive = 1;
    $point = 0;
    $query_str = "insert into users(username, password, email, user_type, favourite_ide, favourite_pl, is_active, point) 
                     values('$user_name','$password','$email','$userType','$favIde','$favPl','$isActive','$point')";
    print $query_str;
    $result = $db->query($query_str);
    $n_rows = $result->num_rows;
    echo $n_rows;
    if ($n_rows != 1) {
        echo "Register successful.";
        header("Location: http://localhost:8090/labproject/login.php");
    } else {
        echo "register failed";
    }
}

?>
</body>
</html>
