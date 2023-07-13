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
                <form action="<?= Router::baseUrl('pengawasan') ?>" method="post" enctype="multipart/form-data">
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
                        <label class="form-label" for="periode">Periode</label>
                        <input type="text" id="periode" name="periode" class="form-control" placeholder="Periode" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="tahun">Tahun</label>
                        <input type="text" id="tahun" name="tahun" class="form-control" placeholder="Tahun" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="keterangan">Keterangan</label>
                        <input type="text" id="keterangan" name="keterangan" class="form-control" placeholder="Keterangan" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="kemajuan">Kemajuan</label>
                        <input type="text" id="kemajuan" name="kemajuan" class="form-control" placeholder="Kemajuan" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="biaya">Biaya Pengeluaran</label>
                        <input type="text" id="biaya" name="biaya" class="form-control" placeholder="Biaya Pengeluaran" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="foto">Foto</label>
                        <input type="file" id="foto" name="foto" class="form-control" placeholder="Foto" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="video">Video</label>
                        <input type="text" id="video" name="video" class="form-control" placeholder="Video" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="kwitansi">Kwitansi</label>
                        <input type="file" id="kwitansi" name="kwitansi" class="form-control" placeholder="Kwitansi" required>
                    </div>

                    <div class="mt-4">
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