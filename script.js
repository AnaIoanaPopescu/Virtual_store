const options = document.querySelectorAll(".options div");
const cup = document.querySelector(".cup");
const title = document.querySelector(".title");

function formatOption(option) {
    return option.toLowerCase().replace(/\s/g, "-");
}

options.forEach((option) => {
    option.addEventListener("click", function () {
        // Remove previous classes
        options.forEach((opt) => {
            cup.classList.remove(formatOption(opt.textContent));
        });

        // Add the new class based on clicked option
        cup.classList.add(formatOption(this.textContent));
        title.innerHTML = this.textContent;
    });
});