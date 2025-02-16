const sidebar = document.getElementById("sidebar");
function toggleSidebar() {
    sidebar.classList.toggle("hidden");
}

function toggleHide() {
    sidebar.classList.add("hidden");
}

document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll("form.formCreate").forEach((form) => {
        form.addEventListener("submit", function (event) {
            event.preventDefault();

            let formData = new FormData(this);
            let actionUrl = this.getAttribute("action");

            fetch(actionUrl, {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute("content"),
                    "Accept": "application/json",
                    "X-Requested-With": "XMLHttpRequest"
                },
                body: formData,
            })
                .then((response) => response.json())
                .then((data) => {
                    console.log(data);
                    if (data.success) {
                        alert(data.success);
                        window.location.href = data.redirect;
                    } else {
                        alert("Terjadi kesalahan. Coba lagi.");
                    }
                })
                .catch((error) => console.error("Error:", error));
        });
    });
});

document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll("form.formEdit").forEach((form) => {
        form.addEventListener("submit", function (event) {
            event.preventDefault();

            let formData = new FormData(this);
            let actionUrl = this.getAttribute("action");

            fetch(actionUrl, {
                method: "POST",
                headers: {
                    "Accept": "application/json",
                },
                body: formData,
            })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    if (data.success) {
                        alert(data.success);
                        window.location.href = data.redirect;
                    } else {
                        alert("Terjadi kesalahan. Coba lagi.");
                    }
                })
                .catch(error => {
                    console.error("Error:", error);
                    alert("Terjadi kesalahan pada server.");
                });
        });
    });
});

document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".delete").forEach((button) => {
        button.addEventListener("click", function (event) {
            event.preventDefault();

            let itemId = this.getAttribute("data-id");
            let deleteUrl = this.getAttribute("data-route");

            if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
                fetch(deleteUrl, {
                    method: "DELETE",
                    headers: {
                        "X-CSRF-TOKEN": document
                            .querySelector('meta[name="csrf-token"]')
                            .getAttribute("content"),
                        "Accept": "application/json",
                        "X-Requested-With": "XMLHttpRequest",
                    },
                })
                    .then((response) => response.json())
                    .then((data) => {
                        if (data.success) {
                            alert(data.success);
                            location.reload();
                        } else {
                            alert("Terjadi kesalahan saat menghapus data.");
                        }
                    })
                    .catch((error) => console.error("Error:", error));
            }
        });
    });
});


