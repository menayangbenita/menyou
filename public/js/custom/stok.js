const filter_from = document.getElementById("from");
const filter_to = document.getElementById("to");

filter_from.addEventListener("change", (e) => {
	let from = new Date(filter_from.value);
	let to = new Date(filter_to.value);

	if (!validate(from, to)) {
        to.setDate(from.getDate() + 6);
		filter_to.value = to.toISOString().slice(0, 10);
	}
});

filter_to.addEventListener("change", (e) => {
	let from = new Date(filter_from.value);
	let to = new Date(filter_to.value);

	if (!validate(from, to)) {
		from.setDate(to.getDate() - 6);
		filter_from.value = from.toISOString().slice(0, 10);
	}
});

function validate(from, to) {
	let range = (to - from) / (1000 * 60 * 60 * 24);
	if (range < 7) return true;

	alert("Rentang filter maksimal 7 hari!");
	return false;
}
