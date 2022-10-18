<!doctype html>
<html>

<head>
	<meta name="viewport" content="width=device-width" />
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>FASTER Notification</title>
	<style>
		/* -------------------------------------
          GLOBAL RESETS
      ------------------------------------- */

		/*All the styling goes here*/

		img {
			border: none;
			-ms-interpolation-mode: bicubic;
			max-width: 100%;
		}

		body {
			background-color: #f6f6f6;
			font-family: sans-serif;
			-webkit-font-smoothing: antialiased;
			font-size: 14px;
			line-height: 1.4;
			margin: 0;
			padding: 0;
			-ms-text-size-adjust: 100%;
			-webkit-text-size-adjust: 100%;
		}

		table {
			border-collapse: separate;
			mso-table-lspace: 0pt;
			mso-table-rspace: 0pt;
			width: 100%;
		}

		table td {
			font-family: sans-serif;
			font-size: 14px;
			vertical-align: top;
		}

		/* -------------------------------------
          BODY & CONTAINER
      ------------------------------------- */

		.body {
			background-color: #f6f6f6;
			width: 100%;
		}

		/* Set a max-width, and make it display as block so it will automatically stretch to that width, but will also shrink down on a phone or something */
		.container {
			display: block;
			margin: 0 auto !important;
			/* makes it centered */
			max-width: 580px;
			padding: 10px;
			width: 580px;
		}

		/* This should also be a block element, so that it will fill 100% of the .container */
		.content {
			box-sizing: border-box;
			display: block;
			margin: 0 auto;
			max-width: 580px;
			padding: 10px;
		}

		/* -------------------------------------
          HEADER, FOOTER, MAIN
      ------------------------------------- */
		.main {
			background: #ffffff;
			border-radius: 3px;
			width: 100%;
		}

		.wrapper {
			box-sizing: border-box;
			padding: 20px;
		}

		.content-block {
			padding-bottom: 10px;
			padding-top: 10px;
		}

		.footer {
			clear: both;
			margin-top: 10px;
			text-align: center;
			width: 100%;
		}

		.footer td,
		.footer p,
		.footer span,
		.footer a {
			color: #999999;
			font-size: 12px;
			text-align: center;
		}

		/* -------------------------------------
          TYPOGRAPHY
      ------------------------------------- */
		h1,
		h2,
		h3,
		h4 {
			color: #000000;
			font-family: sans-serif;
			font-weight: 400;
			line-height: 1.4;
			margin: 0;
			margin-bottom: 30px;
		}

		h1 {
			font-size: 35px;
			font-weight: 300;
			text-align: center;
			text-transform: capitalize;
		}

		p,
		ul,
		ol {
			font-family: sans-serif;
			font-size: 14px;
			font-weight: normal;
			margin: 0;
			margin-bottom: 15px;
		}

		p li,
		ul li,
		ol li {
			list-style-position: inside;
			margin-left: 5px;
		}

		a {
			color: #3498db;
			text-decoration: underline;
		}

		/* -------------------------------------
          BUTTONS
      ------------------------------------- */

		.button-container {
			display: flex;
			align-items: center;
			margin: 1rem 0;
		}

		.button-container a {
			text-decoration: none;
			color: white;
			font-weight: bold;
		}

		.button-container .btn {
			padding: 12px 16px;
			border-radius: 4px;
			margin-right: 4px;
			box-sizing: border-box;
			width: 100%;
		}

		.button-container .btn-info {
			background-color: #0891b2;
		}

		.button-container .btn-docs {
			background-color: #525252;
		}

		.button-container .btn-success {
			background-color: #22c55e;
		}

		.button-container .btn-danger {
			background-color: #e1281b;
		}

		.btn-danger:hover,
		.btn-primary:hover,
		.btn-info:hover,
		.btn-success:hover,
		.btn-docs:hover {
			background-color: #34495e !important;
		}

		.btn-sm {
			padding: 5px 7px !important;
			background-color: #22c55e;
			border-color: #22c55e;
			color: #ffffff;
		}

		a.btn-sm {
			color: #ffffff;
			border-radius: 4px;
			font-size: 11px !important;
			font-weight: bold;
			text-decoration: none !important;
		}

		/* -------------------------------------
          OTHER STYLES THAT MIGHT BE USEFUL
      ------------------------------------- */
		.last {
			margin-bottom: 0;
		}

		.first {
			margin-top: 0;
		}

		.align-center {
			text-align: center;
		}

		.align-right {
			text-align: right;
		}

		.align-left {
			text-align: left;
		}

		.clear {
			clear: both;
		}

		.mt0 {
			margin-top: 0;
		}

		.mb0 {
			margin-bottom: 0;
		}

		.preheader {
			color: transparent;
			display: none;
			height: 0;
			max-height: 0;
			max-width: 0;
			opacity: 0;
			overflow: hidden;
			mso-hide: all;
			visibility: hidden;
			width: 0;
		}

		.powered-by a {
			text-decoration: none;
		}

		hr {
			border: 0;
			border-bottom: 1px solid #f6f6f6;
			margin: 20px 0;
		}

		/* -------------------------------------
          RESPONSIVE AND MOBILE FRIENDLY STYLES
      ------------------------------------- */
		@media only screen and (max-width: 620px) {
			table[class=body] h1 {
				font-size: 28px !important;
				margin-bottom: 10px !important;
			}

			.button-container {
				display: block;
			}

			.button-container div {
				margin-bottom: 2rem !important;
			}

			table[class=body] p,
			table[class=body] ul,
			table[class=body] ol,
			table[class=body] td,
			table[class=body] span,
			table[class=body] a {
				font-size: 16px !important;
			}

			table[class=body] .wrapper,
			table[class=body] .article {
				padding: 10px !important;
			}

			table[class=body] .content {
				padding: 0 !important;
			}

			table[class=body] .container {
				padding: 0 !important;
				width: 100% !important;
			}

			table[class=body] .main {
				border-left-width: 0 !important;
				border-radius: 0 !important;
				border-right-width: 0 !important;
			}

			table[class=body] .btn table {
				width: 100% !important;
			}

			table[class=body] .btn a {
				width: 100% !important;
			}

			table[class=body] .img-responsive {
				height: auto !important;
				max-width: 100% !important;
				width: auto !important;
			}
		}

		/* -------------------------------------
          PRESERVE THESE STYLES IN THE HEAD
      ------------------------------------- */
		@media all {
			.ExternalClass {
				width: 100%;
			}

			.ExternalClass,
			.ExternalClass p,
			.ExternalClass span,
			.ExternalClass font,
			.ExternalClass td,
			.ExternalClass div {
				line-height: 100%;
			}

			.apple-link a {
				color: inherit !important;
				font-family: inherit !important;
				font-size: inherit !important;
				font-weight: inherit !important;
				line-height: inherit !important;
				text-decoration: none !important;
			}

			#MessageViewBody a {
				color: inherit;
				text-decoration: none;
				font-size: inherit;
				font-family: inherit;
				font-weight: inherit;
				line-height: inherit;
			}

			.btn-primary table td:hover {
				background-color: #34495e !important;
			}

			.btn-primary a:hover {
				background-color: #34495e !important;
				border-color: #34495e !important;
			}
		}

	</style>
</head>

<body class="">
	<span class="preheader"><?= @$preview ?></span>
	<table role="presentation" border="0" cellpadding="0" cellspacing="0" class="body">
		<tr>
			<td>&nbsp;</td>
			<td class="container">
				<div class="content">
					<div class="footer">
						<table role="presentation" border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td>
									<p style="font-size: 20px; color: #000; font-weight: bold;">FASTER</p>
									<img style="width: 100px"
										src="<?= site_url('assets/images/logos/FHI_360.png') ?>" />
									<br><br>
								</td>
							</tr>
						</table>
					</div>

					<!-- START CENTERED WHITE CONTAINER -->
					<table role="presentation" class="main">

						<!-- START MAIN CONTENT AREA -->
						<tr>
							<td class="wrapper">
								<table role="presentation" border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td>
											<p>Yth, <b><?= $detail['nama_peserta'] ?></b></p>
											<p>
												Kami sudah melakukan pembayaran untuk penggantian (reimburse) makan
												siang & internet anda pada kegiatan <b><?= $detail['activity'] ?></b> sebesar <b>Rp. <?= $detail['total'] ?></b>
												ke akun <b> <?= $detail['payment_method'] ?> <?= ($detail['payment_method'] == 'Bank' ? $detail['bank_name'] : '') ?> </b> anda.
											</p>
											<div class="button-container">
												<div>
													<a class="btn btn-docs"
														href="<?= $_ENV['ASSETS_URL'] . $detail['resi_konsumsi'] ?>?subfolder=resi_konsumsi&token=<?= $_ENV['ASSETS_TOKEN'] ?>"
														target="_blank">CONSUMPTION RECEIPT</a>
												</div>
												<div>
													<a class="btn btn-docs"
														href="<?= $_ENV['ASSETS_URL'] . $detail['transfer_receipt'] ?>?subfolder=transfer_receipt&token=<?= $_ENV['ASSETS_TOKEN'] ?>"
														target="_blank">TRANSFER RECEIPT</a>
												</div>
											</div>
											<br>
											<p>Terimakasih telah mengikuti kegiatan ini!</p>
										</td>
									</tr>
								</table>
							</td>
						</tr>

						<!-- END MAIN CONTENT AREA -->
					</table>
					<!-- END CENTERED WHITE CONTAINER -->

					<!-- START FOOTER -->
					<div class="footer">
						<table role="presentation" border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td class="content-block">
									<span class="apple-link"><a href="<?= $_ENV['STAGING_URL'] ?>"
											target="_blank">faster.bantuanteknis.id</a></span>
								</td>
							</tr>
						</table>
					</div>
					<!-- END FOOTER -->

				</div>
			</td>
			<td>&nbsp;</td>
		</tr>
	</table>
</body>

</html>
