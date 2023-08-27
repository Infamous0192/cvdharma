<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Pendapatan /</span> Tampil Data</h4>

<div class="card">
    <div class="card-header pb-0 d-flex align-items-center justify-content-between">
        <h5>Tabel Pendapatan</h5>

        <a href="<?= Router::baseUrl('/pendapatan/add') ?>" class="btn btn-sm btn-primary">
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
                <select name="" id="tahun-filter" class="form-control">
                    <option value="">Pilih Tahun</option>
                    <?php foreach ($tahun as $data) : ?>
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
                    <th>Nominal</th>
                    <th>Tahun</th>
                    <th>Proyek</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                <?php $i = 1; ?>
                <?php foreach ($pendapatan as $data) : ?>
                    <tr>
                        <td>
                            <strong><?= $i++ ?></strong>
                        </td>
                        <td><?= $data['nominal'] ?></td>
                        <td><?= $data['tahun'] ?></td>
                        <td><?= $data['nama'] ?></td>
                        <td>
                            <a href="<?= Router::baseUrl('pendapatan/' . $data['id_pendapatan']) ?>" style="text-decoration:none;" class="btn btn-icon btn-warning"><span class="tf-icons bx bx-edit"></span></a>
                            <a href="<?= Router::baseUrl('pendapatan/' . $data['id_pendapatan']) . '/delete'  ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')" style="text-decoration:none;" class="btn btn-icon btn-danger"><span class="tf-icons bx bx-trash"></span></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="p-4 mt-5">

        <div id="chart"></div>
    </div>

</div>

<script>
    const table1 = $("#table1").DataTable({
        dom: "Bfrtip",
        buttons: [{
                extend: "pdf",
                orientation: 'landscape',
                title: "Daftar Pendapatan - CV. Dharma Cipta Pratama",
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
                title: "Daftar Pendapatan - CV. Dharma Cipta Pratama",
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

    $('#tahun-filter').on('change', function() {
        var filterValue = $(this).val();

        table1
            .columns(2)
            .search(filterValue)
            .draw();
    });

    $('#proyek-filter').on('change', function() {
        var filterValue = $(this).val();

        table1
            .columns(3)
            .search(filterValue)
            .draw();
    });

    $(document).ready(function() {
        const summary = <?= json_encode($summary) ?>;

        var options = {
            series: [{
                name: "Total",
                data: summary.map(({ total }) => total)
            }],
            chart: {
                height: 350,
                type: 'line',
                zoom: {
                    enabled: false
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'straight'
            },
            title: {
                text: 'Pengeluaran per Tahun',
                align: 'left'
            },
            xaxis: {
                categories: summary.map(({
                    tahun
                }) => tahun),
            }
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();

    })
</script>