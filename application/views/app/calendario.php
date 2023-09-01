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
                        <input type="text" name="daterange" class="form-control" value="<?= $inicio->format('Y/m/d'); ?> - <?= $final->format('Y/m/d'); ?>" />
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
                        <?php foreach($desarrollos as $desarrollo2){ ?>
                            <th class="text-center"><?= $desarrollo2['Name']; ?></th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        function buscarValorEnArrayMultidimensional($array, $desarrollo, $fecha) {
                            foreach($array['data'] as $clave => $valor){
                                if($valor['Desarrollos.id'] === $desarrollo && $valor['Fecha'] === $fecha){
                                    return $clave;
                                }
                            }
                        }
                        $inicio->subDay();
                        while($inicio->equalTo($final) == false){
                            $inicio->addDay();
                            ?>
                            <tr>
                                <td class="text-center font-weight-bold">
                                    <?= $inicio->day; ?><br>
                                    <span class="small weight-normal"><?= $inicio->locale('es_MX')->isoFormat('dddd'); ?></span>
                                </td>
                                <?php foreach($desarrollos as $desarrollo){
                                    ?>
                                    <td class="text-center">
                                        <?php
                                            if(!is_null($calendario)){
                                                
                                                $fecha = $inicio->toDateString();
                                                $respuesta = buscarValorEnArrayMultidimensional($calendario, $desarrollo['id'], $fecha);
                                                if(is_null($respuesta)){ 
                                        ?>
                                                    <span class="badge badge-light btnAsignar" data-desarrollo="<?= $desarrollo['id']; ?>" data-fecha="<?= $inicio->toDateString(); ?>">Sin Asignar</span>
                                        <?php
                                                }else{
                                        ?>
                                                    <?= $calendario['data'][$respuesta]['Vendedores.first_name'].' '.$calendario['data'][$respuesta]['Vendedores.last_name']; ?>
                                                    <br>
                                                    <span class="small"><?= $calendario['data'][$respuesta]['Tipo']; ?></span>
                                                    <br>
                                                    [<a href="" class="small btnEditar" data-desarrollo="<?= $desarrollo['id']; ?>" data-fecha="<?= $fecha; ?>" data-vendedor="<?= $calendario['data'][$respuesta]['Vendedores']['id']; ?>" data-id="<?= $calendario['data'][$respuesta]['id']; ?>">Editar</a>]
                                        <?php
                                                }

                                            }else{
                                        ?>
                                                <span class="badge badge-light btnAsignar" data-desarrollo="<?= $desarrollo['id']; ?>" data-fecha="<?= $inicio->toDateString(); ?>">Sin Asignar</span>
                                        <?php
                                            }
                                        ?>
                                    </td>
                                <?php } ?>
                            </tr>
                    <?php 
                        }   
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<form id="formCalendario">
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
                        <label for="">Id</label>
                        <input type="text" class="form-control" name="id" id="id">
                    </div>
                    <div class="form-group">
                        <label for="">Fecha</label>
                        <input type="date" class="form-control" name="fecha" id="fecha">
                    </div>
                    <div class="form-group">
                        <label for="">Desarrollo</label>
                        <select class="form-control" id="desarrollo" name="desarrollo">
                            <option value="">Selecciona un Desarrollo</option>
                            <?php foreach($desarrollos as $desarrollo){ ?>
                                <option value="<?= $desarrollo['id']; ?>"><?= $desarrollo['Name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Vendedor</label>
                        <select name="vendedor" class="form-control" id="vendedor">
                            <option value="">Selecciona un Vendedor</option>
                            <?php foreach($usuarios as $usuario){ ?>
                                <option value="<?= $usuario['id']; ?>"><?= $usuario['full_name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Tipo</label>
                        <select name="tipo" id="tipo" class="form-control">
                            <option value="">Presencial</option>
                            <option value="">Virtual</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Observaciones</label>
                        <textarea class="form-control" id="observaciones" name="observaciones" rows="4"></textarea>
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
