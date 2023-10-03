const formNewUser = document.getElementById("form-new-user");
if (formNewUser) {
    formNewUser.addEventListener("submit", async(e) => {
        //Receber o valor do campo
        let name = document.querySelector("#name").value;
        // Verificar se o campo esta vazio
        if (name === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessário preencher o campo nome!</p>";
            return;
        }

        //Receber o valor do campo
        let email = document.querySelector("#email").value;
        // Verificar se o campo esta vazio
        if (email === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessário preencher o campo e-mail!</p>";
            return;
        }

        //Receber o valor do campo
        let password = document.querySelector("#password").value;
        // Verificar se o campo esta vazio
        if (password === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessário preencher o campo senha!</p>";
            return;
        }

        // Verificar se o campo possui 6 caracteres
        if (password.length < 6) {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: A senha deve conter no minimo 6 caracteres!</p>";
            return;
        }

        // Verificar se o campo nao possui n repetidos
        if (password.match(/([1-9]+)\1{1,}/)) {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: A senha nao deve conter numeros repetidos!</p>";
            return;
        }

        // Verificar se o campo nao possui n repetidos
        if (!password.match(/[A-Za-z]/)) {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: A senha deve conter pelo menos uma letra!</p>";
            return;
        }
    });
}

const formAddUser = document.getElementById("form-add-user");
if (formAddUser) {
    formAddUser.addEventListener("submit", async(e) => {
        //Receber o valor do campo
        let name = document.querySelector("#name").value;
        // Verificar se o campo esta vazio
        if (name === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessário preencher o campo nome!</p>";
            return;
        }

        //Receber o valor do campo
        let user = document.querySelector("#user").value;
        // Verificar se o campo esta vazio
        if (user === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessário preencher o campo user!</p>";
            return;
        }

        //Receber o valor do campo
        let email = document.querySelector("#email").value;
        // Verificar se o campo esta vazio
        if (email === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessário preencher o campo e-mail!</p>";
            return;
        }

        //Receber o valor do campo
        let password = document.querySelector("#password").value;
        // Verificar se o campo esta vazio
        if (password === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessário preencher o campo senha!</p>";
            return;
        }

        // Verificar se o campo possui 6 caracteres
        if (password.length < 6) {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: A senha deve conter no minimo 6 caracteres!</p>";
            return;
        }

        // Verificar se o campo nao possui n repetidos
        if (password.match(/([1-9]+)\1{1,}/)) {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: A senha nao deve conter numeros repetidos!</p>";
            return;
        }

        // Verificar se o campo nao possui n repetidos
        if (!password.match(/[A-Za-z]/)) {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: A senha deve conter pelo menos uma letra!</p>";
            return;
        }
    });
}


const formEditPass = document.getElementById("form-edit-pass");
if (formEditPass) {
    formEditPass.addEventListener("submit", async(e) => {
        //Receber o valor do campo
        let password = document.querySelector("#password").value;
        // Verificar se o campo esta vazio
        if (password === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessário preencher o campo senha!</p>";
            return;
        }

        // Verificar se o campo possui 6 caracteres
        if (password.length < 6) {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: A senha deve conter no minimo 6 caracteres!</p>";
            return;
        }

        // Verificar se o campo nao possui n repetidos
        if (password.match(/([1-9]+)\1{1,}/)) {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: A senha nao deve conter numeros repetidos!</p>";
            return;
        }

        // Verificar se o campo nao possui n repetidos
        if (!password.match(/[A-Za-z]/)) {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: A senha deve conter pelo menos uma letra!</p>";
            return;
        }
    });
}

const formLogin = document.getElementById("form-login");

if (formLogin) {
    formLogin.addEventListener("submit", async(e) => {

        //Receber o valor do campo
        let user = document.querySelector("#user").value;
        // Verificar se o campo esta vazio
        if (user === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessário preencher o campo usuário!</p>";
            return;
        }

        //Receber o valor do campo
        let password = document.querySelector("#password").value;
        // Verificar se o campo esta vazio
        if (password === "") {
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessário preencher o campo senha!</p>";
            return;
        }

    });
}

/* Inicio Dropdown Navbar */
let avatar = document.querySelector(".avatar");

dropMenu(avatar);
// dropMenu(notification);

function dropMenu(selector) {
    //console.log(selector);
    selector.addEventListener("click", () => {
        let dropdownMenu = selector.querySelector(".dropdown-menu");
        dropdownMenu.classList.contains("active") ? dropdownMenu.classList.remove("active") : dropdownMenu.classList.add("active");
    });
}
/* Fim Dropdown Navbar */

/* Inicio Sidebar Toggle / bars */
let sidebar = document.querySelector(".sidebar");
let bars = document.querySelector(".bars");

bars.addEventListener("click", () => {
    sidebar.classList.contains("active") ? sidebar.classList.remove("active") : sidebar.classList.add("active");
});

window.matchMedia("(max-width: 768px)").matches ? sidebar.classList.remove("active") : sidebar.classList.add("active");
/* Fim Sidebar Toggle / bars */

function actionDropdown(id) {
    closeDropdownAction();
    document.getElementById("actionDropdown" + id).classList.toggle("show-dropdown-action");
}

window.onclick = function(event) {
    if (!event.target.matches(".dropdown-btn-action")) {
        /*document.getElementById("actionDropdown").classList.remove("show-dropdown-action");*/
        closeDropdownAction();
    }
}

function closeDropdownAction() {
    var dropdowns = document.getElementsByClassName("dropdown-action-item");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
        var openDropdown = dropdowns[i]
        if (openDropdown.classList.contains("show-dropdown-action")) {
            openDropdown.classList.remove("show-dropdown-action");
        }
    }
}



/* Fim botao dropdown do listar */