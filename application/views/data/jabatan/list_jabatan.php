  <!-- partial -->
  <div class="main-panel">
      <div class="content-wrapper">
          <div class="page-header">
              <h3 class="page-title"> <?= $breadcumb ?> </h3>
              <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="#">Tables</a></li>
                      <li class="breadcrumb-item active" aria-current="page"><?= $breadcumb ?></li>
                  </ol>
              </nav>
          </div>
          <div class="row">
              <div class="col-lg-12 grid-margin stretch-card">
                  <div class="card">
                      <div class="card-body">
                          <h4 class="card-title"><?= $breadcumb ?> </h4>
                          <button style="float: right;margin-top:-50px;" type="button" class="btn btn-outline-primary btn-icon-text">
                            <i class="mdi mdi-database-plus btn-icon-prepend"></i> Tambah Data </button>
                          <div class="table-responsive">
                              <table class="table table-bordered table-striped  dataTable js-exportable mt-3">
                                  <thead>
                                      <tr>
                                          <th>No</th>
                                          <th>Nama Jabatan</th>
                                          <th>Gaji</th>
                                          <th>Action</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <?php $i = 1;
                                        foreach ($data_jabatan as $row) { ?>
                                          <tr>
                                              <th><?= $i++ ?></th>
                                              <td><?= $row['nama_jabatan'] ?></td>
                                              <td>Rp <?= number_format($row['gaji'], 0, ".", "."); ?></td>
                                              <td>
                                                  <center>
                                                      <button type="button" class="btn btn-inverse-success btn-rounded btn-icon" data-toggle="tooltip" data-placement="top" title="Edit Data">
                                                          <i class="mdi mdi-pencil-box-outline"></i>
                                                      </button>
                                                      <button type="button" class="btn btn-inverse-danger btn-rounded btn-icon" data-toggle="tooltip" data-placement="top" title="Delete Data">
                                                          <i class="mdi mdi-delete-forever"></i>
                                                      </button>
                                                  </center>
                                              </td>
                                          </tr>
                                      <?php } ?>
                                  </tbody>
                              </table>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <!-- content-wrapper ends -->
      <div class="modal fade" id="modal_verif" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h4 class="modal-title" id="title_modal"></h4>
                  </div>
                  <hr>
                  <div class="modal-body">

                  </div>
                  <hr>
                  <div class="modal-footer">
                      <button type="submit" class="btn btn-primary btn-fw">SAVE CHANGES</button>
                      <button type="button" class="btn btn-outline-secondary btn-fw" data-dismiss="modal">CLOSE</button>
                      </form>
                  </div>
              </div>
          </div>
      </div>