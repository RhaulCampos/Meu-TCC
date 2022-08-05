<?php
session_start();
require_once 'connect.php';
if(!$_SESSION["id_user"]){
    header('Location: ./index.php');
}

$id_product = $_GET['id_product'];

$sql = "SELECT id_products, name_products, amount, value FROM products WHERE id_products = $id_product";
$result = $connect->query($sql);

if(isset($_POST['update'])){
    $product = $_POST['product'];
    $value = $_POST['value'];
    $amountProduct = $_POST['amountProduct'];

    $sqlUp = "UPDATE products SET name_products = '$product' ,amount = $amountProduct, value = $value  WHERE id_products = $id_product";
    if($connect->query($sqlUp) === TRUE){
        echo "<script>location.href='./main.php'</script>";
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
        <title>Editar Produtos</title>
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
                    <h2>Editar Produtos</h2>
                    <hr>
                    <div class="row">
                        <form action="" method="POST">
                            <?php while($row = $result->fetch_assoc()): ?>
                                <div class="form-group">
                                    <label for="formGroupExampleInput">Produto</label>
                                    <input value="<?php echo $row['name_products']; ?>" name="product" type="text" class="form-control" id="formGroupExampleInput" placeholder="Produto">
                                </div>
                                <div class="form-group">
                                    <label for="formGroupExampleInput2">Valor</label>
                                    <input value="<?php echo $row['value']; ?>"  name="value" type="number" class="form-control" id="formGroupExampleInput2" placeholder="Valor produto">
                                </div>
                                <div class="form-group">
                                    <label for="formGroupExampleInput2">Quantidade</label>
                                    <input value="<?php echo $row['amount']; ?>" name="amountProduct" type="number" class="form-control" id="formGroupExampleInput2" placeholder="Qtde produto">
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