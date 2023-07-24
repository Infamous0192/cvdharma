<h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">Kontraktor /</span>
    Tambah Data
</h4>

<!-- Basic Layout -->
<div class="row">
    <div class="col-xl">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Tambah Kontraktor</h5>
            </div>
            <div class="card-body">
                <form action="<?= Router::baseUrl('kontraktor') ?>" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label" for="id_proyek">Project</label>
                        <select id="id_proyek" name="id_proyek" class="form-select" required>
                            <option value="">Pilih Project</option>
                            <?php foreach ($proyek as $data) : ?>
                                <option value="<?= $data['id_proyek'] ?>">
                                    <?= $data['nama'] ?> (<?= $data['kategori'] ?>)
                                </option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="nama_kontraktor">Nama Kontraktor</label>
                        <input type="text" id="nama_kontraktor" name="nama_kontraktor" class="form-control" placeholder="Nama Kontraktor" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="penanggung_jawab">Penanggung Jawab</label>
                        <input type="text" id="penanggung_jawab" name="penanggung_jawab" class="form-control" placeholder="Penanggung Jawab" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="telp">No Telepon</label>
                        <input type="text" id="telp" name="telp" class="form-control" placeholder="No Telepon" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="alamat">Alamat</label>
                        <input type="text" id="alamat" name="alamat" class="form-control" placeholder="Alamat" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="tanggal_mulai">Tanggal Mulai</label>
                        <input type="date" id="tanggal_mulai" name="tanggal_mulai" class="form-control" placeholder="Tanggal Mulai" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="tanggal_selesai">Tanggal Selesai</label>
                        <input type="date" id="tanggal_selesai" name="tanggal_selesai" class="form-control" placeholder="Tanggal Selesai" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="status">Status</label>
                        <select id="status" name="status" class="form-select" required>
                            <option value="">Pilih Status</option>
                            <option value="Baru dibangun">Baru dibangun</option>
                            <option value="Setengah jadi">Setengah jadi</option>
                            <option value="Hampir selesai">Hampir selesai</option>
                            <option value="Selesai">Selesai</option>
                        </select>
                    </div>

                    <div class="mt-4">
                        <button type="submit" name="Submit" class="btn btn-primary">Simpan</button>
                        <a href="<?= Router::baseUrl('kontraktor') ?>">
                            <button type="button" class="btn btn-warning">Kembali</button>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>