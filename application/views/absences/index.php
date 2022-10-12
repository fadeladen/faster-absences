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

								</div>
							</div>

							<!--end::Card header-->
							<!--begin::Card body-->
							<div class="card-body pt-0 mt-5">
								<!--begin::Table-->
								<table id="table" class="table gy-4"
									data-url="<?= base_url('absences/datatable') ?>">
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
		initDatatable('#table', {
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
			},{
				targets: 'requestor',
				orderable: false,
				searchable: true,
				render: function (data, _, row) {
					let avatar = ''
					if(row[7] == null) {
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
			}, {
				targets: 'action-col',
				orderable: false,
				searchable: false,
				render: function (data) {
					return `
	                   <div class="d-flex align-items-center"> 
					        <button data-id="${data}" class="btn btn-sm btn-primary btn-create">Attendant List</button>
	                   </div>
	                `
				}
			}]
		})

		$(document).on('click', '.btn-create', function (e) {
			const activity_code = $(this).attr('data-id')
			$.get(base_url +
				`absences/create?activity_code=${activity_code}`,
				function (html) {
					$('#myModal').html(html)
					$('#myModal').modal('show')
				});
				$(document).on('click', '.btn-copy-link', function (e) {
					var $temp = $("<input>");
					$("body").append($temp);
					const link = base_url + 'site/absences/' + $(this).attr('data-id')
					$(this).select();
					navigator.clipboard.writeText(link);
					showToast('Copied', 'Absence link copied to clipboard', 'success')
				})

				$(document).on('change', '#kind_of_meeting', function (e) {
					const value = $(this).val()
					if(value == 1) {
						$('.online-hybrid').removeClass('d-none')
						$('.qrcode').addClass('d-none')
					} else if(value == 2) {
						$('.qrcode').removeClass('d-none')
						$('.online-hybrid').addClass('d-none')
					} else if(value == 3) {
						$('.qrcode').removeClass('d-none')
						$('.online-hybrid').removeClass('d-none')
					}
				})
				
		})

	</script>
