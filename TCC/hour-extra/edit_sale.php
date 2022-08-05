<?php
session_start();
require_once 'connect.php';
if(!$_SESSION["id_user"]){
    header('Location: ./index.php');
}

$id_sale = $_GET['id_sale'];

$sql = "SELECT id_sale, date_sale, total_value FROM sales WHERE id_sale = $id_sale";
$result = $connect->query($sql);

if(isset($_POST['update'])){
    $date_sale = $_POST['date_sale'];
    $total_value = $_POST['total_value'];

    $sqlUp = "UPDATE sales SET date_sale = '$date_sale' ,total_value = '$total_value' WHERE id_sale = $id_sale";
    if($connect->query($sqlUp) === TRUE){
        echo "<script>location.href='./list_sales.php'</script>";
    }
}

?>

<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Responsive sidebar template with sliding effect and dropdown menu based on bootstrap 3">
        <title>Editar venda</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
            crossorigin="anonymous">
        <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
        <link href="./style/main.css" rel="stylesheet">
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="./style/main.js"></script>
    </head>

    <body>
        <div class="page-wrapper chiller-theme toggled"> 
            <?php require_once 'sidebar.php'; ?>
            <!-- sidebar-wrapper  -->
            <main class="page-content">
                <div class="container-fluid"> 
                    <h2>Editar Venda</h2>
                    <hr>
                    <div class="row">
                        <form action="" method="POST">
                            <?php while($row = $result->fetch_assoc()): ?>
                                <div class="form-group">
                                    <label for="formGroupExampleInput">Produto</label>
                                    <input value="<?php echo $row['date_sale']; ?>" name="date_sale" type="text" class="form-control" id="formGroupExampleInput" placeholder="Produto">
                                </div>
                                <div class="form-group">
                                    <label for="formGroupExampleInput2">Valor</label>
                                    <input value="<?php echo $row['total_value']; ?>"  name="total_value" type="number" class="form-control" id="formGroupExampleInput2" placeholder="Valor produto">
                                </div>
                            <?php endwhile ?>
                            <div>
                                <button name="update" type="submit" class="btn btn-primary btn-lg btn-block">Salvar</button>
                            </div>
                        </form>
                    </div>  
                </div>
            </main>
        </div>
    </body>
</html>