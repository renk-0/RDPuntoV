function _api_fetch(url, formdata) {
	let options = {
		method: "POST",
		body: formdata,
		mode: "cors",
		credentials: "same-origin"
	};

	return fetch(url, options);
}

