<div class="modal-dialog modal-lg">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel">Create absences</h5>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		</div>
		<form show-validation="true" method="POST" action="<?= base_url('absences/store') ?>" id="absence-form">
			<input type="text" class="form-control d-none" name="code_activity" id="code_activity"
				value="<?= $activity_code ?>">
			<input type="text" class="form-control d-none" name="attendance_link" id="attendance_link"
				value="<?= $attendance_link ?>">
			<input type="text" class="form-control d-none" name="qr_file" id="qr_file"
				value="<?= $qr_file ?>">
			<div class="modal-body">
				<div class="form-group mb-3">
					<label for="actual_">Session title</label>
					<input placeholder="Enter session title" type="text" class="form-control mt-2" id="session_title"
						name="session_title">
				</div>
				<div class="form-group mb-3">
					<label for="actual_">Kind of meeting</label>
					<select name="kind_of_meeting" id="kind_of_meeting" class="form-select">
						<option value="">Select kind of meeting</option>
						<option value="1">Online</option>
						<option value="2">Offline</option>
						<option value="3">Hybrid</option>
					</select>
				</div>
				<div class="mb-3">
					<div class="form-group mb-3 row">
						<div class="col-md-6">
							<label>Valid when</label>
							<div class="row mt-2">
								<div class="col-md-8">
									<input type="date" name="valid_when_date" id="valid_when_date" class="form-control">
								</div>
								<div class="col-md-4">
									<input type="time" name="valid_when_time" id="valid_when_time" class="form-control">
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<label>Valid until</label>
							<div class="row mt-2">
								<div class="col-md-8">
									<input type="date" name="valid_until_date" id="valid_until_date"
										class="form-control">
								</div>
								<div class="col-md-4">
									<input type="time" name="valid_until_time" id="valid_until_time"
										class="form-control">
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="online-hybrid form-group mb-3 d-none">
					<label for="actual_">Meeting link</label>
					<textarea placeholder="https://example.com" name="meeting_link" id="meeting_link"
						class="form-control mt-1" rows="2"></textarea>
				</div>
				<div class="qrcode mb-3 py-4 border-top border-bottom d-none">
					<div class="row">
						<div class="col-md-6 d-flex justify-content-center align-items-center">
							<img id="qr_code_image"
								src="<?= base_url('absences/qrcode/') . $attendance_link . '?size=3' ?>" alt="">
						</div>
						<div class="col-md-6">
							<div class="d-flex justify-content-center h-100 flex-column">
								<!-- <a id="qr_link" href="#" data-url="<?= base_url('absences/qrcode/') . $attendance_link ?>"
									class="link-primary btn-copy-qr">
									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
										class="bi bi-paperclip" viewBox="0 0 16 16">
										<path
											d="M4.5 3a2.5 2.5 0 0 1 5 0v9a1.5 1.5 0 0 1-3 0V5a.5.5 0 0 1 1 0v7a.5.5 0 0 0 1 0V3a1.5 1.5 0 1 0-3 0v9a2.5 2.5 0 0 0 5 0V5a.5.5 0 0 1 1 0v7a3.5 3.5 0 1 1-7 0V3z" />
									</svg>
									Copy QR Code
								</a> -->
								<a id="qr_pdf" target="_blank"
									href="<?= base_url('absences/qrcode/') . $attendance_link ?>"
									class="link-danger d-flex align-items-center">
									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
										class="bi bi-download" viewBox="0 0 16 16">
										<path
											d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
										<path
											d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z" />
									</svg>
									<span class="ms-2">
										Download PDF
									</span>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Submit</button>
			</div>
		</form>
	</div>
</div>
