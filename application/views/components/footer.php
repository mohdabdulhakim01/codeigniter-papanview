<?php

$_this = &get_instance();
?>
<!-- <script src="<?php echo base_url(); ?>admin/js/jquery-1.11.1.min.js"></script>
<script src="<?php echo base_url(); ?>admin/js/bootstrap.min.js"></script> -->
<!-- <script src="<?php echo base_url(); ?>admin/js/chart.min.js"></script>
	<script src="<?php echo base_url(); ?>admin/js/typeahead.js"></script>
	<script src="<?php echo base_url(); ?>admin/js/chart-data.js"></script> -->
<!-- <script src="<?php echo base_url(); ?>admin/js/easypiechart.js"></script>
	<script src="<?php echo base_url(); ?>admin/js/easypiechart-data.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.8/umd/popper.min.js" integrity="sha512-TPh2Oxlg1zp+kz3nFA0C5vVC6leG/6mm1z9+mA81MI5eaUVqasPLO8Cuk4gMF4gUfP5etR73rgU/8PNMsSesoQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.min.js" integrity="sha512-3dZ9wIrMMij8rOH7X3kLfXAzwtcHpuYpEgQg1OA4QAob1e81H8ntUQmQm3pBudqIoySO5j0tHN4ENzA6+n2r4w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src=" https://cdn.jsdelivr.net/npm/mdbootstrap@4.20.0/js/mdb.min.js"></script>
<script>
	// Global Script


	function msgManager() {
		const urlParams = new URLSearchParams(window.location.search);
		const msg_code = urlParams.get('msg_code');
		if (msg_code == '00') {
			alertBox('Login Error <span class="fas fa-triangle-exclamation text-warning"></span>', '<span class="h5"><span class="fw-bold text-primary">No Kad Pengenalan</span> atau <span class="fw-bold text-primary">Kata Laluan</span> tidak tepat</span>');
		}
		if (msg_code == '01') {
			alertBox('Notifkasi Sistem  <span class="fas fa-shield-alt text-success"></span>', 'Selamat datang ke halaman Panel Kawalan !.');
			setTimeout(() => {
				let url = '<?php out(base_url()) ?>pentadbir/Program/';
				location.href = url;
			}, 800);

		}
		if (msg_code == '03') {
			alertBox('Notifkasi <span class="fas fa-exclamation-mark text-danger"></span>', '<span class="h5">Responden telah wujud !</span>')

		}
		if (msg_code == '04') {
			alertBox('Notifkasi <span class="fas fa-check"></span>', '<span class="h5">Data pukal telah ditambah ke sistem !</span>')
			setTimeout(() => {


				if (kod_program != undefined) {
					let url = '<?php out(base_url()) ?>pentadbir/Program/viewProgramResponden/' + kod_program;
					location.href = url;
				}

			}, 1000);
		}
		if (msg_code == '06') {
			alertBox('Notifkasi <span class="fas fa-exclamation-mark text-danger"></span>', '<span class="h5">Kod Ujian Tidak Wujud !</span>')
			setTimeout(() => {
				let url = '<?php out(base_url()) ?>responden/main';
				location.href = url;
			}, 1000);
		}
		if (msg_code == '07') {
			alertBox('Notifkasi <span class="fas fa-exclamation-mark text-danger"></span>', '<span class="h5">Kod Program Tidak Wujud !</span>')
			setTimeout(() => {
				let url = '<?php out(base_url()) ?>responden/main';
				location.href = url;
			}, 1000);
		}
		if (msg_code == '08') {
			alertBox('Notifkasi <span class="fas fa-check text-success"></span>', '<span class="h5">Option Group telah dikemaskini !</span>');

			setTimeout(() => {
				let url = '<?php out(base_url()) ?>pentadbir/ExamManager/urusOptionGroupView/' + $("#temp-id-ujian").val();
				location.href = url;
			}, 500);
		}
	}


	function notifBox(msg) {
		$("#notif-box").removeClass('hidden');
		$("#msg-notif").html(msg);
		setTimeout(() => {
			closeNotifBox();
		}, 3000);
	}

	function closeNotifBox() {
		$("#notif-box").addClass('hidden bg-danger');
	}
	window.onload = () => {
		msgManager();

	}


	function msToTime(ms) {
		let seconds = (ms / 1000).toFixed(1);
		let minutes = (ms / (1000 * 60)).toFixed(1);
		let hours = (ms / (1000 * 60 * 60)).toFixed(1);
		let days = (ms / (1000 * 60 * 60 * 24)).toFixed(1);
		if (seconds < 60) return seconds + " Sec";
		else if (minutes < 60) return minutes + " Min";
		else if (hours < 24) return hours + " Hrs";
		else return days + " Days"
	}


	function timeConverter(UNIX_timestamp) {
		var a = new Date(UNIX_timestamp * 1000);
		var months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
		var year = a.getFullYear();
		var month = months[a.getMonth()];
		var date = a.getDate();
		var hour = a.getHours();
		var min = a.getMinutes();
		var sec = a.getSeconds();
		var time = date + ' ' + month + ' ' + year + ' ' + hour + ':' + min + ':' + sec;
		return time;
	}

	function randomInteger(min, max) {
		return Math.floor(Math.random() * (max - min + 1)) + min;
	}
	let oldHTMLDATA = '';
	let magic_reload = true;

	function magicReload() {
		if (magic_reload) {
			fetch('<?php echo current_url() ?>').then(res => res.text()).then(res => {
				let newHTMLDATA = res;
				if (oldHTMLDATA != newHTMLDATA) {
					location.reload();
					loadingBox();
				} else {
					oldHTMLDATA = newHTMLDATA;
					setTimeout(() => {
						magicReload();
					}, 1000);
				}
			})
		} else {
			setTimeout(() => {
				magicReload();
			}, 1000);
		}

	}

	function alertData(msg) {
		$("#notif-box").removeClass('d-none');
		$("#notif-msg").html(msg);
		// reloadPreviewMode();
		setTimeout(() => {
			$("#notif-box").addClass('d-none');
		}, 2.2 * (1000));
	}

	// fetch('<?php echo current_url() ?>').then(res => res.text()).then(res => {
	// 	oldHTMLDATA = res;
	// 	magicReload();
	// })
</script>