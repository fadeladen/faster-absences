<style>
	#participants-table thead th {
		border: 1px solid #eff2f5 !important;
	}

	.container-xxl {
		max-width: 1400px !important;
	}

	.small-file-upload {
		font-size: 11px !important;
		display: inline-block;
		width: 5.7rem;
		padding: 5px;
	}

</style>

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
								<h3 class="card-title align-items-start flex-column">
									<span class="card-label fw-bolder fs-3 mb-1">Participants list
										(<?= $detail['advance_number'] ?>)</span>
									<span class="text-muted mt-1 fw-bold fs-7"><?= $detail['activity'] ?></span>
									<input type="text" class="d-none" value="<?= $detail['code_activity'] ?>"
										id="code_activity">
								</h3>
								<div class="card-toolbar">
									<a class="btn btn-primary" href="<?= base_url('absences/data') ?>">
										<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
											fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
											<path fill-rule="evenodd"
												d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
										</svg>
										<span class="ms-1">
											Back to internet & fee
										</span>
									</a>
								</div>
							</div>

							<!--end::Card header-->
							<!--begin::Card body-->
							<div class="card-body pt-0 mt-5">
								<!--begin::Table-->
								<table id="participants-table" class="table gy-4 table-hover"
									data-url="<?= base_url('absences/participants_datatable/') . $detail['code_activity']  ?>">
									<thead>
										<tr>
											<th class="text-center" rowspan='2'>No</th>
											<th rowspan='2'>Name</th>
											<th rowspan='2'>Gender</th>
											<th class="organization-col" rowspan='2'>Organization</th>
											<th class="email-col" rowspan='2'>Email</th>
											<th class="payment-col" rowspan='2'>Payment Method</th>
											<th style="text-align: center;" colspan='4'>Reimbursement</th>
											<th class="consumption-receipt" rowspan='2'>Consumption Receipt</th>
											<th class="transfer-receipt" rowspan='2'>Transfer Receipt</th>
											<th class="action-col" rowspan='2'>Action</th>
										</tr>
										<tr>
											<th class="meal-col">Meal</th>
											<th class="internet-col">Internet</th>
											<th class="other-col">Other</th>
											<th class="total-col">Total</th>
										</tr>
									</thead>
									<tbody class="text-gray-600">

									</tbody>
									<!--end::Table body-->
									<tfoot>
										<tr style="padding-right: 2rem">
											<td colspan="6" style="text-align: right;">Total :</td>
											<td id="total_meal" class="text-danger text-center">

											</td>
											<td id="total_internet" class="text-danger text-center">

											</td>
											<td id="total_other" class="text-danger text-center">

											</td>
											<td id="total_all" class="text-danger text-center">

											</td>
										</tr>
									</tfoot>
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
		const assets_url = "<?= $_ENV['ASSETS_URL'] ?>"
		const assets_token = "<?= $_ENV['ASSETS_TOKEN'] ?>"
		const participantsTable = initDatatable('#participants-table', {
			order: [
				[0, 'desc']
			],
			columnDefs: [{
					targets: [0],
					render: function (data, _, row, meta) {
						return meta.row + meta.settings._iDisplayStart + 1;
					}
				}, {
					targets: [1, 2, 4],
					render: function (data, _, row) {
						return `<div style="width: 80px !important; font-size: 12px;">${data}</div>`
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
					targets: ['meal-col'],
					orderable: false,
					searchable: false,
					render: function (data, _, row) {
						return `<input type="text" data-field="jumlah_konsumsi" value="${data}" class="form-control meal-input small-input" data-id="${row[18]}">`
					}
				}, {
					targets: ['internet-col'],
					orderable: false,
					searchable: false,
					render: function (data, _, row) {
						return `<input type="text" data-field="jumlah_internet" value="${data}" class="form-control internet-input small-input" data-id="${row[18]}">`
					}
				}, {
					targets: ['other-col'],
					orderable: false,
					searchable: false,
					render: function (data, _, row) {
						return `<input type="text" data-field="jumlah_other" value="${data}" class="form-control other-input small-input" data-id="${row[18]}">`
					}
				}, {
					targets: ['total-col'],
					orderable: false,
					searchable: false,
					render: function (data, _, row) {
						return `<input type="text" value="${data}" class="form-control total-input small-input" disabled data-id="${row[18]}">`
					}
				}, {
					targets: 'payment-col',
					render: function (data, _, row) {
						const ovo = row[11]
						const gopay = row[12]
						const bank_name = row[13]
						const bank_number = row[14]
						let text = 'OVO'
						let number = ovo
						if (row[5] == '2') {
							text = 'GOPAY'
							number = gopay
						} else if (row[5] == '3') {
							text = 'Bank ' + bank_name
							number = bank_number
						}
						return `<div style="width: 80px !important;">
                                   <p class="mb-1 fw-bold fs-7">${text}</p>
                                  <p>${number}</p>
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
						if (!receipt || receipt == '' || receipt == null) {
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
						if (!receipt || receipt == '' || receipt == null) {
							uploadBtn = ''
							receiptDetail = 'd-none'
						}
						return `<div style="width: 95px !important;" class="d-flex flex-column">
                                        <div class="transfer-receipt-container ${receiptDetail}">
                                            <a href="<?= $_ENV['ASSETS_URL'] ?>${row[15]}?subfolder=transfer_receipt&token=<?= $_ENV['ASSETS_TOKEN'] ?>" target="_blank" class="link-primary d-flex align-items-center transfer-receipt-image">
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
				},
				{
					targets: 'action-col',
					orderable: false,
					searchable: false,
					render: function (data, _, row) {
						let disabled = ''
						if(row[19] == 1 || row[15] == null || row[10] == null || !row[10 || !row[15]]) {
							disabled = 'disabled'
						}
						return `
							   <div style="width: 60px !important;" class="d-flex align-items-center"> 
									<button ${disabled} data-id="${row[18]}" class="btn btn-xs btn-primary btn-send-email">Submit</button>
							   </div>
							`
					}
				}
			]
		})
		$(document).ready(function (e) {
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
					success: function (response) {
						console.log(response)
					},
				});
			}
			const codeActivity = $('#code_activity').val()
			const updateTotalField = () => {
				$.ajax({
					type: 'GET',
					url: base_url + 'absences/get_total_participants_reimbursement/' + codeActivity,
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
			updateTotalField()
			$('.small-input').number(true, 0, '', '.')
			$(document).on('click', '.change-transfer-receipt', function (e) {
				const $this = $(this)
				const receiptDetail = $this.parent()
				receiptDetail.addClass('d-none')
				const fileUpload = $this.parent().parent().find('.transfer-file-upload')
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
						$this.parent().find('.upload-notif').text('Uploading...!')
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
							updateParticipantData(id, filename, 'transfer_receipt')
							$this.parent().find('.upload-notif').text(
									'Receipt has been uploaded!')
								.addClass('text-success')
							$this.parent().addClass('d-none')
							$this.parent().parent().parent().parent().find('.btn-send-email').attr('disabled', false)
							const receiptContainer = $this.parent().parent().find(
								'.transfer-receipt-container')
							receiptContainer.removeClass('d-none')
							receiptContainer.find('.transfer-receipt-image').attr('href',
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
						$this.parent().find('.upload-notif').text('Uploading...!')
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
							updateParticipantData(id, filename, 'resi_konsumsi')
							$this.parent().find('.upload-notif').text(
									'Receipt has been uploaded!')
								.addClass('text-success')
							$this.parent().addClass('d-none')
							$this.parent().parent().parent().parent().find('.btn-send-email').attr('disabled', false)
							const receiptContainer = $this.parent().parent().find(
								'.meal-receipt-container')
							receiptContainer.removeClass('d-none')
							receiptContainer.find('.meal-receipt-image').attr('href',
								`<?= $_ENV['ASSETS_URL'] ?>${filename}?subfolder=resi_konsumsi&token=<?= $_ENV['ASSETS_TOKEN'] ?>`
							)
						}
					},
				});
			})
			$(document).on("keyup", '.meal-input, .other-input, .internet-input', function () {
				const $this = $(this)
				const value = $(this).val()
				const field = $(this).attr('data-field')
				const id = $(this).attr('data-id')
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
							$this.parent().parent().find('.total-input').val(response.data.total)
							updateTotalField()
						}
					},
				});
			})
			$(document).on("click", '.btn-send-email', function () {
				const $this = $(this)
				const id = $(this).attr('data-id')
				const loader = `<div style="width: 5rem; height: 5rem;" class="spinner-border mb-5" role="status"></div>
				<h5 class="mt-2">Please wait</h5>
				<p>Sending email to participant...</p>	`
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
							url: base_url + 'absences/submit_participant_reimbursement/' + id,
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
									"title": response.message,
									"text": '',
									"icon": "error",
									"confirmButtonColor": '#000',
								});
							},
							success: function (response) {
								Swal.fire({
									"title": "Success!",
									"text": response.message,
									"icon": "success",
									"confirmButtonColor": '#000',
								}).then((result) => {
									if (result.value) {
										participantsTable.draw(false)
									}
								})
							},
						});
					}
				})
			})
		})

	</script>
