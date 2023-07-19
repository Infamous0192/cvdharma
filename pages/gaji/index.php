<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Gaji /</span> Tampil Data</h4>

<div class="card">
    <div class="card-header pb-0 d-flex align-items-center justify-content-between">
        <h5>Tabel Gaji</h5>

        <?php if ($_SESSION['level'] == 'admin') : ?>
            <a href="<?= Router::baseUrl('/gaji/add') ?>" class="btn btn-sm btn-primary">
                <span class="tf-icons bx bx-plus"></span>&nbsp; Tambah Data
            </a>
        <?php endif; ?>
    </div>

    <div class="table-responsive text-nowrap">
        <table id="table1" class="table table-striped">
            <thead>
                <tr>
                    <th>No. </th>
                    <th>NIK</th>
                    <th>Gaji</th>
                    <th>Tanggal Gaji</th>
                    <th>Proyek</th>
                    <?php if (Session::get('level') == 'admin') : ?>
                        <th>Aksi</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                <?php $i = 1; ?>
                <?php foreach ($gaji as $data) : ?>
                    <tr>
                        <td>
                            <strong><?= $i++ ?></strong>
                        </td>
                        <td><?= $data['nik'] ?? '-' ?></td>
                        <td>
                            Rp <?= number_format($data['gaji'], 2, ',', '.') ?>
                        </td>
                        <td>
                            <?= $data['tanggal_gaji'] ?? '-' ?>
                        </td>
                        <td>
                            <?= $data['nama'] ?? '-' ?>
                        </td>
                        <?php if (Session::get('level') == 'admin') : ?>
                            <td>
                                <a href="<?= Router::baseUrl('gaji/' . $data['id_gaji']) ?>" style="text-decoration:none;" class="btn btn-icon btn-warning"><span class="tf-icons bx bx-edit"></span></a>
                                <a href="<?= Router::baseUrl('gaji/' . $data['id_gaji']) . '/delete'  ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')" style="text-decoration:none;" class="btn btn-icon btn-danger"><span class="tf-icons bx bx-trash"></span></a>
                            </td>
                        <?php endif ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    $("#table1").DataTable({
        dom: "Bfrtip",
        buttons: [{
                extend: "pdf",
                orientation: 'landscape',
                title: "Daftar Gaji - CV. Dharma Cipta Pratama",
                download: "open",
                exportOptions: {
                    columns: [0, 1, 2, 3, 4],
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
                title: "Daftar Gaji - CV. Dharma Cipta Pratama",
                orientation: "potrait",
                exportOptions: {
                    columns: [0, 1, 2, 3, 4],
                    modifier: {
                        selected: null,
                    },
                },
                pageSize: "Legal",
                className: "btn-primary",
            },
        ],
    });
</script>