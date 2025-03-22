export default defineNuxtPlugin((nuxtApp) => {
	const i = (code, templateData, capitalize = true) => {
		if (!templateData) templateData = {}

		const {$i18n} = nuxtApp
		const t = $i18n.t
		const te = $i18n.te
		if (!te(code)) return null

		const _capitalize = (str) => str.charAt(0).toUpperCase() + str.slice(1)
		let phrase = t(code)

		if (capitalize) {
			phrase = _capitalize(phrase)
		}

		for (const key in templateData) {
			phrase = phrase.replaceAll(`%${key}%`, templateData[key])
		}

		return phrase
	}
	const c = (...codes) => {
		return codes.map((element, index) => i(element, null, index === 0)).join(' ')
	}
	//temporary support array in yaml
	const ta = (code) => {
		const {$i18n} = nuxtApp
		const tm = $i18n.tm
		return tm(code).map((itm) => {
			let ret = itm.body?.static
			if (!ret) {
				ret = itm.b?.s
			}
			return ret
		})
	}
	return {
		provide: {
			i: i,
			c: c,
			ta: ta,
		},
	}
})
