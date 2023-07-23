<h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">Pegawai /</span>
    Edit Data
</h4>

<div class="row">
    <div class="col-xl">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Edit Pegawai</h5>
            </div>
            <div class="card-body">
                <form action="<?= Router::baseUrl('pegawai/' . $pegawai['id_pegawai']) ?>" method="post">
                    <div class="mb-3">
                        <label class="form-label" for="nama">Nama Pegawai</label>
                        <input type="text" value="<?= $pegawai['nama'] ?>" class="form-control" id="nama" name="nama" placeholder="Nama Pegawai" required />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="nik">NIK</label>
                        <input type="text" value="<?= $pegawai['nik'] ?>" class="form-control" id="nik" name="nik" placeholder="Masukan NIK" required />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="jenis_kelamin">Jenis Kelamin</label>
                        <select id="jenis_kelamin" name="jenis_kelamin" class="form-select" required>
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="Pria" <?= $pegawai['jenis_kelamin'] == "Pria" ? "selected" : "" ?>>Pria</option>
                            <option value="Wanita" <?= $pegawai['jenis_kelamin'] == "Wanita" ? "selected" : "" ?>>Wanita</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="agama">Agama</label>
                        <select id="agama" name="agama" class="form-select" required>
                            <option value="" <?= $pegawai['agama'] == "" ? "selected" : "" ?>>Pilih Agama</option>
                            <option value="Islam" <?= $pegawai['agama'] == "Islam" ? "selected" : "" ?>>Islam</option>
                            <option value="Protestan" <?= $pegawai['agama'] == "Protestan" ? "selected" : "" ?>>Protestan</option>
                            <option value="Katolik" <?= $pegawai['agama'] == "Katolik" ? "selected" : "" ?>>Katolik</option>
                            <option value="Hindu" <?= $pegawai['agama'] == "Hindu" ? "selected" : "" ?>>Hindu</option>
                            <option value="Buddha" <?= $pegawai['agama'] == "Buddha" ? "selected" : "" ?>>Buddha</option>
                            <option value="Khonghucu" <?= $pegawai['agama'] == "Khonghucu" ? "selected" : "" ?>>Khonghucu</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="alamat">Alamat</label>
                        <textarea id="alamat" name="alamat" class="form-control" placeholder="Alamat Pegawai" required><?= $pegawai['alamat'] ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="no_telp">No. Telp</label>
                        <input type="text" id="no_telp" name="no_telp" class="form-control phone-mask" placeholder="No. Telp Pegawai" required value="<?= $pegawai['no_telp'] ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="email">Email</label>
                        <input type="email" value="<?= $pegawai['email'] ?>" class="form-control" id="email" name="email" placeholder="Email Pegawai" required />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="id_pegawai">Jabatan</label>
                        <select id="id_jabatan" name="id_jabatan" class="form-select" required>
                            <option value="">Pilih Jabatan</option>
                            <?php foreach ($jabatan as $data) : ?>
                                <option value="<?= $data['id_jabatan'] ?>" <?= $data['id_jabatan'] == $pegawai['id_jabatan'] ? "selected" : "" ?>>
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
                                <option value="<?= $data['id_gaji'] ?>" <?= $data['id_gaji'] == $pegawai['id_gaji'] ? "selected" : "" ?>>
                                    Rp <?= number_format($data['gaji'], 2, ',', '.') ?>
                                </option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="id_proyek">Project</label>
                        <select id="id_proyek" name="id_proyek" class="form-select" required>
                            <option value="">Pilih Project</option>
                            <?php foreach ($proyek as $data) : ?>
                                <option value="<?= $data['id_proyek'] ?>" <?= $data['id_proyek'] == $pegawai['id_proyek'] ? "selected" : "" ?>>
                                    <?= $data['nama'] ?> (<?= $data['kategori'] ?>)
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