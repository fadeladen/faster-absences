<!DOCTYPE html>

<html lang="en">
<!--begin::Head-->

<head>
	<title>Faster | <?= $menu ?> </title>
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta charset="utf-8" />
	<link rel="shortcut icon" type="images/logos/inventory.ico"
		href="<?= base_url('assets/images/logos/inventory.ico'); ?>" />
	<!--begin::Fonts-->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
	<!--end::Fonts-->
	<!--begin::Global Stylesheets Bundle(used by all pages)-->
	<link rel="stylesheet" href="<?= site_url('assets/css/app.css?v=' . ASSETS_VERSION) ?>">
	<link rel="stylesheet" href="<?= site_url('assets/css/fontawesome.css') ?>">
	<link href="https://cdn.lineicons.com/3.0/lineicons.css" rel="stylesheet">
	<link rel="stylesheet" href="<?= site_url('assets/theme/css/style.bundle.css') ?>">
	<link rel="stylesheet" href="<?= site_url('assets/theme/plugins/global/plugins.bundle.css') ?>">
	<!--end::Global Stylesheets Bundle-->
	<script src="<?= site_url('assets/js/bootstrap.bundle.js') ?>"></script>
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
		const asset_url = "<?= $_ENV['ASSETS_URL'] ?>"

	</script>
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body" class="header-tablet-and-mobile-fixed aside-enabled">
	<!--begin::Main-->
	<!--begin::Root-->
	<div class="d-flex flex-column flex-root">
		<!--begin::Page-->
		<div class="page d-flex flex-row flex-column-fluid">
			<!--begin::Aside-->
			<div id="kt_aside" class="aside" data-kt-drawer="true" data-kt-drawer-name="aside"
				data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true"
				data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start"
				data-kt-drawer-toggle="#kt_aside_mobile_toggle">
				<!--begin::Aside Toolbarl-->
				<div class="aside-toolbar flex-column-auto" id="kt_aside_toolbar">
					<!--begin::User-->
					<div class="aside-user d-flex align-items-sm-center justify-content-center py-5">
						<!--begin::Symbol-->
						<div class="symbol symbol-50px">
							<img class="img-fluid"
								src="<?= ($this->user_data->avatar == null) ? base_url('assets/images/no-avatar.png') : $_ENV['ASSETS_URL'] . $this->user_data->avatar .'?subfolder=avatars&token=' . $_ENV['ASSETS_TOKEN'] ?>"
								alt="">
						</div>
						<!--end::Symbol-->
						<!--begin::Wrapper-->
						<div class="aside-user-info flex-row-fluid flex-wrap ms-5">
							<!--begin::Section-->
							<div class="d-flex">
								<!--begin::Info-->
								<div class="flex-grow-1 me-2">
									<!--begin::Username-->
									<a href="#"
										class="text-white text-hover-primary fs-6 fw-bold"><?= $this->user_data->fullName ?></a>
									<!--end::Username-->
									<!--begin::Description-->
									<span
										class="text-gray-600 fw-bold d-block fs-8 mb-1"><?= $this->user_data->username ?></span>
									<!--end::Description-->
									<!--begin::Label-->
									<div class="d-flex align-items-center text-success fs-9">
										<span class="bullet bullet-dot bg-success me-1"></span>online</div>
									<!--end::Label-->
								</div>
								<!--end::Info-->
								<!--begin::User menu-->

								<!--end::User menu-->
							</div>
							<!--end::Section-->
						</div>
						<!--end::Wrapper-->
					</div>
					<!--end::User-->
					<!--end::Aside user-->
				</div>
				<!--end::Aside Toolbarl-->
				<!--begin::Aside menu-->
				<div class="aside-menu flex-column-fluid">
					<!--begin::Aside Menu-->
					<div class="hover-scroll-overlay-y px-2 my-5 my-lg-5" id="kt_aside_menu_wrapper"
						data-kt-scroll="true" data-kt-scroll-height="auto"
						data-kt-scroll-dependencies="{default: '#kt_aside_toolbar, #kt_aside_footer', lg: '#kt_header, #kt_aside_toolbar, #kt_aside_footer'}"
						data-kt-scroll-wrappers="#kt_aside_menu" data-kt-scroll-offset="5px">
						<!--begin::Menu-->
						<div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500"
							id="#kt_aside_menu" data-kt-menu="true">
							<div class="menu-item"><a class="menu-link active" href="<?= base_url() ?>"><span
										class="menu-icon"><span class="svg-icon svg-icon-2"><svg
												xmlns="http://www.w3.org/2000/svg" width="24" height="24"
												viewBox="0 0 24 24" fill="none">
												<rect x="2" y="2" width="9" height="9" rx="2" fill="black"></rect>
												<rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2"
													fill="black"></rect>
												<rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2"
													fill="black"></rect>
												<rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2"
													fill="black"></rect>
											</svg></span></span><span class="menu-title">
										Dashboard
									</span>
								</a>
							</div>
							<div id="fast-menus">

							</div>
						</div>
						<!--end::Menu-->
					</div>
					<!--end::Aside Menu-->
				</div>
				<!--end::Aside menu-->
				<!--begin::Footer-->
				<!-- <div class="aside-footer flex-column-auto py-5" id="kt_aside_footer">
					<a href="<?= base_url('auth/logout') ?>" class="btn btn-dark w-100"><span
							class="svg-icon btn-icon svg-icon-2"><svg xmlns="http://www.w3.org/2000/svg" width="24"
								height="24" viewBox="0 0 24 24" fill="none">
								<rect opacity="0.3" x="8.5" y="11" width="12" height="2" rx="1" fill="black"></rect>
								<path
									d="M10.3687 11.6927L12.1244 10.2297C12.5946 9.83785 12.6268 9.12683 12.194 8.69401C11.8043 8.3043 11.1784 8.28591 10.7664 8.65206L7.84084 11.2526C7.39332 11.6504 7.39332 12.3496 7.84084 12.7474L10.7664 15.3479C11.1784 15.7141 11.8043 15.6957 12.194 15.306C12.6268 14.8732 12.5946 14.1621 12.1244 13.7703L10.3687 12.3073C10.1768 12.1474 10.1768 11.8526 10.3687 11.6927Z"
									fill="black"></path>
								<path opacity="0.5"
									d="M16 5V6C16 6.55228 15.5523 7 15 7C14.4477 7 14 6.55228 14 6C14 5.44772 13.5523 5 13 5H6C5.44771 5 5 5.44772 5 6V18C5 18.5523 5.44771 19 6 19H13C13.5523 19 14 18.5523 14 18C14 17.4477 14.4477 17 15 17C15.5523 17 16 17.4477 16 18V19C16 20.1046 15.1046 21 14 21H5C3.89543 21 3 20.1046 3 19V5C3 3.89543 3.89543 3 5 3H14C15.1046 3 16 3.89543 16 5Z"
									fill="black"></path>
							</svg></span><span class="btn-label">
							Sign Out
						</span></a>
				</div> -->
				<!--end::Footer-->
			</div>
			<!--end::Aside-->
			<!--begin::Wrapper-->
			<div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
				<!--begin::Header-->
				<div id="kt_header" class="header align-items-stretch">
					<!--begin::Brand-->
					<div class="header-brand">
						<!--begin::Logo-->
						<a href="<?= base_url('/') ?>">
							<img style="width: 10.4rem;" alt="Logo"
								src="<?= base_url('assets/images/logos/faster_v2.png') ?>" class="h-auto" />
						</a>
						<!--end::Logo-->
						<!--begin::Aside minimize-->
						<div id="kt_aside_toggle"
							class="btn btn-icon w-auto px-0 btn-active-color-primary aside-minimize"
							data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body"
							data-kt-toggle-name="aside-minimize">
							<!--begin::Svg Icon | path: icons/duotune/arrows/arr092.svg-->
							<span class="svg-icon svg-icon-1 me-n1 minimize-default">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
									fill="none">
									<rect opacity="0.3" x="8.5" y="11" width="12" height="2" rx="1" fill="black" />
									<path
										d="M10.3687 11.6927L12.1244 10.2297C12.5946 9.83785 12.6268 9.12683 12.194 8.69401C11.8043 8.3043 11.1784 8.28591 10.7664 8.65206L7.84084 11.2526C7.39332 11.6504 7.39332 12.3496 7.84084 12.7474L10.7664 15.3479C11.1784 15.7141 11.8043 15.6957 12.194 15.306C12.6268 14.8732 12.5946 14.1621 12.1244 13.7703L10.3687 12.3073C10.1768 12.1474 10.1768 11.8526 10.3687 11.6927Z"
										fill="black" />
									<path opacity="0.5"
										d="M16 5V6C16 6.55228 15.5523 7 15 7C14.4477 7 14 6.55228 14 6C14 5.44772 13.5523 5 13 5H6C5.44771 5 5 5.44772 5 6V18C5 18.5523 5.44771 19 6 19H13C13.5523 19 14 18.5523 14 18C14 17.4477 14.4477 17 15 17C15.5523 17 16 17.4477 16 18V19C16 20.1046 15.1046 21 14 21H5C3.89543 21 3 20.1046 3 19V5C3 3.89543 3.89543 3 5 3H14C15.1046 3 16 3.89543 16 5Z"
										fill="black" />
								</svg>
							</span>
							<!--end::Svg Icon-->
							<!--begin::Svg Icon | path: icons/duotune/arrows/arr076.svg-->
							<span class="svg-icon svg-icon-1 minimize-active">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
									fill="none">
									<rect opacity="0.3" width="12" height="2" rx="1"
										transform="matrix(-1 0 0 1 15.5 11)" fill="black" />
									<path
										d="M13.6313 11.6927L11.8756 10.2297C11.4054 9.83785 11.3732 9.12683 11.806 8.69401C12.1957 8.3043 12.8216 8.28591 13.2336 8.65206L16.1592 11.2526C16.6067 11.6504 16.6067 12.3496 16.1592 12.7474L13.2336 15.3479C12.8216 15.7141 12.1957 15.6957 11.806 15.306C11.3732 14.8732 11.4054 14.1621 11.8756 13.7703L13.6313 12.3073C13.8232 12.1474 13.8232 11.8526 13.6313 11.6927Z"
										fill="black" />
									<path
										d="M8 5V6C8 6.55228 8.44772 7 9 7C9.55228 7 10 6.55228 10 6C10 5.44772 10.4477 5 11 5H18C18.5523 5 19 5.44772 19 6V18C19 18.5523 18.5523 19 18 19H11C10.4477 19 10 18.5523 10 18C10 17.4477 9.55228 17 9 17C8.44772 17 8 17.4477 8 18V19C8 20.1046 8.89543 21 10 21H19C20.1046 21 21 20.1046 21 19V5C21 3.89543 20.1046 3 19 3H10C8.89543 3 8 3.89543 8 5Z"
										fill="#C4C4C4" />
								</svg>
							</span>
							<!--end::Svg Icon-->
						</div>
						<!--end::Aside minimize-->
						<!--begin::Aside toggle-->
						<div class="d-flex align-items-center d-lg-none ms-n3 me-1" title="Show aside menu">
							<div class="btn btn-icon btn-active-color-primary w-30px h-30px"
								id="kt_aside_mobile_toggle">
								<span class="svg-icon svg-icon-1">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
										fill="none">
										<path
											d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z"
											fill="black" />
										<path opacity="0.3"
											d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z"
											fill="black" />
									</svg>
								</span>
								<!--end::Svg Icon-->
							</div>
						</div>
						<!--end::Aside toggle-->
					</div>
					<!--end::Brand-->
					<div class="toolbar">
						<!--begin::Toolbar-->
						<div
							class="container-fluid py-6 py-lg-0 d-flex flex-column flex-lg-row align-items-lg-stretch justify-content-lg-between">
							<!--begin::Page title-->
							<div class="page-title d-flex flex-column me-5">
								<!--begin::Title-->
								<h1 class="d-flex flex-column text-dark fw-bolder fs-3 mb-0"><?= $menu ?></h1>
								<!--end::Title-->
								<!--begin::Breadcrumb-->
								<ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 pt-1">
									<li class="breadcrumb-item text-muted"> <?= $menu ?> - <?= $page ?></li>
								</ul>
								<!--end::Breadcrumb-->
							</div>
							<div>
								<a style="padding: .4rem !important; border-radius: 50%; background-color: #fecaca; opacity: 0.5;"
									class="btn btn-danger btn-sm text-white fw-bolder"
									href="<?= base_url('auth/logout') ?>">
									<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="red"
										class="bi bi-power fw-bolder" viewBox="0 0 16 16">
										<path d="M7.5 1v7h1V1h-1z" />
										<path
											d="M3 8.812a4.999 4.999 0 0 1 2.578-4.375l-.485-.874A6 6 0 1 0 11 3.616l-.501.865A5 5 0 1 1 3 8.812z" />
									</svg>
								</a>
							</div>
							<!--end::Page title-->
						</div>
						<!--end::Toolbar-->
					</div>
				</div>
				<!--end::Header-->
				<!--begin::Content-->
				<div class="content d-flex flex-column flex-column-fluid pb-0" id="kt_content">
					<?= $content ?>
				</div>
				<!--end::Content-->
				<!--begin::Footer-->
				<div class="footer py-4 d-flex flex-lg-column" id="kt_footer">
					<!--begin::Container-->
					<div
						class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
						<!--begin::Copyright-->
						<div class="text-dark order-2 order-md-1"><span class="text-muted fw-bold me-1">2022 © </span><a
								href="#" class="text-gray-800 text-hover-primary">Faster Version 2.0</a></div>
						<!--end::Copyright-->
						<!--begin::Menu-->
						<ul class="menu menu-gray-600 menu-hover-primary fw-bold order-1">
							<li class="menu-item"><a href="https://keenthemes.com" target="_blank"
									class="menu-link px-2">EpiC</a></li>
							<li class="menu-item"><a href="https://keenthemes.com/support" target="_blank"
									class="menu-link px-2">FHI360 - INDONESIA</a></li>
						</ul>
						<!--end::Menu-->
					</div>
					<!--end::Container-->
				</div>
				<!--end::Footer-->
			</div>
			<!--end::Wrapper-->
		</div>
		<!--end::Page-->
	</div>
	<!--end::Root-->
	<!-- <button id="kt_explore_toggle"
		class="explore-toggle btn btn-sm bg-body btn-color-gray-700 btn-active-primary shadow-sm position-fixed px-5 fw-bolder zindex-2 top-50 mt-10 end-0 transform-90 fs-6 rounded-top-0"
		title="Explore Metronic" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-trigger="hover">
		<span id="kt_explore_toggle_label">Explore</span>
	</button> -->
	<!--end::Exolore drawer toggle-->
	<!--begin::Exolore drawer-->
	<!-- <div id="kt_explore" class="bg-body" data-kt-drawer="true" data-kt-drawer-name="explore"
		data-kt-drawer-activate="true" data-kt-drawer-overlay="true"
		data-kt-drawer-width="{default:'350px', 'lg': '475px'}" data-kt-drawer-direction="end"
		data-kt-drawer-toggle="#kt_explore_toggle" data-kt-drawer-close="#kt_explore_close">
		<div class="card shadow-none rounded-0 w-100">
			<div class="card-header" id="kt_explore_header">
				<h3 class="card-title fw-bolder text-gray-700">Explore Metronic</h3>
				<div class="card-toolbar">
					<button type="button" class="btn btn-sm btn-icon btn-active-light-primary me-n5"
						id="kt_explore_close">
						<span class="svg-icon svg-icon-2">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
								fill="none">
								<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
									transform="rotate(-45 6 17.3137)" fill="black" />
								<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)"
									fill="black" />
							</svg>
						</span>
					</button>
				</div>
			</div>
		</div>
	</div> -->
	<!--end::Exolore drawer-->
	<!--end::Drawers-->
	<!--begin::Scrolltop-->
	<div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
		<!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
		<span class="svg-icon">
			<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
				<rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)"
					fill="black" />
				<path
					d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z"
					fill="black" />
			</svg>
		</span>
		<!--end::Svg Icon-->
	</div>
	<div class="position-fixed top-0 end-0 p-3" style="z-index: 9999">
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
	<!-- Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

	</div>
	<!--end::Scrolltop-->
	<!--end::Main-->
	<!--begin::Javascript-->
	<!--begin::Global Javascript Bundle(used by all pages)-->
	<script>
		const toast = new bootstrap.Toast(document.getElementById('liveToast'))

		function showToast(title, message, indicator = 'success') {
			$('#liveToast #toast-indicator').removeClass().addClass(`bg-${indicator}`)
			$('#liveToast .toast-header strong').text(title)
			$('#liveToast .toast-body').text(message)

			toast.show()
		}

		const rendermenus = (fastmenus) => {
			let html = ''
			fastmenus.forEach(menu => {
				$('#fast-menus').html('')
				const title = menu.title
				const submenus = menu.sub
				const submenuhtml = ''
				html += `<div class="menu-item">
								<div class="menu-content pt-8 pb-2">
									<span class="menu-section text-muted text-uppercase fs-8 ls-1">
										${title}
									</span>
								</div>
							</div>`
				if (submenus.length > 0) {
					submenus.forEach(submenu => {
						const submenusChild = submenu.sub
						let childhtml = ''
						if (submenusChild.length > 0) {
							submenusChild.forEach(child => {
								childhtml += `<div class="menu-sub menu-sub-accordion menu-active-bg">
													<div
														class="menu-item">
														<a class="menu-link" href="<?= $_ENV['STAGING_URL'] ?>${child.link}">
															<span class="menu-bullet">
																<span class="bullet bullet-dot"></span>
															</span>
															<span class="menu-title">${child.title}</span>
														</a>
													</div>
												</div>`
							})
							html += `<div data-kt-menu-trigger="click" class="menu-item menu-accordion">
											<span class="menu-link">
												<span class="menu-icon">
													<span class="svg-icon svg-icon-2">
														<i class="` + submenu.icon + `" aria-hidden="true"></i>
													</span>
												</span>
												<span class="menu-title">${submenu.title}</span>
												<span class="menu-arrow"></span>
											</span>
											${childhtml}
										</div>`
						} else {
							html += `<div class="menu-item">
										<a class="menu-link" href="<?= $_ENV['STAGING_URL'] ?>${submenu.link}">
											<span class="menu-icon">
												<span class="svg-icon svg-icon-2">
													<i class="` + submenu.icon + `" aria-hidden="true"></i>	
												</span>
											</span>
											<span class="menu-title">${submenu.title}</span>
										</a>
									</div>`
						}
					})
				}
				$('#fast-menus').append(html)
			});
		}

		const fastMenus = localStorage.getItem('fast_menu');
		const menus = JSON.parse(fastMenus)
		rendermenus(menus)
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
<!--end::Body-->

</html>
