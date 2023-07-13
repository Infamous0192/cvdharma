<h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">Pengawasan /</span>
    Tambah Data
</h4>

<!-- Basic Layout -->
<div class="row">
    <div class="col-xl">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Tambah Pengawasan</h5>
            </div>
            <div class="card-body">
                <form action="<?= Router::baseUrl('pengawasan') ?>" method="post">
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
                        <label class="form-label" for="tgl_mulai">Tanggal Mulai</label>
                        <input id="tgl_mulai" name="tgl_mulai" class="form-control" type="date" id="html5-date-input" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="tgl_selesai">Tanggal Selesai</label>
                        <input id="tgl_selesai" name="tgl_selesai" class="form-control" type="date" id="html5-date-input" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="kemajuan">Kemajuan</label>
                        <input type="text" id="kemajuan" name="kemajuan" class="form-control" placeholder="Kemajuan" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="keterangan">Keterangan</label>
                        <input type="text" id="keterangan" name="keterangan" class="form-control" placeholder="Keterangan" required>
                    </div>

                    <div class="mt-1">
                        <button type="submit" name="Submit" class="btn btn-primary">Simpan</button>
                        <a href="<?= Router::baseUrl('pengawasan') ?>">
                            <button type="button" class="btn btn-warning">Kembali</button>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>