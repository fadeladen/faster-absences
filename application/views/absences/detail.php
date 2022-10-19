<div class="post d-flex flex-column-fluid" id="kt_post">
	<div id="kt_content_container" class="container-xxl px-4">
		<div class="post d-flex flex-column-fluid" id="kt_post">
			<div class="container-xxl px-2">
				<div class="row g-5 g-xl-8">
					<div class="col-xl-12">
						<!--begin::Card-->
						<div class="card card-xl-stretch mb-5 mb-xl-8">
							<!--begin::Card header-->
							<div
								class="card-header border-bottom w-100 pt-5 pb-4 d-flex justifiy-content-between align-items-center">
								<div>
									<h3 class="card-title align-items-start flex-column">
										<span
											class="card-label fw-bolder fs-3 mb-1"><?= $detail['kode_kegiatan'] ?></span>
										<span class="text-muted mt-1 fw-bold fs-7">
											<?= $detail['activity'] ?>
										</span>
									</h3>
								</div>
								<div>
									<a href="<?= base_url('absences') ?>" class="btn btn-primary">
										<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
											fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
											<path fill-rule="evenodd"
												d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
										</svg>
										<span class="ms-1">
											Back to absences
										</span>
									</a>
								</div>
							</div>
							<!--end::Card header-->
							<!--begin::Card body-->
							<!-- <div class="card-body pt-4">

							</div> -->
							<!--end::Card body-->
						</div>
						<!--end::Card-->
					</div>
				</div>
			</div>
		</div>

		<div class="post d-flex flex-column-fluid" id="kt_post">
			<div class="container-xxl px-2">
				<div class="row g-5 g-xl-8">
					<div class="col-md-4">
						<div class="card card-xl-stretch mb-5 mb-xl-8">
							<div class="card-header border-0 pt-5">
								<h3 class="card-title align-items-start flex-column border-bottom w-100 pb-3"><span
										class="card-label fw-bolder fs-3 mb-1">Detail Activity</span>
								</h3>
								<div class="card-toolbar">

								</div>
							</div>
							<div class="card-body pt-0">
								<div class="d-flex flex-column">
									<div class="d-flex align-items-center">
										<img style="width: 4rem !important; height: 4rem !important; border-radius: 8px !important; object-fit: cover !important;"
											class="img-fluid me-5"
											src="<?= ($detail['avatar'] == null) ? base_url('assets/images/no-avatar.png') : $_ENV['ASSETS_URL'] . $detail['avatar'] .'?subfolder=avatars&token=' . $_ENV['ASSETS_TOKEN'] ?>"
											alt="">
										<div>
											<div class="fw-bolder text-gray-800 fs-5">
												<?= $detail['requestor_name'] ?>
											</div>
											<div class="text-gray-600 d-flex flex-column">
												<small>
													<?= $detail['purpose'] ?>
												</small>
												<small class="text-success">
													Requestor
												</small>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-8">
						<div class="card card-xl-stretch mb-5 mb-xl-8">
							<div class="card-header border-bottom pb-3 pt-5">
								<div>
									<h3 class="card-title align-items-start flex-column"><span
											class="card-label fw-bolder fs-3 mb-1">Session</span>
										<span class="text-muted mt-1 fw-bold fs-7">
											Manage Session Events
										</span>
									</h3>

								</div>
								<div class="card-toolbar">
									<button id="btn-create-session" data-id="<?= $detail['kode_kegiatan'] ?>"
										class="btn btn-primary">Create New Session</button>
								</div>
							</div>
							<div class="card-body pt-4">
								<table id="table" class="table" data-url="<?= base_url('absences/session_datatable/') . $detail['kode_kegiatan'] ?>">
									<thead>
										<tr class="text-start fw-bolder fs-7 text-uppercase bg-lighten">
											<th class="ps-2" style="width: 180px;" scope="col">Title</th>
											<th>Session</th>
											<th>Status</th>
											<th class="link-col">Attendance link</th>
											<th class="action-col"></th>
										</tr>
									</thead>
									<tbody>

									</tbody>
								</table>
							</div>
						</div>
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
				targets: 'link-col',
				orderable: false,
				searchable: false,
				render: function (data, _, row) {
					return `
                        <div style="width:160px;" class="d-flex align-items-center">
                            <span>
                                 ${data}
                            </span>
                             <button data-id="${data}" class="btn btn-light btn-copy-link bg-transparent fw-bold p-2 ms-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" fill="currentColor"
										class="bi bi-paperclip" viewBox="0 0 16 16">
										<path
											d="M4.5 3a2.5 2.5 0 0 1 5 0v9a1.5 1.5 0 0 1-3 0V5a.5.5 0 0 1 1 0v7a.5.5 0 0 0 1 0V3a1.5 1.5 0 1 0-3 0v9a2.5 2.5 0 0 0 5 0V5a.5.5 0 0 1 1 0v7a3.5 3.5 0 1 1-7 0V3z" />
									</svg>
                             </button>
                        </div>
	                `
				}
			},{
				targets: 'action-col',
				orderable: false,
				searchable: false,
				render: function (data, _, row) {
					return `
	                   <div style="width: 90px;" class="d-flex align-items-center"> 
                           <a class="btn p-2 fw-bolder btn-icon btn-light" href="${base_url}absences/detail/${data}">
							<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
									<path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
									<path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
								</svg>  
						   </a>
	                   </div>
	                `
				}
			},]
		})

		$(document).ready(function () {
			$(document).on('click', '.btn-copy-link', function (e) {
				var $temp = $("<input class='link-sample'>");
				$("body").append($temp);
				const link = base_url + 'site/absences/form/' + $(this).attr('data-id')
				$(this).select();
				navigator.clipboard.writeText(link);
				showToast('Copied', 'Attendance link copied to clipboard', 'success')
                $('.link-sample').remove()
			})

			$(document).on('click', '#btn-create-session', function (e) {
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
						if (data.success) {
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
						}
					},
				})

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
		});

	</script>
