<page>
	<style>
		*,
		p,
		td,
		th {
			font-size: 12px;
		}

		.table {
			border-collapse: collapse;
			width: 100%;
		}

		.table td,
		.table th {
			font-size: 12px;
			border: 1px solid;
			padding-top: 4px;
			padding-bottom: 4px;
			padding-left: 3px;
			padding-right: 3px;
		}

		.table-no-border,
		.table-no-border td {
			border: none;
			border-collapse: collapse;
			padding: 5px !important;
		}

		table th {
			text-align: center;
		}

	</style>
	<img src="<?php echo FCPATH . 'assets/images/logos/FHI_360.png' ?>" style='width:120px;position:absolute;left:0px'>

	<br>
	<p style="font-weight: bold; font-size: 18px">Participants List</p>
	<p style="font-size: 14px; margin: 0;">Activity: <?= $detail['activity'] ?></p>
	<p style="font-size: 14px; margin: 0; margin-top: 5px;">Session: <?= $detail['session_title'] ?></p>
	<br>
	<table class="table" style="width: 100%; margin-left: -5px">
		<tr>
			<th style="width: 5%">No</th>
			<th style="width: 20%">Name</th>
			<th style="width: 25%">Organization</th>
			<th style="width: 20%">Email</th>
			<th style="width: 15%">Payment Method</th>
			<th style="width: 15%">Reimbursement</th>
		</tr>
		<?php $no = 1; foreach($participants as $par): ?>
		<tr style="background: #e8e8e8">
			<td style="text-align: center"><?= $no++ ?></td>
			<td>
				<p style="margin: 0; margin-bottom: 3px;">
					<?= $par->nama_peserta ?>
				</p>
				<p style="margin: 0;">
					<?= $par->jenis_kelamin ?>
				</p>
			</td>
			<td>
				<p style="margin: 0; margin-bottom: 3px;">
					<?= $par->asal_layanan ?>
				</p>
				<p style="margin: 0;">
					<?= $par->nama_lembaga ?>
				</p>
			</td>
			<td><?= $par->email_peserta ?></td>
			<td>
				<?php if ($par->payment_method == 1): ?>
				<p style="margin: 0; margin-bottom: 2px;">
					OVO
				</p>
				<p style="margin: 0;">
					<?= $par->ovo_number ?>
				</p>
				<?php elseif ($par->payment_method == 2): ?>
				<p style="margin: 0; margin-bottom: 2px;">
					GOPAY
				</p>
				<p style="margin: 0;">
					<?= $par->gopay_number ?>
				</p>
				<?php else: ?>

				<p style="margin: 0; margin-bottom: 2px;">
					Bank <?= $par->bank_name ?>
				</p>
				<p style="margin: 0;">
					<?= $par->bank_number ?>
				</p>

				<?php endif; ?>
			</td>
			<td style="text-align: right"><?= $par->total ?></td>
		</tr>
		<tr>
			<td colspan="6">
				<table class="table" style="width: 100%; margin-left: 0px; margin-top: -5px; margin-bottom: -5px">
					<tr>
						<td
							style="width: 50%; vertical-align: top; border-top: none; border-bottom: none; border-right:none; border-left: none; text-align: center">
							<p style="margin-bottom: 5px;">Consumption Receipt</p>
							<table class="table-no-border">
								<tr>
									<td style="width: 100%;">
										<?php if ($par->resi_konsumsi != NULL): ?>
											<img style="max-width: 350px; max-height: 200px;"
												src="<?= $_ENV['ASSETS_URL'] . $par->resi_konsumsi . '?subfolder=resi_konsumsi&token=' .  $_ENV['ASSETS_TOKEN'] ?>">
										<?php endif; ?>
										<!-- <img style="max-width: 350px; max-height: 200px;"
											src="<?= base_url('assets/images/sample1.jpg') ?>"> -->
									</td>
								</tr>
								<br>
							</table>
						</td>
						<td
							style="width: 50%; vertical-align: top; border-top: none; border-bottom: none; border-left: none; border-right: none; text-align: center">
							<p style="margin-bottom: 5px;">Transfer Receipt</p>
							<table class="table-no-border">
								<tr>
									<td style="width: 100%;">
										<?php if ($par->transfer_receipt != NULL): ?>
												<img style="max-width: 300px; max-height: 200px;"
													src="<?= $_ENV['ASSETS_URL'] . $par->transfer_receipt . '?subfolder=transfer_receipt&token=' .  $_ENV['ASSETS_TOKEN'] ?>">
										<?php endif; ?>
										<!-- <img style="max-width: 350px; max-height: 200px;"
											src="<?= base_url('assets/images/sample2.jpg') ?>"> -->
									</td>
								</tr>
								<br>
							</table>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<?php endforeach; ?>
	</table>

	<br><br><br><br><br>

	<div style="text-align: center">
		<p style="margin: 0px; font-size: 14px; margin-top: 3px"><?= $detail['pa_purpose'] ?></p>
		<br>
		<p style="margin: 0px; font-size: 16px; font-weight: bold; text-decoration: underline"><?= $detail['pa_name'] ?>
		</p>
	</div>
</page>
