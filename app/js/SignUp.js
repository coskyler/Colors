document.addEventListener("DOMContentLoaded", () => {
	const form = document.querySelector(".form");
	const errorEl = document.querySelector(".error");

	form.addEventListener("submit", async (e) => {
		e.preventDefault(); // stop default page reload

		const formData = new FormData(form);

		const res = await fetch(form.action, {
			method: "POST",
			body: formData
		});

		const text = await res.text();

		if (text === "OK") {
			errorEl.textContent = ""; // clear errors
			window.location.href = "/colors";
		} else {
			errorEl.textContent = text; // show error from PHP
		}
	});
});