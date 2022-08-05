<?php
session_start();
require_once 'connect.php';
if(!$_SESSION["id_user"]){
    header('Location: ./index.php');
}

$sql = "SELECT id_sale, date_sale, total_value FROM sales ORDER BY date_sale DESC";
$result = $connect->query($sql);

?>

<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Responsive sidebar template with sliding effect and dropdown menu based on bootstrap 3">
        <title>Principal</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
            crossorigin="anonymous">
        <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
        <link href="./style/main.css" rel="stylesheet">
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script src="./style/main.js"></script>
    </head>

    <body>
        <div class="page-wrapper chiller-theme toggled"> 
            <?php require_once 'sidebar.php'; ?>
            <main class="page-content">
                <div class="container-fluid">
                    <h2>VENDAS</h2>
                    <div class="card-body">
                        <h2>
                            <button  onclick="location.href='./total_day.php'" type="button" class="btn btn-primary">TOTAL DE VENDAS POR DIA</button>
                            <button onclick="location.href='./total_month.php'" type="submit" class="btn btn-primary">TOTAL DE VENDAS POR MÊS</button>
                        </h2>
                    </div>
                    <br>
                    <div class="row">
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                <th scope="col">Data</th>
                                <th scope="col">Valor Total</th>
                                <th width="200px" scope="col">Ações</th>
                                </tr>
                            </thead>
                            <?php while($row = $result->fetch_assoc()): ?>
                                <tbody>
                                    <td><?php echo $row['date_sale']; ?></td>
                                    <td>R$ <?php echo $row['total_value']; ?></td>  
                                    <td>
                                        <button type="button" class="btn btn-warning" onclick="location.href='./edit_sale.php?id_sale=<?php echo $row['id_sale'] ?>'">Editar</button>
                                        <button type="button" class="btn btn-danger" onclick="clickDelete('<?php echo $row['id_sale'] ?>')">Excluir</button>
                                    </td>  
                                </tbody>
                            <?php endwhile ?> 
                        </table>
                    </div>  
                </div>
            </main>
        </div>
    </body>
</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
    function clickDelete(id){
        Swal.fire({
        title: 'Deseja excluir essa venda',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'SIM'
        }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                method: "POST",
                url: "./delete_sale.php",
                data: { id_sale: id }
            })
            .then(result => {
                    Swal.fire(
                    'Excluido !',
                    'Venda excluido com sucesso',
                    'success'
                    ).then(r =>{
                        location.reload();
                    })
                })
            }
        })
    }
</script>

