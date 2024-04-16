const openButton = document.querySelector("[data-open-modal]")
const modal = document.querySelector("[data-modal]");

openButton.addEventListener("click", () => {
    modal.showModal()
})

modal.addEventListener("click", e => {
    const dialogDimension = modal.getBoundingClientRect()

    if (
        e.clientX < dialogDimension.left ||
        e.clientX > dialogDimension.right ||
        e.clientY < dialogDimension.top ||
        e.clientY > dialogDimension.bottom
    ) {
        modal.close()
    }
})