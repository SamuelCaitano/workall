@section('css') 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />
@endsection

<div id="jsTreePageUserProfile"></div>

@section('scripts')
@parent 
<script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js"></script>
<script type="text/javascript">

	setClockpicker('.clockpicker input');
	setDatePicker('.input-group.date', {
		startView: 2,
	});

	$(document).ready(function() {
		$('#jsTreePageUserProfile').jstree({
			'plugins': ["checkbox"],
			'core': {
				'data': APP.listSelectBox.mappingToJsTree,
			}
		});

		document.querySelector('form[name="form"]').addEventListener('submit', (event) => {
			event.preventDefault()
			const jsTreeChecked = $('#jsTreePageUserProfile').jstree().get_checked().reduce((carry, item) => {
				let match = null

				if (match = item.match(/^((\d*)\.(\d+))\.(\w+)$/)) {
					if (!carry[match[1]]) {
						carry[match[1]] = {
							page_module_id: match[2],
							page_config_id: match[3],
							create: 0,
							read: 0,
							update: 0,
							delete: 0,
						}
					}

					carry[match[1]][match[4]] = 1
				}

				return carry
			}, {})

			$.ajax({
				url: '/admin/pageUserProfile/save',
				method: 'post',
				type: 'json',
				data: {
					type: APP.payload.type,
					id: APP.payload.data.id,
					pageUserProfile: Object.values(jsTreeChecked),
				},
				async: false,
			}).done(function () {
				console.log('dnone');
				location.reload()
			})
		})
	});

</script>
@endsection
