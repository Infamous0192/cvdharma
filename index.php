<?php

ob_start();
session_start();

require 'config.php';
require 'router.php';
require 'database.php';
require 'utils.php';

$router = new Router();
$template = new TemplatingEngine('pages', 'layouts');
$db = new Database($_ENV['DB_HOST'], $_ENV['DB_USER'], $_ENV['DB_PASS'], $_ENV['DB_NAME']);
$db->connect();

function auth()
{
    if (!Session::has('username')) {
        return Redirect::to('/login');
    }
}

function admin()
{
    auth();

    if (Session::get('level') != 'admin') {
        return Redirect::to('/');
    }
}

$router->get('/', function () use ($template) {
    return $template->withLayout('dashboard')->render('home');
})->with('auth');

/** Auth Section */
$router->get('/login', function () use ($template, $db) {
    if (Session::has('username')) {
        Redirect::to('/');
    }

    return $template->withLayout('auth')->render('login');
});

$router->post('/login', function () use ($db) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $user = $db->table('pengguna')->where('username', "'$username'")->find();
    if ($user == null) {
        return Redirect::withMessage('error', 'User tidak ditemukan')->back();
    }

    if ($user['password'] != $password) {
        return Redirect::withMessage('error', 'Password salah')->back();
    }

    Session::set('username', $user['username']);
    Session::set('level', $user['level']);

    return Redirect::to('/');
});

$router->get('/register', function () use ($template, $db) {
    if (Session::has('username')) {
        Redirect::to('/');
    }

    return $template->withLayout('auth')->render('register');
});

$router->post('/register', function () use ($db) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $user = $db->table('pengguna')->where('username', "'$username'")->find();
    if ($user != null) {
        return Redirect::withMessage('error', 'Username telah digunakan')->back();
    }

    $db->table('pengguna')
        ->insert([
            'username' => $username,
            'password' => $password,
            'level' => 'pegawai'
        ]);

    Session::set('username', $username);
    Session::set('level', 'pegawai');

    return Redirect::to('/');
});

$router->get('/logout', function () {
    Session::destroy();

    return Redirect::to('login');
})->with('auth');

/** Jabatan Section */
$router->get('/jabatan', function () use ($template, $db) {
    $jabatan = $db->table('jabatan')->findAll();

    return $template->withLayout('dashboard')->render('jabatan/index', compact('jabatan'));
})->with('auth');

$router->get('/jabatan/add', function () use ($template) {

    return $template->withLayout('dashboard')->render('jabatan/add');
})->with('admin');

$router->post('/jabatan', function () use ($db) {
    $success = $db->table('jabatan')->insert([
        'nama_jabatan' => $_POST['nama_jabatan']
    ]);

    if (!$success) {
        return Redirect::withMessage('error', 'Data gagal ditambahkan')->to('/jabatan');
    }

    return Redirect::withMessage('success', 'Data berhasil ditambahkan')->to('/jabatan');
})->with('admin');

$router->get('/jabatan/:id', function ($id) use ($template, $db) {
    $jabatan = $db->table('jabatan')->where('id_jabatan', $id)->find();
    if ($jabatan == null) {
        return Redirect::withMessage('error', 'Gagal memuat data');
    }

    return $template->withLayout('dashboard')->render('jabatan/edit', compact('jabatan'));
})->with('admin');

$router->post('/jabatan/:id', function ($id) use ($db) {
    $success = $db->table('jabatan')->where('id_jabatan', $id)->update([
        'nama_jabatan' => $_POST['nama_jabatan'],
    ]);
    if (!$success) {
        return Redirect::withMessage('error', 'Data gagal diubah')->to('/jabatan');
    }

    return Redirect::withMessage('success', 'Data berhasil diubah')->to('/jabatan');
})->with('admin');

$router->get('/jabatan/:id/delete', function ($id) use ($db) {
    $success = $db->table('jabatan')->where('id_jabatan', $id)->delete();
    if (!$success) {
        return Redirect::withMessage('error', 'Data gagal dihapus')->to('/jabatan');
    }

    return Redirect::withMessage('success', 'Data berhasil dihapus')->to('/jabatan');;
})->with('admin');

/** Gaji Section */
$router->get('/gaji', function () use ($template, $db) {
    $nik = $db->table('gaji')->select('nik')->groupBy('nik')->column('nik');
    $gaji = $db->table('gaji')->findAll();

    return $template->withLayout('dashboard')->render('gaji/index', compact('gaji', 'nik'));
})->with('auth');

$router->get('/gaji/add', function () use ($template) {
    return $template->withLayout('dashboard')->render('gaji/add');
})->with('admin');

$router->post('/gaji', function () use ($db) {
    $success = $db->table('gaji')->insert([
        'gaji' => $_POST['gaji'],
        'nik' => $_POST['nik'],
        'tanggal_gaji' => $_POST['tanggal_gaji'],
    ]);

    if (!$success) {
        return Redirect::withMessage('error', 'Data gagal ditambahkan')->to('/gaji');
    }

    return Redirect::withMessage('success', 'Data berhasil ditambahkan')->to('/gaji');
})->with('admin');

$router->get('/gaji/:id', function ($id) use ($template, $db) {
    $gaji = $db->table('gaji')->where('id_gaji', $id)->find();
    if ($gaji == null) {
        return Redirect::withMessage('error', 'Gagal memuat data');
    }

    return $template->withLayout('dashboard')->render('gaji/edit', compact('gaji'));
})->with('admin');

$router->post('/gaji/:id', function ($id) use ($db) {
    $success = $db->table('gaji')->where('id_gaji', $id)->update([
        'gaji' => $_POST['gaji'],
        'nik' => $_POST['nik'],
        'tanggal_gaji' => $_POST['tanggal_gaji'],
    ]);
    if (!$success) {
        return Redirect::withMessage('error', 'Data gagal diubah')->to('/gaji');
    }

    return Redirect::withMessage('success', 'Data berhasil diubah')->to('/gaji');
})->with('admin');

$router->get('/gaji/:id/delete', function ($id) use ($db) {
    $success = $db->table('gaji')->where('id_gaji', $id)->delete();
    if (!$success) {
        return Redirect::withMessage('error', 'Data gagal dihapus')->to('/gaji');
    }

    return Redirect::withMessage('success', 'Data berhasil dihapus')->to('/gaji');;
})->with('admin');

/** Pegawai Section */
$router->get('/pegawai', function () use ($template, $db) {
    $jabatan = $db->table('jabatan')->select('nama_jabatan')->groupBy('nama_jabatan')->column('nama_jabatan');

    $pegawai = $db->table('pegawai')
        ->select('pegawai.id_pegawai, pegawai.nama, pegawai.nik, pegawai.jenis_kelamin, pegawai.agama, pegawai.no_telp, gaji.gaji, jabatan.nama_jabatan')
        ->join('jabatan', 'pegawai.id_jabatan = jabatan.id_jabatan')
        ->join('gaji', 'pegawai.id_gaji = gaji.id_gaji')
        ->join('pengguna', 'pegawai.id_user = pengguna.id_user', 'left')
        ->findAll();

    return $template->withLayout('dashboard')->render('pegawai/index', compact('pegawai', 'jabatan'));
})->with('auth');

$router->get('/pegawai/add', function () use ($template, $db) {
    $jabatan = $db->table('jabatan')->findAll();
    $gaji = $db->table('gaji')->findAll();

    return $template->withLayout('dashboard')->render('pegawai/add', compact('jabatan', 'gaji'));
})->with('auth');

$router->post('/pegawai', function () use ($db) {
    $success = $db->table('pegawai')->insert([
        'nik' => $_POST['nik'],
        'nama' => $_POST['nama'],
        'jenis_kelamin' => $_POST['jenis_kelamin'],
        'agama' => $_POST['agama'],
        'alamat' => $_POST['alamat'],
        'no_telp' => $_POST['no_telp'],
        'email' => $_POST['email'],
        'id_jabatan' => $_POST['id_jabatan'],
        'id_gaji' => $_POST['id_gaji'],
    ]);

    if (!$success) {
        return Redirect::withMessage('error', 'Data gagal ditambahkan')->to('/pegawai');
    }

    return Redirect::withMessage('success', 'Data berhasil ditambahkan')->to('/pegawai');
})->with('auth');

$router->get('/pegawai/:id', function ($id) use ($template, $db) {
    $pegawai = $db->table('pegawai')->where('id_pegawai', $id)->find();
    if ($pegawai == null) {
        return Redirect::withMessage('error', 'Gagal memuat data');
    }

    $jabatan = $db->table('jabatan')->findAll();
    $gaji = $db->table('gaji')->findAll();

    return $template->withLayout('dashboard')->render('pegawai/edit', compact('pegawai', 'gaji', 'jabatan'));
})->with('auth');

$router->post('/pegawai/:id', function ($id) use ($db) {
    $success = $db->table('pegawai')->where('id_pegawai', $id)->update([
        'nik' => $_POST['nik'],
        'nama' => $_POST['nama'],
        'jenis_kelamin' => $_POST['jenis_kelamin'],
        'agama' => $_POST['agama'],
        'alamat' => $_POST['alamat'],
        'no_telp' => $_POST['no_telp'],
        'email' => $_POST['email'],
        'id_jabatan' => $_POST['id_jabatan'],
        'id_gaji' => $_POST['id_gaji'],
    ]);
    if (!$success) {
        return Redirect::withMessage('error', 'Data gagal diubah')->to('/pegawai');
    }

    return Redirect::withMessage('success', 'Data berhasil diubah')->to('/pegawai');
})->with('auth');

$router->get('/pegawai/:id/delete', function ($id) use ($db) {
    $success = $db->table('pegawai')->where('id_pegawai', $id)->delete();
    if (!$success) {
        return Redirect::withMessage('error', 'Data gagal dihapus')->to('/pegawai');
    }

    return Redirect::withMessage('success', 'Data berhasil dihapus')->to('/pegawai');;
})->with('auth');

/** Bangunan Section */
$router->get('/bangunan', function () use ($template, $db) {
    $bangunan = $db->table('proyek')->where('kategori', '\'Bangunan\'')->findAll();

    return $template->withLayout('dashboard')->render('bangunan/index', compact('bangunan'));
})->with('auth');

$router->get('/bangunan/add', function () use ($template) {
    return $template->withLayout('dashboard')->render('bangunan/add');
})->with('auth');

$router->post('/bangunan', function () use ($db) {
    $success = $db->table('proyek')->insert([
        'nama' => $_POST['nama'],
        'jenis' => $_POST['jenis'],
        'kategori' => 'Bangunan',
        'alamat' => $_POST['alamat'],
        'panjang' => $_POST['panjang'],
        'lebar' => $_POST['lebar'],
        'tinggi' => $_POST['tinggi'],
        'tanggal_mulai' => $_POST['tanggal_mulai'],
        'tanggal_selesai' => $_POST['tanggal_selesai'],
        'dana' => $_POST['dana'],
    ]);

    if (!$success) {
        return Redirect::withMessage('error', 'Data gagal ditambahkan')->to('/bangunan');
    }

    return Redirect::withMessage('success', 'Data berhasil ditambahkan')->to('/bangunan');
})->with('auth');

$router->get('/bangunan/:id', function ($id) use ($template, $db) {
    $bangunan = $db->table('proyek')->where('id_proyek', $id)->where('kategori', '\'Bangunan\'')->find();
    if ($bangunan == null) {
        return Redirect::withMessage('error', 'Gagal memuat data');
    }

    return $template->withLayout('dashboard')->render('bangunan/edit', compact('bangunan'));
})->with('auth');

$router->post('/bangunan/:id', function ($id) use ($db) {
    $success = $db->table('proyek')->where('id_proyek', $id)->update([
        'nama' => $_POST['nama'],
        'jenis' => $_POST['jenis'],
        'kategori' => 'Bangunan',
        'alamat' => $_POST['alamat'],
        'panjang' => $_POST['panjang'],
        'lebar' => $_POST['lebar'],
        'tinggi' => $_POST['tinggi'],
        'tanggal_mulai' => $_POST['tanggal_mulai'],
        'tanggal_selesai' => $_POST['tanggal_selesai'],
        'dana' => $_POST['dana'],
    ]);
    if (!$success) {
        return Redirect::withMessage('error', 'Data gagal diubah')->to('/bangunan');
    }

    return Redirect::withMessage('success', 'Data berhasil diubah')->to('/bangunan');
})->with('auth');

$router->get('/bangunan/:id/delete', function ($id) use ($db) {
    $success = $db->table('proyek')->where('id_proyek', $id)->delete();
    if (!$success) {
        return Redirect::withMessage('error', 'Data gagal dihapus')->to('/bangunan');
    }

    return Redirect::withMessage('success', 'Data berhasil dihapus')->to('/bangunan');;
})->with('auth');

/** Jalan Section */
$router->get('/jalan', function () use ($template, $db) {
    $jalan = $db->table('proyek')->where('kategori', '\'Jalan\'')->findAll();

    return $template->withLayout('dashboard')->render('jalan/index', compact('jalan'));
})->with('auth');

$router->get('/jalan/add', function () use ($template) {
    return $template->withLayout('dashboard')->render('jalan/add');
})->with('auth');

$router->post('/jalan', function () use ($db) {
    $success = $db->table('proyek')->insert([
        'nama' => $_POST['nama'],
        'jenis' => $_POST['jenis'],
        'kategori' => 'Jalan',
        'alamat' => $_POST['alamat'],
        'panjang' => $_POST['panjang'],
        'lebar' => $_POST['lebar'],
        'tinggi' => 0,
        'tanggal_mulai' => $_POST['tanggal_mulai'],
        'tanggal_selesai' => $_POST['tanggal_selesai'],
        'dana' => $_POST['dana'],
    ]);

    if (!$success) {
        return Redirect::withMessage('error', 'Data gagal ditambahkan')->to('/jalan');
    }

    return Redirect::withMessage('success', 'Data berhasil ditambahkan')->to('/jalan');
})->with('auth');

$router->get('/jalan/:id', function ($id) use ($template, $db) {
    $jalan = $db->table('proyek')->where('id_proyek', $id)->where('kategori', '\'Jalan\'')->find();
    if ($jalan == null) {
        return Redirect::withMessage('error', 'Gagal memuat data');
    }

    return $template->withLayout('dashboard')->render('jalan/edit', compact('jalan'));
})->with('auth');

$router->post('/jalan/:id', function ($id) use ($db) {
    $success = $db->table('proyek')->where('id_proyek', $id)->update([
        'nama' => $_POST['nama'],
        'jenis' => $_POST['jenis'],
        'kategori' => 'Jalan',
        'alamat' => $_POST['alamat'],
        'panjang' => $_POST['panjang'],
        'lebar' => $_POST['lebar'],
        'tinggi' => 0,
        'tanggal_mulai' => $_POST['tanggal_mulai'],
        'tanggal_selesai' => $_POST['tanggal_selesai'],
        'dana' => $_POST['dana'],
    ]);
    if (!$success) {
        return Redirect::withMessage('error', 'Data gagal diubah')->to('/jalan');
    }

    return Redirect::withMessage('success', 'Data berhasil diubah')->to('/jalan');
})->with('auth');

$router->get('/jalan/:id/delete', function ($id) use ($db) {
    $success = $db->table('proyek')->where('id_proyek', $id)->delete();
    if (!$success) {
        return Redirect::withMessage('error', 'Data gagal dihapus')->to('/jalan');
    }

    return Redirect::withMessage('success', 'Data berhasil dihapus')->to('/jalan');;
})->with('auth');

/** Jembatan Section */
$router->get('/jembatan', function () use ($template, $db) {
    $jembatan = $db->table('proyek')->where('kategori', '\'Jembatan\'')->findAll();

    return $template->withLayout('dashboard')->render('jembatan/index', compact('jembatan'));
})->with('auth');

$router->get('/jembatan/add', function () use ($template) {
    return $template->withLayout('dashboard')->render('jembatan/add');
})->with('auth');

$router->post('/jembatan', function () use ($db) {
    $success = $db->table('proyek')->insert([
        'nama' => $_POST['nama'],
        'jenis' => $_POST['jenis'],
        'kategori' => 'Jembatan',
        'alamat' => $_POST['alamat'],
        'panjang' => $_POST['panjang'],
        'lebar' => $_POST['lebar'],
        'tinggi' => 0,
        'tanggal_mulai' => $_POST['tanggal_mulai'],
        'tanggal_selesai' => $_POST['tanggal_selesai'],
        'dana' => $_POST['dana'],
    ]);

    if (!$success) {
        return Redirect::withMessage('error', 'Data gagal ditambahkan')->to('/jembatan');
    }

    return Redirect::withMessage('success', 'Data berhasil ditambahkan')->to('/jembatan');
})->with('auth');

$router->get('/jembatan/:id', function ($id) use ($template, $db) {
    $jembatan = $db->table('proyek')->where('id_proyek', $id)->where('kategori', '\'Jembatan\'')->find();
    if ($jembatan == null) {
        return Redirect::withMessage('error', 'Gagal memuat data');
    }

    return $template->withLayout('dashboard')->render('jembatan/edit', compact('jembatan'));
})->with('auth');

$router->post('/jembatan/:id', function ($id) use ($db) {
    $success = $db->table('proyek')->where('id_proyek', $id)->update([
        'nama' => $_POST['nama'],
        'jenis' => $_POST['jenis'],
        'kategori' => 'Jembatan',
        'alamat' => $_POST['alamat'],
        'panjang' => $_POST['panjang'],
        'lebar' => $_POST['lebar'],
        'tinggi' => 0,
        'tanggal_mulai' => $_POST['tanggal_mulai'],
        'tanggal_selesai' => $_POST['tanggal_selesai'],
        'dana' => $_POST['dana'],
    ]);
    if (!$success) {
        return Redirect::withMessage('error', 'Data gagal diubah')->to('/jembatan');
    }

    return Redirect::withMessage('success', 'Data berhasil diubah')->to('/jembatan');
})->with('auth');

$router->get('/jembatan/:id/delete', function ($id) use ($db) {
    $success = $db->table('proyek')->where('id_proyek', $id)->delete();
    if (!$success) {
        return Redirect::withMessage('error', 'Data gagal dihapus')->to('/jembatan');
    }

    return Redirect::withMessage('success', 'Data berhasil dihapus')->to('/jembatan');;
})->with('auth');

/** Pengawasan Section */
$router->get('/pengawasan', function () use ($template, $db) {
    $pengawasan = $db->table('pengawasan')->join('proyek', 'proyek.id_proyek = pengawasan.id_proyek')->findAll();
    $periode = $db->table('pengawasan')->select('periode')->groupBy('periode')->column('periode');
    $tahun = $db->table('pengawasan')->select('tahun')->groupBy('tahun')->column('tahun');
    $proyek = $db->table('proyek')->select('nama')->column('nama');

    return $template->withLayout('dashboard')->render('pengawasan/index', compact('pengawasan', 'periode', 'tahun', 'proyek'));
})->with('auth');

$router->get('/pengawasan/add', function () use ($template, $db) {
    $proyek = $db->table('proyek')->findAll();

    return $template->withLayout('dashboard')->render('pengawasan/add', compact('proyek'));
})->with('auth');

$router->post('/pengawasan', function () use ($db) {
    $foto = FileUpload::upload('foto');
    if (!$foto) {
        return Redirect::withMessage('error', 'Gagal mengupload foto')->back();
    }

    $kwitansi = FileUpload::upload('kwitansi');
    if (!$kwitansi) {
        return Redirect::withMessage('error', 'Gagal mengupload kwitansi')->back();
    }

    $success = $db->table('pengawasan')->insert([
        'kemajuan' => $_POST['kemajuan'],
        'periode' => $_POST['periode'],
        'keterangan' => $_POST['keterangan'],
        'tahun' => $_POST['tahun'],
        'video' => $_POST['video'],
        'biaya' => $_POST['biaya'],
        'foto' => $foto['name'],
        'kwitansi' => $kwitansi['name'],
        'id_proyek' => $_POST['id_proyek'],
    ]);

    if (!$success) {
        return Redirect::withMessage('error', 'Data gagal ditambahkan')->to('/pengawasan');
    }

    return Redirect::withMessage('success', 'Data berhasil ditambahkan')->to('/pengawasan');
})->with('auth');

$router->get('/pengawasan/:id', function ($id) use ($template, $db) {
    $proyek = $db->table('proyek')->findAll();
    $pengawasan = $db->table('pengawasan')->where('id_pengawasan', $id)->find();
    if ($pengawasan == null) {
        return Redirect::withMessage('error', 'Gagal memuat data');
    }

    return $template->withLayout('dashboard')->render('pengawasan/edit', compact('pengawasan', 'proyek'));
})->with('auth');

$router->post('/pengawasan/:id', function ($id) use ($db) {
    $data = [
        'kemajuan' => $_POST['kemajuan'],
        'periode' => $_POST['periode'],
        'keterangan' => $_POST['keterangan'],
        'tahun' => $_POST['tahun'],
        'video' => $_POST['video'],
        'biaya' => $_POST['biaya'],
        'id_proyek' => $_POST['id_proyek'],
    ];

    if ($_FILES['foto']['error'] == 0) {
        $foto = FileUpload::upload('foto');
        if (!$foto) {
            return Redirect::withMessage('error', 'Gagal mengupload foto')->back();
        }

        $data['foto'] = $foto['name'];
    }

    if ($_FILES['kwitansi']['error'] == 0) {
        $kwitansi = FileUpload::upload('kwitansi');
        if (!$kwitansi) {
            return Redirect::withMessage('error', 'Gagal mengupload kwitansi')->back();
        }

        $data['kwitansi'] = $kwitansi['name'];
    }

    $success = $db->table('pengawasan')->where('id_pengawasan', $id)->update($data);
    if (!$success) {
        return Redirect::withMessage('error', 'Data gagal diubah')->to('/pengawasan');
    }

    return Redirect::withMessage('success', 'Data berhasil diubah')->to('/pengawasan');
})->with('auth');

$router->get('/pengawasan/:id/delete', function ($id) use ($db) {
    $success = $db->table('pengawasan')->where('id_pengawasan', $id)->delete();
    if (!$success) {
        return Redirect::withMessage('error', 'Data gagal dihapus')->to('/pengawasan');
    }

    return Redirect::withMessage('success', 'Data berhasil dihapus')->to('/pengawasan');
})->with('auth');

$router->get('/pengawasan/:id/project', function ($id) use ($template, $db) {
    $pegawai = $db->table('pegawai')->whereNotIn('id_pegawai', "SELECT id_pegawai FROM pengawasan_pegawai WHERE id_pengawasan = $id")->findAll();
    $pengawas = $db->table('pengawasan_pegawai')->select('id_pengawasan, pegawai.id_pegawai, nama, username, role')->join('pegawai', 'pengawasan_pegawai.id_pegawai = pegawai.id_pegawai')->join('pengguna', 'pegawai.id_user = pengguna.id_user')->where('id_pengawasan', $id)->findAll();
    $pengawasan = $db->table('pengawasan')->where('id_pengawasan', $id)->join('proyek', 'proyek.id_proyek = pengawasan.id_proyek')->find();

    return $template->withLayout('dashboard')->render('pengawasan/project', compact('pengawasan', 'pegawai', 'pengawas'));
})->with('auth');

$router->post('/pengawasan/:id/project', function ($id) use ($template, $db) {
    $success = $db->table('pengawasan_pegawai')->insert([
        'id_pengawasan' => $id,
        'id_pegawai' => $_POST['id_pegawai'],
        'role' => $_POST['role'],
    ]);
    if (!$success) {
        return Redirect::withMessage('error', 'Data gagal ditambahkan')->back();
    }

    return Redirect::withMessage('success', 'Data berhasil ditambahkan')->back();
})->with('auth');

$router->get('/pengawasan/:id_pengawasan/:id_pegawai/delete', function ($id_pengawasan, $id_pegawai) use ($db) {
    $success = $db->table('pengawasan_pegawai')->where('id_pengawasan', $id_pengawasan)->where('id_pegawai', $id_pegawai)->delete();
    if (!$success) {
        return Redirect::withMessage('error', 'Data gagal dihapus')->back();
    }

    return Redirect::withMessage('success', 'Data berhasil dihapus')->back();;
});

/** Kontraktor Section */
$router->get('/kontraktor', function () use ($template, $db) {
    $proyek = $db->table('proyek')->select('nama')->groupBy('nama')->column('nama');
    $nama = $db->table('kontraktor')->select('nama_kontraktor')->groupBy('nama_kontraktor')->column('nama_kontraktor');
    $kontraktor = $db->table('kontraktor')->select('id_kontraktor, nama, kontraktor.alamat, kontraktor.telp, kontraktor.penanggung_jawab, nama_kontraktor, kategori, status')->join('proyek', 'proyek.id_proyek = kontraktor.id_proyek')->findAll();

    return $template->withLayout('dashboard')->render('kontraktor/index', compact('kontraktor', 'proyek', 'nama'));
})->with('auth');

$router->get('/kontraktor/add', function () use ($template, $db) {
    $proyek = $db->table('proyek')->findAll();

    return $template->withLayout('dashboard')->render('kontraktor/add', compact('proyek'));
})->with('auth');

$router->post('/kontraktor', function () use ($db) {
    $success = $db->table('kontraktor')->insert([
        'nama_kontraktor' => $_POST['nama_kontraktor'],
        'status' => $_POST['status'],
        'penanggung_jawab' => $_POST['penanggung_jawab'],
        'alamat' => $_POST['alamat'],
        'telp' => $_POST['telp'],
        'id_proyek' => $_POST['id_proyek'],
    ]);

    if (!$success) {
        return Redirect::withMessage('error', 'Data gagal ditambahkan')->to('/kontraktor');
    }

    return Redirect::withMessage('success', 'Data berhasil ditambahkan')->to('/kontraktor');
})->with('auth');

$router->get('/kontraktor/:id', function ($id) use ($template, $db) {
    $proyek = $db->table('proyek')->findAll();
    $kontraktor = $db->table('kontraktor')->where('id_kontraktor', $id)->find();
    if ($kontraktor == null) {
        return Redirect::withMessage('error', 'Gagal memuat data');
    }

    return $template->withLayout('dashboard')->render('kontraktor/edit', compact('kontraktor', 'proyek'));
})->with('auth');

$router->post('/kontraktor/:id', function ($id) use ($db) {
    $success = $db->table('kontraktor')->where('id_kontraktor', $id)->update([
        'nama_kontraktor' => $_POST['nama_kontraktor'],
        'status' => $_POST['status'],
        'penanggung_jawab' => $_POST['penanggung_jawab'],
        'alamat' => $_POST['alamat'],
        'telp' => $_POST['telp'],
        'id_proyek' => $_POST['id_proyek'],
    ]);
    if (!$success) {
        return Redirect::withMessage('error', 'Data gagal diubah')->to('/kontraktor');
    }

    return Redirect::withMessage('success', 'Data berhasil diubah')->to('/kontraktor');
})->with('auth');

$router->get('/kontraktor/:id/delete', function ($id) use ($db) {
    $success = $db->table('kontraktor')->where('id_kontraktor', $id)->delete();
    if (!$success) {
        return Redirect::withMessage('error', 'Data gagal dihapus')->to('/kontraktor');
    }

    return Redirect::withMessage('success', 'Data berhasil dihapus')->to('/kontraktor');
})->with('auth');

/** Laporan Section */
$router->get('/laporan/bangunan', function () use ($template, $db) {
    $laporan = $db->table('pengawasan')->join('proyek', 'proyek.id_proyek = pengawasan.id_proyek')->where('kategori', '\'Bangunan\'')->findAll();

    return $template->withLayout('dashboard')->render('laporan/bangunan', compact('laporan'));
})->with('auth');

$router->get('/laporan/jalan', function () use ($template, $db) {
    $laporan = $db->table('pengawasan')->join('proyek', 'proyek.id_proyek = pengawasan.id_proyek')->where('kategori', '\'Jalan\'')->findAll();

    return $template->withLayout('dashboard')->render('laporan/jalan', compact('laporan'));
})->with('auth');

$router->get('/laporan/jembatan', function () use ($template, $db) {
    $laporan = $db->table('pengawasan')->join('proyek', 'proyek.id_proyek = pengawasan.id_proyek')->where('kategori', '\'Jembatan\'')->findAll();

    return $template->withLayout('dashboard')->render('laporan/jembatan', compact('laporan'));
})->with('auth');

/** Pendapatan Section */
$router->get('/pendapatan', function () use ($template, $db) {
    $tahun = $db->table('pendapatan')->select('tahun')->groupBy('tahun')->column('tahun');
    $proyek = $db->table('proyek')->select('nama')->groupBy('nama')->column('nama');
    $pendapatan = $db->table('pendapatan')->join('proyek', 'proyek.id_proyek = pendapatan.id_proyek', 'left')->findAll();
    $summary = $db->table('pendapatan')->select('tahun, SUM(nominal) AS total')->groupBy('tahun')->findAll();

    return $template->withLayout('dashboard')->render('pendapatan/index', compact('pendapatan', 'tahun', 'proyek', 'summary'));
})->with('auth');

$router->get('/pendapatan/add', function () use ($template, $db) {
    $proyek = $db->table('proyek')->findAll();

    return $template->withLayout('dashboard')->render('pendapatan/add', compact('proyek'));
})->with('auth');

$router->post('/pendapatan', function () use ($db) {
    $success = $db->table('pendapatan')->insert([
        'nominal' => $_POST['nominal'],
        'tahun' => $_POST['tahun'],
        'id_proyek' => $_POST['id_proyek'],
    ]);

    if (!$success) {
        return Redirect::withMessage('error', 'Data gagal ditambahkan')->to('/pendapatan');
    }

    return Redirect::withMessage('success', 'Data berhasil ditambahkan')->to('/pendapatan');
})->with('auth');

$router->get('/pendapatan/:id', function ($id) use ($template, $db) {
    $pendapatan = $db->table('pendapatan')->where('id_pendapatan', $id)->find();
    if ($pendapatan == null) {
        return Redirect::withMessage('error', 'Gagal memuat data');
    }

    $proyek = $db->table('proyek')->findAll();

    return $template->withLayout('dashboard')->render('pendapatan/edit', compact('pendapatan', 'proyek'));
})->with('auth');

$router->post('/pendapatan/:id', function ($id) use ($db) {
    $success = $db->table('pendapatan')->where('id_pendapatan', $id)->update([
        'nominal' => $_POST['nominal'],
        'tahun' => $_POST['tahun'],
        'id_proyek' => $_POST['id_proyek'],
    ]);
    if (!$success) {
        return Redirect::withMessage('error', 'Data gagal diubah')->to('/pendapatan');
    }

    return Redirect::withMessage('success', 'Data berhasil diubah')->to('/pendapatan');
})->with('auth');

$router->get('/pendapatan/:id/delete', function ($id) use ($db) {
    $success = $db->table('pendapatan')->where('id_pendapatan', $id)->delete();
    if (!$success) {
        return Redirect::withMessage('error', 'Data gagal dihapus')->to('/pendapatan');
    }

    return Redirect::withMessage('success', 'Data berhasil dihapus')->to('/pendapatan');;
})->with('auth');

/** Pengeluaran Section */
$router->get('/pengeluaran', function () use ($template, $db) {
    $jenis = $db->table('pengeluaran')->select('jenis')->groupBy('jenis')->column('jenis');
    $pengeluaran = $db->table('pengeluaran')->findAll();
    $summary = $db->table('pengeluaran')->select('YEAR(tanggal) AS tahun, SUM(nominal) AS total')->groupBy('YEAR(tanggal)')->findAll();

    return $template->withLayout('dashboard')->render('pengeluaran/index', compact('pengeluaran', 'jenis', 'summary'));
})->with('auth');

$router->get('/pengeluaran/add', function () use ($template) {

    return $template->withLayout('dashboard')->render('pengeluaran/add');
})->with('auth');

$router->post('/pengeluaran', function () use ($db) {
    $success = $db->table('pengeluaran')->insert([
        'jenis' => $_POST['jenis'],
        'nominal' => $_POST['nominal'],
        'tanggal' => $_POST['tanggal'],
    ]);

    if (!$success) {
        return Redirect::withMessage('error', 'Data gagal ditambahkan')->to('/pengeluaran');
    }

    return Redirect::withMessage('success', 'Data berhasil ditambahkan')->to('/pengeluaran');
})->with('auth');

$router->get('/pengeluaran/:id', function ($id) use ($template, $db) {
    $pengeluaran = $db->table('pengeluaran')->where('id_pengeluaran', $id)->find();
    if ($pengeluaran == null) {
        return Redirect::withMessage('error', 'Gagal memuat data');
    }

    return $template->withLayout('dashboard')->render('pengeluaran/edit', compact('pengeluaran'));
})->with('auth');

$router->post('/pengeluaran/:id', function ($id) use ($db) {
    $success = $db->table('pengeluaran')->where('id_pengeluaran', $id)->update([
        'jenis' => $_POST['jenis'],
        'nominal' => $_POST['nominal'],
        'tanggal' => $_POST['tanggal'],
    ]);
    if (!$success) {
        return Redirect::withMessage('error', 'Data gagal diubah')->to('/pengeluaran');
    }

    return Redirect::withMessage('success', 'Data berhasil diubah')->to('/pengeluaran');
})->with('auth');

$router->get('/pengeluaran/:id/delete', function ($id) use ($db) {
    $success = $db->table('pengeluaran')->where('id_pengeluaran', $id)->delete();
    if (!$success) {
        return Redirect::withMessage('error', 'Data gagal dihapus')->to('/pengeluaran');
    }

    return Redirect::withMessage('success', 'Data berhasil dihapus')->to('/pengeluaran');;
})->with('auth');

$requestMethod = $_SERVER['REQUEST_METHOD'];
$requestUrl = $_SERVER['REQUEST_URI'];

$router->handleRequest($requestMethod, $requestUrl);

$db->disconnect();
