			</div>
			<!-- End of Main Content -->
			<!-- Footer -->
			<footer class="sticky-footer">
				<div class="container my-auto">
					<div class="copyright text-center my-auto">
						<span>Copyright &copy; shabiqghazi.id 2021</span>
					</div>
				</div>
			</footer>
			<!-- End of Footer -->

		</div>
		<!-- End of Content Wrapper -->

	</div>
	<!-- End of Page Wrapper -->

	<!-- Scroll to Top Button-->
	<a class="scroll-to-top rounded" href="#page-top">
		<i class="fas fa-angle-up"></i>
	</a>

	<!-- Logout Modal-->
	<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
		aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
				<div class="modal-footer">
					<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
					<a class="btn btn-primary" href="<?= base_url('auth/logout') ?>">Logout</a>
				</div>
			</div>
		</div>
	</div>

	<!-- Bootstrap core JavaScript-->
	<script src="<?= base_url('assets/') ?>vendor/jquery/jquery.min.js"></script>
	<script src="<?= base_url('assets/') ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

	<!-- Core plugin JavaScript-->
	<script src="<?= base_url('assets/') ?>vendor/jquery-easing/jquery.easing.min.js"></script>

	<!-- Custom scripts for all pages-->
	<script src="<?= base_url('assets/') ?>js/sb-admin-2.min.js"></script>

	<!-- Page level plugins -->
	<script src="<?= base_url('assets/') ?>vendor/chart.js/Chart.min.js"></script>

	<!-- Page level custom scripts -->
	<script src="<?= base_url('assets/') ?>js/demo/chart-area-demo.js"></script>
	<script src="<?= base_url('assets/') ?>js/demo/chart-pie-demo.js"></script>
	<script type="text/javascript">
		$('.custom-file-input').on('change', function(){
			var files = $(this).prop("files");
			var fileNames = $.map(files, function(val) { 
				return val.name; 
			});
			var file_inputan = '';

			for (var file = 0; file < files.length; file++){
				file_inputan += `<div class="row" id="file-inputan">
					<div class="col-lg-2"></div>
					<div class="col-lg-1" id="file-icon">`;
				let nameArray = fileNames[file].split('.');
				format = nameArray[(nameArray.length - 1)];
				if (format == 'jpeg' || format == 'png' || format == 'jpg'){
					file_inputan += `<img src="https://winaero.com/blog/wp-content/uploads/2019/11/Photos-new-icon.png" width="100%">`;
				} else if (format == 'pdf'){
					file_inputan += `<img src="https://www.iconpacks.net/icons/2/free-pdf-download-icon-3388-thumb.png" width="100%">`;
				} else if (format == 'doc' || format == 'docx'){
					file_inputan += `<img src="https://cdn.iconscout.com/icon/free/png-256/doc-file-1934509-1634559.png" width="100%">`;
				} else if (format == 'xls' || format == 'xlsx'){
					file_inputan += `<img src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/15/Xls_icon_%282000-03%29.svg/1200px-Xls_icon_%282000-03%29.svg.png" width="100%">`;
				} else if (format == 'ppt' || format == 'pptx'){
					file_inputan += `<img src="https://image.flaticon.com/icons/png/512/732/732224.png" width="100%">`;
				} else if (format == 'rar' || format == 'zip'){
					file_inputan += `<img src="https://apk4all.com/wp-content/uploads/apps/unnamed-file.RAR/bTV0yJmaQGeMCeT3iV1u4j5Zmzhfz4he_KjnxC2kRu5xd6D7-N3lP1z5ADNEh_sSeEN2-3.png" width="100%">`;
				} else {
					file_inputan += `<img src="https://i.pinimg.com/originals/7f/d2/e4/7fd2e46b2da9819e667fb75caf475cf7.png" width="100%">`;
				}

				file_inputan += `</div>
					<div class="col-lg-9 d-flex align-items-center"><p id="file-name">`;
				file_inputan += fileNames[file];
				file_inputan += `</p></div>
				</div>`;
			}
			$('#ini').html(file_inputan);
		});
		$('.krs').on('click', function(){
			var userId = $(this).data('user');
			var mkId = $(this).data('mk');
			var smk = $(this).data('smk');

			console.log(userId);
			console.log(mkId);

			$.ajax({
				url: "<?= base_url('mahasiswa/changekrs') ?>",
				type: 'post',
				data: {
					userId : userId,
					mkId : mkId
				},
				success: function(){
					document.location.href = "<?= base_url('mahasiswa/krs/') ?>" + smk;
				}
			})
		});
	</script>
	<script type="text/javascript">
		$('.manajemen-kelas').on('change', function(){
			var utamaId = $(this).children("option:selected").data('utama');
			var type = $(this).data('type');
			var dmId = $(this).data('dm_id');
			var semester = $(this).data('semester');
			// console.log(utamaId + ' ' + dmId + ' ' + type);

			$.ajax({
				url: "<?= base_url('admin/changemanajemenkelas') ?>",
				type: 'post',
				data: {
					utamaId : utamaId,
					type : type,
					dmId : dmId,
					semester : semester
				},
				success: function(data){
					document.location.href = "<?= base_url('admin/manajemenkelas/'); ?>" + semester;
				},
				error: function(){
					console.log('error');
				}
			})
		});
	</script>
	<script>
		$(window).on('load', function(){	
			setTimeout( function() {
				$('.loader').fadeOut();
			}, 500);
			$('.loader').removeClass('d-block');
		})	
	</script>
</body>

</html>