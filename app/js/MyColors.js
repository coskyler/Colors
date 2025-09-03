const popup = document.querySelector(".profilePopup");
const profileButton = document.querySelector("aside button")

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
})