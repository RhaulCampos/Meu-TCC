<?php
require_once 'connect.php';
?>
<div class="container">
<?php
session_start();
$erro = "";
$id_user = "";
$full_name = "";

if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT id_user, full_name FROM users WHERE email = '$email' AND password = '$password'";
    $result = $connect->query($sql);

    while($row = $result->fetch_assoc()){
       $id_user = $row['id_user'];  
       $full_name = $row['full_name'];  
    }

    $_SESSION["id_user"] = $id_user;
    $_SESSION["full_name"] = $full_name;

    if($id_user){
        header('Location: ./main.php');
    }else{
        $erro = "Usuário ou Senha inválido";  
    }
}
?>
<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login</title>
    <link href="./bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="./style/login.css" rel="stylesheet">

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  </head>

    <body class="text-center">
        <div class="wrapper fadeInDown">
            <div id="formContent">

            <div class="fadeIn first">
                <h1>LOGIN</h1>
            </div>
                <form action="" method="POST">
                    <input name="email" type="text" id="login" class="fadeIn second" name="login" placeholder="E-mail">
                    <input name="password" type="password" id="password" class="fadeIn third" name="login" placeholder="Senha">
                    <input name="login" type="submit" class="fadeIn fourth" value="ENTRAR">
                </form>

                <div id="formFooter">
                    <p style="color:firebrick"><?php echo $erro; ?></p>
                    <p>HORA EXTRA</p> 
                </div>

            </div>
        </div>
    </body>
</html>


<?php





