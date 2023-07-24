<h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">Pengeluaran /</span>
    Tambah Data
</h4>

<!-- Basic Layout -->
<div class="row">
    <div class="col-xl">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Tambah Pengeluaran</h5>
            </div>
            <div class="card-body">
                <form action="<?= Router::baseUrl('pengeluaran') ?>" method="post">
                    <div class="mb-3">
                        <label class="form-label" for="jenis">Jenis</label>
                        <input type="text" class="form-control" id="jenis" name="jenis" placeholder="Jenis" required />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="nominal">Nominal</label>
                        <input type="text" class="form-control" id="nominal" name="nominal" placeholder="Nominal" required />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="tanggal">Tanggal</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal" placeholder="Tanggal" required />
                    </div>

                    <div class="mt-1">
                        <button type="submit" name="Submit" class="btn btn-primary">Simpan</button>
                        <a href="<?= Router::baseUrl('pengeluaran') ?>">
                            <button type="button" class="btn btn-warning">Kembali</button>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>