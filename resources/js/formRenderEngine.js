window.FormRenderEngine = class FormRenderEngine {

	constructor(opts, params) {
		this.form = this.createElem('form')
		this.params = params

		this.setAttrs(this.form, opts.attrs)
		this.renderFields(opts.fields)
	}

	renderFields(fields) {
		for (const field of fields) {
			const container = this.createElem('div')

			if (field.label) {
				const label = this.createElem('label')
				label.style.marginLeft = "15px"
				label.innerHTML = field.label
				container.append(label)
			}

			if (field.attrs) {
				let tag = 'input'

				if (field.attrs.type === 'select') {
					tag = 'select'
				}

				const input = this.createElem(tag)
				this.setAttrs(input, field.attrs)

				if (field.populate && this.params?.payloadComboBox[field.populate.target]) {
					populateComboBox({
						target: input,
						keyLabel: field.populate.label,
						list: this.params?.payloadComboBox[field.populate.target],
					})
				}

				container.append(input)
			}

			this.form.append(container)
		}
	}

	renderBtn(opts) {
		const btn = this.createElem('button')

		if (opts.label) {
			btn.innerHTML = opts.label
		}

		if (opts.attrs) {
			this.setAttrs(btn, opts.attrs)
		}

		return btn
	}

	setAttrs(elem, attrs) {
		if (elem && attrs) {
			for (const attr in attrs) {
				if (Object.hasOwnProperty.call(attrs, attr)) {
					elem.setAttribute(attr, attrs[attr])
				}
			}
		}
	}

	createElem(elem) {
		return document.createElement(elem)
	}

	reset() {
		this.form.reset()
		this.form.querySelectorAll('input[type="hidden"]').forEach(input => input.value = '')
	}

	get() {
		return this.form
	}

}
