function redesEdit() {
    idRede = document.querySelector("#id-rede");
    action = document.querySelector("#action");
    btnSubmit = document.querySelector("#btn-submit");
    // liMaster = this.parentNode.parentNode; // liMaster = pai do pai do botao
    liMaster = this.closest("li"); // liMaster = o próximo ascendente "li"

    idRede.value = liMaster.dataset.id;
    action.value = this.dataset.action;

    titulo.value = liMaster.dataset.titulo;
    icon.value = liMaster.dataset.icon;
    site.value = liMaster.dataset.site;

    if (action.value == "edit") {
        btnSubmit.innerText = "Editar Rede Social";
        btnSubmit.classList.remove("btn-primary", "btn-danger");
        btnSubmit.closest(".col").classList.remove("form-box-danger");
        btnSubmit.classList.add("btn-warning");
        btnSubmit.closest(".col").classList.add("form-box-warning");
    } else if (action.value == "delete") {
        btnSubmit.innerText = "Eliminar Rede Social";
        btnSubmit.classList.remove("btn-primary", "btn-warning");
        btnSubmit.closest(".col").classList.remove("form-box-warning");
        btnSubmit.classList.add("btn-danger");
        btnSubmit.closest(".col").classList.add("form-box-danger");
    }
}


function menuEdit() {
    idMenu = document.querySelector("#id-menu");
    action = document.querySelector("#action");
    btnSubmit = document.querySelector("#btn-submit");
    // liMaster = this.parentNode.parentNode; // liMaster = pai do pai do botao
    liMaster = this.closest("li"); // liMaster = o próximo ascendente "li"

    idMenu.value = liMaster.dataset.id;
    action.value = this.dataset.action;

    titulo.value = liMaster.dataset.titulo;
    link.value = liMaster.dataset.link;


    if (action.value == "edit") {
        btnSubmit.innerText = "Editar Item de menu";
        btnSubmit.classList.remove("btn-primary", "btn-danger");
        btnSubmit.closest(".col").classList.remove("form-box-danger");
        btnSubmit.classList.add("btn-warning");
        btnSubmit.closest(".col").classList.add("form-box-warning");
    } else if (action.value == "delete") {
        btnSubmit.innerText = "Eliminar item de menu";
        btnSubmit.classList.remove("btn-primary", "btn-warning");
        btnSubmit.closest(".col").classList.remove("form-box-warning");
        btnSubmit.classList.add("btn-danger");
        btnSubmit.closest(".col").classList.add("form-box-danger");
    }
}


function fotosEdit() {
    idFoto = document.querySelector("#id-foto");
    action = document.querySelector("#action");
    btnSubmit = document.querySelector("#btn-submit");
    // liMaster = this.parentNode.parentNode; // liMaster = pai do pai do botao
    liMaster = this.closest("li"); // liMaster = o próximo ascendente "li"

    idFoto.value = liMaster.dataset.id;
    action.value = this.dataset.action;

    titulo.value = liMaster.dataset.titulo;
    ficheiro.required = false;

    if (action.value == "edit") {
        btnSubmit.innerText = "Editar imagem";
        btnSubmit.classList.remove("btn-primary", "btn-danger");
        btnSubmit.closest(".col").classList.remove("form-box-danger");
        btnSubmit.classList.add("btn-warning");
        btnSubmit.closest(".col").classList.add("form-box-warning");
    } else if (action.value == "delete") {
        btnSubmit.innerText = "Eliminar imagem";
        btnSubmit.classList.remove("btn-primary", "btn-warning");
        btnSubmit.closest(".col").classList.remove("form-box-warning");
        btnSubmit.classList.add("btn-danger");
        btnSubmit.closest(".col").classList.add("form-box-danger");
    }
}