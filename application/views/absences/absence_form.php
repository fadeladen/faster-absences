<div style="background-color: #1e1e2d; padding-top: 5rem; padding-bottom: 13rem;" class="d-flex px-5">
	<div class="shadow-sm mx-auto rounded bg-white py-5 px-3 m col-xl-7">
		<div class="text-center pb-3 mb-2 border-bottom">
			<h1 class="mb-5">Formulir absensi dan konsumsi</h1>
			<h4><?= $detail['activity'] ?></h4>
		</div>
		<div class="pb-3 mb-5 border-bottom">
			<p>Bapak/Ibu yang mengikuti kegiatan ini dapat melakukan reimbursement makan siang dengan
				mengisi form reimbursement berikut dengan lengkap..</p>

			<p>
				Makan Siang<br />
				Peserta diperbolehkan untuk memesan makan siang masing-masing menggunakan ojek online
				atau pemesanan di restauran/rumah makan dan kemudian melakukan reimburse, dengan batasan
				sebagai berikut:<br />
				1. Jika kegiatan kurang dari dua jam tidak mendapatkan penggatian snack atau makan
				siang.<br />
				2. Jika kegiatan lebih dari 2-4 jam maksimal Rp. 25.000/orang <br />
				3. jika kegiatan lebih dari 4- 6 jam maksimal Rp 60.000/orang<br />
				4. Jika lebih dari 6 jam, maksima Rp. 85.000/orang (makan siang, snack, dan biaya
				pengiriman) <br /><br />

				Peserta haris melampirkan resi pemesanan melalui Form berikut sampai pukul 23.59 WIB
				pada hari kegiatan berlangsung. <br />

				Resi pembelian konsumsi berupa resi pembelian melalui jasa ojek online (ie.
				Grabfood/Go-Food) ataupun resi pembelian langsung di restoran/kedai. Untuk resi
				pembelian di restoran/kedai, mohon dipastikan tertera informasi nama restoran, tanggal
				yang sama dengan pelaksanaan kegiatan, lokasi restoran/kedai harus sama dengan domisili
				Bapak/Ibu saat ini, alamat atapun kontak restoran/kedai tersebut.

				<br />Terima kasih
			</p>
		</div>
		<form method="POST" action="<?= base_url('site/consultant_registration/store') ?>" id="registration-form">
			<input class="d-none" type="text" value="<?= $detail['code_activity'] ?>" name="code_activity"
				id="code_activity">
			<input class="d-none" type="text" value="<?= $detail['absence_id'] ?>" name="absence_id"
				id="request_number">
			<div class="modal-body">
				<div class="row">
					<div class="form-group col-md-6 mb-3">
						<label for="name">Name of consultant</label>
						<input placeholder="Enter name" type="text" class="form-control" name="name" id="name">
					</div>
					<div class="form-group col-md-6 mb-3">
						<label for="email">Email</label>
						<input placeholder="Enter email" type="text" class="form-control" name="email" id="email">
					</div>
					<div class="form-group col-md-6 mb-3">
						<label for="address">Home address</label>
						<input placeholder="Enter address" type="text" class="form-control" name="address" id="address">
					</div>
					<div class="form-group col-md-6 mb-3">
						<label for="phone_number">Phone/Mobile number</label>
						<input placeholder="Enter phone number" type="text" class="form-control" name="phone_number"
							id="phone_number">
					</div>
					<div class="form-group col-md-6 mb-3">
						<label for="cover_letter">Upload cover letter</label>
						<input type="file" class="form-control" name="cover_letter_file" id="cover_letter_file">
						<input type="text" class="form-control field-value d-none" name="cover_letter"
							id="cover_letter">
						<small class="my-2 upload-notif"></small>
					</div>
					<div class="form-group col-md-6 mb-3">
						<label for="cv">Upload CV/Resume</label>
						<input type="file" class="form-control" name="cv_file" id="cv_file">
						<input type="text" class="form-control field-value d-none" name="cv" id="cv">
						<small class="my-2 upload-notif"></small>
					</div>
					<div class="form-group col-md-6 mb-3">
						<label for="daily_rate">Daily rate expexted</label>
						<input placeholder="Enter daily rate" type="text" class="form-control" name="daily_rate"
							id="daily_rate">
					</div>
					<div class="d-grid gap-2">
						<button class="btn btn-primary" type="submit">Submit</button>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>

<script>
	$(document).ready(function () {
		$('#lodging, #').number(true, 0, '', '.');
		const asset_url = "<?= $_ENV['ASSETS_URL'] ?>"
		const loader = `<div style="width: 5rem; height: 5rem;" class="spinner-border mb-5" role="status"></div>
				<h5 class="mt-2">Please wait</h5>
				<p>Saving data...</p>`;

		$("#reimbursement_receipt").on("change", function () {
			var $this = $(this);
			var form = new FormData();
			form.append("file", $this[0].files[0]);
			$.ajax({
				url: asset_url + 'reimbursement_receipt',
				type: "POST",
				data: form,
				cache: false,
				contentType: false,
				processData: false,
				dataType: 'json',
				beforeSend: function (request) {
					request.setRequestHeader("token", "<?= $_ENV['ASSETS_TOKEN'] ?>");
					$this.parent().find('.upload-notif').text('Uploading ..., please wait!')
				},
				error: function (xhr) {
					const response = xhr.responseJSON;
					console.log(response)
					$this.parent().find('.upload-notif').text('Failed to upload file!')
						.addClass('text-danger')
					$this.val(null);
					$this.parent().find('.field-value').val('')
				},
				success: function (response) {
					if (response.status === true) {
						const filename = response.data.filename
						$this.parent().find('.field-value').val(filename)
						$this.parent().find('.upload-notif').text('File has been uploaded!')
							.addClass('text-success')
					} else {
						$this.parent().find('.field-value').val('')
						$this.val(null);
						$this.parent().find('.upload-notif').text('Failed to upload file!')
							.addClass('text-danger')
					}
				},
			});
		})

		initFormAjax('#registration-form', {
			beforeSend: function () {
				$(".form-control").removeClass("is-invalid")
				$('.upload-notif').text('').removeClass('text-danger')
				$('.invalid-feedback').remove()
				Swal.fire({
					html: loader,
					showConfirmButton: false,
					allowEscapeKey: false,
					allowOutsideClick: false,
				});
			},
			error: function (xhr) {
				const response = xhr.responseJSON;
				if (response.errors) {
					for (const err in response.errors) {
						const $parent = $(
							`#${err.replace("[]", "")}`
						).parent();
						$(`#${err.replace("[]", "")}`)
							.addClass("is-invalid");
						if ($parent.find(
								"invalid-feeedback")
							.length == 0) {
							$parent.append(
								`<div class="invalid-feedback">${response.errors[err]}</div>`
							);
						}
					}
				}
				Swal.fire({
					"title": response.message,
					"text": '',
					"icon": "error",
					"confirmButtonColor": '#000',
				});
			},
			success: function (data) {
				Swal.fire({
					"title": "Saved!",
					"text": data.message,
					"icon": "success",
					"confirmButtonClass": "btn btn-primary"
				}).then((result) => {
					if (result.value) {
						window.close()
					}
				})
			}
		})
	})

</script>
