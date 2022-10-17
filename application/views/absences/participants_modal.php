<script src="<?= site_url('assets/js/app.js?v=' . ASSETS_VERSION) ?>"></script>
<style>
    .tbody tr td {
        border-color: #eff2f5 !important; border-bottom: 1px !important;
    }
</style>
<div class="modal-dialog modal-xl">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel">Participants list (<?= $code_activity ?>)</h5>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		</div>
		<div class="modal-body">
			<table id="participants-table" class="table gy-4"
				data-url="<?= base_url('absences/participants_datatable/') . $code_activity  ?>">
				<thead>
					<tr>
						<th rowspan='2'>Name</th>
						<th rowspan='2'>Gender</th>
						<th rowspan='2'>Organization</th>
						<th rowspan='2'>Email</th>
						<th rowspan='2'>Payment Method</th>
						<th style="text-align: center;" colspan='4'>Reimbursement</th>
						<th class="consumption-receipt" rowspan='2'>Consumption Receipt</th>
						<th class="transfer-receipt"  rowspan='2'>Transfer Receipt</th>
						<th class="action-col" rowspan='2'>Action</th>
					</tr>
					<tr>
						<th>Meal</th>
						<th>Internet</th>
						<th>Other</th>
						<th>Total</th>
					</tr>
				</thead>
				<tbody class="text-gray-600">

				</tbody>
				<!--end::Table body-->
				<tfoot>
					<tr style="padding-right: 2rem">
						<td colspan="5" style="text-align: right;">Total :</td>
						<td class="total text-danger" style="text-align: right;">150.000</td>
						<td class="total_internet text-danger">
							250.000
						</td>
						<td class="total_other text-danger">
							50.000
						</td>
						<td class="grand_total text-danger">
							450.000
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
