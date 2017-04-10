
<style type="text/css">
${demo.css}
        </style>




<script type="text/javascript">

$(function () {
 $('#containerPartidos1').highcharts({
        title: {
            text: 'Distribución por hora de los partidos'
        },
        subtitle: {
            text: 'Matchday'
        },
        yAxis: {
             title: {
                text: 'Partidos',
                align: 'high'
            }

        },
        xAxis: {


            categories: [
               <?php
                foreach($vars['hora'] as $res){
                ?>

                '<?php echo $res['hora'] ?>',
                <?php
                    }
                ?>
            ],
             title: {
                text: 'Hora',
                align: 'high'
            }
        },
        plotOptions: {
            series: {
                allowPointSelect: true
            }
        },
        series: [{
            data: [
             <?php
                foreach($vars['hora'] as $res){
                ?>

                <?php echo $res['cantidad'] ?>,
                <?php
                    }
                ?>



            ]
        }],

    });

});


$(function () {

    $('#containerPartidos3').highcharts({ //Comentarios
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Partidos agendados v/s jugados v/s cancelados'
        },
        subtitle: {
            text: 'Matchday'
        },
        xAxis: {
            name: 'Jugador',
            categories: [
<?php
                
                $aux;
                foreach($vars['estado'] as $res){
                    if($res['estado'] == 1){
                        $aux="Agendado";
                    }
                    if($res['estado'] == 2){
                        $aux="Jugado";
                    }
                    if($res['estado'] == 3){
                        $aux="Cancelado";
                    }
?>

                ['<?php echo $aux ?>'],
<?php
}
?>

            ],
            title: {
                text: 'Estado'
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
            name: 'Partido',
            data: [
<?php
                
                foreach($vars['estado'] as $res){

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
     $('#containerPartidos2').highcharts({
        title: {
            text: 'Partidos jugados agrupados por día'
        },
        subtitle: {
            text: 'Matchday'
        },
        yAxis: {
             title: {
                text: 'Partidos',
                align: 'high'
            }

        },
        xAxis: {


            categories: [
               <?php
                foreach($vars['dia'] as $res){
                ?>

                '<?php echo $res['dia'] ?>',
                <?php
                    }
                ?>
            ],
             title: {
                text: 'Dias',
                align: 'high'
            }
        },
        plotOptions: {
            series: {
                allowPointSelect: true
            }
        },
        series: [{
            data: [
             <?php
                foreach($vars['dia'] as $res){
                ?>

                <?php echo $res['cantidad'] ?>,
                <?php
                    }
                ?>



            ]
        }],

    });


});



/*
$(function () {
});*/
    </script>

    <div id="containerPartidos1" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto">
    </div>
    </br>
    <div id="containerPartidos2" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto">
    </div>
    </br>

