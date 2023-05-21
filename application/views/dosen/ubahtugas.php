<div class="container">
	<div class="row">
		<div class="col-lg-6">
		<?= validation_errors('<div class="">', '</div>'); ?>
		<?= $this->session->flashdata('message'); ?>
		<form action="" method="post">
			<div class="form-group row">
				<div class="col-sm-2 col-form-label">
					<label for="title">Title</label>
				</div>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="title" name="title" value="<?= $tugas['title']; ?>">
				</div>
			</div>
			<div class="form-group row">
				<div class="col-sm-2 col-form-label">
					<label for="deskripsi">Deskripsi</label>
				</div>
				<div class="col-sm-10">
					<textarea class="form-control" rows="5" id="deskripsi" name="deskripsi"><?= $tugas['deskripsi']; ?></textarea>
				</div>
			</div>
			<div class="form-group row">
				<div class="col-sm-2 col-form-label">
					<label for="deadline">Deadline</label>
				</div>
				<div class="col-sm-10">
					<div class="row">
						<div class="col-sm-12">
							<input type="datetime-local" class="form-control" id="deadline" name="deadline" value="<?= date('Y-m-d', $tugas['deadline']) . 'T' . date('H:i',$tugas['deadline']) ?>">
						</div>
					</div>
				</div>
			</div>
			<div class="form-group row">
				<div class="col-sm-2 col-form-label">
					<label for="kelas_id">Kelas</label>
				</div>
				<div class="col-sm-10">
					<div class="form-check">
						<input class="form-check-input" type="checkbox" value="<?= $tugas['kelas_id']; ?>" id="<?= $tugas['kelas']; ?>" name="kelas_id" checked disabled>
						<label class="form-check-label" for="<?= $tugas['kelas']; ?>">
							<?= $tugas['kelas']; ?>
						</label>
					</div>
				</div>
			</div>
			<div class="form-group row">
				<div class="col-sm-2">
					<label for="sesi">Sesi</label>
				</div>
				<div class="col-sm-4">
					<select class="form-control" id="sesi" name="sesi_id">
						<?php foreach($sesi as $ss): ?>
						<option value="<?= $ss['sesi_id'] ?>" <?= $ss['sesi_id'] == $tugas['sesi_id'] ? 'selected' : '' ?>><?= $ss['sesi'] ?></option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>
			<div class="form-group row">
				<div class="col-sm-2"></div>
				<div class="col-sm-10">
					<button type="submit" class="btn btn-primary">Submit</button>
				</div>
			</div>
		</form>
		</div>
	</div>
</div>