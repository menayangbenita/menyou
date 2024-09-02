function generateRandomColor() {
	var letters = "0123456789ABCDEF";
	var color = "#";
	for (var i = 0; i < 6; i++) {
		color += letters[Math.floor(Math.random() * 16)];
	}
	return color;
}

function createPieChart(ctx, dataset) {
	// Dataset needed = labels, colors, data
	return new Chart(ctx, {
		type: "pie",
		data: {
			labels: dataset.labels,
			datasets: [
				{
					label: "Product",
					weight: 9,
					cutout: 0,
					tension: 0.9,
					pointRadius: 2,
					borderWidth: 2,
					backgroundColor: dataset.colors,
					data: dataset.data,
					fill: false,
				},
			],
		},
		options: {
			responsive: true,
			maintainAspectRatio: false,
			plugins: {
				legend: {
					display: false,
				},
			},
			interaction: {
				intersect: false,
				mode: "index",
			},
			scales: {
				y: {
					grid: {
						drawBorder: false,
						display: false,
						drawOnChartArea: false,
						drawTicks: false,
					},
					ticks: {
						display: false,
					},
				},
				x: {
					grid: {
						drawBorder: false,
						display: false,
						drawOnChartArea: false,
						drawTicks: false,
					},
					ticks: {
						display: false,
					},
				},
			},
		},
	});
}

function createLineChart(ctx, dataset, is_currencies = false) {
	// Dataset needed = labels, line (array : required data label, data, pointBackgroundColor, borderColor, backgroundColor)
	let y_callback = is_currencies
		? (value) => `Rp ${value.toLocaleString("id-ID")}`
		: (value) => value;

	return new Chart(ctx, {
		type: "line",
		data: {
			labels: dataset.labels,
			datasets: dataset.line.map((ln) => {
				return {
					label: ln.label,
					data: ln.data,
					fill: true,
					tension: 0.4,
					pointRadius: 2,
					borderWidth: 3,
                    maxBarThickness: 32,
					pointBackgroundColor: ln.pointBackgroundColor,
					borderColor: ln.borderColor,
					backgroundColor: ln.backgroundColor,
				};
			}),
		},
		options: {
			responsive: true,
			maintainAspectRatio: false,
			plugins: {
				legend: {
					display: false,
				},
			},
			interaction: {
				intersect: false,
				mode: "index",
			},
			scales: {
				y: {
					grid: {
						drawBorder: false,
						display: true,
						drawOnChartArea: true,
						drawTicks: false,
						borderDash: [5, 5],
					},
					ticks: {
						display: true,
						padding: 10,
						color: "#9ca2b7",
						callback: y_callback,
						crossAlign: "center",
					},
				},
				x: {
					grid: {
						drawBorder: false,
						display: true,
						drawOnChartArea: true,
						drawTicks: true,
						borderDash: [5, 5],
					},
					ticks: {
						display: true,
						color: "#9ca2b7",
						padding: 10,
					},
				},
			},
		},
	});
}
