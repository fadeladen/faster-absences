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
									<!-- <a class="btn btn-primary" href="<?= base_url('absences/data') ?>">
										<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
											fill="currentColor" class="bi bi-list-ul" viewBox="0 0 16 16">
											<path fill-rule="evenodd"
												d="M5 11.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm-3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm0 4a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm0 4a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
										</svg>
										<span class="ms-1">
											Internet, local transport & fee
										</span>
									</a> -->
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
											<th style="width: 300px;">Activity</th>
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
				[4, 'asc']
			],
			columnDefs: [{
				targets: [2],
				orderable: true,
				searchable: false,
			}, {
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
			}, {
				targets: 'numbers-col',
				orderable: false,
				searchable: true,
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
					return `<div class="d-flex align-items-center">
								<div>
									<div class="fw-bolder text-gray-800 fs-5">
										${data}
									</div>
									<div style="font-size: 16px; !important" class="text-gray-600 d-flex flex-column">
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

	</script>
