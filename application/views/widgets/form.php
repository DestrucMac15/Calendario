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
                    <div class="form-group" hidden>
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
                            <option value="Presencial">Presencial</option>
                            <option value="Virtual">Virtual</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Observaciones</label>
                        <textarea class="form-control" id="observaciones" name="observaciones" rows="4"></textarea>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Agregar</button>
                </div>
            </div>
        </div>
    </div>
</form>