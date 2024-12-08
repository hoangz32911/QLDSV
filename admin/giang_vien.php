<?php include 'db_connect.php' ?>
<br>
<h2>Giảng viên</h2>
<div class="col-lg-12">
	<div class="card card-outline card-primary">
		<div class="card-header">
			<div class="card-tools">
				<a class="btn btn-block btn-sm btn-default btn-flat border-primary new_class" href="javascript:void(0)"><i class="fa fa-plus"></i> Thêm giảng viên</a>
			</div>
		</div>
		<div class="card-body">
			<table class="table tabe-hover table-bordered" id="list">
				<colgroup>
					<col width="5%">
					<col width="8%">
					<col width="7%">
					<col width="7%">
					<col width="8%">
					<col width="%">
					<col width="8%">
					<col width="15%">
					<col width="20%">
				</colgroup>
				<thead>
					<tr>
						<th class="text-center">STT</th>
						<th class="text-center">Mã GV</th>
						<th class="text-center">Họ</th>
						<th class="text-center">Đệm</th>
						<th class="text-center">Tên GV</th>
						<th class="text-center">Giới tính</th>
						<th class="text-center">SĐT</th>
						<th class="text-center">Email</th>
						<th class="text-center">Địa chỉ</th>
						<th class="text-center">Thao tác</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i = 1;
					$qry = $conn->query("SELECT * FROM giang_vien order by ma_gv asc, ten_gv asc ");
					while ($row = $qry->fetch_assoc()) :
					?>
						<tr>
							<th class="text-center"><?php echo $i++ ?></th>
							<td class="text-center"><b><?php echo $row['ma_gv'] ?></b></td>
							<td class="text-center"><b><?php echo $row['ho_gv'] ?></b></td>
							<td class="text-center"><b><?php echo $row['dem_gv'] ?></b></td>
							<td class="text-center"><b><?php echo $row['ten_gv'] ?></b></td>
							<td class="text-center"><b><?php echo $row['gioi_tinh'] ?></b></td>
							<td class="text-center"><b><?php echo $row['sdt'] ?></b></td>
							<td class="text-center"><b><?php echo $row['email'] ?></b></td>
							<td class="text-center"><b><?php echo $row['dia_chi'] ?></b></td>
							<td class="text-center">
								<div class="btn-group">
									<a href="javascript:void(0)" data-id='<?php echo $row['id'] ?>' class="btn btn-primary btn-flat manage_class">
										<i class="fas fa-edit"></i>
									</a>
									<button type="button" class="btn btn-danger btn-flat delete_giang_vien" data-id="<?php echo $row['id'] ?>">
										<i class="fas fa-trash"></i>
									</button>
								</div>
							</td>
						</tr>
					<?php endwhile; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<script>
	$(document).ready(function() {
		$('#list').dataTable()
		$('.new_class').click(function() {
			uni_modal("Thêm giảng viên", "manage_giang_vien.php")
		})
		$('.manage_class').click(function() {
			uni_modal("Cập nhật giảng viên", "manage_giang_vien.php?id=" + $(this).attr('data-id'))
		})
		$('.delete_giang_vien').click(function() {
			_conf("Bạn có muốn xóa giảng viên này không?", "delete_giang_vien", [$(this).attr('data-id')])
		})
	})

	function delete_giang_vien($id) {
		start_load()
		$.ajax({
			url: 'ajax.php?action=delete_giang_vien',
			method: 'POST',
			data: {
				id: $id
			},
			success: function(resp) {
				if (resp == 1) {
					alert_toast("Dữ liệu đã được cập nhật thành công!", 'success')
					setTimeout(function() {
						location.reload()
					}, 1500)

				}
			}
		})
	}
</script>