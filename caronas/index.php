<?php

include_once('../assets/php/classCaronas.php');

use Ride\PHP\Model\Caronas;

if (isset($_POST['createCarona'])) {

    $newCarona = new Caronas;
    $newCarona->setData($_POST['data']);
    $newCarona->setOrigem($_POST['origem']);
    $newCarona->setDestino($_POST['destino']);
    $newCarona->setVagas($_POST['vagas']);
    $newCarona->setPreco($_POST['preco']);
    try {
        $newCarona->create();
        $result = "Carona inserida com sucesso.";
    } catch (Exception $e) {
        $error = "Houve uma falha ao inserir sua carona. <p> Falha: " . $e;
    }
}

if (isset($_POST['updateCarona'])) {
    $carona = new Caronas;
    $carona->setIDCaronas($_POST['idcaronas']);
    $carona->setData($_POST['data']);
    $carona->setOrigem($_POST['origem']);
    $carona->setDestino($_POST['destino']);
    $carona->setVagas($_POST['vagas']);
    $carona->setPreco($_POST['preco']);
    try {
        $carona->update();
        $result = "Carona atualizada com sucesso.";
    } catch (Exception $e) {
        $error = "Houve uma falha ao atualizar sua carona. <p> Falha: " . $e;
    }
}

if (isset($_POST['deleteCarona'])) {
    $oldCarona = new Caronas;
    $oldCarona->setIDCaronas($_POST['idcaronas']);
    try {
        $oldCarona->delete();
        $result = "Carona cancelada com sucesso.";
    } catch (Exception $e) {
        $error = "Houve uma falha ao cancelar sua carona. <p> Falha: " . $e;
    }
}

?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Minhas Caronas | Ride</title>

    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/fonts/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="../assets/css/animate.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
    <link href="../assets/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
    <link href="../assets/css/plugins/chosen/chosen.css" rel="stylesheet">

</head>

<body>

    <!-- BEGIN WRAPPER -->
    <div id="wrapper">

        <!-- BEGIN LEFT MENU -->
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                    
                    <li>
                        <a href="../index.html"><i class="fa fa-th-large"></i> <span class="nav-label">Página Inicial</span></a>
                    </li>
                    <li class="active">
                        <a href=""><i class="fa fa-car"></i> <span class="nav-label">Minhas Caronas</span></a>
                    </li>
                    
                </ul>
            </div>
        </nav>
        <!-- END LEFT MENU -->

        <!-- BEGIN PAGE -->
        <div id="page-wrapper" class="gray-bg">

            <!-- BEGIN TOP NAVBAR -->
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header">
                        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                    </div>
                </nav>
            </div>
            <!-- END TOP NAVBAR -->

            <!-- BEGIN PAGE HEADER -->
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Minhas Caronas</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="../index.html">Home</a>
                        </li>
                        <li class="active">
                            <strong>Minhas Caronas</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
            </div>
            <!-- END PAGE HEADER -->

            <!-- BEGIN CONTENT -->
            <div class="wrapper wrapper-content animated fadeInRight">

                <!-- BEGIN FEEDBACK MESSAGES -->
                <div class="row" id="temporizador">
                    <?php if (isset($result)) { ?>
                    <div class="alert alert-success">
                        <?php echo $result; ?>
                    </div>
                    <?php }else if(isset($error)){ ?>
                    <div class="alert alert-danger">
                        <?php echo $error; ?>
                    </div>
                    <?php } ?>
                </div>
                <!-- END FEEDBACK MESSAGES -->

                <!-- BEGIN ESTADOS TABLE -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>Caronas</h5>
                                <div class="ibox-tools">
                                    <a class="collapse-link">
                                        <i class="fa fa-chevron-up"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="ibox-content">
                                <div class="table-responsive">
                                    <a data-toggle="modal" data-target="#createCarona" class="btn btn-primary ">Ofertar carona</a>
                                </div>
                                <table class="table table-striped table-bordered table-hover display" id="">
                                    <thead>
                                        <tr>
                                            <th>Data</th>
                                            <th>Origem</th>
                                            <th>Destino</th>
                                            <th>Vagas Disponíveis</th>
                                            <th>Preço</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $caronas = new Caronas(); 
                                            $stmt = $caronas->index();
                                            while ($row = $stmt->fetch(PDO::FETCH_OBJ)){
                                        ?>
                                        <tr class="gradeA">
                                            <td><?php echo $row->data . " " . $row->hora; ?></td>
                                            <td><?php echo $row->origem; ?></td>
                                            <td><?php echo $row->destino; ?></td>
                                            <td><?php echo $row->vagas; ?></td>
                                            <td>R$ <?php echo $row->preco; ?></td>
                                            <td class="center">
                                                <div class="list-tools"> 
                                                    <a data-toggle="modal" data-target="#updateCarona<?php echo $row->idcaronas;  ?>">
                                                        <i class="fa fa-pencil "></i>
                                                    </a>
                                                    &nbsp
                                                    <a data-toggle="modal" data-target="#deleteCarona<?php echo $row->idcaronas; ?>">
                                                        <i class="fa fa-times"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php 
                                            }; 
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Data</th>
                                            <th>Origem</th>
                                            <th>Destino</th>
                                            <th>Vagas Disponíveis</th>
                                            <th>Preço</th>
                                            <th>Ações</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END ESTADOS TABLE -->

            </div>
            <!-- END CONTENT -->

            <!-- BEGIN FOOTER -->
            <div class="footer">
                <!-- <div>
                    <strong>Copyright</strong> Víctor Ballestrini &copy; 2017
                </div> -->
            </div>
            <!-- END FOOTER -->

        </div>
        <!-- END PAGE -->

    </div>
    <!-- END WRAPPER -->  

    <!-- BEGIN MODAL INSERT CARONA -->
    <div class="modal inmodal" id="createCarona" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <form action="" method="post" role="form" enctype="multipart/form-data" >
                <div class="modal-content animated bounceInRight">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Fechar</span></button>
                        <h4 class="modal-title">Nova Carona</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Data e Hora da Partida</label> 
                            <input name="data" type="datetime-local" placeholder="Digite o CPF do cliente" class="form-control" value="<?php echo date('Y-m-d')."T".date("H:i"); ?>" min="<?php echo date('Y-m-d')."T".date("H:i"); ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Origem</label> 
                            <input name="origem" type="text" placeholder="Informe a cidade de origem" class="form-control" required>
                            <label>Destino</label> 
                            <input name="destino" type="text" placeholder="Informe a cidade de destino" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Vagas Disponíveis</label> 
                            <input name="vagas" type="number" max="5" min="1" placeholder="Informe a quantidade de vagas no carro" class="form-control" required>
                            <label>Preço em R$</label> 
                            <input name="preco" type="number" min="1" step="1" placeholder="Informe o valor cobrado na carona" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Cancelar</button>
                        <button type="submit" name="createCarona" class="btn btn-primary">Salvar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- END MODAL INSERT CARONA -->

    <!-- BEGIN MODAL UPDATE CARONA -->
    <?php
        $caronas = new Caronas(); 
        $stmt = $caronas->index();
        while ($row = $stmt->fetch(PDO::FETCH_OBJ)){
    ?>
    <div class="modal inmodal" id="updateCarona<?php echo $row->idcaronas; ?>" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <form action="" method="post" role="form" enctype="multipart/form-data" >
                <div class="modal-content animated bounceInRight">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Fechar</span></button>
                        <h4 class="modal-title">Alterar Carona</h4>
                    </div>
                    <div class="modal-body">
                        <input name="idcaronas" type="hidden" class="form-control" value="<?php echo $row->idcaronas; ?>">
                        <div class="form-group">
                            <label>Data e Hora da Partida</label>
                            <input name="data" type="datetime-local" placeholder="Digite o CPF do cliente" class="form-control" value="<?php echo $row->dataform . "T" . $row->hora; ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Origem</label> 
                            <input name="origem" type="text" placeholder="Informe a cidade de origem" class="form-control" value="<?php echo $row->origem; ?>" required>
                            <label>Destino</label> 
                            <input name="destino" type="text" placeholder="Informe a cidade de destino" class="form-control" value="<?php echo $row->destino; ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Vagas Disponíveis</label> 
                            <input name="vagas" type="number" max="5" min="1" placeholder="Informe a quantidade de vagas no carro" class="form-control" value="<?php echo $row->vagas; ?>" required>
                            <label>Preço em R$</label> 
                            <input name="preco" type="number" min="1" step="1" placeholder="Informe o valor cobrado na carona" class="form-control" value="<?php echo $row->preco; ?>" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Cancelar</button>
                        <button type="submit" name="updateCarona" class="btn btn-primary">Salvar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php  
        };
    ?>
    <!-- END MODAL UPDATE CARONA -->

    <!-- BEGIN MODAL DELETE CARONA -->
    <?php 
        $caronas = new Caronas(); 
        $stmt = $caronas->index();
        while ($row = $stmt->fetch(PDO::FETCH_OBJ)){
    ?>
    <div class="modal inmodal fade" id="deleteCarona<?php echo $row->idcaronas; ?>" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <form action="" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header delete">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title">Zona de Perigo</h4>
                        <input type="hidden" name="idcaronas" value="<?php echo $row->idcaronas; ?>">
                    </div>
                    <div class="modal-body">
                        <p>Você tem certeza que deseja <strong>cancelar</strong> essa carona?</p> 
                        <p>Essa ação será permanente.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="deleteCarona" class="btn btn-danger">Confirmar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php  
        };
    ?>
    <!-- END MODAL DELETE CARONA -->

    <!-- Mainly scripts -->
    <script src="../assets/js/jquery-2.1.1.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="../assets/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- DataTables -->
    <script src="../assets/js/plugins/dataTables/datatables.min.js"></script>

    <!-- Chosen -->
    <script src="../assets/js/plugins/chosen/chosen.jquery.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="../assets/js/inspinia.js"></script>
    <script src="../assets/js/plugins/pace/pace.min.js"></script>

    <!-- Page-Level Scripts -->
    <script>
        $(document).ready(function() {
            $('table.display').DataTable();

            setTimeout("$('#temporizador').hide()", 4000);
        } );
    </script>

</body>
</html>
