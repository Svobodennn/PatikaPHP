<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Starter</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?= assets('plugins/fontawesome-free/css/all.min.css') ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= assets('css/adminlte.min.css') ?>">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <!-- Navbar -->
    <?= $data["navbar"]; ?>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <?= $data["sidebar"] ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Profilim</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?= _link('') ?>">Keşfet</a></li>
                            <li class="breadcrumb-item"><a href="<?= _link('profile') ?>">Profilim</a></li>
                            <li class="breadcrumb-item active">Ekle</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <!-- Main content -->
<!--        --><?php //echo "<pre>";  var_dump( $data); exit;?>
        <div class="content">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <form id="profile">
                            <input type="hidden" id="id" value="<?= _session('id') ?>">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">İsim</label>
                                    <input type="text" class="form-control" id="name"
                                           value="<?= _session('name') ?>" >
                                </div>
                                <div class="form-group">
                                    <label for="surname">Soyisim</label>
                                    <input type="text" class="form-control" id="surname"
                                           value="<?= _session('surname') ?>"
                                          >
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control" id="email"
                                           value="<?= _session('email') ?>"
                                           >
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Güncelle</button>
                            </div>
                        </form>

                    </div>

                </div>
                <div class="col-md-6">
                    <div class="card">
                        <form id="changepassword">
                            <input type="hidden" id="id" value="<?= _session('id') ?>">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="password">Eski Şifreniz</label>
                                    <input type="password" class="form-control" id="password"
                                            placeholder="Eski Şifrenizi giriniz.">
                                </div>
                                <div class="form-group">
                                    <label for="new_password">Yeni Şifreniz</label>
                                    <input type="password" class="form-control" id="new_password"

                                           placeholder="Yeni Şifrenizi giriniz.">
                                </div>
                                <div class="form-group">
                                    <label for="new_password_again">Yeni Şifreniz (Tekrar)</label>
                                    <input type="password" class="form-control" id="new_password_again"

                                           placeholder="Yeni Şifrenizi Tekrar giriniz.">
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Güncelle</button>
                            </div>
                        </form>

                    </div>

                </div>
            </div>
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- To the right -->
        <div class="float-right d-none d-sm-inline">
            Anything you want
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
    </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="<?= assets('plugins/jquery/jquery.min.js') ?>"></script>
<!-- Bootstrap 4 -->
<script src="<?= assets('plugins/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<!-- AdminLTE App -->
<script src="<?= assets('js/adminlte.min.js') ?>"></script>

<script src="<?= assets('plugins/sweetalert2/sweetalert2.all.js') ?>"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.1.3/axios.min.js"
        integrity="sha512-0qU9M9jfqPw6FKkPafM3gy2CBAvUWnYVOfNPDYKVuRTel1PrciTj+a9P3loJB+j0QmN2Y0JYQmkBBS8W+mbezg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    const profile = document.getElementById('profile')
    const changepassword = document.getElementById('changepassword')

    profile.addEventListener('submit', (e) => {
        let name = document.getElementById('name').value
        let surname = document.getElementById('surname').value
        let email = document.getElementById('email').value
        let id = document.getElementById('id').value

        let formData = new FormData()

        formData.append('name', name)
        formData.append('surname', surname)
        formData.append('email', email)
        formData.append('id', id)


        axios.post('<?=_link('profile/edit')?>', formData)
            .then(res => {
                if (res.data.redirect) {
                    window.location.href = res.data.redirect
                }
                console.log(res)

                Swal.fire(
                    res.data.title,
                    res.data.msg,
                    res.data.status
                )
            })
            .catch((err) => {
                console.log(res)
                console.log(err)

                Swal.fire(
                    res.data.title,
                    res.data.msg,
                    res.data.status
                )
            })
        e.preventDefault()
    })
    changepassword.addEventListener('submit', (e) => {
        let password = document.getElementById('password').value
        let new_password = document.getElementById('new_password').value
        let new_password_again = document.getElementById('new_password_again').value
        let id = document.getElementById('id').value


        let formData = new FormData()

        formData.append('password', password)
        formData.append('new_password', new_password)
        formData.append('new_password_again', new_password_again)
        formData.append('id', id)

        axios.post('<?=_link('profile/password')?>', formData)
            .then(res => {
                if (res.data.redirect) {
                    window.location.href = res.data.redirect
                }
                Swal.fire(
                    res.data.title,
                    res.data.msg,
                    res.data.status
                )
            })
            .catch((err) => {

                Swal.fire(
                    res.data.title,
                    res.data.msg,
                    res.data.status
                )
            })
        e.preventDefault()
    })
</script>

</body>
</html>
