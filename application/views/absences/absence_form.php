<div style="background-color: #1e1e2d; padding-top: 3rem; padding-bottom: 13rem; min-height: 58rem;" class="d-flex flex-column px-5">
	<div class="d-flex justify-content-center align-items-center mb-5 pb-3">
		<img style="width: 15rem; height: auto;" src="<?= base_url('assets/images/logos/faster_v2.png') ?>" alt="">
	</div>
	<div class="shadow-sm mx-auto rounded bg-white py-5 m col-xl-7">
		<div id="content">
			<div class="text-center pb-3 mb-2 border-bottom">
				<h3 class="mb-5 pt-3">Formulir absensi dan konsumsi</h3>
				<h1><?= $detail['activity'] ?></h1>
			</div>
			<div class="py-3 px-5 mb-2 border-bottom">
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
			<form method="POST" action="<?= base_url('site/absences/store') ?>"
				id="attendance-form">
				<input class="d-none" type="text" value="<?= $detail['code_activity'] ?>" name="code_activity" id="code_activity">
				<input class="d-none" type="text" value="<?= $detail['absence_id'] ?>" name="absence_id" id="absence_id">
				<div class="modal-body">
					<div class="row">
						<div class="form-group col-12 mb-3">
							<label class="fw-bolder" for="nama_peserta">Nama peserta</label>
							<input placeholder="Masukkan nama" type="text" class="form-control mt-2" name="nama_peserta"
								id="nama_peserta">
						</div>
						<div class="form-group col-12 mb-3">
							<label class="fw-bolder" for="jenis_kelamin">Jenis kelamin</label>
							<br>
							<div id="jenis_kelamin">
								<div class="form-check form-check-inline mt-4">
									<input class="form-check-input" type="radio" name="jenis_kelamin" id="inlineRadio1"
										value="1">
									<label class="form-check-label" for="inlineRadio1">Laki-laki</label>
								</div>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="jenis_kelamin" id="inlineRadio2"
										value="2">
									<label class="form-check-label" for="inlineRadio2">Perempuan</label>
								</div>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="jenis_kelamin" id="inlineRadio3"
										value="3">
									<label class="form-check-label" for="inlineRadio3">Transgender</label>
								</div>
							</div>
						</div>
						<div class="form-group col-12 mb-3">
							<label class="fw-bolder">Instansi/Organisasi</label>
							<select name="asal_layanan" id="asal_layanan" class="form-select mt-2">
								<option value="">Pilih instansi/organisasi</option>
								<option value="Layanan Kesehatan">Layanan Kesehatan</option>
								<option value="CSO/LSM">CSO/LSM</option>
								<option value="Instansi Pemerintah">Instansi Pemerintah</option>
								<option value="Kementrian/Lembaga">Kementrian/Lembaga</option>
								<option value="Donor">Donor</option>
								<option value="epic">EpiC (Staff / Konsultan)</option>
								<option value="Lainnya">Lainnya</option>
							</select>
						</div>
						<div class="form-group col-12 mb-3">
							<label class="fw-bolder" for="nama_lembaga">Nama lembaga</label>
							<textarea placeholder="Masukkan nama lembaga" type="text" class="form-control mt-2"
								name="nama_lembaga" id="nama_lembaga"></textarea>
						</div>
						<div class="form-group col-12 mb-3">
							<label class="fw-bolder" for="phone_number">No HP/WhatsApp</label>
							<input placeholder="Masukkan no hp" type="text" class="form-control" name="phone_number"
								id="phone_number">
						</div>
						<div class="form-group col-12 mb-3">
							<label class="fw-bolder" for="email">Email</label>
							<input placeholder="Masukkan email" type="text" class="form-control" name="email_peserta"
								id="email_peserta">
						</div>
						<div class="form-group col-12 mb-3">
							<label class="fw-bolder">Tujuan pengisian absensi</label> <br>
							<div class="form-check mt-3 mb-3">
								<input class="form-check-input" value="1" type="radio" name="tujuan_pengisian" id="flexRadioDefault1">
								<label class="form-check-label" for="flexRadioDefault1">
									Hanya mengisi absensi tanpa participant cost
								</label>
							</div>
							<div class="form-check">
								<input class="form-check-input" value="2" type="radio" name="tujuan_pengisian" id="flexRadioDefault2">
								<label class="form-check-label" for="flexRadioDefault2">
									Mengisi absensi dengan participant cost
								</label>
							</div>
						</div>
						<div class="form-group col-12 mb-3">
							<label id="reimbursement_type" class="fw-bolder">Proses reimbursement</label> <br>
							<div class="form-check mt-3 mb-3">
								<input class="form-check-input" value="1" type="radio" name="reimbursement_type" id="p1">
								<label class="form-check-label" for="p1">
									OVO
								</label>
							</div>
							<div class="ovo-field mb-2 ps-5 ms-4 d-none">
								<input placeholder="Masukkan nomor OVO" type="text" class="form-control" name="ovo_number" id="ovo_number">
							</div>
							<div class="form-check mt-5">
								<input class="form-check-input" value="2" type="radio" name="reimbursement_type" id="p2">
								<label class="form-check-label" for="p2">
									GOPAY
								</label>
							</div>
							<div class="gopay-field mb-2 ps-5 ms-4 d-none">
								<input placeholder="Masukkan nomor GOPAY" type="text" class="form-control" name="gopay_number" id="gopay_number">
							</div>
							<div class="form-check mt-5">
								<input class="form-check-input" value="3" type="radio" name="reimbursement_type" id="p3">
								<label class="form-check-label" for="p3">
									Bank
								</label>
							</div>
							<div class="bank-field mb-2 ps-5 form-group ms-4 d-none">
								<div class="mb-2">
									<input placeholder="Masukkan nama Bank" type="text" class="form-control" name="bank_name" id="bank_name">
								</div>
								<div class="mb-2">
									<label>Nomor rekening </label>
									<input placeholder="Masukkan nomor rekening" type="text" class="form-control" name="bank_number" id="bank_number">
								</div>
							</div>
						</div>
						<div class="form-group col-md-6 my-3">
							<label class="fw-bolder">Jumlah konsumsi</label>
							<input placeholder="Masukkan jumlah konsumsi" type="text" class="form-control mt-2" name="jumlah_konsumsi"
								id="jumlah_konsumsi">
						</div>
						<div class="form-group col-md-6 my-3">
							<label class="fw-bolder">Jumlah internet</label>
							<input placeholder="Masukkan jumlah internet" type="text" class="form-control mt-2" name="jumlah_internet"
								id="jumlah_internet">
						</div>
						<div class="form-group col-12 mb-3">
							<label class="fw-bolder">Upload resi konsumsi</label>
							<input type="file" class="form-control mt-2" name="resi_file" id="resi_file">
							<input type="text" class="form-control field-value d-none" name="resi_konsumsi"
								id="resi_konsumsi">
							<small class="my-2 upload-notif"></small>
						</div>
						<div class="d-grid gap-2">
							<button class="btn btn-primary" type="submit">Submit</button>
						</div>
					</div>
				</div>
			</form>
		</div>
		<div class="text-center fw-bolder text-muted fs-7 my-3">
			faster.bantuanteknis.id
		</div>
	</div>
</div>

<script>
	$(document).ready(function () {
        $('input[name=reimbursement_type]').change(function () {
            const value = $(this).val();
            if (value == '1') {
                $('.ovo-field').removeClass('d-none')
                $('.gopay-field').addClass('d-none')
                $('.bank-field').addClass('d-none')
            } else if(value == '2') {
                $('.gopay-field').removeClass('d-none')
                $('.ovo-field').addClass('d-none')
                $('.bank-field').addClass('d-none')
            } else {
                $('.bank-field').removeClass('d-none')
                $('.ovo-field').addClass('d-none')
                $('.gopay-field').addClass('d-none')
            }
		});
		$('#jumlah_konsumsi, #jumlah_internet').number(true, 0, '', '.')
		$('#asal_layanan').select2()
		const asset_url = "<?= $_ENV['ASSETS_URL'] ?>"
		const loader = `<div style="width: 5rem; height: 5rem;" class="spinner-border mb-5" role="status"></div>
				<h5 class="mt-2">Mohon tunggu</h5>
				<p>Menyimpan data...</p>`;
		$("#resi_file").on("change", function () {
			var $this = $(this);
			var form = new FormData();
			form.append("file", $this[0].files[0]);
			$.ajax({
				url: asset_url + 'resi_konsumsi',
				type: "POST",
				data: form,
				cache: false,
				contentType: false,
				processData: false,
				dataType: 'json',
				beforeSend: function (request) {
					request.setRequestHeader("token", "<?= $_ENV['ASSETS_TOKEN'] ?>");
					$this.parent().find('.upload-notif').text(
						'Mengupload file ..., mohon tunggu!')
				},
				error: function (xhr) {
					const response = xhr.responseJSON;
					console.log(response)
					$this.parent().find('.upload-notif').text('Gagal mengupload file!')
						.addClass('text-danger')
					$this.val(null);
					$this.parent().find('.field-value').val('')
				},
				success: function (response) {
					if (response.status === true) {
						const filename = response.data.filename
						$this.parent().find('.field-value').val(filename)
						$this.parent().find('.upload-notif').text('File berhasil di upload!')
							.addClass('text-success')
					} else {
						$this.parent().find('.field-value').val('')
						$this.val(null);
						$this.parent().find('.upload-notif').text('Gagal mengupload file!')
							.addClass('text-danger')
					}
				},
			});
		})

		initFormAjax('#attendance-form', {
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
					"title": 'Gagal!',
					"text": response.message,
					"icon": "error",
					"confirmButtonColor": '#000',
				});
			},
			success: function (data) {
				Swal.fire({
					"title": "Berhasil!",
					"text": data.message,
					"icon": "success",
					"confirmButtonClass": "btn btn-primary"
				}).then((result) => {
					if (result.value) {
						window.close()
					}
					$('#content').html(data.html)
				})
			}
		})
	})

</script>
