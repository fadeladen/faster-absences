// form ajax submit helper
export function initFormAjax(selector, ajaxConfig = {}) {
	const showValidation = $(selector).attr("show-validation") !== undefined;

	if (showValidation) {
		$(document).on("focus, change", ".is-invalid", function (e) {
			$(e.target)
				.parent()
				.children("div.invalid-feedback")
				.remove();
			$(e.target).removeClass("is-invalid");
		});
	}

	$(document).on("submit", selector, function (e) {
		const loader = `<div style="width: 5rem; height: 5rem;" class="spinner-border mb-5" role="status"></div>
				<h5 class="mt-2">Please wait</h5>
				<p>Saving data ...</p>`
		const defaultConfig = {
			url: $(selector).attr("action"),
			type: "POST",
			data: $(selector).serialize(),
			beforeSend: function () {
				$('.invalid-feedback').remove()
				$(selector).find('.select2-selection').removeClass('is-invalid')
				$(document).on("focus, change", ".is-invalid", function (e) {
					$(e.target)
						.parent()
						.children("div.invalid-feedback")
						.remove();
					$(e.target).removeClass("is-invalid");
				});
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
						const $parent = $(`#${err.replace("[]", "")}`).parent();
						$(`#${err.replace("[]", "")}`).addClass("is-invalid");
						if ($parent.find("invalid-feeedback").length == 0) {
							$parent.append(
								`<div class="invalid-feedback">${response.errors[err]}</div>`
							);
						}
					}
				}
				Swal.fire({
					"title": "Something went wrong!",
					"text": response.message,
					"icon": "error",
					"confirmButtonColor": '#000'
				});
			},

			success: function (data) {
				Swal.fire({
					"title": "Saved!",
					"text": data.message,
					"icon": "success",
					"confirmButtonColor": '#000'
				}).then((result) => {
					if (result.value) {
						if (data.formReset) {
							$(selector).trigger("reset");
						}
					}
				})
			},
		};

		const mergedConfig = {
			...defaultConfig,
			...ajaxConfig
		};

		e.preventDefault();
		$.ajax(mergedConfig);
	});
}


export function initDatatable(selector, config = {}) {
	const defaultConfig = {
		processing: true,
		serverSide: true,
		ajax: {
			url: $(selector).attr("data-url"),
			type: "POST",
		},
		language: {
            zeroRecords: `<div class="d-flex flex-column justify-content-center align-items-center py-3">
							<img style="height: 15rem; width: auto;"
							src="${base_url+'assets/images/svg/empty_data.svg'}" alt="">
							<p class="text-gray-700 fw-bolder fs-3 mt-5">No data available</p>
						  </div>`,
        }
	};

	const mergedConfig = {
		...defaultConfig,
		...config
	};
	return $(selector).DataTable(mergedConfig);
}
