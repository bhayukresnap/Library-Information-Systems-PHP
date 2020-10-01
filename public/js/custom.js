function readURL(input) {
	if (input.files && input.files[0]) {
		const reader = new FileReader();
		$(reader).on("load", function(e){
			$(input).siblings('img').attr('src', e.target.result);
		});
		reader.readAsDataURL(input.files[0]);
	}
}

function notify(errors){
	$.notify({
		title: errors.title,
		message: errors.message,
		icon: 'fa fa-'+errors.icon,
	},{
		type: errors.type,
		delay: 3000,
		animate: {
			enter: 'animated fadeInDown',
			exit: 'animated fadeOutUp'
		},
	});
}

function capitalize(s){
	if (typeof s !== 'string') return ''
		return s.charAt(0).toUpperCase() + s.slice(1)
}

function convertNumber(n){
	if(!n) return "";
	return parseInt(n.replace(/\D/g, ''));
}

function currencyRp(n) {
	if(isNaN(convertNumber(n))) return "";
	return 'Rp ' + convertNumber(n).toString().replace(/./g, function(c, i, a) {
		return i > 0 && c !== "." && (a.length - i) % 3 === 0 ? "." + c : c;
	});
}

$(document).ready(function(){
	const url = document.URL.split('?')[0];

	$('[data-action="remove"]').click(function(){
		$this = $(this);
		swal({
			title: "Are you sure?",
			text: "You will not be able to recover this data again!",
			type: "warning",
			showCancelButton: true,
			confirmButtonText: "Yes, I'm sure!",
			cancelButtonText: "Cancel!",
			closeOnConfirm: false,
			closeOnCancel: true
		}, function(isConfirm) {
			if (isConfirm) {
				swal("Deleted!", "This data has been successfully removed.", "success");
				window.location.href = "?delete="+$this.data('id');
			}
		});
	});

	$("[data-attribute='year']").datepicker({
		format: "yyyy",
		viewMode: "years", 
		minViewMode: "years",
		autoclose: true,
	}).keydown(function(e){
		e.preventDefault();
		return false;
	});
	$('[data-attribute="select"]').attr("multiple","multiple").select2({
		placeholder: " --Please select-- ",
		allowClear: true,
		closeOnSelect: false
	}).val("").trigger('change');

	$("[data-attribute='currency']").on("keyup", function(){
		$(this).val(currencyRp($(this).val()))
		//const value_num = $(this).val() ? convertNumber($(this).val()) : "";
		$(this).siblings('[name="'+$(this).data('name')+'"]').val(convertNumber($(this).val()))
	});

	if($('[data-attribute="description"]').length > 0){
		ClassicEditor.create( document.querySelector( '[data-attribute="description"]' ), {
			removePlugins: ["Image", "ImageCaption", "ImageStyle", "ImageToolbar","ImageUpload", "MediaEmbed"]
		}).then(editor=>{
			const data_value = $('[data-attribute="description"]').data('value')
			if(data_value) editor.setData(data_value);
		}).catch( error => {
			console.error( error );
		});
	}
});