<h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">Kontraktor /</span>
    Edit Data
</h4>

<!-- Basic Layout -->
<div class="row">
    <div class="col-xl">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Edit Kontraktor</h5>
            </div>
            <div class="card-body">
                <form action="<?= Router::baseUrl('kontraktor/' . $kontraktor['id_kontraktor']) ?>" method="post">
                    <div class="mb-3">
                        <label class="form-label" for="id_proyek">Project</label>
                        <select id="id_proyek" name="id_proyek" class="form-select" required>
                            <option value="">Pilih Project</option>
                            <?php foreach ($proyek as $data) : ?>
                                <option value="<?= $data['id_proyek'] ?>" <?= $data['id_proyek'] == $kontraktor['id_proyek'] ? "selected" : "" ?>>
                                    <?= $data['nama'] ?> (<?= $data['kategori'] ?>)
                                </option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="nama_kontraktor">Nama Kontraktor</label>
                        <input type="text" value="<?= $kontraktor['nama_kontraktor'] ?>" id="nama_kontraktor" name="nama_kontraktor" class="form-control" placeholder="Nama Kontraktor" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="penanggung_jawab">Penanggung Jawab</label>
                        <input type="text" id="penanggung_jawab" value="<?= $kontraktor['penanggung_jawab'] ?>" name="penanggung_jawab" class="form-control" placeholder="Penanggung Jawab" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="telp">No Telepon</label>
                        <input type="text" id="telp" name="telp" value="<?= $kontraktor['telp'] ?>" class="form-control" placeholder="No Telepon" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="alamat">Alamat</label>
                        <input type="text" id="alamat" name="alamat" value="<?= $kontraktor['alamat'] ?>" class="form-control" placeholder="Alamat" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="tanggal_mulai">Tanggal Mulai</label>
                        <input type="date" value="<?= $kontraktor['tanggal_mulai'] ?>" id="tanggal_mulai" name="tanggal_mulai" class="form-control" placeholder="Tanggal Mulai" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="tanggal_selesai">Tanggal Selesai</label>
                        <input type="date" value="<?= $kontraktor['tanggal_selesai'] ?>" id="tanggal_selesai" name="tanggal_selesai" class="form-control" placeholder="Tanggal Selesai" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="status">Status</label>
                        <select id="status" name="status" class="form-select" required>
                            <option value="" <?= $kontraktor['status'] == '' ? "selected" : "" ?>>Pilih Status</option>
                            <option value="Baru dibangun" <?= $kontraktor['status'] == 'Baru dibangun' ? "selected" : "" ?>>Baru dibangun</option>
                            <option value="Setengah jadi" <?= $kontraktor['status'] == 'Setengah jadi' ? "selected" : "" ?>>Setengah jadi</option>
                            <option value="Hampir selesai" <?= $kontraktor['status'] == 'Hampir selesai' ? "selected" : "" ?>>Hampir selesai</option>
                            <option value="Selesai" <?= $kontraktor['status'] == 'Selesai' ? "selected" : "" ?>>Selesai</option>
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