<head>
	<meta charset="utf-8">
	<link rel="icon" href="<?= base_url() ?>img/favicon.ico" type="image">

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- <link href="<?php echo base_url(); ?>admin/css/bootstrap.min.css" rel="stylesheet"> -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/fontawesome.min.css" integrity="sha512-SgaqKKxJDQ/tAUAAXzvxZz33rmn7leYDYfBP+YoMRSENhf3zJyx3SBASt/OfeQwBHA1nxMis7mM3EV/oYT6Fdw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
	<!-- <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css" rel="stylesheet"> -->
	<!-- <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css" rel="stylesheet"> -->
	<!-- <link href="<?php echo base_url(); ?>admin/css/styles.css" rel="stylesheet"> -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" integrity="sha512-t4GWSVZO1eC8BM339Xd7Uphw5s17a86tIZIj8qRxhnKub6WoyhnrxeCIMeAqBPgdZGlCcG2PrZjMc+Wr78+5Xg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/mdbootstrap@4.20.0/css/mdb.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/handsontable/dist/handsontable.full.min.css" />
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/handsontable/8.3.2/handsontable.full.min.js" integrity="sha512-QKxTQfGv2U/EFV8WPXb0i/TtwNzacYyd6JE0bP1LHhSYu0aivteQYaE7uNi3IvyF6h+Z2oo7GUWXbYhlGrXUng==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	
</head>


<div class="position-fixed d-none" style="top: 8vh;right:1vw;z-index:999" id="notif-box">
	<div class="bg-white rounded p-2 shadow" style="width: 13vw!important;">
		<div class="d-flex flex-row align-items-center gap-2">
			<div><span class="fas fa-info-circle text-primary fa-2x w-25"></span></div>
			<div class="w-75">
				<div id="notif-msg">
				</div>
			</div>
		</div>
	</div>
</div>