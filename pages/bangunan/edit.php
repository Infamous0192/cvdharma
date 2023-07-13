<h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">Bangunan /</span>
    Edit Data
</h4>

<div class="row">
    <div class="col-xl">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Edit Bangunan</h5>
            </div>
            <div class="card-body">
                <form action="<?= Router::baseUrl('bangunan/' . $bangunan['id_proyek']) ?>" method="post">
                    <div class="mb-3">
                        <label class="form-label" for="nama">Nama Bangunan</label>
                        <input type="text" value="<?= $bangunan['nama'] ?>" class="form-control" id="nama" name="nama" placeholder="Nama Bangunan" required />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="jenis">Jenis Bangunan</label>
                        <input type="text" value="<?= $bangunan['jenis'] ?>" class="form-control" id="jenis" name="jenis" placeholder="Jenis Bangunan" required />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="alamat">Alamat</label>
                        <textarea id="alamat" name="alamat" class="form-control" placeholder="Alamat" required><?= $bangunan['alamat'] ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="panjang">Panjang Bangunan</label>
                        <input type="number" value="<?= $bangunan['panjang'] ?>" class="form-control" id="panjang" name="panjang" placeholder="Panjang Bangunan" required />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="lebar">Lebar Bangunan</label>
                        <input type="number" value="<?= $bangunan['lebar'] ?>" class="form-control" id="lebar" name="lebar" placeholder="Lebar Bangunan" required />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="tinggi">Tinggi Bangunan</label>
                        <input type="number" value="<?= $bangunan['tinggi'] ?>" class="form-control" id="tinggi" name="tinggi" placeholder="Tinggi Bangunan" required />
                    </div>

                    <div class="mt-1">
                        <button type="submit" name="Submit" class="btn btn-primary">Simpan</button>
                        <a href="<?= Router::baseUrl('bangunan') ?>">
                            <button type="button" class="btn btn-warning">Kembali</button>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>