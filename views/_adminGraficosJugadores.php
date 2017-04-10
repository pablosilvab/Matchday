
<style type="text/css">
${demo.css}
        </style>




<script type="text/javascript">
$(function () {
        $('#containerJugadores1').highcharts({
        chart: {
            type: 'pie',
            options3d: {
                enabled: true,
                alpha: 45,
                beta: 0
            }
        },
        title: {
            text: 'Distribución por sexo'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                depth: 35,
                dataLabels: {
                    enabled: true,
                    format: '{point.name}'
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'Cantidad',
            data: [

                ['Hombre', <?php echo end($vars['sexo'][1])['M']; ?>],
                ['Mujer', <?php echo  end($vars['sexo'][0])['F']; ?>]

            ]
        }]
    });//Fin grafico hombre/mujer
});
$(function () {
$('#containerJugadores2').highcharts({
 chart: {
            type: 'bar'
        },
        title: {
            text: 'Distribución por edad'
        },
        subtitle: {
            text: 'Matchday'
        },
        xAxis: {
            categories: [
<?php
                
             
              foreach($vars['edad'] as $row){
                   
                
?>

                [<?php echo $row['edad'] ?>],
<?php
    }
?>

            ],
            title: {
                text: null
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Jugadores ',
                align: 'high'
            },
            labels: {
                overflow: 'justify'
            }
        },
        tooltip: {
            valueSuffix: ' Jugadores'
        },
        plotOptions: {
            bar: {
                dataLabels: {
                    enabled: true
                }
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'top',
            x: -40,
            y: 100,
            floating: true,
            borderWidth: 1,
            backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
            shadow: true
        },
        credits: {
            enabled: false
        },
        series: [{
            name: 'Número de jugadores',
            data: [
<?php
                
                
                 foreach($vars['edad'] as $row){
?>

                [<?php echo $row['cantidad'] ?>],
<?php
    }
?>


            ]
        }]
    });
});

$(function () {
$('#containerJugadores3').highcharts({ //Comentarios
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Número de comentarios por jugador'
        },
        subtitle: {
            text: 'Matchday'
        },
        xAxis: {
            name: 'Jugador',
            categories: [
<?php
                
                foreach($vars['comentario'] as $res){
?>

                ['<?php echo $res['idUsuario'] ?>'],
<?php
}
?>

            ],
            title: {
                text: 'jugador'
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Comentarios ',
                align: 'high'
            },
            labels: {
                overflow: 'justify'
            }
        },
        tooltip: {
            valueSuffix: ''
        },
        plotOptions: {
            bar: {
                dataLabels: {
                    enabled: true
                }
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'top',
            x: -40,
            y: 100,
            floating: true,
            borderWidth: 1,
            backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
            shadow: true
        },
        credits: {
            enabled: false
        },
        series: [{
            name: 'Comentario',
            data: [
<?php
        
             
               foreach($vars['comentario'] as $res){
?>

                [<?php echo $res['cantidad'] ?>],
<?php
}
?>


            ]
        }]
    });	
	});


$(function () {
 $('#containerJugadores4').highcharts({ //Comentarios
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Top 10 jugadores con más partidos'
        },
        subtitle: {
            text: 'Matchday'
        },
        xAxis: {
            categories: [
<?php
              
                foreach( $vars['topTen'] AS $res){
?>

                ['<?php echo $res['nombre']." ".$res['apellido'] ?>'],
<?php
}
?>

            ],
            title: {
                text: null
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Partidos ',
                align: 'high'
            },
            labels: {
                overflow: 'justify'
            }
        },
        tooltip: {
            valueSuffix: ''
        },
        plotOptions: {
            bar: {
                dataLabels: {
                    enabled: true
                }
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'top',
            x: -40,
            y: 100,
            floating: true,
            borderWidth: 1,
            backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
            shadow: true
        },

        credits: {
            enabled: false
        },
        series: [{
            name: 'Partidos',
            data: [
<?php
                
                foreach( $vars['topTen'] AS $res){
?>

                [<?php echo $res['partidos'] ?>],
<?php
}
?>


            ]
        }]
    });
});
    </script>

    <div id="containerJugadores1" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto">
    </div>
    </br>
    <div id="containerJugadores2" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto">
    </div>
    </br>
    <div id="containerJugadores3" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto">
    </div>
    </br>
    <div id="containerJugadores4" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto">
    </div>
    </br>
