let hoverNode = document.createElement("style");
hoverNode.innerHTML = ".hoverNode { border: 1px solid black; background-color: yellow; cursor: pointer; }";
document.head.appendChild(hoverNode);

window.onload = () => {
  let DOMElements = document.querySelectorAll("*");
  DOMElements.forEach(element => {
    if (element.nodeType !== Node.TEXT_NODE) {
      let hoverNode = document.createElement("span");
      hoverNode.classList.add("hoverNode");
      hoverNode.innerHTML = element.tagName;
      element.appendChild(hoverNode);
      hoverNode.onclick = () => {
        alert(`You just clicked an ${element.tagName} it has an ID of ${element.id} and contains ${element.innerHTML}`);
      }
    }
  });
}