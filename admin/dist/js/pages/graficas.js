/* global Chart:false */
$(function () {

  'use strict';

  var ticksStyle = {
    fontColor: '#FFFFFF',
    fontStyle: 'bold',
  };

  var mode = 'index';
  var intersect = true;

  var $salesChart = $('#sales-chart');
  // eslint-disable-next-line no-unused-vars
  var salesChart = new Chart($salesChart, {
    type: 'bar',
    data: {
      labels: ['Meta (2 Mejora - 1 Preventiva)', 'Auditoria Interna', 'Auditoria Externa'],
      datasets: [
        {
          label: 'Acciones Correctivas',
          backgroundColor: '#FF6060',
          borderColor: '#FF6060',
          
          data: [1, 1, 9],
        },
        {
          label: 'Acciones Correctivas Realizadas',
          backgroundColor: '#dc3545',
          borderColor: '#dc3545',
         
          data: [5, 5, 10],
        },
        {
          label: 'Acciones Preventivas',
          backgroundColor: '#FEE960',
          borderColor: '#FEE960',
          
          data: [18, 5, 3],
        },
        {
          label: 'Acciones Preventivas Realizadas',
          backgroundColor: '#ffc107',
          borderColor: '#ffc107',
          data: [9, 2, 2],
        },
        {
          label: 'Acciones de Mejora',
          backgroundColor: '#71FE60',
          borderColor: '#71FE60',
          data: [10, 9, 4],
        },
        {
          label: 'Acciones de Mejora Realizadas',
          backgroundColor: '#28a745',
          borderColor: '#28a745',
          data: [8, 2, 1],
        },
      ],
    },
    options: {
      maintainAspectRatio: false,
      tooltips: {
        mode: mode,
        intersect: intersect,
      },
      hover: {
        mode: mode,
        intersect: intersect,
      },
      legend: {
        display: true,
      },
      scales: {
        yAxes: [
          {
            gridLines: {
              display: true,
              lineWidth: '4px',
              color: 'rgba(0, 0, 0, .1)',
              zeroLineColor: 'transparent',
            },
            ticks: $.extend(
              {
                beginAtZero: true,
                max: 20,
                stepSize: 1,
              },
              ticksStyle
            ),
          },
        ],
        xAxes: [
          {
            display: true,
            gridLines: {
              display: false,
            },
            ticks: ticksStyle,
          },
        ],
      },
    },
    
    plugins: {
      datalabels: {},
    },
    // Agregar etiquetas manualmente
    plugins: [{
      afterDatasetsDraw: function(chart) {
        var ctx = chart.ctx;

        chart.data.datasets.forEach(function(dataset, datasetIndex) {
          var meta = chart.getDatasetMeta(datasetIndex);
          if (!meta.hidden) {
            meta.data.forEach(function(element, index) {
              var model = element._model;
              var yPos = model.y - 10; // Ajusta la posición vertical de la etiqueta
              ctx.fillStyle = '#FFFFFF';
              ctx.font = ticksStyle.fontStyle + ' ' + ticksStyle.fontColor;
              ctx.fillText(dataset.data[index], model.x, yPos);
            });
          }
        });
      }
    }]
  });
 
  




  var $visitorsChart = $('#visitors-chart')
  // eslint-disable-next-line no-unused-vars
  var visitorsChart = new Chart($visitorsChart, {
    data: {
      labels: ['18th', '20th', '22nd', '24th', '26th', '28th', '30th'],
      datasets: [{
        type: 'line',
        data: [100, 120, 170, 167, 180, 177, 160],
        backgroundColor: 'transparent',
        borderColor: '#007bff',
        pointBorderColor: '#007bff',
        pointBackgroundColor: '#007bff',
        fill: false
        // pointHoverBackgroundColor: '#007bff',
        // pointHoverBorderColor    : '#007bff'
      },
      {
        type: 'line',
        data: [60, 80, 70, 67, 80, 77, 100],
        backgroundColor: 'tansparent',
        borderColor: '#ced4da',
        pointBorderColor: '#ced4da',
        pointBackgroundColor: '#ced4da',
        fill: false
        // pointHoverBackgroundColor: '#ced4da',
        // pointHoverBorderColor    : '#ced4da'
      }]
    },
    options: {
      maintainAspectRatio: false,
      tooltips: {
        mode: mode,
        intersect: intersect
      },
      hover: {
        mode: mode,
        intersect: intersect
      },
      legend: {
        display: false
      },
      scales: {
        yAxes: [{
          // display: false,
          gridLines: {
            display: true,
            lineWidth: '4px',
            color: 'rgba(0, 0, 0, .2)',
            zeroLineColor: 'transparent'
          },
          ticks: $.extend({
            beginAtZero: true,
            suggestedMax: 200
          }, ticksStyle)
        }],
        xAxes: [{
          display: true,
          gridLines: {
            display: false
          },
          ticks: ticksStyle
        }]
      }
    }
  })
})

// lgtm [js/unused-local-variable]
