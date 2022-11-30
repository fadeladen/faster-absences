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
					<div class="col-md-3">
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
									<div class="d-flex align-items-center mb-2">
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
									<div class="text-center pt-5 my-5">
										<h1 class="fw-bolder text-gray-800 mb-1">
											<?= total_expired_absences($detail['kode_kegiatan']) ?> of <span
												id="count_absences"><?= $detail['total_absences'] ?></span>
										</h1>
										<small class="text-muted fw-bold fs-6">Event Expired</small>
										<div class="range-container mt-2">
											<Input id="range-total-absences" class="range" type="range"
												value="<?= total_expired_absences($detail['kode_kegiatan']) ?>" min="0"
												max="<?= $detail['total_absences'] ?>">
											</Input>
										</div>
									</div>
									<div class="d-flex align-items-center my-5">
										<span class="icon-badge cb-dark">
											<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"
												fill="currentColor" class="bi bi-bar-chart-fill" viewBox="0 0 16 16">
												<path
													d="M1 11a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1v-3zm5-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1V2z" />
											</svg>
										</span>
										<div class="ms-5">
											<div class="fw-bolder text-gray-800 fs-5">
												Rp. <span
													id="count_total_advance"><?= $detail['total_advance'] ?></span>
											</div>
											<div class="text-muted fw-bold d-flex flex-column">
												Advance Used
											</div>
										</div>
									</div>
									<div class="d-flex align-items-center my-5">
										<span class="icon-badge cb-dark">
											<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"
												fill="currentColor" class="bi bi-bar-chart-fill" viewBox="0 0 16 16">
												<path
													d="M1 11a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1v-3zm5-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1V2z" />
											</svg>
										</span>
										<div class="ms-5">
											<div class="fw-bolder text-gray-800 fs-5">
												Rp. <span
													id="count_total_submitted"><?= $detail['total_submitted'] ?></span>
											</div>
											<div class="text-muted fw-bold d-flex flex-column">
												Advance Submitted
											</div>
										</div>
									</div>
									<div class="mx-auto mt-5">
										<button type="button" class="btn btn-primary btn-lg d-flex align-items-center">
											<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
												fill="currentColor" class="bi bi-envelope-paper-fill"
												viewBox="0 0 16 16">
												<path fill-rule="evenodd"
													d="M6.5 9.5 3 7.5v-6A1.5 1.5 0 0 1 4.5 0h7A1.5 1.5 0 0 1 13 1.5v6l-3.5 2L8 8.75l-1.5.75ZM1.059 3.635 2 3.133v3.753L0 5.713V5.4a2 2 0 0 1 1.059-1.765ZM16 5.713l-2 1.173V3.133l.941.502A2 2 0 0 1 16 5.4v.313Zm0 1.16-5.693 3.337L16 13.372v-6.5Zm-8 3.199 7.941 4.412A2 2 0 0 1 14 16H2a2 2 0 0 1-1.941-1.516L8 10.072Zm-8 3.3 5.693-3.162L0 6.873v6.5Z" />
											</svg>
											<span class="ms-2 fw-bold">Report Activity</span>
										</button>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-9">
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
										class="btn btn-primary d-flex align-items-center">
										<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
											fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
											<path fill-rule="evenodd"
												d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z" />
										</svg>
										<span class="ms-2">
											Create New Session
										</span>
									</button>
								</div>
							</div>
							<div class="card-body pt-4">
								<input type="text" class="d-none" value="<?= $detail['kode_kegiatan'] ?>"
									id="code_activity">
								<table id="table" class="table"
									data-url="<?= base_url('absences/session_datatable/') . $detail['kode_kegiatan'] ?>">
									<thead>
										<tr class="text-start fw-bolder fs-7 bg-lighten">
											<th class="number-col text-center" style="width: 20px;" scope="col">No</th>
											<th class="title-col" style="width: 140px;" scope="col">Title</th>
											<th class="session-col">Session</th>
											<th class="status-col">Status</th>
											<th class="payment-col">Payment</th>
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
		const code_activity = $('#code_activity').val()
		const updateDetailActivity = () => {
			$.ajax({
				type: 'GET',
				url: base_url + 'absences/get_current_advance_and_absences/' +
					code_activity,
				error: function (xhr) {
					const response = xhr.responseJSON;
					console.log(response)
				},
				success: function (response) {
					const data = response.data
					if (response.success) {
						$('#count_absences').text(data.total_absence)
						$('#count_total_advance').text(data.total_advance)
					}
				},
			});
		}
		const table = initDatatable('#table', {
			lengthMenu: [
				[5, 25, 50, -1],
				[5, 25, 50, 100],
			],
			order: [
				[2, 'desc']
			],
			columnDefs: [{
				targets: 'number-col',
				orderable: false,
				searchable: false,
				render: function (data, type, row, meta) {
					return `<div class="mt-4"><span class="custom-badge cb-dark">${meta.row + meta.settings._iDisplayStart + 1}</span></div>`
				}
			}, {
				targets: 'title-col',
				render: function (data, _, row) {
					let text = 'Online'
					if (row[9] == 2) {
						text = 'Offline'
					} else if (row[9] == 3) {
						text = 'Hybrid'
					}
					return `<div style="width:140px;" class="d-flex flex-column">
					 			<h4 class="fw-bolder mt-2 text-gray-700 mb-0">${data}</h4>
								<span style="font-size: 11px;" class="text-primary fw-bold">${text}</span>
							</div>`
				}
			}, {
				targets: 'session-col',
				orderable: false,
				searchable: false,
				render: function (data, _, row) {
					return `<div style="font-size:11px !important; width:105px;">
								<p class="mb-1 mt-2">${data}</p>
								<p class="mb-0">${row[7]}</p>
							</div>`
				}
			}, {
				targets: 'status-col',
				render: function (data, _, row) {
					return data
				}
			}, {
				targets: 'payment-col',
				render: function (data, _, row) {
					let text = 'Pending'
					let color = 'cb-warning'
					if (data == 1) {
						text = 'Complete'
						color = 'cb-success'
					}
					return `<div class='mt-3'><span class='custom-badge ${color}'>${text}</span></div>`
				}
			}, {
				targets: 'link-col',
				orderable: false,
				searchable: false,
				render: function (data, _, row) {
					return `
                        <div style="width:140px;" class="d-flex align-items-center fw-bold text-gray-800">
                            <span class="fs-5">
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
			}, {
				targets: 'action-col',
				orderable: false,
				searchable: false,
				render: function (data, _, row) {
					let link =
						`<li><a class="dropdown-item btn-participants" data-id="${data}" href="#">Manual transfer</a></li>`
					if(row[4] == 1) {
						link += `<li><a class="dropdown-item" target="_blank" href="${base_url}site/documents/participants_list_by_session/${row[8]}">Download PDF</a></li>`
					}
					if (row[9] == 2 || row[9] == 3) {
						link +=
							`<li><a class="dropdown-item" target="_blank" href="${base_url}absences/qrcode/${row[8]}?size=4">Download QR Code</a></li>
							 <li><a class="dropdown-item" target="_blank" href="${base_url}site/documents/blank_absence/${row[8]}?size=4">Download Blank Absence</a></li>`
					}
					return `<div style="width: 135px;" class="dropdown">
								<a class="btn btn-sm bg-lighten text-muted dropdown-toggle" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
									Options
								</a>
								<ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
									${link}
								</ul>
							</div>`
				}
			}, ]
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
			$(document).on('click', '#qr_link', function (e) {
				var $temp = $("<input class='link-sample'>");
				$("body").append($temp);
				const link = `${$(this).attr('data-url')}`
				$(this).select();
				navigator.clipboard.writeText(link);
				showToast('Copied', 'QR code link copied to clipboard', 'success')
				$('.link-sample').remove()
			})
			const updateQrCode = (url) => {
				$('#qr_code_image').attr('src', url + '&size=3')
				$('#qr_pdf').attr('href', url)
				$('#qr_link').attr('data-url', url)
			}
			const updateTotalField = (absence_id) => {
				$.ajax({
					type: 'GET',
					url: base_url + 'absences/get_total_participants_reimbursement/' +
						absence_id,
					error: function (xhr) {
						const response = xhr.responseJSON;
						console.log(response)
					},
					success: function (response) {
						const data = response.data
						if (response.success) {
							$('#total_meal').text(data.total_konsumsi)
							$('#total_internet').text(data.total_internet)
							$('#total_other').text(data.total_other)
							$('#total_all').text(data.total)
						}
					},
				});
			}
			$(document).on('click', '.btn-participants', function (e) {
				const absence_id = $(this).attr('data-id')
				$.get(base_url +
					`absences/participants_modal?absence_id=${absence_id}`,
					function (html) {
						$('#myModal').html(html).modal('show')
						const assets_url = "<?= $_ENV['ASSETS_URL'] ?>"
						const assets_token = "<?= $_ENV['ASSETS_TOKEN'] ?>"
						const is_submitted = $('#is_submitted').val()
						let input_disabled = ''
						if (is_submitted == 1) {
							input_disabled = 'disabled'
						}
						const participantsTable = initDatatable('#participants-table', {
							order: [
								[0, 'desc']
							],
							columnDefs: [{
									targets: [0],
									render: function (data, _, row, meta) {
										return `<div class="text-center">${meta.row + meta.settings._iDisplayStart +1}</div`
									}
								}, {
									targets: [2],
									render: function (data, _, row) {
										return `<div style="width: 65px !important; font-size: 11px;">${data}</div>`
									}
								}, {
									targets: [1],
									render: function (data, _, row) {
										return `<div style="width: 120px !important; font-size: 12px;">${data}</div>`
									}
								}, {
									targets: ['organization-col'],
									render: function (data, _, row) {
										return `<div style="width: 123px !important; font-size: 11px;">
													<p class="mb-1">${data}</p>
										 			<p><small>${row[17]}</small></p>
												</div>`
									}
								}, {
									targets: ['email-col'],
									render: function (data, _, row) {
										return `<div style="width: auto !important; font-size: 11px;">
													${data}
												</div>`
									}
								}, {
									targets: ['meal-col'],
									orderable: false,
									searchable: false,
									render: function (data, _, row) {
										return `<input type="text" data-field="jumlah_konsumsi" value="${data}" class="form-control meal-input small-input" ${input_disabled} data-id="${row[18]}" data-absence-id="${row[20]}">`
									}
								}, {
									targets: ['internet-col'],
									orderable: false,
									searchable: false,
									render: function (data, _, row) {
										return `<input type="text" data-field="jumlah_internet" value="${data}" class="form-control internet-input small-input" ${input_disabled} data-id="${row[18]}" data-absence-id="${row[20]}">`
									}
								}, {
									targets: ['other-col'],
									orderable: false,
									searchable: false,
									render: function (data, _, row) {
										return `<input type="text" data-field="jumlah_other" value="${data}" class="form-control other-input small-input" ${input_disabled} data-id="${row[18]}" data-absence-id="${row[20]}">`
									}
								}, {
									targets: ['total-col'],
									orderable: false,
									searchable: false,
									render: function (data, _, row) {
										return `<input type="text" value="${data}" class="form-control total-input small-input" disabled data-id="${row[18]}" data-absence-id="${row[20]}">`
									}
								}, {
									targets: 'payment-col',
									render: function (data, _, row) {
										const bank_name = row[13]
										const bank_number = row[14]
										return `<div style="width: 80px !important;">
													<p class="mb-1 fw-bold fs-7">${bank_name}</p>
													<p>${bank_number}</p>
												</div>`
									}
								}, {
									targets: 'consumption-receipt',
									orderable: false,
									searchable: false,
									render: function (data, _, row) {
										const receipt = data
										let receiptDetail = ''
										let uploadBtn = 'd-none'
										if (!receipt || receipt == '' || receipt ==
											null) {
											uploadBtn = ''
											receiptDetail = 'd-none'
										}
										return `<div style="width: 95px !important;" class="d-flex flex-column">
                                        <div class="meal-receipt-container ${receiptDetail}">
                                            <a href="<?= $_ENV['ASSETS_URL'] ?>${data}?subfolder=resi_konsumsi&token=<?= $_ENV['ASSETS_TOKEN'] ?>" target="_blank" class="link-primary d-flex align-items-center meal-receipt-image">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-file-earmark-image" viewBox="0 0 16 16">
                                                    <path d="M6.502 7a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"/>
                                                    <path d="M14 14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5L14 4.5V14zM4 1a1 1 0 0 0-1 1v10l2.224-2.224a.5.5 0 0 1 .61-.075L8 11l2.157-3.02a.5.5 0 0 1 .76-.063L13 10V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4z"/>
                                                </svg>
                                                <span class="ms-1">
                                                    See receipt
                                                </span>
                                            </a>
                                            <p style="cursor: pointer;" class="link-primary d-flex align-items-center change-meal-receipt mt-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                                </svg>
                                                <span class="ms-1">
                                                    Change
                                                </span>
                                            </p>
                                        </div>
                                        <div class="meal-file-upload ${uploadBtn}">
                                            <input type="file" data-id="${row[18]}" class="form-control meal-receipt-file small-file-upload">
                                            <small class="my-2 upload-notif"></small>
                                        </div>
								</div>`
									}
								},
								{
									targets: 'transfer-receipt',
									orderable: false,
									searchable: false,
									render: function (data, _, row) {
										const receipt = row[15]
										let receiptDetail = ''
										let uploadBtn = 'd-none'
										let url = `<?= $_ENV['ASSETS_URL'] ?>${row[15]}?subfolder=transfer_receipt&token=<?= $_ENV['ASSETS_TOKEN'] ?>`
										if (!receipt || receipt == '' || receipt == null) {
											uploadBtn = ''
											receiptDetail = 'd-none'
										}
										return `<div style="width: 95px !important;" class="d-flex flex-column">
                                        <div class="transfer-receipt-container ${receiptDetail}">
                                            <a href="${url}" target="_blank" class="link-primary d-flex align-items-center transfer-receipt-image">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-file-earmark-image" viewBox="0 0 16 16">
                                                    <path d="M6.502 7a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"/>
                                                    <path d="M14 14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5L14 4.5V14zM4 1a1 1 0 0 0-1 1v10l2.224-2.224a.5.5 0 0 1 .61-.075L8 11l2.157-3.02a.5.5 0 0 1 .76-.063L13 10V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4z"/>
                                                </svg>
                                                <span class="ms-1">
                                                    See receipt
                                                </span>
                                            </a>
                                            <p style="cursor: pointer;" class="link-primary d-flex align-items-center change-transfer-receipt mt-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                                </svg>
                                                <span class="ms-1">
                                                    Change
                                                </span>
                                            </p>
                                        </div>
                                        <div class="transfer-file-upload ${uploadBtn}">
                                            <input type="file" data-id="${row[18]}" class="form-control transfer-receipt-file small-file-upload">
                                            <small class="my-2 upload-notif"></small>
                                        </div>
								</div>`
									}
								},{
									targets: 'action-col',
									orderable: false,
									searchable: false,
									render: function (data, _, row) {
										console.log(row[19])
										let disabled = flipbtn = ''
										if (row[19] == 1 || row[15] == null || row[10] ==
											null || !row[10 || !row[15]]) {
											disabled = 'disabled'
										}
										if(row[21] != null) {
											flipbtn = 'disabled'
										}
										return `
											<div style="width: 60px !important;" class="d-flex flex-column align-items-center"> 
													<button ${disabled} data-id="${row[18]}" class="btn btn-xs btn-primary btn-send-email">Submit</button>
													<button ${flipbtn}  data-id="${row[18]}" class="btn btn-xs btn-danger btn-flip mt-1">Flip</button>
											</div>`
									}
								}, {
									targets: 'flip-status-col',
									orderable: false,
									searchable: false,
									render: function (data, _, row) {
										let flipStatus = row[21]
										if(flipStatus == null) {
											flipStatus = '-'
										}
										return `<div class="text-gray-800">${flipStatus}</div>`
									}
								}
							]
						})
						const updateParticipantData = (id, value, field) => {
							$.ajax({
								type: 'POST',
								url: base_url + 'absences/update_participant/' + id,
								data: {
									value,
									field
								},
								error: function (xhr) {
									const response = xhr.responseJSON;
									showToast('Error', response.message, 'error')
								},
							});
						}
						$(document).on('click', '.change-transfer-receipt', function (e) {
							const $this = $(this)
							const receiptDetail = $this.parent()
							receiptDetail.addClass('d-none')
							const fileUpload = $this.parent().parent().find(
								'.transfer-file-upload')
							fileUpload.removeClass('d-none')
						})
						$(document).on('click', '.change-meal-receipt', function (e) {
							const $this = $(this)
							const receiptDetail = $this.parent()
							receiptDetail.addClass('d-none')
							const fileUpload = $this.parent().parent().find('.meal-file-upload')
							fileUpload.removeClass('d-none')
						})
						$(document).on("change", '.transfer-receipt-file', function () {
							var $this = $(this);
							var form = new FormData();
							const id = $this.attr('data-id')
							form.append("file", $this[0].files[0]);
							$.ajax({
								url: asset_url + 'transfer_receipt',
								type: "POST",
								data: form,
								cache: false,
								contentType: false,
								processData: false,
								dataType: 'json',
								beforeSend: function (request) {
									request.setRequestHeader("token",
										"<?= $_ENV['ASSETS_TOKEN'] ?>");
									$this.parent().find('.upload-notif').text(
										'Uploading...!')
								},
								error: function (xhr) {
									const response = xhr.responseJSON;
									console.log(response)
									$this.parent().find('.upload-notif').text(
											'Failed to upload receipt!')
										.addClass('text-danger')
									$this.val(null);
									$this.parent().parent().parent().parent()
										.find(
											'.btn-send-email').attr('disabled',
											true)
								},
								success: function (response) {
									if (response.status === true) {
										const filename = response.data.filename
										updateParticipantData(id, filename,
											'transfer_receipt')
										$this.parent().find('.upload-notif').text(
												'Receipt has been uploaded!')
											.addClass('text-success')
										$this.parent().addClass('d-none')
										$this.parent().parent().parent().parent()
											.find(
												'.btn-send-email').attr('disabled',
												false)
										const receiptContainer = $this.parent()
											.parent().find(
												'.transfer-receipt-container')
										receiptContainer.removeClass('d-none')
										receiptContainer.find(
											'.transfer-receipt-image').attr(
											'href',
											`<?= $_ENV['ASSETS_URL'] ?>${filename}?subfolder=transfer_receipt&token=<?= $_ENV['ASSETS_TOKEN'] ?>`
										)
									}
								},
							});
						})
						$(document).on("change", '.meal-receipt-file', function () {
							var $this = $(this);
							var form = new FormData();
							const id = $this.attr('data-id')
							form.append("file", $this[0].files[0]);
							$.ajax({
								url: asset_url + 'resi_konsumsi',
								type: "POST",
								data: form,
								cache: false,
								contentType: false,
								processData: false,
								dataType: 'json',
								beforeSend: function (request) {
									request.setRequestHeader("token",
										"<?= $_ENV['ASSETS_TOKEN'] ?>");
									$this.parent().find('.upload-notif').text(
										'Uploading...!')
								},
								error: function (xhr) {
									const response = xhr.responseJSON;
									console.log(response)
									$this.parent().find('.upload-notif').text(
											'Failed to upload receipt!')
										.addClass('text-danger')
									$this.val(null);
								},
								success: function (response) {
									if (response.status === true) {
										const filename = response.data.filename
										updateParticipantData(id, filename,
											'resi_konsumsi')
										$this.parent().find('.upload-notif').text(
												'Receipt has been uploaded!')
											.addClass('text-success')
										$this.parent().addClass('d-none')
										// $this.parent().parent().parent().parent()
										// 	.find(
										// 		'.btn-send-email').attr('disabled',
										// 		false)
										const receiptContainer = $this.parent()
											.parent().find(
												'.meal-receipt-container')
										receiptContainer.removeClass('d-none')
										receiptContainer.find('.meal-receipt-image')
											.attr('href',
												`<?= $_ENV['ASSETS_URL'] ?>${filename}?subfolder=resi_konsumsi&token=<?= $_ENV['ASSETS_TOKEN'] ?>`
											)
									}
								},
							});
						})
						$(document).on("keyup", '.meal-input, .other-input, .internet-input',
							function () {
								$('.small-input').number(true, 0, '', '.')
								const $this = $(this)
								const value = $(this).val()
								const field = $(this).attr('data-field')
								const id = $(this).attr('data-id')
								const abs_id = $(this).attr('data-absence-id')
								$.ajax({
									type: 'POST',
									url: base_url + 'absences/update_participant/' + id,
									data: {
										value,
										field
									},
									error: function (xhr) {
										const response = xhr.responseJSON;
										console.log(response)
									},
									success: function (response) {
										if (response.success) {
											$this.parent().parent().find('.total-input')
												.val(response
													.data.total)
											updateTotalField(abs_id)
											updateDetailActivity()
										}
									},
								});
							})
						$(document).on("click", '.btn-send-email', function () {
							const $this = $(this)
							const id = $(this).attr('data-id')
							const loader = `<div style="width: 5rem; height: 5rem;" class="spinner-border mb-5" role="status"></div>
							<h5 class="mt-2">Please wait</h5>
							<p>Sending email to participant...</p>`
							Swal.fire({
								title: `Send email to participant?`,
								text: "",
								icon: 'warning',
								showCancelButton: true,
								confirmButtonColor: '#009EF7',
								cancelButtonColor: '#F1416C',
								confirmButtonText: `Yes!`
							}).then((result) => {
								if (result.value) {
									$.ajax({
										type: 'POST',
										url: base_url +
											'absences/submit_participant_reimbursement/' +
											id,
										beforeSend: function () {
											Swal.fire({
												html: loader,
												showConfirmButton: false,
												allowEscapeKey: false,
												allowOutsideClick: false,
											});
										},
										error: function (xhr) {
											const response = xhr.responseJSON;
											Swal.fire({
												"title": response
													.message,
												"text": '',
												"icon": "error",
												"confirmButtonColor": '#000',
											});
										},
										success: function (response) {
											Swal.fire({
												"title": "Success!",
												"text": response
													.message,
												"icon": "success",
												"confirmButtonColor": '#000',
											}).then((result) => {
												if (result.value) {
													participantsTable
														.draw(false)
												}
											})
										},
									});
								}
							})
						})
						$(document).on("click", '.btn-flip', function () {
							const $this = $(this)
							const id = $(this).attr('data-id')
							const loader = `<div style="width: 5rem; height: 5rem;" class="spinner-border mb-5" role="status"></div>
							<h5 class="mt-2">Please wait</h5>
							<p>Sending...</p>`
							Swal.fire({
								title: `Send payment with Flip?`,
								text: "",
								icon: 'warning',
								showCancelButton: true,
								confirmButtonColor: '#009EF7',
								cancelButtonColor: '#F1416C',
								confirmButtonText: `Yes!`
							}).then((result) => {
								if (result.value) {
									$.ajax({
										type: 'POST',
										url: base_url +
											'absences/flip_payment/' +
											id,
										beforeSend: function () {
											Swal.fire({
												html: loader,
												showConfirmButton: false,
												allowEscapeKey: false,
												allowOutsideClick: false,
											});
										},
										error: function (xhr) {
											const response = xhr.responseJSON;
											Swal.fire({
												"title": response
													.message,
												"text": '',
												"icon": "error",
												"confirmButtonColor": '#000',
											});
										},
										success: function (response) {
											Swal.fire({
												"title": "Success!",
												"text": response
													.message,
												"icon": "success",
												"confirmButtonColor": '#000',
											}).then((result) => {
												if (result.value) {
													participantsTable
														.draw(false)
												}
											})
										},
									});
								}
							})
						})
						$(document).on('click', '#btn-submit-absence', function (e) {
							const absence_id = $(this).attr('data-id')
							const loader = `<div style="width: 5rem; height: 5rem;" class="spinner-border mb-5" role="status"></div>
							<h5 class="mt-2">Please wait</h5>
							<p>Submiting payment...</p>`
							const $this = $(this)
							Swal.fire({
								title: `Submit payment?`,
								text: "",
								icon: 'warning',
								showCancelButton: true,
								confirmButtonColor: '#009EF7',
								cancelButtonColor: '#F1416C',
								confirmButtonText: `Yes!`
							}).then((result) => {
								if (result.value) {
									$.ajax({
										type: 'POST',
										url: base_url +
											'absences/submit_payment/' +
											absence_id,
										beforeSend: function () {
											Swal.fire({
												html: loader,
												showConfirmButton: false,
												allowEscapeKey: false,
												allowOutsideClick: false,
											});
										},
										error: function (xhr) {
											const response = xhr.responseJSON;
											Swal.fire({
												"title": response
													.message,
												"text": '',
												"icon": "error",
												"confirmButtonColor": '#000',
											});
										},
										success: function (response) {
											const pdfloader = `<div class="py-5 my-5 d-flex justify-content-center align-items-center">
																	<span class="pdf-loader"></span>
																</div>
																<h5 class="mt-2">Success!</h5>
																<p class="mb-0">${response.message}</p>`
											Swal.fire({
												"html": pdfloader,
												"showConfirmButton": true,
												"allowEscapeKey": true,
												"allowOutsideClick": true,
												"confirmButtonColor": '#000'
											}).then((result) => {
												$this.attr('disabled',
													true)
												$this.parent()
													.parent().find(
														'.small-input'
													).attr(
														'disabled',
														true)
												if (result.value) {
													$('#myModal')
														.modal('hide')
												}
												table.draw()
											});
										},
									});
								}
							})
						})
					});
			})

			$(document).on('click', '#btn-create-session', function (e) {
				const activity_code = $(this).attr('data-id')
				$.get(base_url +
					`absences/create?activity_code=${activity_code}`,
					function (html) {
						$('#myModal').html(html)
						$('#myModal').modal('show')
						const attendance_link = $('#attendance_link').val()
						initFormAjax('#absence-form', {
							error: function (xhr) {
								const response = xhr.responseJSON;
								if (response.errors) {
									for (const err in response.errors) {
										const $parent = $(`#${err.replace("[]", "")}`)
											.parent();
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
											$('#myModal').modal(
												'hide')
										}
										table.draw()
									})
									// $.ajax({
									// 	type: 'GET',
									// 	url: base_url +
									// 		'absences/save_qrcode/' + attendance_link,
									// 	success: function (response) {
									// 		Swal.fire({
									// 			"title": "Saved!",
									// 			"text": data.message,
									// 			"icon": "success",
									// 			"confirmButtonColor": '#000'
									// 		}).then((result) => {
									// 			if (result.value) {
									// 				$('#myModal').modal(
									// 					'hide')
									// 			}
									// 			table.draw()
									// 		})
									// 	},
									// });
								}
							},
						})
					});

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
