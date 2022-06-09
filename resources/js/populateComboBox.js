window.populateComboBox = function populateComboBox(params) {
	const target = params.target

	if (params.emptyOption) {
		const option = document.createElement('option');

		option.value = params.emptyOption.value || '';
		option.innerText = params.emptyOption.label || '';

		target.appendChild(option);
	}

	const keyValue = params.keyValue ?? 'id'
	const keyLabel = params.keyLabel ?? 'label'
	params.list.forEach(function (item) {
		const option = document.createElement('option');

		option.value = item[keyValue];
		option.innerHTML = item[keyLabel];
		option.dataset.payload = item;
		option.selected = item.selected;

		if (params.selectBy && params.selectBy.length) {
			option.selected = params.selectBy.some(item => item == option.value);
		}

		target.appendChild(option);

		if (item.optGroup && item.optGroup.length) {
			const optGroup = document.createElement('optgroup');

			optGroup.label = item[keyLabel]
			target.appendChild(optGroup);

			populateComboBox({
				list: item.optGroup,
				target: optGroup,
				selectBy: params.selectBy,
			})
		}
	})
}
