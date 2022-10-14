<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Faster</title>
	<!--begin::Global Stylesheets Bundle(used by all pages)-->
	<link rel="stylesheet" href="<?= site_url('assets/css/app.css?v=' . ASSETS_VERSION) ?>">
	<link rel="stylesheet" href="<?= site_url('assets/theme/css/style.bundle.css') ?>">
	<link rel="stylesheet" href="<?= site_url('assets/theme/plugins/global/plugins.bundle.css') ?>">
	<!--end::Global Stylesheets Bundle-->
	<script src="<?= site_url('assets/js/app.js?v=' . ASSETS_VERSION) ?>"></script>
	<?php
	if (isset($assets_css)) {
		foreach ($assets_css as $asset_css) {
	?>
	<link rel="stylesheet" href="<?= $asset_css ?>">
	<?php
		}
	}
	?>

	<?php
	if (isset($assets_js)) {
		foreach ($assets_js as $asset_js) {
	?>
	<script src="<?= $asset_js ?>"></script>
	<?php
		}
	}
	?>

	<script>
		const base_url = "<?= base_url() ?>"

	</script>
</head>

<body class="bg-light d-flex flex-column h-100" style="min-height: 100vh;">

	<main class="flex-shrink-0">
		<?= $content ?>
	</main>

	<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
		<div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
			<div class="toast-header">
				<div id="toast-indicator" style="width: 16px; height:16px; margin-right: 4px;"></div>
				<strong class="me-auto"></strong>
				<button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
			</div>
			<div class="toast-body">
			</div>
		</div>
	</div>
	<script>
		const toast = new bootstrap.Toast(document.getElementById('liveToast'))

		function showToast(title, message, indicator = 'success') {
			$('#liveToast #toast-indicator').removeClass().addClass(`bg-${indicator}`)
			$('#liveToast .toast-header strong').text(title)
			$('#liveToast .toast-body').text(message)

			toast.show()
		}
		$(document).on("focus, change", ".is-invalid", function (e) {
			$(e.target)
				.parent()
				.children("div.invalid-feedback")
				.remove();
			$(e.target)
				.parent()
				.children("p.error")
				.remove();
			$(e.target).removeClass("is-invalid");
			$(e.target).parent().find('.select2-selection').removeClass(
				'is-invalid')
		});

	</script>
	<script src="<?= base_url('assets/theme/plugins/global/plugins.bundle.js') ?>"></script>
	<script src="<?= base_url('assets/theme/js/scripts.bundle.js') ?>"></script>
	<script src="<?= site_url('assets/vendors/jquery-number/jquery.number.min.js') ?>" type="text/javascript"></script>
</body>
