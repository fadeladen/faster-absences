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
											<th class="receipt">Participant Receipt</th>
											<th>Local Transport</th>
											<th>Internet</th>
											<th>Download</th>
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
                            <p class="text-primary fw-bold">${data}</p>
	                   </div>
	                `
				}
			}, {
				targets: 'receipt',
				orderable: false,
				searchable: false,
				render: function (data, _, row) {
					return `
                            <a href="#" data-id="${data}" class="text-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-people" viewBox="0 0 16 16">
                            <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0zM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816zM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275zM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4z"/>
                            </svg>
                            <span>
                                See receipt
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
