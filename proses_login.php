<?php 

session_start(); 

include("test.php"); 

// Memeriksa apakah 'email' dan 'password' diset di dalam $_POST
if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email']; 
    $password = $_POST['password']; 

    $sql = "SELECT * FROM user WHERE email='$email'"; 

    $result = $test->query($sql); 
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();


$hashed_password = password_hash($password, PASSWORD_DEFAULT);

if (password_verify($password, $row['password'])) {
    $_SESSION['email'] = $email; 
    header("Location: dashboard.php"); 
    exit(); 
} else{
    header("Location: login.php?error=Incorect Email or password");
    exit();
}
    } else{
        header("Location: login.php?error=Incorect Email or password");
        exit();
    }
    

    $test->close(); 

} else {
    echo "Form tidak lengkap. <a href='login.php'>Kembali</a>";
}
?>
