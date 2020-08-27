/*
 * Author: Abdullah A Almsaeed
 * Date: 4 Jan 2014
 * Description:
 *      This is a demo file used only for the main dashboard (index.html)
 **/

$(function () {
  
    $('#addLista').on('click', function() {

        var tipo = $('#tipo').val(),
        bloco = $('#bloco').val(),
        titulo = $('#titulo').val(),
        ordem = $('#ordem').val();

        if (ordem == '') {
            alert('O campo ordem é obrigatório');
            return false;
        }

        if (tipo == '') {
            alert('O campo Tipo é obrigatório');
            return false;
        }

        if (bloco == '') {
            alert('O campo Bloco é obrigatório');
            return false;
        }

        if (titulo == '') {
            alert('O campo Título é obrigatório');
            return false;
        }

        var conteudo = '';

        conteudo = '<tr>';
            conteudo += '<td>';
                conteudo += ordem;
            conteudo += '</td>';
            conteudo += '<td>';
                conteudo += tipo;
            conteudo += '</td>';
            conteudo += '<td>';
                conteudo += bloco;
            conteudo += '</td>';
            conteudo += '<td>';
                conteudo += titulo;
            conteudo += '</td>';
        conteudo += '<input type="hidden" name="perguntas[]" class="perguntas" value="'+ordem+'|'+tipo+'|'+bloco+'|'+titulo+'">';
        conteudo += '</tr>';

        $('#tbodyPerguntas').html(conteudo);

        // incrementa +1 na ordem e altera o valor minimo da ordem
        ordemIncrementada = parseInt(ordem) + 1;
        $('#ordem').val(ordemIncrementada);

    });

});
