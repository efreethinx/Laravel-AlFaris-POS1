      <!-- Modal -->
      <div class="modal fade" id="myModalGudang" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">Daftar Gudang</h4>
            </div>
            <div class="modal-body">
              
              

              <div class="table-responsive">
                    
                  <div class="row">
                    <div class="col-md-12">
                        <div class="grid simple ">
                            <div class="grid-title no-border">
                                &nbsp;
                            </div>
                            <div class="grid-body no-border">
                                  <!--
                                  <h3>Pilih  <span class="semi-bold">Kepala Desa</span></h3>
                                  -->
                                    <table id="tabel_gudang" class="table display" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th style="width:1%" hidden="true" >
                                                    &nbsp;
                                                </th>
                                                <th style="width:19%">Kode Gudang</th>
                                                <th style="width:40%">Nama Gudang</th>
                                                <th style="width:15%">Tipe</th>
                                                <th style="width:15%">Kurs</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                  @foreach($kontak_list as $data)
                  <tr>
                    <?php                    
                      $id = $data->id;
                    ?>
                    <td class="v-align-middle" hidden="true">
                        {{ $data->id }}
                    </td>
                    <td class="v-align-middle">{{ $data->kode_gudang }}</td>
                    <td class="v-align-middle">{{ $data->nama_gudang }}</td>
                    <th class="v-align-middle">{{ $data->tipe }}</th>
                    <th class="v-align-middle">{{ $data->kurs }}</th>
                  </tr>
                @endforeach                         
                </tbody>
                </table>
                </div>
                </div>
                </div>
                </div>
              </div>
              <!-- end table-responsive -->              
            </div>
            <div class="modal-footer">
              <input type="button" class="btn btn-success" id="btn_kontakx" value="Pilih Kontak"/>
              <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
            </div>
          </div>
        </div>
      </div>
      <!-- /Modal -->