<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Bangunan /</span> Tampil Data</h4>

<div class="card">
    <div class="card-header pb-0 d-flex align-items-center justify-content-between">
        <h5>Tabel Bangunan</h5>

        <?php if ($_SESSION['level'] == 'admin') : ?>
            <a href="<?= Router::baseUrl('/bangunan/add') ?>" class="btn btn-sm btn-primary">
                <span class="tf-icons bx bx-plus"></span>&nbsp; Tambah Data
            </a>
        <?php endif; ?>
    </div>

    <div class="table-responsive text-nowrap">
        <table id="table1" class="table table-striped">
            <thead>
                <tr>
                    <th>No. </th>
                    <th>Nama Bangunan</th>
                    <th>Jenis</th>
                    <th>Alamat</th>
                    <th>Panjang</th>
                    <th>Lebar</th>
                    <th>Tinggi</th>
                    <?php if (Session::get('level') == 'admin') : ?>
                        <th>Aksi</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                <?php $i = 1; ?>
                <?php foreach ($bangunan as $data) : ?>
                    <tr>
                        <td>
                            <strong><?= $i++ ?></strong>
                        </td>
                        <td><?= $data['nama'] ?></td>
                        <td><?= $data['jenis'] ?></td>
                        <td><?= $data['alamat'] ?></td>
                        <td><?= $data['panjang'] ?></td>
                        <td><?= $data['lebar'] ?></td>
                        <td><?= $data['tinggi'] ?></td>
                        <?php if (Session::get('level') == 'admin') : ?>
                            <td>
                                <a href="<?= Router::baseUrl('bangunan/' . $data['id_proyek']) ?>" style="text-decoration:none;" class="btn btn-icon btn-warning"><span class="tf-icons bx bx-edit"></span></a>
                                <a href="<?= Router::baseUrl('bangunan/' . $data['id_proyek']) . '/delete'  ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')" style="text-decoration:none;" class="btn btn-icon btn-danger"><span class="tf-icons bx bx-trash"></span></a>
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
                title: "Daftar Bangunan - CV. Dharma Cipta Pratama",
                download: "open",
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7],
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
                title: "Daftar Bangunan - CV. Dharma Cipta Pratama",
                orientation: "potrait",
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7],
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