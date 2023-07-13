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
                        <label class="form-label" for="potongan">Jumlah Potongan</label>
                        <input type="number" class="form-control" id="potongan" name="potongan" placeholder="Jumlah Potongan (Rupiah)" value="<?= $gaji['potongan'] ?>" required />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="gaji_bersih">Jumlah Gaji Bersih</label>
                        <input type="number" class="form-control" id="gaji_bersih" name="gaji_bersih" placeholder="Jumlah Gaji Bersih (Rupiah)" value="<?= $gaji['gaji_bersih'] ?>" required />
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