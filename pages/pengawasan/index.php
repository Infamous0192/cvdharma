<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Pengawasan /</span> Tampil Data</h4>

<div class="card">
    <div class="card-header pb-0 d-flex align-items-center justify-content-between">
        <h5>Tabel Pengawasan</h5>

        <a href="<?= Router::baseUrl('/pengawasan/add') ?>" class="btn btn-sm btn-primary">
            <span class="tf-icons bx bx-plus"></span>&nbsp; Tambah Data
        </a>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive text-nowrap">
            <div class="row mb-3">
                <div class="col-md-3">
                    <select name="" id="periode-filter" class="form-control">
                        <option value="">Pilih Periode</option>
                        <?php foreach ($periode as $data) : ?>
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
            </div>
            <table id="table1" class="table table-striped">
                <thead>
                    <tr>
                        <th>No. </th>
                        <th>Aksi</th>
                        <th>Nama Proyek</th>
                        <th>Jenis Proyek</th>
                        <th>Periode</th>
                        <th>Tahun</th>
                        <th>Keterangan</th>
                        <th>Kemajuan</th>
                        <th>Biaya Pengeluaran</th>
                        <th>Foto</th>
                        <th>Video</th>
                        <th>Kwitansi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    <?php $i = 1; ?>
                    <?php foreach ($pengawasan as $data) : ?>
                        <tr>
                            <td>
                                <strong><?= $i++ ?></strong>
                            </td>
                            <td>
                                <a href="<?= Router::baseUrl('pengawasan/' . $data['id_pengawasan']) ?>" style="text-decoration:none;" class="btn btn-icon btn-warning"><span class="tf-icons bx bx-edit"></span></a>
                                <a href="<?= Router::baseUrl('pengawasan/' . $data['id_pengawasan']) . '/delete'  ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')" style="text-decoration:none;" class="btn btn-icon btn-danger"><span class="tf-icons bx bx-trash"></span></a>
                            </td>
                            <td><?= $data['nama'] ?></td>
                            <td><?= $data['kategori'] ?></td>
                            <td><?= $data['periode'] ?></td>
                            <td><?= $data['tahun'] ?></td>
                            <td><?= $data['keterangan'] ?></td>
                            <td><?= $data['kemajuan'] ?></td>
                            <td><?= $data['biaya'] ?></td>
                            <td>
                                <?php if ($data['foto']) : ?>
                                    <a href="<?= Router::baseUrl('uploads/' . $data['foto']) ?>" target="_blank">
                                        Lihat Foto
                                    </a>
                                <?php else : ?>
                                    -
                                <?php endif ?>
                            </td>
                            <td>
                                <?php if ($data['video']) : ?>
                                    <a href="<?= $data['video'] ?>" target="_blank">
                                        Lihat Video
                                    </a>
                                <?php else : ?>
                                    -
                                <?php endif ?>
                            </td>
                            <td>
                                <?php if ($data['kwitansi']) : ?>
                                    <a href="<?= Router::baseUrl('uploads/' . $data['kwitansi']) ?>" target="_blank">
                                        Lihat Kwitansi
                                    </a>
                                <?php else : ?>
                                    -
                                <?php endif ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<script>
    const table1 = $("#table1").DataTable({
        dom: "Bfrtip",
        buttons: [{
                extend: "pdf",
                orientation: 'landscape',
                title: "Daftar Pengawasan Project - CV. Dharma Cipta Pratama",
                download: "open",
                exportOptions: {
                    columns: [0, 2, 3, 4, 5, 6, 7],
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
                    columns: [0, 2, 3, 4, 5, 6, 7],
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
            .columns(5)
            .search(filterValue)
            .draw();
    });

    $('#periode-filter').on('change', function() {
        var filterValue = $(this).val();

        table1
            .columns(4)
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