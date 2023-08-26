<!DOCTYPE html>
<html lang="en-US">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo $this->Responden->getNamaByNoKP($nokp); ?></title>
	<link rel="icon" type="image/ico" href="../favicon.ico">
	<link href="<?php echo base_url(); ?>admin/css/bootstrap.min.css" rel="stylesheet">
	<style>
		@import url('https://fonts.googleapis.com/css?family=Lato:100,300,400,700,900');

		body,
		html {
			color: #333538;
			font-family: 'Lato', sans-serif;
			line-height: 1.6;
			padding: 0;
			margin: 0;
		}

		a {
			color: #f27173;
			text-decoration: none;
		}

		a:hover {
			color: #e25f5f;
			text-decoration: underline;
		}

		.content {
			max-width: 1000px;
			margin: auto;
			padding: 16px 32px;
			padding-bottom: 0px;
		}

		.header {
			text-align: center;
			padding: 32px 0;
		}

		.wrapper {
			min-height: 400px;
			padding: 16px 0;
			position: relative;
		}

		.wrapper.col-2 {
			display: inline-block;
			min-height: 256px;
			width: 49%;
		}

		@media (max-width: 400px) {
			.wrapper.col-2 {
				width: 100%
			}
		}

		.wrapper canvas {
			-moz-user-select: none;
			-webkit-user-select: none;
			-ms-user-select: none;
		}

		.toolbar {
			display: flex;
		}

		.toolbar>* {
			margin: 0 8px 0 0;
		}

		.btn {
			background-color: #aaa;
			border-radius: 4px;
			color: white;
			padding: 0.25rem 0.75rem;
		}

		.btn .fa {
			font-size: 1rem;
		}

		.btn:hover {
			background-color: #888;
			color: white;
			text-decoration: none;
		}

		.btn-chartjs {
			background-color: #f27173;
		}

		.btn-chartjs:hover {
			background-color: #e25f5f;
		}

		.btn-docs:hover {
			background-color: #2793db;
		}

		.btn-docs {
			background-color: #36A2EB;
		}

		.btn-docs:hover {
			background-color: #2793db;
		}

		.btn-gh {
			background-color: #444;
		}

		.btn-gh:hover {
			background-color: #333;
		}

		.btn-on {
			border-style: inset;
		}

		.chartjs-title {
			font-size: 2rem;
			font-weight: 600;
			white-space: nowrap;
		}

		.chartjs-title::before {
			background-image: url(logo.svg);
			background-position: left center;
			background-repeat: no-repeat;
			background-size: 40px;
			content: 'Chart.js | ';
			color: #f27173;
			font-weight: 600;
			padding-left: 48px;
		}

		.chartjs-caption {
			font-size: 1.2rem;
		}

		.chartjs-links {
			display: flex;
			justify-content: center;
			padding: 8px 0;
		}

		.chartjs-links a {
			align-items: center;
			display: flex;
			font-size: 0.9rem;
			margin: 0.2rem;
		}

		.chartjs-links .fa:before {
			margin-right: 0.5em;
		}

		.samples-category {
			display: inline-block;
			margin-bottom: 32px;
			vertical-align: top;
			width: 25%;
		}

		.samples-category>.title {
			color: #aaa;
			font-weight: 300;
			font-size: 1.5rem;
		}

		.samples-category:hover>.title {
			color: black;
		}

		.samples-category>.items {
			padding: 8px 0;
		}

		.samples-entry {
			padding: 0 0 4px 0;
		}

		.samples-entry>.title {
			font-weight: 700;
		}

		@media (max-width: 640px) {
			.samples-category {
				width: 33%;
			}
		}

		@media (max-width: 512px) {
			.samples-category {
				width: 50%;
			}
		}

		@media (max-width: 420px) {
			.chartjs-caption {
				font-size: 1.05rem;
			}

			.chartjs-title::before {
				content: '';
			}

			.chartjs-links a {
				flex-direction: column;
			}

			.chartjs-links .fa {
				margin: 0
			}

			.samples-category {
				width: 100%;
			}
		}

		.column {
			float: left;
			width: 49.5%;
			/* border: 1px solid #ce32ed; */
		}

		/* Clear floats after the columns */
		.row:after {
			content: "";
			display: table;
			clear: both;
		}

		.canvas-wrapper {
			/* background: #aaa !important; */
		}

		.secondheader {
			display: none;
		}

		.bar {
			height: 30px;
			max-width: 800px;
			margin: 0 auto 10px auto;
			line-height: 30px;
			font-size: 16px;

			color: white;
			padding: 0 0 0 10px;
			position: relative;
		}

		.bar::before {
			content: '';
			width: 100%;
			position: absolute;
			left: 0;
			height: 30px;
			top: 0;
			z-index: -2;
			background: #ecf0f1;
		}

		.bar::after {
			text-align: right;
			content: '';
			background: #FFA500;
			height: 30px;
			transition: 0.7s;
			display: block;
			width: 100%;
			-webkit-animation: bar-before 1 1.8s;
			position: absolute;
			top: 0;
			left: 0;
			z-index: -1;
		}

		.bar1::after {
			max-width: 60%;
		}

		.barutama {
			/*max-width: 800px;*/
		}

		@media print {
			footer {
				page-break-after: always;
			}

			.secondheader {
				display: block;
			}

			/* .canvas-wrapper{
		width: 120px !important;
	} */

			.container {
				width: 700px !important;
			}

			.barutama {
				max-width: 400px;
			}
		}
	</style>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<!--<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>-->
	<script src="https://www.chartjs.org/dist/2.9.3/Chart.min.js"></script>
	<!--<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.5.0"></script>
	<script src="https://chartjs-plugin-datalabels.netlify.com/chartjs-plugin-datalabels.js"></script>-->
	<script src="<?php echo base_url(); ?>js/chartjs-plugin-datalabels.min.js"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.3/jspdf.debug.js"></script>
	<script src="https://code.highcharts.com/highcharts.js"></script>
	<!-- <script src="<?php echo base_url(); ?>admin/js/canvasjs.min.js"></script> -->

</head>