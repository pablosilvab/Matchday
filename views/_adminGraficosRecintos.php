
<style type="text/css">
${demo.css}
        </style>




<script type="text/javascript">
$(function () {
        $('#containerRecintos1').highcharts({ //Comentarios
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Top 10 recintos con más partidos agendados'
        },
        subtitle: {
            text: 'Matchday'
        },
        xAxis: {
            categories: [
<?php
                
                foreach($vars['partidos'] as $res){
?>

                ['<?php echo $res['nombre'] ?>'],
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
                text: 'Recintos ',
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
            foreach($vars['partidos'] as $res){
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
$('#containerRecintos2').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },
        title: {
            text: 'Superficie de canchas del sistema' //titulo
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            }
        },
        series: [{
            type: 'pie', //Tipo de grafico
            name: 'Recintos deportivos', //nombre de lo que estamos viendo
            data: [
                
                <?php 
              
                foreach($vars['superficie'] as $row){
                ?>
            ['<?php echo $row['superficie'] ?>',  <?php echo $row['cantidad']?>],
            <?php
                }
            ?>
            ]
        }]
    });
});

$(function () {
$('#containerRecintos3').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },
        title: {
            text: 'Precio más alto por recinto' //titulo
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            }
        },
        series: [{
            type: 'pie', //Tipo de grafico
            name: 'Recintos', //nombre de lo que estamos viendo
            data: [
                
                <?php 

                foreach($vars['precio'] AS $res){
                ?>
            ['<?php  setlocale(LC_MONETARY, 'es_CL');
            echo money_format('%.0n', $res['precio']); ?>',  <?php echo $res['cantidad']?>],
            <?php
                }
            ?>
            ]
        }]
    });
});

$(function () {
$('#containerRecintos4').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },
        title: {
            text: 'Precio más bajo por recinto' //titulo
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            }
        },
        series: [{
            type: 'pie', //Tipo de grafico
            name: 'Recintos', //nombre de lo que estamos viendo
            data: [
                
                <?php 
			foreach($vars['precioMin'] AS $res){
                ?>
            ['<?php setlocale(LC_MONETARY, 'es_CL');
            echo money_format('%.0n', $res['precio']); ?>',  <?php echo $res['cantidad']?>],
            <?php
                }
            ?>
            ]
        }]
    });
});

$(function () {

$('#containerRecintos5').highcharts({ //Comentarios
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Recintos más comentados'
        },
        subtitle: {
            text: 'Matchday'
        },
        xAxis: {
            categories: [
<?php
			foreach($vars['comentario'] as $res){
?>

                ['<?php echo $res['nombre'] ?>'],
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
                text: 'Recintos ',
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
            name: 'Comentarios',
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
	$('#containerRecintos6').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },
        title: {
            text: 'Tipo de recintos' //titulo
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            }
        },
        series: [{
            type: 'pie', //Tipo de grafico
            name: 'Recintos deportivos', //nombre de lo que estamos viendo
            data: [
                
                <?php 
                foreach($vars['tipo'] as $row){
                ?>
            ['<?php echo $row['tipo'] ?>',  <?php echo $row['cantidad']?>],
            <?php
                }
            ?>
            ]
        }]
    });
});


/*
$(function () {
});*/
/*
$(function () {
});*/
    </script>

    <div id="containerRecintos1" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto">
    </div>
    </br>
    <div id="containerRecintos2" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto">
    </div>
    </br>
    <div id="containerRecintos3" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto">
    </div>
    </br>
    <div id="containerRecintos4" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto">
    </div>
    </br>
    <div id="containerRecintos5" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto">
    </div>
    </br>
    <div id="containerRecintos6" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto">
    </div>
    </br>
