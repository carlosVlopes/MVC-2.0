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