<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Pengawasan /</span> Tampil Data</h4>

<div class="card">
    <div class="card-header pb-0 d-flex align-items-center justify-content-between">
        <h5>Tabel Pengawasan</h5>

        <?php if ($_SESSION['level'] == 'admin') : ?>
            <a href="<?= Router::baseUrl('/pengawasan/add') ?>" class="btn btn-sm btn-primary">
                <span class="tf-icons bx bx-plus"></span>&nbsp; Tambah Data
            </a>
        <?php endif; ?>
    </div>

    <div class="table-responsive text-nowrap">
        <table id="table1" class="table table-striped">
            <thead>
                <tr>
                    <th>No. </th>
                    <th>Nama Project</th>
                    <th>Tgl. Mulai</th>
                    <th>Tgl. Selesai</th>
                    <th>Kemajuan</th>
                    <th>Jenis Project</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                <?php $i = 1; ?>
                <?php foreach ($pengawasan as $data) : ?>
                    <tr>
                        <td>
                            <strong><?= $i++ ?></strong>
                        </td>
                        <td><?= $data['nama'] ?></td>
                        <td><?= $data['tgl_mulai'] ?></td>
                        <td><?= $data['tgl_selesai'] ?></td>
                        <td><?= $data['kemajuan'] ?></td>
                        <td><?= $data['kategori'] ?></td>
                        <td><?= $data['keterangan'] ?></td>
                        <td>
                            <a href="<?= Router::baseUrl('pengawasan/' . $data['id_pengawasan']) ?>" style="text-decoration:none;" class="btn btn-icon btn-warning"><span class="tf-icons bx bx-edit"></span></a>
                            <a href="<?= Router::baseUrl('pengawasan/' . $data['id_pengawasan']) . '/delete'  ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')" style="text-decoration:none;" class="btn btn-icon btn-danger"><span class="tf-icons bx bx-trash"></span></a>
                            <a href="<?= Router::baseUrl('pengawasan/' . $data['id_pengawasan']) . '/project'  ?>" style="text-decoration:none;" class="btn btn-icon btn-primary"><span class="tf-icons bx bx-user"></a>
                        </td>
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
                title: "Daftar Pengawasan Project - CV. Dharma Cipta Pratama",
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
                title: "Daftar Pengawasan Project - CV. Dharma Cipta Pratama",
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
</script>