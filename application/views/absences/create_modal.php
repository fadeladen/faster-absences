<div class="modal-dialog modal-lg">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel">Create absences</h5>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		</div>
		<form show-validation="true" method="POST" action="<?= base_url('absences/store') ?>" id="absence-form">
			<input type="text" class="form-control d-none" name="code_activity" id="code_activity"
				value="<?= $activity_code ?>">
			<div class="modal-body">
				<div class="form-group mb-3">
					<label for="actual_">Activity code</label>
					<input type="text" class="form-control mt-2" disabled value="<?= $activity_code ?>">
				</div>
				<div class="form-group mb-3">
					<label for="actual_">Actual date of activity</label>
					<div class="row mt-2">
						<div class="col-md-6">
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text" id="inputGroup-sizing-default">Start</span>
								</div>
								<input type="date" class="form-control" name="start_date" id="start_date">
							</div>
						</div>
						<div class="col-md-6">
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text" id="inputGroup-sizing-default">End</span>
								</div>
								<input type="date" class="form-control" id="end_date" name="end_date">
							</div>
						</div>
					</div>
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
				<div class="online-hybrid mb-3 d-none">
					<div class="form-group mb-3">
						<label for="actual_">Absence link</label>
						<div class="d-flex justify-content-between align-items-center mb-3">
							<input style="width: 85%;" type="text" class="form-control" disabled
								value="<?= base_url('site/absences/') . $activity_code ?>">
							<div style="width: 15%;" class="d-flex justify-content-end">
								<a href="#" data-id="<?= $activity_code ?>" class="link-primary btn-copy-link">
									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
										class="bi bi-paperclip" viewBox="0 0 16 16">
										<path
											d="M4.5 3a2.5 2.5 0 0 1 5 0v9a1.5 1.5 0 0 1-3 0V5a.5.5 0 0 1 1 0v7a.5.5 0 0 0 1 0V3a1.5 1.5 0 1 0-3 0v9a2.5 2.5 0 0 0 5 0V5a.5.5 0 0 1 1 0v7a3.5 3.5 0 1 1-7 0V3z" />
									</svg>
									Copy link
								</a>
							</div>
						</div>
					</div>
					<div class="form-group mb-3">
						<label for="actual_">Meeting link</label>
						<textarea name="meeting_link" id="meeting_link" class="form-control" rows="2"></textarea>
					</div>
					<div class="form-group mb-3">
						<label>Valid until</label>
						<div class="row mt-2">
							<div class="col-md-6">
								<input type="date" name="valid_date" id="valid_date" class="form-control">
							</div>
							<div class="col-md-6">
								<input type="time" name="valid_time" id="valid_time" class="form-control">
							</div>
						</div>
					</div>
				</div>
				<div class="qrcode mb-3 py-4 border-top border-bottom d-none">
					<div class="row">
						<div class="col-md-6 d-flex justify-content-center align-items-center">
							<svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor"
								class="bi bi-qr-code" viewBox="0 0 16 16">
								<path d="M2 2h2v2H2V2Z" />
								<path d="M6 0v6H0V0h6ZM5 1H1v4h4V1ZM4 12H2v2h2v-2Z" />
								<path d="M6 10v6H0v-6h6Zm-5 1v4h4v-4H1Zm11-9h2v2h-2V2Z" />
								<path
									d="M10 0v6h6V0h-6Zm5 1v4h-4V1h4ZM8 1V0h1v2H8v2H7V1h1Zm0 5V4h1v2H8ZM6 8V7h1V6h1v2h1V7h5v1h-4v1H7V8H6Zm0 0v1H2V8H1v1H0V7h3v1h3Zm10 1h-1V7h1v2Zm-1 0h-1v2h2v-1h-1V9Zm-4 0h2v1h-1v1h-1V9Zm2 3v-1h-1v1h-1v1H9v1h3v-2h1Zm0 0h3v1h-2v1h-1v-2Zm-4-1v1h1v-2H7v1h2Z" />
								<path d="M7 12h1v3h4v1H7v-4Zm9 2v2h-3v-1h2v-1h1Z" />
							</svg>
						</div>
						<div class="col-md-6">
							<a href="#" data-id="<?= $activity_code ?>" class="link-primary btn-copy-qr">
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
									class="bi bi-paperclip" viewBox="0 0 16 16">
									<path
										d="M4.5 3a2.5 2.5 0 0 1 5 0v9a1.5 1.5 0 0 1-3 0V5a.5.5 0 0 1 1 0v7a.5.5 0 0 0 1 0V3a1.5 1.5 0 1 0-3 0v9a2.5 2.5 0 0 0 5 0V5a.5.5 0 0 1 1 0v7a3.5 3.5 0 1 1-7 0V3z" />
								</svg>
								Copy QR Code
							</a>
							<br> <br>
							<a href="#" class="link-danger">
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
									class="bi bi-download" viewBox="0 0 16 16">
									<path
										d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
									<path
										d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z" />
								</svg>
								Download PDF
							</a>
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
