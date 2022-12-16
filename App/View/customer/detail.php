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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?=assets( 'plugins/fontawesome-free/css/all.min.css')?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?=assets( 'css/adminlte.min.css')?>">
    <link rel="stylesheet" href="<?=assets( 'plugins/summernote/summernote.css')?>">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <!-- Navbar -->
    <?=$data["navbar"];?>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <?=$data["sidebar"]?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"><?=$data['customer']['name'].' '.$data['customer']['surname']?></h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"> <a href="<?=_link('')?>">Keşfet</a> </li>
                            <li class="breadcrumb-item"><a href="<?=_link('customer')?>">Müşteriler</a></li>
                            <li class="breadcrumb-item active"><?=$data['customer']['name'].' '.$data['customer']['surname']?></li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="row">

            <div class="col-md-4">
                <div class="card card-widget widget-user-2">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header bg-warning">
                        <!-- /.widget-user-image -->
                        <h3 class="widget-user-username"><?=$data['customer']['name'].' '.$data['customer']['surname']?></h3>
                        <h5 class="widget-user-desc"><?=$data['customer']['company']?></h5>
                    </div>
                    <div class="card-footer p-0">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    Projeler <span class="float-right badge bg-primary"><?=count($data['projects'])?></span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <?=$data['customer']['email']?>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <?=$data['customer']['phone']?>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
            <div class="col-md-8">
                <textarea id="summernote"></textarea>
                <button class="btn btn-sm btn-success" onclick="saveNote()">Kaydet</button>
            </div>
            </div>
            <div class="row">
                <div class="col">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>Proje</th>
                            <th>Durum</th>
                            <th>İlerleyiş</th>
                            <th style="width: 40px">Eylem</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($data['projects'] as $key => $value): ?>
                            <tr id="row_<?= $value['id'] ?>">
                                <td><?=$value['title']?></td>
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
<script src="<?=assets( 'plugins/jquery/jquery.min.js')?>"></script>
<!-- Bootstrap 4 -->
<script src="<?=assets( 'plugins/plugins/bootstrap/js/bootstrap.bundle.min.js')?>"></script>
<!-- AdminLTE App -->
<script src="<?=assets( 'js/adminlte.min.js')?>"></script>

<script src="<?= assets('plugins/sweetalert2/sweetalert2.all.js') ?>"></script>
<script src="<?= assets('plugins/summernote/summernote.min.js') ?>"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.1.3/axios.min.js"
        integrity="sha512-0qU9M9jfqPw6FKkPafM3gy2CBAvUWnYVOfNPDYKVuRTel1PrciTj+a9P3loJB+j0QmN2Y0JYQmkBBS8W+mbezg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>

    $(function() {
        $('#summernote').summernote();
    });

    function saveNote(){
        const html = $('#summernote').summernote('code');

            let formData = new FormData()

            formData.append('html', html)

            axios.post('<?=_link('customer/not/'.$data['customer']['id'])?>', formData)
                .then(res => {
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

        }




</script>

</body>
</html>
