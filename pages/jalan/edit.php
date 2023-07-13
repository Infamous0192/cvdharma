<h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">Jalan /</span>
    Edit Data
</h4>

<div class="row">
    <div class="col-xl">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Edit Jalan</h5>
            </div>
            <div class="card-body">
                <form action="<?= Router::baseUrl('jalan/' . $jalan['id_proyek']) ?>" method="post">
                    <div class="mb-3">
                        <label class="form-label" for="nama">Nama Jalan</label>
                        <input type="text" value="<?= $jalan['nama'] ?>" class="form-control" id="nama" name="nama" placeholder="Nama Jalan" required />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="jenis">Jenis Jalan</label>
                        <input type="text" value="<?= $jalan['jenis'] ?>" class="form-control" id="jenis" name="jenis" placeholder="Jenis Jalan" required />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="alamat">Alamat</label>
                        <textarea id="alamat" name="alamat" class="form-control" placeholder="Alamat" required><?= $jalan['alamat'] ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="panjang">Panjang Jalan</label>
                        <input type="text" value="<?= $jalan['panjang'] ?>" class="form-control" id="panjang" name="panjang" placeholder="Panjang Jalan" required />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="lebar">Lebar Jalan</label>
                        <input type="text" value="<?= $jalan['lebar'] ?>" class="form-control" id="lebar" name="lebar" placeholder="Lebar Jalan" required />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="tanggal_mulai">Tanggal Mulai</label>
                        <input type="date" value="<?= $jalan['tanggal_mulai'] ?>" class="form-control" id="tanggal_mulai" name="tanggal_mulai" placeholder="Tanggal Mulai" required />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="tanggal_selesai">Tanggal Selesai</label>
                        <input type="date" value="<?= $jalan['tanggal_selesai'] ?>" class="form-control" id="tanggal_selesai" name="tanggal_selesai" placeholder="Tanggal Selesai" required />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="dana">Dana</label>
                        <input type="number" value="<?= $jalan['dana'] ?>" class="form-control" id="dana" name="dana" placeholder="Dana" required />
                    </div>

                    <div class="mt-1">
                        <button type="submit" name="Submit" class="btn btn-primary">Simpan</button>
                        <a href="<?= Router::baseUrl('jalan') ?>">
                            <button type="button" class="btn btn-warning">Kembali</button>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>