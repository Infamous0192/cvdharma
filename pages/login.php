<h4 class="mb-2">Selamat datang! 👋</h4>
<p class="mb-4">Silahkan login terlebih dahulu</p>

<?php if (Session::has('error')) : ?>
    <div class="alert alert-danger alert-dismissible" role="alert">
        <?= Session::retrive('error') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif ?>

<form class="mb-3" action="login" method="POST">
    <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" id="username" name="username" placeholder="Username" required />
    </div>
    <div class="mb-3 form-password-toggle">
        <div class="d-flex justify-content-between">
            <label class="form-label" for="password">Password</label>
        </div>
        <div class="input-group input-group-merge">
            <input type="password" id="password" class="form-control" name="password" placeholder="Masukan Password" aria-describedby="password" required />
            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
        </div>
    </div>
    <div class="mb-3">
        <button class="btn btn-primary d-grid w-100" name="Submit" type="submit">Masuk</button>
    </div>
</form>

<p class="text-center">
    <span>Klik daftar untuk menambah user</span>
    <a href="register">
        <span> Daftar</span>
    </a>
</p>