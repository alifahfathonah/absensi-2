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
                                          <th>Nama Lengkap</th>
                                          <th>Jenis Kelamin</th>
                                          <th>Email</th>
                                          <th>No Telepon</th>
                                          <th>Tanggal Lahir</th>
                                          <th>Action</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <?php $i = 0;
                                        foreach ($data_karyawan as $row) {
                                            $i++; ?>
                                          <tr>
                                              <td><?= $i; ?></td>
                                              <td><?= $row['nama_lengkap'] ?></td>
                                              <td><?= $row['jenis_kelamin'] ?></td>
                                              <td><?= $row['email'] ?></td>
                                              <td><?= sprintf(
                                                        "%s-%s-%s",
                                                        substr($row['no_telp'], 0, 4),
                                                        substr($row['no_telp'], 4, 4),
                                                        substr($row['no_telp'], 8)
                                                    ); ?></td>
                                              <td><?= $row['tgl_lahir']; ?></td>
                                              <td>
                                                  <center>
                                                      <span data-toggle="modal" data-target="#modal_detail">
                                                      <button onClick="detail_pegawai('<?= $row['nama_lengkap'] ?>','<?= $row['no_pegawai'] ?>','<?= $row['email'] ?>','<?= $row['nama_jabatan'] ?>','<?= $row['no_telp'] ?>','<?= $row['device_id'] ?>','<?= $row['foto'] ?>','<?= base_url() ?>')" id="btn_verif" type="button" class="btn btn-inverse-primary btn-rounded btn-icon" data-toggle="tooltip" data-placement="top" title="Detail Data Pegawai">
                                                          <i class="mdi mdi-account-card-details"></i>
                                                      </button>
                                                      </span>
                                                      <!-- <button type="button" class="btn btn-inverse-info btn-rounded btn-icon" data-toggle="tooltip" data-placement="top" title="Edit Data">
                                                          <i class="mdi mdi-pencil-box-outline"></i>
                                                      </button> -->
                                                      <button type="button" class="btn btn-inverse-danger btn-rounded btn-icon" data-toggle="tooltip" data-placement="top" title="Delete Data">
                                                          <i class="mdi mdi-account-remove"></i>
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
      <div class="modal fade" id="modal_detail" tabindex="-1" role="dialog">
          <div class="modal-dialog modal-size" role="document">
              <div class="modal-content bg-primary">
                  <div class="modal-header">
                      <h4 class="modal-title" id="title_modal">Detail Pegawai</h4>
                  </div>
                  <hr>
                  <div class="modal-body">
                      <div class="row ml-4">
                          <div class="col-lg-4">
                              
                              <img id="foto" style="width: 200px; height:200px;border-radius:100px;" src="h" alt="">
                          </div>
                          <div class="col-lg-8">
                              <div class="row">
                                  <div class="col-sm-4">
                                      <p>Nama Pegawai</p>
                                      <p>No Pegawai</p>
                                      <p>Email</p>
                                      <p>Jabatan</p>
                                      <p>No Telepon</p>
                                      <p>Device ID</p>
                                  </div>
                                  <div class="col-sm-8">
                                      <p id="nama">: </p>
                                      <p id="no_pegawai">: </p>
                                      <p id="email">: </p>
                                      <p id="jabatan">: </p>
                                      <p id="no_telp">: </p>
                                      <p id="device_id" class="text-uppercase">: </p>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <hr>
                      <div class="modal-footer">
                          <button type="submit" class="btn btn-primary btn-fw" data-dismiss="modal">Keluar</button>
                          </form>
                      </div>
                  </div>
              </div>
          </div>