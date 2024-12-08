<!DOCTYPE html>
<html lang="en">
<?php
session_start();
include('./db_connect.php');
ob_start();
// if(!isset($_SESSION['system'])){

$system = $conn->query("SELECT * FROM tt_truong")->fetch_array();
foreach ($system as $k => $v) {
  $_SESSION['system'][$k] = $v;
}
// }
ob_end_flush();
?>

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Đăng nhập | <?php echo $_SESSION['system']['name'] ?></title>


  <?php include('./header.php'); ?>
  <?php
  if (isset($_SESSION['login_id']))
    header("location:index.php?page=home");

  ?>

</head>
<style>
  body {
    width: 100%;
    height: calc(100%);
    position: fixed;
    top: 0;
    left: 0;
    align-items: center !important;
    margin-top: 100px;
  }

  main#main {
    width: 100%;
    height: calc(100%);
    display: flex;
  }
</style>

<body class="bg-primary">


  <main id="main">

    <div class="align-self-center w-100">
      <h2 class="text-white text-center"><b><?php echo $_SESSION['system']['name'] ?> - Admin</b></h2>
      <div id="login-center" class="bg-primary row justify-content-center">
        <div class="card col-md-4">
          <div class="card-body">
            <form id="login-form">
              <div class="form-group">
                <label for="username" class="control-label text-dark">Tên tài khoản</label>
                <input type="text" id="username" name="username" class="form-control form-control-sm">
              </div>
              <div class="form-group">
                <label for="password" class="control-label text-dark">Mật khẩu</label>
                <input type="password" id="password" name="password" class="form-control form-control-sm">
              </div>
              <div class="w-100 d-flex justify-content-center align-items-center">
                <button class="btn-sm btn-block btn-wave col-md-4 btn-primary m-0 mr-1">Đăng nhập</button>
                <button class="btn-sm btn-block btn-wave col-md-4 btn-success m-0" type="button" id="view_result">Xem kết quả</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </main>

  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>
  <div class="modal fade" id="view_student_results" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"></h5>
        </div>
        <div class="modal-body">
          <div class="container-fluid">
            <form id="vsr-frm">
              <div class="form-group">
                <label for="student_code" class="control-label text-dark">Mã sinh viên:</label>
                <input type="text" id="student_code" name="student_code" class="form-control form-control-sm">
              </div>
            </form>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" id='submit' onclick="$('#view_student_results form').submit()">Xem</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Thoát</button>
        </div>
      </div>
    </div>
  </div>

</body>
<?php include 'footer.php' ?>
<script>
  $('#view_result').click(function() {
    $('#view_student_results').modal('show')
  })
  $('#login-form').submit(function(e) {
    e.preventDefault()
    $('#login-form button[type="button"]').attr('disabled', true).html('Đăng nhập...');
    if ($(this).find('.alert-danger').length > 0)
      $(this).find('.alert-danger').remove();
    $.ajax({
      url: 'ajax.php?action=login',
      method: 'POST',
      data: $(this).serialize(),
      error: err => {
        console.log(err)
        $('#login-form button[type="button"]').removeAttr('disabled').html('Login');

      },
      success: function(resp) {
        if (resp == 1) {
          location.href = 'index.php?page=home';
        } else {
          $('#login-form').prepend('<div class="alert alert-danger">Tên tài khoản hoặc mật khẩu sai.</div>')
          $('#login-form button[type="button"]').removeAttr('disabled').html('Xem kết quả');
        }
      }
    })
  })
  $('#vsr-frm').submit(function(e) {
    e.preventDefault()
    start_load()
    if ($(this).find('.alert-danger').length > 0)
      $(this).find('.alert-danger').remove();
    $.ajax({
      url: 'ajax.php?action=login2',
      method: 'POST',
      data: $(this).serialize(),
      error: err => {
        console.log(err)
        end_load()
      },
      success: function(resp) {
        if (resp == 1) {
          location.href = 'student_results.php';
        } else {
          $('#login-form').prepend('<div class="alert alert-danger">Mã sinh viên không tồn tại.</div>')
          end_load()
        }
      }
    })
  })
  $('.number').on('input keyup keypress', function() {
    var val = $(this).val()
    val = val.replace(/[^0-9 \,]/, '');
    val = val.toLocaleString('en-US')
    $(this).val(val)
  })
</script>

</html>