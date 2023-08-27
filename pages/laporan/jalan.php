<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Laporan /</span> Tampil Data</h4>

<div class="card">
    <div class="card-header pb-0 d-flex align-items-center justify-content-between">
        <h5>Tabel Laporan</h5>
    </div>

    <div class="table-responsive text-nowrap">
        <table id="table1" class="table table-striped">
            <thead>
                <tr>
                    <th>No. </th>
                    <th>Nama Project</th>
                    <th>Kemajuan</th>
                    <th>Jenis Project</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                <?php $i = 1; ?>
                <?php foreach ($laporan as $data) : ?>
                    <tr>
                        <td>
                            <strong><?= $i++ ?></strong>
                        </td>
                        <td><?= $data['nama'] ?></td>
                        <td><?= $data['kemajuan'] ?></td>
                        <td><?= $data['kategori'] ?></td>
                        <td><?= $data['keterangan'] ?></td>
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
                title: "Daftar Project Jalan - CV. Dharma Cipta Pratama",
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
                title: "Daftar Project Jalan - CV. Dharma Cipta Pratama",
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