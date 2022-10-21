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
			<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
		</div>
	</div>
</div>