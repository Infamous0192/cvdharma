<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Kontraktor /</span> Tampil Data</h4>

<div class="card">
    <div class="card-header pb-0 d-flex align-items-center justify-content-between">
        <h5>Tabel Kontraktor</h5>

        <a href="<?= Router::baseUrl('/kontraktor/add') ?>" class="btn btn-sm btn-primary">
            <span class="tf-icons bx bx-plus"></span>&nbsp; Tambah Data
        </a>
    </div>

    <div class="table-responsive text-nowrap">
        <div class="row mb-3">
            <div class="col-md-3">
                <select name="" id="proyek-filter" class="form-control">
                    <option value="">Pilih Proyek</option>
                    <?php foreach ($proyek as $data) : ?>
                        <option value="<?= $data ?>">
                            <?= $data ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-3">
                <select name="" id="nama-filter" class="form-control">
                    <option value="">Pilih Nama</option>
                    <?php foreach ($nama as $data) : ?>
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
                    <th>No. </th>
                    <th>Nama Kontraktor</th>
                    <th>Nama Proyek</th>
                    <th>Penanggung Jawab</th>
                    <th>Alamat</th>
                    <th>No Telepon</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                <?php $i = 1; ?>
                <?php foreach ($kontraktor as $data) : ?>
                    <tr>
                        <td>
                            <strong><?= $i++ ?></strong>
                        </td>
                        <td><?= $data['nama_kontraktor'] ?></td>
                        <td><?= $data['nama'] ?></td>
                        <td><?= $data['penanggung_jawab'] ?? '-' ?></td>
                        <td><?= $data['alamat'] ?? '-' ?></td>
                        <td><?= $data['telp'] ?? '-' ?></td>
                        <td><?= $data['status'] ?></td>
                        <td>
                            <a href="<?= Router::baseUrl('kontraktor/' . $data['id_kontraktor']) ?>" style="text-decoration:none;" class="btn btn-icon btn-warning"><span class="tf-icons bx bx-edit"></span></a>
                            <a href="<?= Router::baseUrl('kontraktor/' . $data['id_kontraktor']) . '/delete'  ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')" style="text-decoration:none;" class="btn btn-icon btn-danger"><span class="tf-icons bx bx-trash"></span></a>
                        </td>
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
                title: "Daftar Kontraktor Project - CV. Dharma Cipta Pratama",
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
                title: "Daftar Kontraktor Project - CV. Dharma Cipta Pratama",
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

    $('#nama-filter').on('change', function() {
        var filterValue = $(this).val();

        table1
            .columns(1)
            .search(filterValue)
            .draw();
    });

    $('#proyek-filter').on('change', function() {
        var filterValue = $(this).val();

        table1
            .columns(2)
            .search(filterValue)
            .draw();
    });
</script>