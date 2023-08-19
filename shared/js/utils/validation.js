export function showErrorMessage(message, adjacentElement,timeout=1000) {
    let errorMessage = document.createElement("h4");
    errorMessage.style = "background-color:red;padding: 1cqb 4cqb;border-radius:20px";
    errorMessage.innerText = message;
    adjacentElement.insertAdjacentElement("afterend", errorMessage);

    setTimeout(() => {
        adjacentElement.parentElement.removeChild(errorMessage);
    }, timeout);
}