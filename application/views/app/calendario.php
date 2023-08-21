<?php
    use Carbon\Carbon; 

    $final = new Carbon($_GET['final']);
    $inicio = new Carbon($_GET['inicio']);
 ?>
<div class="container-fluid my-5">
    <div class="row my-2">
        <div class="col-md-8">
            <form id="form_filtro">
                <div class="form row">
                    <div class="col ">
                        <select class="form-control">
                            <option value="">Selecciona un Vendedor</option>
                            <?php foreach($usuarios as $usuario){ ?>
                                <option value="<?= $usuario['id']; ?>"><?= $usuario['full_name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col ">
                        <select class="form-control">
                            <option value="">Selecciona un Desarrollo</option>
                            <?php foreach($desarrollos as $desarrollo){ ?>
                                <option value="<?= $desarrollo['id']; ?>"><?= $desarrollo['Name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col">
                        <input type="text" name="daterange" class="form-control" value="" />
                    </div>
                    <button type="submit" class="btn btn-success">Filtrar</button>
                </div>
            </form>
        </div>
        <div class="col-md-4 text-right">
            <button class="btn btn-secondary mx-2">Exportar</button>
            <button class="btn btn-success mx-2 btnAgregar">Asociar</button>
        </div>
    </div>
    <div class="row my-2">
        <div class="col-md-12">
            <h2 class="text-center my-5">
                <?= $inicio->locale('es_MX')->isoFormat('LL').' a '.$final->locale('es_MX')->isoFormat('LL'); ?>
            </h2>
             <table class="table table-striped ">
                <thead>
                    <tr>
                        <th class="text-center">Días</th>
                        <?php foreach($desarrollos as $desarrollo){ ?>
                            <th><?= $desarrollo['Name']; ?></th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $inicio->subDay();
                        while($inicio->equalTo($final) == false){
                            $inicio->addDay();
                    ?>
                            <tr>
                                <td class="text-center font-weight-bold">
                                    <?= $inicio->day; ?><br>
                                    <span class="small weight-normal"><?= $inicio->locale('es_MX')->monthName; ?></span>
                                </td>
                                <td>John</td>
                                <td>Doe</td>
                                <td>john@example.com</td>
                            </tr>
                    <?php 
                        }   
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<form action="">
    <!-- The Modal -->
    <div class="modal" id="modalAgregar">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Asociar</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Fecha</label>
                        <input type="date" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Desarrollo</label>
                        <select class="form-control">
                            <option value="">Selecciona un Desarrollo</option>
                            <?php foreach($desarrollos as $desarrollo){ ?>
                                <option value="<?= $desarrollo['id']; ?>"><?= $desarrollo['Name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Vendedor</label>
                        <select name="" id="" class="form-control">
                            <option value="">Selecciona un Vendedor</option>
                            <?php foreach($usuarios as $usuario){ ?>
                                <option value="<?= $usuario['id']; ?>"><?= $usuario['full_name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Tipo</label>
                        <select name="" id="" class="form-control">
                            <option value="">Presencial</option>
                            <option value="">Virtual</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Observaciones</label>
                        <textarea class="form-control" id="" rows="4"></textarea>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" data-dismiss="modal">Agregar</button>
                </div>

            </div>
        </div>
    </div>
</form>
