<?php 
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=Calendario.xls");
    use Carbon\Carbon; 
?>
<div class="container-fluid my-5">
    <div class="row my-2">
        <div class="col-md-12 text-center">
            <h4 class="text-center my-5">
                <?= $inicio->locale('es_MX')->isoFormat('LL').' a '.$final->locale('es_MX')->isoFormat('LL'); ?>
            </h4>
            <div class="d-flex justify-content-between my-2">
                <?php 
                    //Nueva instancia para las flechas de semanas
                    $inicioFlechas = new Carbon($inicio);
                    $finalFechas = new Carbon($final);

                    $inicioHeader = new Carbon($inicio);
                    $finalHeader = new Carbon($final);
                ?>
                <a href="<?= base_url(); ?>?inicio=<?= $inicioFlechas->subWeek()->toDateString(); ?>&final=<?= $finalFechas->subWeek()->toDateString(); ?>" type="button" class="btn btn-secondary"><i class="fas fa-chevron-left"></i></a>
                <a href="<?= base_url(); ?>?inicio=<?= $inicioFlechas->addWeeks(2)->toDateString(); ?>&final=<?= $finalFechas->addWeeks(2)->toDateString(); ?>" type="button" class="btn btn-secondary"><i class="fas fa-chevron-right"></i></a>
            </div>
            <div class="table-responsive">
                <table class="table table-striped">
                   <thead>
                       <tr class="thead-dark">
                           <th class="text-center" style="vertical-align: middle;">Desarrollos</th>
                           <?php 
                               $inicioHeader->subDay();
                               while($inicioHeader->equalTo($finalHeader) == false){
                               $inicioHeader->addDay();
                           ?>
                               <th class="text-center font-weight-bold">
                                   <?= $inicioHeader->day; ?><br>
                                   <span class="small weight-normal"><?= $inicioHeader->locale('es_MX')->isoFormat('dddd'); ?></span>
                               </th>
                           <?php } ?>
                       </tr>
                   </thead>
                   <tbody>
                       <?php 
                           foreach($desarrollos as $desarrollo){ 
                           $semana = new Carbon();
                           $inicioBody = new Carbon($inicio);
                           $finalBody = new Carbon($final);
                       ?>
                           <tr>
                               <td class="text-center font-weight-bold"><?= $desarrollo['Name']; ?></td>
                               <?php 
                                   $inicioBody->subDay();
                                   while($inicioBody->equalTo($finalBody) == false){
                                   $inicioBody->addDay();
                               ?>
                                   <td class="text-center">
                                       
                                       <?php
                                           if(!is_null($calendario)){
                                               
                                               $fecha = $inicioBody->toDateString();
                                               $respuesta = buscarValorEnArrayMultidimensional($calendario, $desarrollo['id'], $fecha);
                                               if(is_null($respuesta)){ 
                                       ?>
                                                   <span class="badge badge-light <?= ($inicioBody->week() >= $semana->week()) ? 'btnAsignar' : ''; ?>" data-desarrollo="<?= $desarrollo['id']; ?>" data-fecha="<?= $inicioBody->toDateString(); ?>">Sin Asignar</span>
                                       <?php
                                               }else{
                                       ?>
                                                   <?= $calendario['data'][$respuesta]['Vendedores.first_name'].' '.$calendario['data'][$respuesta]['Vendedores.last_name']; ?>
                                                   <br>
                                                   <span class="small"><?= $calendario['data'][$respuesta]['Tipo']; ?></span>
                                                   <br>
                                                   <?php 
                                                       
                                                       if($inicioBody->week() >= $semana->week()){
                                                   ?>
                                                   [<a href="" class="small btnEditar" data-desarrollo="<?= $desarrollo['id']; ?>" data-fecha="<?= $fecha; ?>" data-vendedor="<?= $calendario['data'][$respuesta]['Vendedores']['id']; ?>" data-id="<?= $calendario['data'][$respuesta]['id']; ?>" data-tipo="<?= $calendario['data'][$respuesta]['Tipo']; ?>" data-observaciones="<?= $calendario['data'][$respuesta]['Descripcion']; ?>">Editar</a>]
                                                   <?php 
                                                       }
                                                   ?>
                                       <?php
                                               }
   
                                           }else{
                                       ?>  
                                               <span class="badge badge-light <?= ($inicioBody->week() >= $semana->week()) ? 'btnAsignar' : 'no'; ?>" data-desarrollo="<?= $desarrollo['id']; ?>" data-fecha="<?= $inicioBody->toDateString(); ?>">Sin Asignar</span>
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
</div>
