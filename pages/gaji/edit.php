<h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">Gaji /</span>
    Edit Data
</h4>

<div class="row">
    <div class="col-xl">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Edit Gaji</h5>
            </div>
            <div class="card-body">
                <form action="<?= Router::baseUrl('gaji/' . $gaji['id_gaji']) ?>" method="post">
                    <div class="mb-3">
                        <label class="form-label" for="gaji">Jumlah Gaji</label>
                        <input type="number" class="form-control" id="gaji" name="gaji" placeholder="Jumlah Gaji (Rupiah)" value="<?= $gaji['gaji'] ?>" required />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="nik">NIK</label>
                        <input type="text" value="<?= $gaji['nik'] ?>" class="form-control" id="nik" name="nik" placeholder="Masukan NIK" required />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="tanggal_gaji">Tanggal Gaji</label>
                        <input type="date" value="<?= $gaji['tanggal_gaji'] ?>" class="form-control" id="tanggal_gaji" name="tanggal_gaji" placeholder="Masukan Tanggal Gaji" required />
                    </div>

                    <div class="mt-1">
                        <button type="submit" name="Submit" class="btn btn-primary">Simpan</button>
                        <a href="<?= Router::baseUrl('gaji') ?>">
                            <button type="button" class="btn btn-warning">Kembali</button>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>