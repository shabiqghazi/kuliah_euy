<meta name="viewport" content="width=1024, initial-scale=1">
<style>
	*{
		font-family: calibri;
		color: #000;
	}
</style>
	<div class="container p-5">
		<div class="row justify-content-center d-flex align-items-center">
			<div class="col-2 p-4">
				<img src="<?= base_url('assets/img/logo-univ.png') ?>" width="100%">
			</div>
			<div class="col-8 text-center">
				<h3>UNIVERSITY OF KULIAH EUY</h3>
				<p>FAKULTAS SAINS DAN TEKNOLOGI</p>
			</div>
			<div class="col-2"></div>
		</div>
		<hr style="border-width:1px;border-color:#000;border-style:solid;">
		<h3 class="text-center">KARTU RENCANA STUDI</h3>
		<div class="row">
			<div class="col-6">
				<table class="my-5">
					<tr>
						<td width="200px">Fakultas</td>
						<td>Sains dan Teknologi</td>
					</tr>
					<tr>
						<td class="">Jurusan</td>
						<td>Teknik Informatika</td>
					</tr>
					<tr>
						<td class="">Tahun Akademik</td>
						<td>2021/2022</td>
					</tr>
				</table>
			</div>
			<div class="col-6">
				<table class="my-5">
					<tr>
						<td width="150px">Nama</td>
						<td><?= $user['nama'] ?></td>
					</tr>
					<tr>
						<td class="">NIM</td>
						<td><?= $user['ni'] ?></td>
					</tr>
				</table>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<table class="table-sm" border="1" width="100%">
					<thead>
						<tr class="text-center">
							<th rowspan="2" class="align-middle">No</th>
							<th rowspan="2" class="align-middle">Kode Matkul</th>
							<th rowspan="2" class="align-middle">Mata Kuliah</th>
							<th rowspan="2" class="align-middle">SKS</th>
							<th colspan="2">Jadwal</th>
						</tr>
						<tr class="text-center">
							<th>Hari</th>
							<th>Jam</th>
						</tr>
					</thead>
					<tbody>
						<?php $i=1; foreach($krs as $krs_): ?>
						<tr>
							<td><?= $i++ ?></td>
							<td><?= $krs_['kode'] ?></td>
							<td><?= $krs_['kelas'] ?></td>
							<td><?= $krs_['jml_sks'] ?></td>
							<td><?= $krs_['hari'] ?></td>
							<td><?= date('h:i', strtotime($krs_['waktu'])) .' - '. date('h:i', strtotime($krs_['waktu']) + 60*50*$krs_['jml_sks']) ?></td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
		<div class="row justify-content-end mt-5">
			<div class="col-6 text-center">
				<p><?= date('l, d M Y', time()); ?></p>
				<p class="mt-5"><?= $user['nama'] ?></p>
			</div>
		</div>
	</div>

<script type="text/javascript">
	window.onload = function() { 
		window.print(); 
	}
</script>