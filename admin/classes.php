<?php include 'db_connect.php' ?>
<br>
<h2>Lớp học</h2>
<div class="col-lg-12">
	<div class="card card-outline card-primary">
		<div class="card-header">
			<div class="card-tools">
				<a class="btn btn-block btn-sm btn-default btn-flat border-primary new_class" href="javascript:void(0)"><i class="fa fa-plus"></i> Thêm lớp học</a>
			</div>
		</div>
		<div class="card-body">
			<table class="table tabe-hover table-bordered" id="list">
				<colgroup>
					<col width="8%">
					<col width="18%">
					<col width="60%">
				</colgroup>
				<thead>
					<tr>
						<th class="text-center">STT</th>
						<th class="text-center">Mã lớp</th>
						<th class="text-center">Tên lớp</th>
						<th class="text-center">Thao tác</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i = 1;
					$qry = $conn->query("SELECT * FROM classes order by level asc, section asc ");
					while ($row = $qry->fetch_assoc()) :
					?>
						<tr>
							<th class="text-center"><?php echo $i++ ?></th>
							<td class="text-center"><b><?php echo $row['level'] ?></b></td>
							<td class="text-center"><b><?php echo $row['section'] ?></b></td>
							<td class="text-center">
								<div class="btn-group">
									<a href="javascript:void(0)" data-id='<?php echo $row['id'] ?>' class="btn btn-primary btn-flat manage_class">
										<i class="fas fa-edit"></i>
									</a>
									<button type="button" class="btn btn-danger btn-flat delete_class" data-id="<?php echo $row['id'] ?>">
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
			uni_modal("Thêm lớp học", "manage_class.php")
		})
		$('.manage_class').click(function() {
			uni_modal("Cập nhật lớp học", "manage_class.php?id=" + $(this).attr('data-id'))
		})
		$('.delete_class').click(function() {
			_conf("Bạn có muốn xóa lớp học này không?", "delete_class", [$(this).attr('data-id')])
		})
	})

	function delete_class($id) {
		start_load()
		$.ajax({
			url: 'ajax.php?action=delete_class',
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