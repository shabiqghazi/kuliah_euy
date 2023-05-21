<div class="container-fluid">
	<h4 class="mb-4"><?= $this->db->get_where('kelas', ['kelas_id' => $kelas_id])->row_array()['kelas']; ?></h4>
	<div class="list-group shadow">
		<?php foreach($sesi as $ss): ?>
		<span href="#" class="list-group-item list-group-item-action">
			<div class="d-flex w-100 justify-content-between">
				<h3 class="mb-3"><?= $ss['sesi']; ?></h3>
			</div>
			<?php $materi = $this->db->get_where('materi', ['sesi_id' => $ss['sesi_id'], 'kelas_id' => $kelas_id])->result_array(); ?>
			<?php if($materi): ?>
			<?php foreach($materi as $mtr): ?>
			<a href="<?= base_url('mahasiswa/materi/') . $mtr['materi_id'] ?>" class="d-block"><?= $mtr['title']; ?></a><br>
			<?php endforeach; ?>
			<?php endif; ?>

			<?php $tugas = $this->db->get_where('tugas', ['sesi_id' => $ss['sesi_id'], 'kelas_id' => $kelas_id])->result_array(); ?>
			<?php if ($tugas): ?>
			<p class="mb-3">Tugas : </p>
			<?php foreach($tugas as $tgs): ?>
			<a href="<?= base_url('mahasiswa/tugas/') . $tgs['tugas_id'] ?>"><?= $tgs['title']; ?></a><br>
			<?php endforeach; ?>
			<?php endif ?>
		</span>
		<?php endforeach; ?>
	</div>
</div>