<?php include 'db_connect.php' ?>
<br>
<h2>Môn học</h2>
<div class="col-lg-12">
	<div class="card card-outline card-primary">
		<div class="card-header">
			<div class="card-tools">
				<a class="btn btn-block btn-sm btn-default btn-flat border-primary new_subject" href="javascript:void(0)"><i class="fa fa-plus"></i> Thêm môn học</a>
			</div>
		</div>
		<div class="card-body">
			<table class="table tabe-hover table-bordered" id="list">
				<colgroup>
					<col width="10%">
					<col width="20%">
					<col width="20%">
					<col width="30%">
					<col width="20%">
				</colgroup>
				<thead>
					<tr>
						<th class="text-center">STT</th>
						<th class="text-center">Mã môn học</th>
						<th class="text-center">Tên môn học</th>
						<th class="text-center">Giới thiệu</th>
						<th class="text-center">Thao tác</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i = 1;
					$qry = $conn->query("SELECT * FROM subjects");
					while ($row = $qry->fetch_assoc()) :
					?>
						<tr>
							<th class="text-center"><?php echo $i++ ?></th>
							<td class="text-center"><b><?php echo ucwords($row['subject_code']) ?></b></td>
							<td><b><?php echo ucwords($row['subject']) ?></b></td>
							<td>
								<p class=""><b><?php echo $row['description'] ?></b></p>
							</td>
							<td class="text-center">
								<div class="btn-group">
									<a href="javascript:void(0)" data-id='<?php echo $row['id'] ?>' class="btn btn-primary btn-flat manage_subject">
										<i class="fas fa-edit"></i>
									</a>
									<button type="button" class="btn btn-danger btn-flat delete_subject" data-id="<?php echo $row['id'] ?>">
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
		$('.new_subject').click(function() {
			uni_modal("Thêm mới môn học", "manage_subject.php")
		})
		$('.manage_subject').click(function() {
			uni_modal("Quản lý môn học", "manage_subject.php?id=" + $(this).attr('data-id'))
		})
		$('.delete_subject').click(function() {
			_conf("Bạn có muốn xóa môn học này không?", "delete_subject", [$(this).attr('data-id')])
		})
	})

	function delete_subject($id) {
		start_load()
		$.ajax({
			url: 'ajax.php?action=delete_subject',
			method: 'POST',
			data: {
				id: $id
			},
			success: function(resp) {
				if (resp == 1) {
					alert_toast("Dữ liệu đã được xóa thành công.", 'success')
					setTimeout(function() {
						location.reload()
					}, 1500)

				}
			}
		})
	}
</script>