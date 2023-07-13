<h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">Jabatan /</span>
    Edit Data
</h4>

<div class="row">
    <div class="col-xl">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Edit Jabatan</h5>
            </div>
            <div class="card-body">
                <form action="<?= Router::baseUrl('jabatan/' . $jabatan['id_jabatan']) ?>" method="post">
                    <div class="mb-3">
                        <label class="form-label" for="nama_jabatan">Nama Jabatan</label>
                        <input type="text" class="form-control" id="nama_jabatan" name="nama_jabatan" placeholder="Nama Jabatan" value="<?= $jabatan['nama_jabatan'] ?>" required />
                    </div>

                    <div class="mt-1">
                        <button type="submit" name="Submit" class="btn btn-primary">Simpan</button>
                        <a href="<?= Router::baseUrl('jabatan') ?>">
                            <button type="button" class="btn btn-warning">Kembali</button>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>