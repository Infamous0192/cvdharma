<h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">Pengawasan /</span>
    Project
</h4>

<div class="card mb-4">
    <h5 class="card-header">Informasi Project</h5>
    <div class="card-body">
        <div class="mb-3">
            <label class="form-label">Nama Project</label>
            <input class="form-control" type="text" value="<?= $pengawasan['nama'] ?>" readonly="">
        </div>
        <div class="mb-3">
            <label class="form-label">Jenis Project</label>
            <input class="form-control" type="text" value="<?= $pengawasan['kategori'] ?>" readonly="">
        </div>
        <div class="mb-3">
            <label class="form-label">Tanggal Mulai</label>
            <input class="form-control" type="text" value="<?= $pengawasan['tanggal_mulai'] ?>" readonly="">
        </div>
        <div class="mb-3">
            <label class="form-label">Tanggal Selesai</label>
            <input class="form-control" type="text" value="<?= $pengawasan['tanggal_selesai'] ?>" readonly="">
        </div>
        <div class="mb-3">
            <label class="form-label">Kemajuan</label>
            <input class="form-control" type="text" value="<?= $pengawasan['kemajuan'] ?>" readonly="">
        </div>
        <div class="mb-3">
            <label class="form-label">Keterangan</label>
            <input class="form-control" type="text" value="<?= $pengawasan['keterangan'] ?>" readonly="">
        </div>
    </div>
</div>

<?php if ($_SESSION['level'] == 'admin') : ?>
    <div class="card mb-4">
        <h5 class="card-header">Tambah Pegawai</h5>
        <div class="card-body">
            <form action="<?= Router::baseUrl('pengawasan/' . $pengawasan['id_pengawasan'] . '/project') ?>" method="post">
                <input name="id_pengawasan" type="hidden" value="<?= $_GET['id'] ?>">
                <div class="mb-3">
                    <label for="id_pegawai" class="form-label">Nama Pegawai</label>
                    <select id="id_pegawai" name="id_pegawai" class="form-select" required>
                        <?php foreach ($pegawai as $data) : ?>
                            <option value="<?= $data['id_pegawai'] ?>">
                                <?= $data['nama'] ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <select id="role" name="role" class="form-select" required>
                        <option value="Owner">Owner</option>
                        <option value="Pegawai">Pegawai</option>
                        <option value="Pengawas">Pengawas</option>
                    </select>
                </div>
                <button type="submit" name="Submit" class="btn btn-primary">Tambah</button>
            </form>
        </div>
    </div>
<?php endif; ?>


<!-- Striped Rows -->
<div class="card">
    <div class="card-header pb-0 mb-0">
        <h5>Tabel Pegawai dalam Project</h5>
    </div>
    <div class="table-responsive text-nowrap">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No. </th>
                    <th>Nama Pegawai</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                <?php $i = 1; ?>
                <?php foreach ($pengawas as $data) : ?>
                    <tr>
                        <td>
                            <strong><?= $i++ ?></strong>
                        </td>
                        <td><?= $data['nama'] ?></td>
                        <td><?= $data['role'] ?></td>
                        <td>
                            <a href="<?= Router::baseUrl('pengawasan/' . $pengawasan['id_pengawasan'] . '/' . $data['id_pegawai'] . '/delete') ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')" style="text-decoration:none;" class="btn btn-icon btn-danger">
                                <span class="tf-icons bx bx-trash"></span>
                            </a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>