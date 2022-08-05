<?php
session_start();
require_once 'connect.php';
if(!$_SESSION["id_user"]){
    header('Location: ./index.php');
}

$sql = "SELECT MONTH(date_sale) AS data, SUM(total_value) AS total
        FROM sales
        GROUP BY MONTH(date_sale) 
        ORDER BY total_value DESC";
$result = $connect->query($sql);

?>

<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Responsive sidebar template with sliding effect and dropdown menu based on bootstrap 3">
        <title>Vendas por mês</title>
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
                    <h2>TOTAL DE VENDAS POR MÊS</h2>
                    <br>
                    <div class="row">
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th scope="col">Mês</th>
                                    <th scope="col">Valor Total</th>
                                </tr>
                            </thead>
                            <?php while($row = $result->fetch_assoc()): ?>
                                <tbody>
                                    <td><?php 
                                        switch($row['data']){
                                            case 1:     
                                                echo "Janeiro"; 
                                                break;
                                            case 2:     
                                                echo "Fevereiro"; 
                                                break;
                                            case 3:     
                                                echo "Março"; 
                                                break;
                                            case 4:     
                                                echo "Abril"; 
                                                break;
                                            case 5:     
                                                echo "Maio"; 
                                                break;
                                            case 6:     
                                                echo "Junho"; 
                                                break;
                                            case 7:     
                                                echo "Julho"; 
                                                break;
                                            case 8:     
                                                echo "Agosto"; 
                                                break;
                                            case 9:     
                                                echo "Setembro"; 
                                                break;
                                            case 10:    
                                                 echo "Outubro"; 
                                                 break;
                                            case 11:    
                                                 echo "Novembro";
                                                  break;
                                            case 12:    
                                                 echo "Dezembro"; 
                                                 break; 
                                        }
                                    ?></td>
                                    <td>R$ <?php echo $row['total']; ?></td>  
                                </tbody>
                            <?php endwhile ?> 
                        </table>
                    </div>  
                </div>
            </main>
        </div>
    </body>
</html>

