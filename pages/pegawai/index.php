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
        <table id="table1" class="table table-striped">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Pegawai</th>
                    <th>Jenis Kelamin</th>
                    <th>Agama</th>
                    <th>Alamat</th>
                    <th>No. Telp</th>
                    <th>Email</th>
                    <th>Jabatan</th>
                    <th>Gaji</th>
                    <th>Username</th>
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
                        <td><?= $data['jenis_kelamin'] ?></td>
                        <td><?= $data['agama'] ?></td>
                        <td><?= $data['alamat'] ?></td>
                        <td><?= $data['no_telp'] ?></td>
                        <td><?= $data['email'] ?></td>
                        <td><?= $data['nama_jabatan'] ?></td>
                        <td><?= number_format($data['gaji'], 2, ',', '.') ?></td>
                        <td><?= $data['username'] ?></td>
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
    $("#table1").DataTable({
        dom: "Bfrtip",
        buttons: [{
                extend: "pdf",
                orientation: 'landscape',
                title: "Daftar Pegawai - CV. Dharma Cipta Pratama",
                download: "open",
                exportOptions: {
                    columns: [0, 1],
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
                    columns: [0, 1],
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