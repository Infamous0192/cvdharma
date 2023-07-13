<h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">Jalan /</span>
    Tambah Data
</h4>

<!-- Basic Layout -->
<div class="row">
    <div class="col-xl">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Tambah Jalan</h5>
            </div>
            <div class="card-body">
                <form action="<?= Router::baseUrl('jalan') ?>" method="post">
                    <div class="mb-3">
                        <label class="form-label" for="nama">Nama Jalan</label>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Jalan" required />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="jenis">Jenis Jalan</label>
                        <input type="text" class="form-control" id="jenis" name="jenis" placeholder="Jenis Jalan" required />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="alamat">Alamat</label>
                        <textarea id="alamat" name="alamat" class="form-control" placeholder="Alamat" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="panjang">Panjang Jalan</label>
                        <input type="text" class="form-control" id="panjang" name="panjang" placeholder="Panjang Jalan" required />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="lebar">Lebar Jalan</label>
                        <input type="text" class="form-control" id="lebar" name="lebar" placeholder="Lebar Jalan" required />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="tanggal_mulai">Tanggal Mulai</label>
                        <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai" placeholder="Tanggal Mulai" required />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="tanggal_selesai">Tanggal Selesai</label>
                        <input type="date" class="form-control" id="tanggal_selesai" name="tanggal_selesai" placeholder="Tanggal Selesai" required />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="dana">Dana</label>
                        <input type="number" class="form-control" id="dana" name="dana" placeholder="Dana" required />
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