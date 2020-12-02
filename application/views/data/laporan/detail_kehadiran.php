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

              </div>
              <div class="col-lg-12 grid-margin stretch-card">
                  <div class="card">
                      <div class="card-body">
                          <h4 class="card-title">Detail Pegawai</h4>
                          <div class="row">
                              <div class="col-lg-4">
                                  <?php if ($data_pegawai['foto'] != null) {  ?>
                                      <img style="width: 200px; height:200px;border-radius:100px;" src="<?= base_url() ?>assets/image_profile/<?= $data_pegawai['foto'] ?>" alt="">
                                  <?php } ?>
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
                                          <p>: <?= $data_pegawai['nama_lengkap'] ?></p>
                                          <p>: <?= $data_pegawai['no_pegawai'] ?></p>
                                          <p>: <?= $data_pegawai['email'] ?></p>
                                          <p>: <?= $data_pegawai['nama_jabatan'] ?></p>
                                          <p>: <?= $data_pegawai['no_telp'] ?></p>
                                          <p class="text-uppercase">: <?= $data_pegawai['device_id'] ?></p>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <hr>
                          <ul class="nav nav-tabs" id="myTab" role="tablist">
                              <li class="nav-item" role="presentation">
                                  <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Riwayat Kehadiran</a>
                              </li>
                              <li class="nav-item" role="presentation">
                                  <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Izin Tidak Masuk</a>
                              </li>
                          </ul>
                          <div class="tab-content" id="myTabContent">
                              <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                  <h5>Data Riwayat Kehadiran</h5>
                                  <div class="table-responsive">
                                      <table class="table table-bordered table-striped  dataTable js-exportable mt-3">
                                          <thead>
                                              <tr>
                                                  <th>No</th>
                                                  <th>Tanggal</th>
                                                  <th>Masuk Kerja</th>
                                                  <th>Jadwal Kerja</th>
                                                  <th>Waktu Masuk</th>
                                                  <th>Waktu Keluar</th>
                                                  <th>Terlambat</th>
                                                  <th>Jam Kerja</th>
                                              </tr>
                                          </thead>
                                          <tbody>
                                              <?php $i = 1;
                                                foreach ($data_kehadiran as $row) { ?>
                                                  <tr>
                                                      <td><?= $i++; ?></td>
                                                      <td><?= date('d-m-Y', strtotime($row['date'])) ?></td>
                                                      <?php if ($row['status'] == "Hadir") { ?>
                                                          <td><span class="btn btn-success"><?= $row['status'] ?></span></td>
                                                      <?php } else if ($row['status'] == "Tidak") { ?>
                                                          <td><span class="btn btn-danger"><?= $row['status'] ?></span></td>
                                                      <?php } else { ?>
                                                          <td><span class="btn btn-warning"><?= $row['status'] ?></span></td>
                                                      <?php } ?>
                                                      <td>08:00:00 - 16:00:00</td>
                                                      <td><?= $row['check_in'] ?></td>
                                                      <td><?= $row['check_out'] ?></td>
                                                      <td><?= $row['late'] ?></td>
                                                      <td><?= $row['work_time'] ?></td>
                                                  </tr>
                                              <?php } ?>
                                          </tbody>
                                      </table>
                                  </div>
                              </div>
                              <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                  <h5>Data Riwayat Izin Tidak Masuk</h5>
                                  <div class="table-responsive">
                                      <table class="table table-bordered table-striped  dataTable js-exportable mt-3">
                                          <thead>
                                              <tr>
                                                  <th>No</th>
                                                  <th>Tanggal</th>
                                                  <th>Alasan</th>
                                                  <th>Bukti</th>
                                                  <th>Status</th>
                                              </tr>
                                              <?php $i=1; foreach($data_suratizin as $row){ ?>
                                              <tr>
                                                  <td><?= $i++ ?></td>
                                                  <td><span class="badge badge-primary"><?= date('d-m-Y', strtotime($row['tanggal'])) ?></span></td>
                                                  <td><?= $row['alasan'] ?></td>
                                                  <td><a target="_blank" href="<?= base_url() ?>assets/image_surat/<?= $row['bukti'] ?>" class="badge badge-info">Lihat Bukti</a></td>
                                                  <td>
                                                      <?php if($row['status_surat'] == 1){ ?>
                                                       <span class="badge badge-success">Sudah dikonfirmasi</span> 
                                                      <?php }else {?>
                                                        <span class="badge badge-warning">Belum dikonfirmasi</span> 
                                                      <?php } ?>
                                                  </td>
                                              </tr>
                                              <?php } ?>
                                          </thead>
                                          <tbody>

                                          </tbody>
                                      </table>
                                  </div>
                              </div>
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