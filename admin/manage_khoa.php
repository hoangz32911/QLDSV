<?php
include 'db_connect.php';
if (isset($_GET['id'])) {
	$qry = $conn->query("SELECT * FROM khoa where id={$_GET['id']}")->fetch_array();
	foreach ($qry as $k => $v) {
		$$k = $v;
	}
}
?>
<div class="container-fluid">
	<form action="" id="manage-class">
		<input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
		<div id="msg" class="form-group"></div>
		<div class="form-group">
			<label for="ma_khoa" class="control-label">Mã khoa:</label>
			<input type="text" class="form-control form-control-sm" name="ma_khoa" id="ma_khoa" required value="<?php echo isset($ma_khoa) ? $ma_khoa : '' ?>" >
		</div>
		<div class="form-group">
			<label for="ten_khoa" class="control-label">Tên khoa:</label>
			<input type="text" class="form-control form-control-sm" name="ten_khoa" id="ten_khoa" required value="<?php echo isset($ten_khoa) ? $ten_khoa : '' ?>" >
		</div>
        <div class="form-group">
			<label for="sdt" class="control-label">SĐT:</label>
			<input type="text" class="form-control form-control-sm" name="sdt" id="sdt" required value="<?php echo isset($sdt) ? $sdt : '' ?>" >
		</div>
		<div class="form-group">
			<label for="dia_chi" class="control-label">Địa chỉ:</label>
			<input type="text" class="form-control form-control-sm" name="dia_chi" id="dia_chi" required value="<?php echo isset($dia_chi) ? $dia_chi : '' ?>" >
		</div>
	</form>
</div>
<script>	
	$(document).ready(function() {
		$('#manage-class').submit(function(e) {
			e.preventDefault();
			start_load()
			$('#msg').html('')
			$.ajax({
				url: 'ajax.php?action=save_khoa',
				method: 'POST',
				data: $(this).serialize(),
				success: function(resp) {
					if (resp == 1) {
						alert_toast("Đã cập nhật dữ liệu thành công!", "success");
						setTimeout(function() {
							location.reload()
						}, 1750)
					} else if (resp == 2) {
						$('#msg').html('<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> Khoa đã tồn tại.</div>')
						end_load()
					}
				}
			})
		})
	})
</script>