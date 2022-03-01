
$(function () {
  $("#divCarregando").hide();
  $("#divDonuts").hide();

  $.ajax({ 
    url: $('#urlCanvas').val(),
    dataType: "json",
    type: 'get',
    data: {
      idFormulario : $('#idFormulario').val()
    },
    beforeSend : function() {
      $("#divCarregando").show();
      $("#divDonuts").hide();
    }
  })
  .done(function(response) {
    $("#divCarregando").hide();
    $("#divDonuts").show();

    if (response.status == '1') {
      
      $.each(response.dados.listPerguntas, function(index, value) {

        var donutChartCanvas = $('.donutChart'+value.id).get('0').getContext('2d');
        
        var donutData = {
          labels: value.notas.labels,
          datasets: [
            {
              data: value.notas.data,
              backgroundColor : [
                '#FF0000', 
                '#FF4500', 
                '#FF8C00', 
                '#FFA500', 
                '#FFD700', 
                '#ADFF2F',
                '#7FFF00',
                '#00FF00',
                '#228B22',
                '#006400',
              ],
              datalabels: {
                color: '#000'
              }
            },
          ]
        }
    
        var donutOptions = {
          tooltips: {
            enabled: false
          },
          maintainAspectRatio : false,
          responsive : true,
          plugins: {
            datalabels: {
              color: '#000'
            }
          }
        }
    
        var donutChart = new Chart(donutChartCanvas, {
          type: 'doughnut',
          data: donutData,
          options: donutOptions      
        })

      });
      
    }
  })
  .fail(function(jqXHR, textStatus, msg) {
    console.log(msg);
  }); 


  //-------------
  //- DONUT CHART -
  //-------------
  // Get context with jQuery - using jQuery's .get() method.

});
