const popup = document.querySelector(".profilePopup");
const profileButton = document.querySelector("aside button");
const profileName = document.querySelector("#name");
const profileUsername = document.querySelector("#username");
const pfp = document.querySelector(".pfp");
const re = document.getElementById("r");
const ge = document.getElementById("g");
const be = document.getElementById("b");
const hexe = document.getElementById("hex");
const addColorForm = document.getElementById("addColorForm");
const addColorError = document.getElementById("addColorError");
const addColorDropdown = document.getElementById("addColorDropdown");
const addColorDiv = document.querySelector(".addColor");
const newColorName = document.getElementById("newColorName");

if(window.userData) {
    profileName.textContent = window.userData.first_name + " " + window.userData.last_name;
    profileUsername.textContent = window.userData.username;
    pfp.textContent = window.userData.first_name[0].toUpperCase();
}

profileButton.addEventListener("click", e => {
    const close = ev => {
        if(!popup.contains(ev.target)) {
            popup.style.display = "none";
            profileButton.style.removeProperty("background-color");
            document.removeEventListener("click", close);
            window.removeEventListener("resize", positionPopup);
        }
    }

    function positionPopup() {
        const rect = profileButton.getBoundingClientRect();
        popup.style.left = (rect.left + 8) + "px";
        popup.style.top = rect.top - popup.offsetHeight - 4 + "px";
    }

    if(popup.style.display === "none") {
        popup.style.display = "flex";

        positionPopup();

        profileButton.style.setProperty("background-color", "#121212", "important");

        window.addEventListener("resize", positionPopup);
        setTimeout(() => document.addEventListener("click", close), 1);
    } else {
        popup.style.display = "none";
    }
});

function updatePreviewRgb() {
    let r = Number(re.value) || 0;
    let g = Number(ge.value) || 0;
    let b = Number(be.value) || 0;

    if(r < 0) r = 0; else if(r > 255) r = 255;
    if(g < 0) g = 0; else if(g > 255) g = 255;
    if(b < 0) b = 0; else if(b > 255) b = 255;

    if (!/^0+$/.test(re.value)) if(r == 0) re.value = ""; else re.value = r;
    if (!/^0+$/.test(ge.value)) if(g == 0) ge.value = ""; else ge.value = g;
    if (!/^0+$/.test(be.value)) if(b == 0) be.value = ""; else be.value = b;

    re.value = re.value.slice(0, 3);
    ge.value = ge.value.slice(0, 3);
    be.value = be.value.slice(0, 3);

    const toHex = n => n.toString(16).padStart(2, "0");
    hexe.value = `#${toHex(r)}${toHex(g)}${toHex(b)}`;

    const preview = document.getElementById("preview");
    preview.style.backgroundColor = `rgb(${r}, ${g}, ${b})`;
}

["r", "g", "b"].forEach(id => {
    document.getElementById(id).addEventListener("input", updatePreviewRgb);
});

hexe.addEventListener("input", e => {
    let hex = hexe.value;

    if(hex === "#" || hex === "") {
        return;
    }

    // remove everything except hex digits
    hex = hex.replace(/[^0-9A-Fa-f]/g, "");

    hex = hex.slice(0, 6);

    hexe.value = "#" + hex;

    if(hex.length !== 6) return;

    let num = parseInt(hex, 16);

    const r = (num >> 16) & 255;
    const g = (num >> 8) & 255;
    const b = num & 255;

    re.value = r;
    ge.value = g;
    be.value = b;

    updatePreviewRgb();
});

addColorForm.addEventListener("submit", async (e) => {
    e.preventDefault(); // stop default page reload

    const formData = new FormData(addColorForm);

    const res = await fetch(addColorForm.action, {
        method: "POST",
        body: formData
    });

    const text = await res.text();

    if (text === "OK") {
        addColorError.textContent = ""; // clear errors
        addColorDiv.style.display = "none";
        re.value = "";
        ge.value = "";
        be.value = "";
        newColorName.value = "";
        updatePreviewRgb();
        hexe.value = "";
    } else {
        addColorError.textContent = text;
    }
});

addColorDropdown.addEventListener("click", e => {
    if(addColorDiv.style.display !== "flex")
        addColorDiv.style.display = "flex";
    else
        addColorDiv.style.display = "none";
});