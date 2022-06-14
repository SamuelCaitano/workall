window.FormRenderEngine = class FormRenderEngine {

	constructor(opts, params) {
		this.form = this.createElem('form')
		this.params = params

		this.setAttrs(this.form, opts.attrs)
		this.renderFields(opts.fields)
	}

	renderFields(fields) {
		for (const field of fields) {
			var classDiv = "relative"

			const container = this.createElem('div')

			container.setAttribute('class', classDiv)

			if (field.attrs) {
				let classTag = "block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"

				let tag = 'input'

				if (field.attrs.type === 'select') {
					tag = 'select'
				}

				const input = this.createElem(tag)

				let identify =   "teste"

				input.setAttribute('id', identify)
				
				input.setAttribute('class', classTag)

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

			if (field.label) {
				let classe = "absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-800 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1"

				const label = this.createElem('label') 

				label.innerHTML = field.label

				let id =   "teste"
				label.setAttribute('for', id)

				label.setAttribute('class', classe)

				container.append(label)
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
