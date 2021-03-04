let requiredStyle = document.createElement("style");
requiredStyle.innerHTML = ".requiredStyle { border: 2px solid red; }";
document.head.appendChild(requiredStyle);

window.onload = () => {
  let form = document.querySelector("#mainForm");
  let requiredInput = document.querySelectorAll(".required");

  form.addEventListener("submit", (e) => {
    requiredInput.forEach(input => {
      if (input.type === "checkbox" && !input.checked) {
        input.parentElement.classList.add("requiredStyle");
        e.preventDefault();
      } else if (input.value === "") {
        input.classList.add("requiredStyle");
        e.preventDefault();
      }
    });
  });

  requiredInput.forEach(input => {
    input.addEventListener("change", () => {
      if (input.type === "checkbox")
        input.parentElement.classList.remove("requiredStyle");
      else
        input.classList.remove("requiredStyle");
    });
  });
}