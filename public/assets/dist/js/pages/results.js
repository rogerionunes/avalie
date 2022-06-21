
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

        var donutChartCanvas = $('.donutChart'+value.id)[0].getContext('2d');
        
        var donutData = {
          labels: value.notas.labels,
          datasets: [
            {
              data: value.notas.data,
              backgroundColor : [
                '#696969', 
                '#A9A9A9', 
                '#6A5ACD', 
                '#483D8B', 
                '#191970', 
                '#00008B',
                '#0000CD',
                '#6495ED',
                '#4169E1',
                '#1E90FF',
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
