<?php
include('db_connect.php');
session_start();
if (isset($_GET['id'])) {
	$user = $conn->query("SELECT * FROM users where id =" . $_GET['id']);
	foreach ($user->fetch_array() as $k => $v) {
		$meta[$k] = $v;
	}
}
?>
<div class="container-fluid">
	<div id="msg"></div>

	<form action="" id="manage-user">
		<input type="hidden" name="id" value="<?php echo isset($meta['id']) ? $meta['id'] : '' ?>">
		<div class="form-group">
			<label for="name">Họ đệm</label>
			<input type="text" name="firstname" id="firstname" class="form-control" value="<?php echo isset($meta['firstname']) ? $meta['firstname'] : '' ?>" required>
		</div>
		<div class="form-group">
			<label for="name">Tên</label>
			<input type="text" name="lastname" id="lastname" class="form-control" value="<?php echo isset($meta['lastname']) ? $meta['lastname'] : '' ?>" required>
		</div>
		<div class="form-group">
			<label for="username">Tên tài khoản</label>
			<input type="text" name="username" id="username" class="form-control" value="<?php echo isset($meta['username']) ? $meta['username'] : '' ?>" required autocomplete="off">
		</div>
		<div class="form-group">
			<label for="password">Mật khẩu</label>
			<input type="password" name="password" id="password" class="form-control" value="" autocomplete="off">
			<small><i>Để trống nếu bạn không muốn thay đổi mật khẩu.</i></small>
		</div>


	</form>
</div>
<style>
	img#cimg {
		max-height: 15vh;
		/*max-width: 6vw;*/
	}
</style>
<script>
	function displayImg(input, _this) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
				$('#cimg').attr('src', e.target.result);
			}

			reader.readAsDataURL(input.files[0]);
		}
	}
	$('#manage-user').submit(function(e) {
		e.preventDefault();
		start_load()
		$.ajax({
			url: 'ajax.php?action=update_user',
			data: new FormData($(this)[0]),
			cache: false,
			contentType: false,
			processData: false,
			method: 'POST',
			type: 'POST',
			success: function(resp) {
				if (resp == 1) {
					alert_toast("Đã cập nhật dữ liệu thành công!", 'success')
					setTimeout(function() {
						location.reload()
					}, 1500)
				} else {
					$('#msg').html('<div class="alert alert-danger">Tên tài khoản đã tồn tại</div>')
					end_load()
				}
			}
		})
	})
</script>