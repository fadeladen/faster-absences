<script src="<?= site_url('assets/js/bootstrap.bundle.js') ?>"></script>
<script src="<?= site_url('assets/js/app.js?v=' . ASSETS_VERSION) ?>"></script>
<script src="<?= site_url('assets/vendors/jquery-number/jquery.number.min.js') ?>" type="text/javascript"></script>


<style>
	.tbody tr td {
		border-color: #eff2f5 !important;
		border-bottom: 1px !important;
	}

</style>
<div class="modal-dialog modal-xl">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel">Participants list (<?= $detail['session_title'] ?>)</h5>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		</div>
		<div class="modal-body">
			<input type="text" class="d-none" value="<?= $detail['is_submitted'] ?>" id="is_submitted">
			<table id="participants-table" class="table gy-4 table-hover"
				data-url="<?= base_url('absences/participants_datatable/') . $detail['absence_id']  ?>">
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
							<?= $total['total_konsumsi'] ?>
						</td>
						<td id="total_internet" class="text-danger text-center">
							<?= $total['total_internet'] ?>
						</td>
						<td id="total_other" class="text-danger text-center">
							<?= $total['total_other'] ?>
						</td>
						<td id="total_all" class="text-danger text-center">
							<?= $total['total'] ?>
						</td>
					</tr>
				</tfoot>
			</table>
		</div>
		<div class="modal-footer">
			<button <?= $detail['is_submitted'] == 1 ? 'disabled' : '' ?> id="btn-submit-absence" class="btn btn-primary" type="button"
				data-id="<?= $detail['absence_id'] ?>">
				<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-send"
					viewBox="0 0 16 16">
					<path
						d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576 6.636 10.07Zm6.787-8.201L1.591 6.602l4.339 2.76 7.494-7.493Z" />
				</svg>
				<span class="ms-1">
					Submit
				</span>
			</button>
			<a class="btn btn-danger" target="_blank"
				href="<?= base_url('site/documents/participants_list_by_session/') . encrypt($detail['absence_id']) ?>">
				<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
					class="bi bi-download" viewBox="0 0 16 16">
					<path
						d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
					<path
						d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z" />
				</svg>
				<span class="ms-1">
					Download PDF
				</span>
			</a>
			<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
		</div>
	</div>
</div>
