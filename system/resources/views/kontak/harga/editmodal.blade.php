<!-- Update item modal -->
    <div class="modal fade" id="edit-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Update Harga Jual Pelanggan</h4>
          </div>
          <!--
          <div class="modal-body" id="edit-loading-bar">
            <div class="progress">
            <div class="progress-bar progress-bar-success progress-bar-striped active loading-bar" role="progressbar" aria-valuenow="100">
            </div>
            </div>
          </div> -->
          <form method="post" id="update-form" class="form-horizontal">
          {{ method_field('PATCH') }}

          <input type="hidden" name="id" id="id" class="form-control">
            <div class="modal-body">  

              <div class="form-group">
                <label for="kontak_id" class="col-sm-4 label-control">Pelanggan</label>
                <div class="col-sm-6">
                <input type="text" class="form-control" name="kontak_id" id="kontak_id"  readonly="true">
                </div>
              </div>

              <div class="form-group">
                <label for="kontak_id" class="col-sm-4 label-control">Produk</label>
                <div class="col-sm-6">
                <input type="text" class="form-control" name="produk_id" id="produk_id" readonly="true">
              </div>
              </div>

              <div class="form-group">
                <label for="uom_id" class="col-sm-4 label-control">Satuan</label>
                <div class="col-sm-6">              
                <input type="text" name="uom_id" class="form-control" id="uom_id">
              </div>
              </div>

              <div class="form-group">
                <label for="harga_jual_pelanggan" class="col-sm-4 label-control">Harga Jual Standar</label>
                <div class="col-sm-6">
              
              <input type="text" name="harga_jual_standar" class="form-control" id="harga_jual_standar"  readonly="true">
              </div>
              </div>

              <div class="form-group">
                <label for="harga_jual_pelanggan" class="col-sm-4 label-control">Harga Jual Pelanggan</label>
                <div class="col-sm-6">
              
              <input type="text" name="harga_jual_pelanggan" class="form-control" id="harga_jual_pelanggan">
              </div>
              </div>

            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-success"  id="update-submit">Update</button>
              <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
            </div>
          </form>
        </div>
      </div>
    </div>