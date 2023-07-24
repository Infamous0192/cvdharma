<h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">Pegawai /</span>
    Tambah Data
</h4>

<!-- Basic Layout -->
<div class="row">
    <div class="col-xl">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Tambah Pegawai</h5>
            </div>
            <div class="card-body">
                <form action="<?= Router::baseUrl('pegawai') ?>" method="post">
                    <div class="mb-3">
                        <label class="form-label" for="nama">Nama Pegawai</label>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Pegawai" required />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="nik">NIK</label>
                        <input type="text" class="form-control" id="nik" name="nik" placeholder="Masukan NIK" required />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="jenis_kelamin">Jenis Kelamin</label>
                        <select id="jenis_kelamin" name="jenis_kelamin" class="form-select" required>
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="Pria">Pria</option>
                            <option value="Wanita">Wanita</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="agama">Agama</label>
                        <select id="agama" name="agama" class="form-select" required>
                            <option value="">Pilih Agama</option>
                            <option value="Islam">Islam</option>
                            <option value="Protestan">Protestan</option>
                            <option value="Katolik">Katolik</option>
                            <option value="Hindu">Hindu</option>
                            <option value="Buddha">Buddha</option>
                            <option value="Khonghucu">Khonghucu</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="alamat">Alamat</label>
                        <textarea id="alamat" name="alamat" class="form-control" placeholder="Alamat Pegawai" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="no_telp">No. Telp</label>
                        <input type="text" id="no_telp" name="no_telp" class="form-control phone-mask" placeholder="No. Telp Pegawai" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email Pegawai" required />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="id_jabatan">Jabatan</label>
                        <select id="id_jabatan" name="id_jabatan" class="form-select" required>
                            <option value="">Pilih Jabatan</option>
                            <?php foreach ($jabatan as $data) : ?>
                                <option value="<?= $data['id_jabatan'] ?>">
                                    <?= $data['nama_jabatan'] ?>
                                </option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="id_gaji">Gaji</label>
                        <select id="id_gaji" name="id_gaji" class="form-select" required>
                            <option value="">Pilih Gaji</option>
                            <?php foreach ($gaji as $data) : ?>
                                <option value="<?= $data['id_gaji'] ?>">
                                    Rp <?= number_format($data['gaji'], 2, ',', '.') ?>
                                </option>
                            <?php endforeach ?>
                        </select>
                    </div>

                    <div class="mt-2">
                        <button type="submit" name="Submit" class="btn btn-primary">Simpan</button>
                        <a href="<?= Router::baseUrl('pegawai') ?>">
                            <button type="button" class="btn btn-warning">Kembali</button>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>