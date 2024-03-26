<?php
include('header.php');
if (isset($_POST['login'])) {
    $username = get_safe_value($_POST['username']);
    $password = get_safe_value($_POST['password']);

    $res = mysqli_query($con, "select * from users where username = '$username' and password = '$password'");

    if(mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_assoc($res);
        $_SESSION['UID'] = $row['id'];
        $_SESSION['UNAME'] = $row['name'];
        redirect('dashboard.php');
    }else {
        echo "Please enter a valid login details";
    }

}

?>

<h2>Log in</h2>
<form method="POST">
    <table>
        <tr>
            <td>Username</td>
            <td><input type="text" name='username' required></td>
        </tr>
        <tr>
            <td>Password</td>
            <td><input type="password" name='password' required></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" name='login' value='login'></td>
        </tr>
    </table>
</form>

<?php
include('footer.php');
?>