$(function() {

    $("#meuPrimeiroDropzone").dropzone({
        url: "produtos-galeria/upload",
        paramName: "file",
        dictDefaultMessage: "Selecione ou arraste as imagens aqui!",
        maxFilesize: 300
    });

});
