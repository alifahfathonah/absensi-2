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
                          <h4 class="card-title"><?= $breadcumb ?></h4>
                          </p>
                          <div class="table-responsive">
                              <table class="table table-bordered dataTable js-exportable mt-3">
                                  <thead>
                                      <tr>
                                          <th>No</th>
                                          <th>NIK</th>
                                          <th>Nama Lengkap</th>
                                          <th>No Telepon</th>
                                          <th>Device ID</th>
                                          <th>Action</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <?php $i = 0;
                                        foreach ($data_karyawan as $row) {
                                            $i++; ?>
                                          <tr>
                                              <td><?= $i; ?></td>
                                              <td><?= $row['nik'] ?></td>
                                              <td><?= $row['nama_lengkap'] ?></td>
                                              <td><?= sprintf(
                                                        "%s-%s-%s",
                                                        substr($row['no_telp'], 0, 4),
                                                        substr($row['no_telp'], 4, 4),
                                                        substr($row['no_telp'], 8)
                                                    ); ?></td>
                                              <td><?= strtoupper($row['device_id']); ?></td>
                                              <td>
                                                  <center>
                                                      <span data-toggle="modal" onClick="verifData('<?= $row['id_users']; ?>','<?= base_url() ?>','<?= $row['nama_lengkap'] ?>')" data-target="#modal_verif">
                                                          <button id="btn_verif" type="button" class="btn btn-inverse-primary btn-rounded btn-icon" data-toggle="tooltip" data-placement="top" title="Verifikasi Data">
                                                              <i class="mdi mdi-account-card-details"></i>
                                                          </button>
                                                      </span>
                                                      <span data-toggle="modal" data-target="#modal_delete">
                                                          <button id="btn_verif" type="button" class="btn btn-inverse-danger btn-rounded btn-icon" data-toggle="tooltip" data-placement="top" title="Hapus Data">
                                                              <i class="mdi mdi-account-remove"></i>
                                                          </button>
                                                          </button>
                                                      </span>
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
                      <form id="form_action" action="<?= base_url('pegawai/verifikasi_data/') ?>" method="post">
                          <div class="col-sm-12">
                              <div class="form-group">
                                  <label for="shift">Nama Pegawai</label>
                                  <div class="form-line">
                                      <input readonly type="text" id="nama" name="nama" placeholder="Keterangan ..." class="form-control form-readonly">
                                  </div>
                              </div>
                          </div>
                          <input type="hidden" name="id_users" id="id_users">
                          <div class="col-sm-12">
                              <div class="form-group">
                                  <label for="shift">Pilih Jabatan</label>
                                  <div class="form-line">
                                      <select type="text" id="jabatan" name="jabatan" placeholder="Keterangan ..." class="form-control form">
                                          <option value="">-- Pilih Jabatan --</option>
                                          <?php foreach($list_jabatan as $row){ ?>
                                          <option value="<?= $row['id_jabatan'] ?>"><?= $row['nama_jabatan'] ?></option>
                                          <?php } ?>
                                      </select>   
                                  </div>
                              </div>
                          </div>
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