<?php
session_start();
require_once 'connect.php';
if(!$_SESSION["id_user"]){
    header('Location: ./index.php');
}

$sql = "SELECT id_products, name_products, amount, value FROM products";
$result = $connect->query($sql);

$alunos = array();
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
                    <div class="card">
                        <h5 class="card-header">VENDA</h5>
                        <div class="card-body">
                            <form id="form">
                                <h2>
                                    TOTAL VENDA: R$ <b id="resultSum"></b>
                                    <button onclick="zeroSale()" type="button" class="btn btn-danger">ZERAR VENDA</button>
                                    <button type="submit" class="btn btn-success">FECHAR VENDA</button>
                                </h2>
                                <ul>
                                    <div id="resultName"></div>
                                </ul>
                                <!-- <b style="font-size: 25px;" id="resultName"></b>:
                                <b style="font-size: 25px;" id="resultAmount"></b> -->
                            </form>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                <th scope="col">VENDER</th>
                                <th scope="col">Produto</th>
                                <th scope="col">Quantidade</th>
                                <th scope="col">Valor</th>
                                <th width="200px" scope="col">Ações</th>
                                </tr>
                            </thead>
                            <?php while($row = $result->fetch_assoc()): ?>
                                <?php  $dataResult[] = $row['id_products'] . " " . $row['amount']; ?>
                                <tbody>
                                    <td><button type="button" class="btn btn-success" onclick="sale('<?php echo $row['name_products']; ?>','<?php echo $row['amount']; ?>', '<?php echo $row['value'] ?>', '<?php echo $row['id_products'] ?>')">VENDER</button></td>
                                    <td><?php echo $row['name_products']; ?></td>
                                    <td><?php echo $row['amount']; ?></td>
                                    <td>R$<?php echo $row['value']; ?></td>  
                                    <td>
                                        <button type="button" class="btn btn-warning" onclick="location.href='./edit_product.php?id_product=<?php echo $row['id_products'] ?>'">Editar</button>
                                        <button type="button" class="btn btn-danger" onclick="clickDelete('<?php echo $row['id_products'] ?>')">Excluir</button>
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
    title: 'Deseja excluir esse produto',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'SIM'
    }).then((result) => {
    if (result.isConfirmed) {
        $.ajax({
            method: "POST",
            url: "./delete_product.php",
            data: { id_product: id }
        })
        .then(result => {
                Swal.fire(
                'Excluido !',
                'Produto excluido com sucesso',
                'success'
                ).then(r =>{
                    location.reload();
                })
            })
        }
    })
}

let numSale = 0;
let data = [];
let a = 0
let amountProducts = 0;
let teste = [];
let numAmount = 0;
let = []

document.getElementById("resultSum").innerHTML = numSale;

function sale(name, amount, valueProduct, id_products){  
    var dados = <?=json_encode($dataResult)?>  
    let total = 0;
    let countTotal = 0;
    for(let item of dados){
        let json = item.split(' ')
        if(id_products == json[0]){
           total = json[1];
        }
    }

    data.push({id: id_products, totalAmount: numAmount });
    let countId = [];
    var arrByID = data.filter(function(i) {
        if(i.id == id_products){
            countId.push(i.id)
        }
    });
    
    for(let item of countId){
        countTotal = total - countId.length;
        teste.push({id: item, total: countTotal})
    }
    arrayUniqueByKey = [...new Map(teste.map(item => [item.id, item])).values()];

    if(countTotal < 0){
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Esse produto não tem mais no estoque',
        })
    }else{
        numSale = numSale + parseInt(valueProduct);
        showTotalSale(numSale);
    }
}


function showTotalSale(valor) {
    document.getElementById("resultSum").innerHTML = valor;
}

function amountProduct(value){
    document.getElementById("resultAmount").innerHTML = value;
}

function zeroSale() {
    numSale = 0
    document.getElementById("resultSum").innerHTML = numSale;
}

$('#form').submit(function(e){
	e.preventDefault();
    console.log(arrayUniqueByKey)
    $.ajax({
        method: "POST",
        url: "./crate_sales.php",
        data: { total_sales: numSale, data: arrayUniqueByKey }
    })
    .then(result => {
        Swal.fire(
        'Venda !',
        'Venda concluida com sucesso',
        'success'
        ).then(r =>{
            location.reload();
        })
    })
});

</script>