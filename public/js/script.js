const body = document.querySelector("body");
const sidebar = body.querySelector(".sidebar");
const toogle = body.querySelector(".toogle");

toogle.addEventListener("click", () => {
    sidebar.classList.toggle("close");
});

function abrirModal(id) {
    const modal = document.getElementById('modal-' + id);
    if (modal) {
        modal.classList.add('active');
    }
}

function fecharModal(id) {
    const modal = document.getElementById('modal-' + id);
    if (modal) {
        modal.classList.remove('active');
    }
}

document.addEventListener('click', function(e) {
    document.querySelectorAll('.modal').forEach(modal => {
        if (e.target === modal) {
            modal.classList.remove('active');
        }
    });
});

