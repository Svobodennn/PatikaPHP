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
                        <h1 class="m-0">Starter Page</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"> <a href="<?=_link('')?>">Keşfet</a> </li>
                            <li class="breadcrumb-item"><a href="<?=_link('customer')?>">Müşteriler</a></li>
                            <li class="breadcrumb-item active">Ekle</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">

                <form id="customer">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="customer_name">Müşteri Adı</label>
                            <input type="text" class="form-control" id="customer_name" placeholder="Müşteri adını giriniz.">
                        </div>
                        <div class="form-group">
                            <label for="customer_surname">Müşteri Soyadı</label>
                            <input type="text" class="form-control" id="customer_surname" placeholder="Müşteri soyadını giriniz.">
                        </div>
                        <div class="form-group">
                            <label for="customer_company">Müşteri Şirket Adı</label>
                            <input type="text" class="form-control" id="customer_company" placeholder="Müşteri şirketini giriniz.">
                        </div>
                        <div class="form-group">
                            <label for="customer_phone">Müşteri Telefon</label>
                            <input type="text" class="form-control" id="customer_phone" placeholder="Müşteri telefonunu giriniz.">
                        </div>
                        <div class="form-group">
                            <label for="customer_gsm">Müşteri GSM</label>
                            <input type="text" class="form-control" id="customer_gsm" placeholder="Müşteri gsmini giriniz.">
                        </div>
                        <div class="form-group">
                            <label for="customer_email">Müşteri E-Mail</label>
                            <input type="text" class="form-control" id="customer_email" placeholder="Müşteri emailini giriniz.">
                        </div>
                        <div class="form-group">
                            <label for="customer_adress">Müşteri Adres</label>
                            <textarea class="form-control" id="customer_adress" placeholder="Müşteri adresini giriniz."></textarea>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Ekle</button>
                    </div>
                </form>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.1.3/axios.min.js"
        integrity="sha512-0qU9M9jfqPw6FKkPafM3gy2CBAvUWnYVOfNPDYKVuRTel1PrciTj+a9P3loJB+j0QmN2Y0JYQmkBBS8W+mbezg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    const customer = document.getElementById('customer')

    customer.addEventListener('submit', (e) => {
        let name = document.getElementById('customer_name').value
        let surname = document.getElementById('customer_surname').value
        let company = document.getElementById('customer_company').value
        let phone = document.getElementById('customer_phone').value
        let gsm = document.getElementById('customer_gsm').value
        let email = document.getElementById('customer_email').value
        let adress = document.getElementById('customer_adress').value

        let formData = new FormData()

        formData.append('name', name)
        formData.append('surname', surname)
        formData.append('company', company)
        formData.append('phone', phone)
        formData.append('gsm', gsm)
        formData.append('email', email)
        formData.append('adress', adress)

        axios.post('<?=_link('customer/add')?>', formData)
            .then(res => {
                if (res.data.redirect){
                    window.location.href=res.data.redirect
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
