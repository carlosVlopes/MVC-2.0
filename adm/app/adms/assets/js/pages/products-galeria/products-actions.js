$(function()
{
    $(document).on('click', '.edit-picture', function(e)
    {
        e.preventDefault();
        el = $(this);

        el.closest('tr').find('td.name-picture span').css('display', 'none');
        el.closest('tr').find('td.orderby span').css('display', 'none');
        let name = el.closest('tr').find('input[name="name-picture"]');
        let order = el.closest('tr').find('input[name="orderby-picture"]');

        name.css({'display':'inline-block', 'width':'450px'});
        order.css({'display':'inline-block', 'width':'150px'});

        el.css('display', 'none');
        el.closest('tr').find('a.save-picture').css('display', 'inline-block');

    });

    $(document).on('click', '.save-picture', function()
    {
        let el = $(this);

        var name = el.closest('tr').find('input[name="name-picture"]'); // procurando a legenda
        var orderby   = el.closest('tr').find('input[name="orderby-picture"]'); // procurando a ordem
        var id      = el.closest('form').find('input[name="picture_id"]').val(); // pegando o valor do id com o val()

        $.ajax({
            url: "produtos-galeria/edit",
            data: "id=" + id +'&orderby='+orderby.val() + '&name='+name.val(),
            dataType:'json',
            type:'post',
            success: function(data) {
                if(data.status == 'success')
                {
                    name.val(name.val()).css('visibility', 'hidden'); // esconde o input
                    orderby.val(orderby.val()).css('visibility', 'hidden'); // esconde o input

                    el.closest('tr').find('td.name-picture span').text(name.val()).css('display', 'block');
                    el.closest('tr').find('td.orderby span').text(orderby.val()).css('display', 'block');

                    $('#msg').text('Ação efetuada com sucesso!');

                    el.css('display', 'none');
                    el.closest('tr').find('a.edit-picture').css('display', 'inline-block');
                }
                else
                {
                    let msg = (data.message) ? data.message : 'Imagem não encontrada!';
                    $('#msg').text(msg);
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown)
            {
                $('#msg').text('Ops! um erro foi encontrado, tente novamente mais tarde!');
            }
        });
    });

    $(document).on('click', '.delete', function(e) {
        e.preventDefault();

        var id = $('input[name=picture_id]').val();

        $.ajax({
            url: "produtos-galeria/delete",
            data: "id=" + id,
            dataType:'json',
            type:'post',
            success: function(data) {
                if(data.status == 'success')
                {

                    $('#msg').text('Imagem deletada com sucesso!');

                    setTimeout(function(){
                        location.reload();
                    }, 0001);

                }
                else
                {
                    var msg = (data.message) ? data.message : 'Imagem não encontrada!';
                    $('#msg').text(msg);
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown)
            {
                $('#msg').text('Ops! um erro foi encontrado, tente novamente mais tarde!');
            }
        });

    });
});
