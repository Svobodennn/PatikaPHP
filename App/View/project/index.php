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
    <?= $data["sidebar"]; ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Projeler</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?= _link('') ?>">Keşfet</a></li>
                            <li class="breadcrumb-item active">Projeler</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>Proje</th>
                    <th>Müşteri</th>
                    <th>Durum</th>
                    <th>İlerleyiş</th>
                    <th style="width: 40px">Eylem</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($data['projects'] as $key => $value): ?>
                    <tr id="row_<?= $value['id'] ?>">
                        <td><?=$value['title']?></td>
                        <td><?=$value['customer_name'] ? '<a href="'._link('customer/detail/'.$value['customer_id']).'">'. $value['customer_name'] .'</a>' : null ?></td>
                        <td><?=$value['status'] == 'a' ? 'Aktif':'Pasif'?></td>
                        <td>
                            <?=$value['progress']?>%
                            <div class="progress progress-xs">
                                <div class="progress-bar progress-bar-danger" style="width: <?=$value['progress']?>%"></div>
                            </div>
                        </td>
                        <td>
                            <div class="btn btn-group">
                                <button class="btn btn-md btn-danger" onclick="confirm('<?= $value['id'] ?>')"><i class="fa fa-trash"></i>
                                </button>
                                <a href="<?= _link('project/edit/' . $value['id']) ?>" class="btn btn-md btn-warning"><i class="fa fa-pen"></i></a>
                                <a href="<?= _link('project/edit/' . $value['id']) ?>" class="btn btn-md btn-info"><i class="fa fa-eye"></i></a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
        <div class="p-3">
            <h5>Title</h5>
            <p>Sidebar content</p>
        </div>
    </aside>
    <!-- /.control-sidebar -->

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

    function confirm(project_id) {
        Swal.fire({
            title: 'Silmek istediğinize emin misiniz?',
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: 'Evet, Eminim',
            denyButtonText: `Vazgeç`,
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                removeProject(project_id)
            } else if (result.isDenied) {
                Swal.fire('Tamamdır', '', 'info')
            }
        })
    }

    function removeProject(id) {
        let project_id = id
        let formData = new FormData()
        formData.append('project_id', project_id)

        axios.post('<?=_link('project/remove')?>', formData)
            .then(res => {
                console.log(res.data)

                if (res.data.removed) {
                    document.getElementById('row_' + res.data.removed).remove();
                }
                Swal.fire(
                    res.data.title,
                    res.data.msg,
                    res.data.status
                )
            })
            .catch((err) => {
                console.log(err)
                Swal.fire(
                    res.data.title,
                    res.data.msg,
                    res.data.status
                )
            })

    }

</script>

</body>
</html>
