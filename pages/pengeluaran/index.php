<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Pengeluaran /</span> Tampil Data</h4>

<div class="card">
    <div class="card-header pb-0 d-flex align-items-center justify-content-between">
        <h5>Tabel Pengeluaran</h5>

        <?php if ($_SESSION['level'] == 'admin') : ?>
            <a href="<?= Router::baseUrl('/pengeluaran/add') ?>" class="btn btn-sm btn-primary">
                <span class="tf-icons bx bx-plus"></span>&nbsp; Tambah Data
            </a>
        <?php endif; ?>
    </div>

    <div class="table-responsive text-nowrap">
        <div class="row mb-3">
            <div class="col-md-3">
                <select name="" id="jenis-filter" class="form-control">
                    <option value="">Pilih Jenis</option>
                    <?php foreach ($jenis as $data) : ?>
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
                    <th>Jenis</th>
                    <th>Nominal</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                <?php $i = 1; ?>
                <?php foreach ($pengeluaran as $data) : ?>
                    <tr>
                        <td>
                            <strong><?= $i++ ?></strong>
                        </td>
                        <td><?= $data['jenis'] ?></td>
                        <td><?= $data['nominal'] ?></td>
                        <td><?= $data['tanggal'] ?></td>
                        <td>
                            <a href="<?= Router::baseUrl('pengeluaran/' . $data['id_pengeluaran']) ?>" style="text-decoration:none;" class="btn btn-icon btn-warning"><span class="tf-icons bx bx-edit"></span></a>
                            <a href="<?= Router::baseUrl('pengeluaran/' . $data['id_pengeluaran']) . '/delete'  ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')" style="text-decoration:none;" class="btn btn-icon btn-danger"><span class="tf-icons bx bx-trash"></span></a>
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
                title: "Daftar Pengeluaran - CV. Dharma Cipta Pratama",
                download: "open",
                exportOptions: {
                    columns: [0, 1, 2, 3],
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
                title: "Daftar Pengeluaran - CV. Dharma Cipta Pratama",
                orientation: "potrait",
                exportOptions: {
                    columns: [0, 1, 2, 3],
                    modifier: {
                        selected: null,
                    },
                },
                pageSize: "Legal",
                className: "btn-primary",
            },
        ],
    });

    $('#jenis-filter').on('change', function() {
        var filterValue = $(this).val();

        table1
            .columns(1)
            .search(filterValue)
            .draw();
    });
</script>