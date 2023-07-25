<h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">Pendapatan /</span>
    Edit Data
</h4>

<div class="row">
    <div class="col-xl">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Edit Pendapatan</h5>
            </div>
            <div class="card-body">
                <form action="<?= Router::baseUrl('pendapatan/' . $pendapatan['id_pendapatan']) ?>" method="post">
                    <div class="mb-3">
                        <label class="form-label" for="nominal">Nominal</label>
                        <input type="text" value="<?= $pendapatan['nominal'] ?>" class="form-control" id="nominal" name="nominal" placeholder="Nominal" required />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="tahun">Tahun</label>
                        <input type="number" value="<?= $pendapatan['tahun'] ?>" class="form-control" id="tahun" name="tahun" placeholder="Tahun" required />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="id_proyek">Project</label>
                        <select id="id_proyek" name="id_proyek" class="form-select" required>
                            <option value="">Pilih Project</option>
                            <?php foreach ($proyek as $data) : ?>
                                <option value="<?= $data['id_proyek'] ?>" <?= $data['id_proyek'] == $pendapatan['id_proyek'] ? "selected" : "" ?>>
                                    <?= $data['nama'] ?> (<?= $data['kategori'] ?>)
                                </option>
                            <?php endforeach ?>
                        </select>
                    </div>

                    <div class="mt-1">
                        <button type="submit" name="Submit" class="btn btn-primary">Simpan</button>
                        <a href="<?= Router::baseUrl('pendapatan') ?>">
                            <button type="button" class="btn btn-warning">Kembali</button>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>