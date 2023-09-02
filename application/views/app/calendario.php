<div class="container-fluid my-5">
    <div class="row my-2">
        <div class="col-md-8">
            <form id="formFiltro">
                <div class="form row">
                    <div class="col ">
                        <select class="form-control" id="filtro_desarrollo" name="filtro_desarrollo">
                            <option value="">Todos los Desarrollos</option>
                            <?php foreach($desarrollos as $desarrollo){ ?>
                                <option <?= (isset($_GET['desarrollo']) && $_GET['desarrollo'] ==  $desarrollo['id']) ? 'selected' : ''; ?> value="<?= $desarrollo['id']; ?>"><?= $desarrollo['Name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col ">
                        <select class="form-control" id="filtro_vendedor" name="filtro_vendedor">
                            <option value="">Todos los Vendedores</option>
                            <?php foreach($usuarios as $usuario){ ?>
                                <option <?= (isset($_GET['vendedor']) && $_GET['vendedor'] ==  $usuario['id']) ? 'selected' : ''; ?> value="<?= $usuario['id']; ?>"><?= $usuario['full_name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col">
                        <input type="text" id="daterange" name="daterange" class="form-control" value="<?= $inicio->format('Y/m/d'); ?> - <?= $final->format('Y/m/d'); ?>" />
                    </div>
                    <button type="submit" class="btn btn-success">Filtrar</button>
                    <a href="<?= base_url(); ?>" class="btn btn-info mx-2">Resetear</a>
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
                                                    [<a href="" class="small btnEditar" data-desarrollo="<?= $desarrollo['id']; ?>" data-fecha="<?= $fecha; ?>" data-vendedor="<?= $calendario['data'][$respuesta]['Vendedores']['id']; ?>" data-id="<?= $calendario['data'][$respuesta]['id']; ?>" data-tipo="<?= $calendario['data'][$respuesta]['Tipo']; ?>" data-observaciones="<?= $calendario['data'][$respuesta]['Descripcion']; ?>">Editar</a>]
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

<?php echo $this->template->widget("formCalendario"); ?>