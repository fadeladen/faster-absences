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
										class="card-label fw-bolder fs-3 mb-1">Internet, local transport & fee</span>
									<span class="text-muted mt-1 fw-bold fs-7"></span>
								</h3>
								<div class="card-toolbar">
									<a class="btn btn-primary" href="<?= base_url('absences') ?>">
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
							<div class="card-body pt-0 mt-5">
								<!--begin::Table-->
								<table id="table" class="table gy-4"
									data-url="<?= base_url('absences/absences_datatable') ?>">
									<!--begin::Table head-->
									<thead>
										<tr class="text-start fw-bolder fs-7 text-uppercase bg-lighten">
											<th class="numbers-col">Advance number</th>
											<th>Activity</th>
											<th class="receipt">Participants</th>
											<th>Local Transport</th>
											<th>Internet</th>
											<th class="download-col">Download</th>
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
                            <p class="text-dark fw-bold">${data}</p>
	                   </div>
	                `
				}
			}, {
				targets: 'download-col',
				orderable: false,
				searchable: false,
				render: function (data, _, row) {
					return `<a href="#" class="btn btn-danger btn-sm">
								<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
									<path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
									<path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
								</svg>
								<span class="ms-1">
									PDF
								</span>
							</a>`
				}
			}, {
				targets: 'old-receipt',
				orderable: false,
				searchable: false,
				render: function (data, _, row) {
					return `
                            <a href="#" data-id="${data}" class="link-primary btn-participants d-flex align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-people" viewBox="0 0 16 16">
                            <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0zM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816zM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275zM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4z"/>
                            </svg>
                            <span class="ms-2">
                                See participants
                            </span>
                                </a>
                                `
				}
			}, {
				targets: 'receipt',
				orderable: false,
				searchable: false,
				render: function (data, _, row) {
					return `
                            <a href="${base_url}absences/participants/${data}" class="link-primary d-flex align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-people" viewBox="0 0 16 16">
                            <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0zM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816zM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275zM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4z"/>
                            </svg>
                            <span class="ms-2">
                                See participants
                            </span>
                                </a>
                                `
				}
			}, {
				targets: 'action-col',
				orderable: false,
				searchable: false,
				render: function (data) {
					return `
	                   <div class="d-flex align-items-center"> 
					        <button data-id="${data}" class="btn btn-sm btn-primary btn-create">Submit reimbursement</button>
	                   </div>
	                `
				}
			}]
		})
		$(document).on('click', '.btn-copy-link', function (e) {
			var $temp = $("<input>");
			$("body").append($temp);
			const link = base_url + 'site/absences/' + $(this).attr('data-id')
			$(this).select();
			navigator.clipboard.writeText(link);
			showToast('Copied', 'Absence link copied to clipboard', 'success')
		})

	</script>
