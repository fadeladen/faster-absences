<div class="post d-flex flex-column-fluid" id="kt_post">
	<div id="kt_content_container" class="container-xxl px-4">
		<div class="post d-flex flex-column-fluid" id="kt_post">
			<div class="container-xxl px-2">
				<div class="row g-5 g-xl-8">
					<div class="col-xl-12">
						<!--begin::Card-->
						<div class="card card-xl-stretch mb-5 mb-xl-8">
							<!--begin::Card header-->
							<div class="card-header border-0 pt-5">
								<h3 class="card-title align-items-start flex-column"><span
										class="card-label fw-bolder fs-3 mb-1">Create Absences</span>
									<span class="text-muted mt-1 fw-bold fs-7"></span>
								</h3>
								<div class="card-toolbar">
									<a class="btn btn-primary" href="<?= base_url('absences/data') ?>">
										<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
											fill="currentColor" class="bi bi-list-ul" viewBox="0 0 16 16">
											<path fill-rule="evenodd"
												d="M5 11.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm-3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm0 4a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm0 4a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
										</svg>
										<span class="ms-1">
											Data Absences
										</span>
									</a>
								</div>
							</div>

							<!--end::Card header-->
							<!--begin::Card body-->
							<div class="card-body pt-0 mt-5">
								<!--begin::Table-->
								<table id="table" class="table gy-4" data-url="<?= base_url('absences/datatable') ?>">
									<!--begin::Table head-->
									<thead>
										<tr class="text-start fw-bolder fs-7 text-uppercase bg-lighten">
											<th class="numbers-col">Request numbers</th>
											<th class="requestor">Requestor</th>
											<th>Date of Approval</th>
											<th>Activity</th>
											<th class="action-col">Action</th>
										</tr>
										<!--end::Table head-->
										<!--begin::Table body-->
									<tbody class="text-gray-600">

									</tbody>
									<!--end::Table body-->
								</table>
								<!--end::Table-->
							</div>
							<!--end::Card body-->
						</div>
						<!--end::Card-->
					</div>
				</div>
			</div>
		</div>
	</div>
	<script>
		const table = initDatatable('#table', {
			order: [
				[0, 'desc']
			],
			columnDefs: [{
				targets: 'numbers-col',
				orderable: false,
				searchable: false,
				render: function (data, _, row) {
					return `
	                   <div class="d-flex flex-column"> 
                            <p class="text-muted fw-bolder mb-0 border-bottom pb-2">Advance: ${data}</p>
                            <p class="text-primary mb-0 border-bottom py-2">TOR: ${row[5]}</p>
                            <p class="text-danger mb-0 pt-2">Activity: ${row[6]}</p>
	                   </div>
	                `
				}
			}, {
				targets: 'requestor',
				orderable: false,
				searchable: true,
				render: function (data, _, row) {
					let avatar = ''
					if (row[7] == null) {
						avatar = base_url + 'assets/images/no-avatar.png'
					} else {
						const asset_token = "<?= $_ENV['ASSETS_TOKEN']; ?>"
						const asset_url = "<?= $_ENV['ASSETS_URL']; ?>"
						avatar = asset_url + row[7] + '?subfolder=avatars&token=' + asset_token
					}
					return `<div class="d-flex align-items-center">
								<img style="width: 4rem !important; height: 4rem !important; border-radius: 50% !important; object-fit: cover !important;"
									class="img-fluid me-5"
									src="${avatar}"
									alt="">
								<div>
									<div class="fw-bolder text-gray-800 fs-5">
										${data}
									</div>
									<div style="font-size: 12px; !important" class="text-gray-600 d-flex flex-column">
										<small>
										${row[8]}
										</small>
										<small>
										${row[9]}
										</small>
									</div>
								</div>
							</div>`
				}
			}]
		})

		$(document).on('click', '.btn-copy-link', function (e) {
				var $temp = $("<input>");
				$("body").append($temp);
				const link = base_url + 'site/absences/form/' + $(this).attr('data-id')
				$(this).select();
				navigator.clipboard.writeText(link);
				showToast('Copied', 'Absence link copied to clipboard', 'success')
		})

		$(document).on('click', '.btn-create', function (e) {
			const activity_code = $(this).attr('data-id')
			$.get(base_url +
				`absences/create?activity_code=${activity_code}`,
				function (html) {
					$('#myModal').html(html)
					$('#myModal').modal('show')
				});
			initFormAjax('#absence-form', {
				error: function (xhr) {
					const response = xhr.responseJSON;
					if (response.errors) {
						for (const err in response.errors) {
							const $parent = $(`#${err.replace("[]", "")}`).parent();
							$(`#${err.replace("[]", "")}`).addClass("is-invalid");
							if ($parent.find("invalid-feeedback").length == 0) {
								$parent.append(
									`<div class="invalid-feedback">${response.errors[err]}</div>`
								);
							}
						}
					}
					Swal.fire({
						"title": "Something went wrong!",
						"text": response.message,
						"icon": "error",
						"confirmButtonColor": '#000'
					});
				},
				success: function (data) {
					Swal.fire({
						"title": "Saved!",
						"text": data.message,
						"icon": "success",
						"confirmButtonColor": '#000'
					}).then((result) => {
						if (result.value) {
							$('#myModal').modal('hide')
						}
						table.draw()
					})
				},
			})
			// $(document).on('click', '.btn-copy-link', function (e) {
			// 	var $temp = $("<input>");
			// 	$("body").append($temp);
			// 	const link = base_url + 'site/absences/form/' + $(this).attr('data-id')
			// 	$(this).select();
			// 	navigator.clipboard.writeText(link);
			// 	showToast('Copied', 'Absence link copied to clipboard', 'success')
			// })

			$(document).on('change', '#kind_of_meeting', function (e) {
				const value = $(this).val()
				if (value == 1) {
					$('.online-hybrid').removeClass('d-none')
					$('.qrcode').addClass('d-none')
				} else if (value == 2) {
					$('.qrcode').removeClass('d-none')
					$('.online-hybrid').addClass('d-none')
				} else if (value == 3) {
					$('.qrcode').removeClass('d-none')
					$('.online-hybrid').removeClass('d-none')
				}
			})

		})

	</script>
