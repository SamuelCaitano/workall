window.populateForm = function populateForm(form, data, basename) {
	const that = {
		finished: function (callback) {
			callback();
		}
	};

	if (data === null) {
		form.reset();
		return that;
	}

	for (const key in data) {

		if (!data.hasOwnProperty(key)) {
			continue;
		}

		let name = typeof (basename) !== "undefined" ? basename + "[" + key + "]" : key;
		let value = data[key];

		if (typeof value === 'undefined' || value === null) {
			value = '';
		} else if (value.constructor === Array) {
			name += '[]';
		} else if (typeof value == "object") {
			populateForm(form, value, name);
			continue;
		}

		const element = form.elements.namedItem(name);
		if (!element) {
			continue;
		}

		const type = element.type || element[0].type;

		switch (type) {
			default:
			element.value = value;
			break;
			case 'radio':
			case 'checkbox':
			if (element.length) {
				for (let j = 0; j < element.length; j++) {
					element[j].checked = (value.constructor == Array) ? value.includes(element[j].value) : (value == element[j].value);
				}
			} else {
				element.checked = value == element.value;
			}
			break;

			case 'select-multiple':
			const values = (value.constructor == Array) ? value : [value];
			for (let k = 0; k < element.options.length; k++) {
				element.options[k].selected = values.some(function(val) { return val == element.options[k].value });
			}
			break;

			case 'select':
			case 'select-one':
			element.value = value.toString() || value;
			break;
			case 'date':
			element.value = new Date(value).toISOString().split('T')[0];
			break;
		}

	}

	return that;
}
