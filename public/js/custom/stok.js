const filter_from = document.getElementById("from");
const filter_to = document.getElementById("to");

filter_from.addEventListener("change", (e) => {
	if (!validate()) {
		let from = new Date(filter_to.value);
        from.setDate(from.getDate() + 6);
		filter_to.value = from.toISOString().slice(0, 10);
	}
});

filter_to.addEventListener("change", (e) => {
	if (!validate()) {
		let to = new Date(filter_from.value);
		to.setDate(to.getDate() - 6);
		filter_from.value = to.toISOString().slice(0, 10);
	}
});

function validate() {
	let from = new Date(filter_from.value);
	let to = new Date(filter_to.value);

	let range = (to - from) / (1000 * 60 * 60 * 24);

	if (range < 7) return true;

	alert("Rentang filter maksimal 7 hari!");
	return false;
}
