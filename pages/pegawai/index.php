<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Pegawai /</span> Tampil Data</h4>

<div class="card">
    <div class="card-header pb-0 d-flex align-items-center justify-content-between">
        <h5>Tabel Pegawai</h5>

        <?php if ($_SESSION['level'] == 'admin') : ?>
            <a href="<?= Router::baseUrl('/pegawai/add') ?>" class="btn btn-sm btn-primary">
                <span class="tf-icons bx bx-plus"></span>&nbsp; Tambah Data
            </a>
        <?php endif; ?>
    </div>

    <div class="table-responsive text-nowrap">
        <div class="row mb-3">
            <div class="col-md-3">
                <select name="" id="jabatan-filter" class="form-control">
                    <option value="">Pilih Jabatan</option>
                    <?php foreach ($jabatan as $data) : ?>
                        <option value="<?= $data ?>">
                            <?= $data ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <table id="table1" class="table table-striped">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Pegawai</th>
                    <th>NIK</th>
                    <th>Jenis Kelamin</th>
                    <th>Agama</th>
                    <th>No. Telp</th>
                    <th>Jabatan</th>
                    <th>Gaji</th>
                    <?php if (Session::get('level') == 'admin') : ?>
                        <th>Aksi</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                <?php $i = 1; ?>
                <?php foreach ($pegawai as $data) : ?>
                    <tr>
                        <td>
                            <strong><?= $i++ ?></strong>
                        </td>
                        <td><?= $data['nama'] ?></td>
                        <td><?= $data['nik'] ?? '-' ?></td>
                        <td><?= $data['jenis_kelamin'] ?></td>
                        <td><?= $data['agama'] ?></td>
                        <td><?= $data['no_telp'] ?></td>
                        <td><?= $data['nama_jabatan'] ?></td>
                        <td>Rp <?= number_format($data['gaji'], 2, ',', '.') ?></td>
                        <?php if (Session::get('level') == 'admin') : ?>
                            <td>
                                <a href="<?= Router::baseUrl('pegawai/' . $data['id_pegawai']) ?>" style="text-decoration:none;" class="btn btn-icon btn-warning"><span class="tf-icons bx bx-edit"></span></a>
                                <a href="<?= Router::baseUrl('pegawai/' . $data['id_pegawai']) . '/delete'  ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')" style="text-decoration:none;" class="btn btn-icon btn-danger"><span class="tf-icons bx bx-trash"></span></a>
                            </td>
                        <?php endif ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    const table1 = $("#table1").DataTable({
        dom: "Bfrtip",
        buttons: [{
                extend: "pdf",
                orientation: 'landscape',
                title: "Daftar Pegawai - CV. Dharma Cipta Pratama",
                download: "open",
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6],
                    modifier: {
                        selected: null,
                    },
                },
                className: "btn-primary",
                customize: function(doc) {
                    doc.content[1].table.widths =
                        Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                }
            },
            {
                extend: "print",
                title: "Daftar Pegawai - CV. Dharma Cipta Pratama",
                orientation: "potrait",
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6],
                    modifier: {
                        selected: null,
                    },
                },
                pageSize: "Legal",
                className: "btn-primary",
            },
        ],
    });

    $('#jabatan-filter').on('change', function() {
        var filterValue = $(this).val();

        table1
            .columns(6)
            .search(filterValue)
            .draw();
    });
</script>