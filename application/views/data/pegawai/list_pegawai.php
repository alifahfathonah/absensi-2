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
                              <table class="table table-bordered">
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
                                                      <button id="btn_verif" type="button" class="btn btn-inverse-primary btn-rounded btn-icon" data-toggle="tooltip" data-placement="top" title="Detail Data Pegawai">
                                                          <i class="mdi mdi-account-card-details"></i>
                                                      </button>
                                                      <button type="button" class="btn btn-inverse-info btn-rounded btn-icon" data-toggle="tooltip" data-placement="top" title="Edit Data">
                                                          <i class="mdi mdi-pencil-box-outline"></i>
                                                      </button>
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