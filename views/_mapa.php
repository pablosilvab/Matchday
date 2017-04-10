<div class="modal-dialog modal-lg" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title">¿Cómo llegar?</h4>
    </div>
    <?php
    // Obtener "lugar" -> recinto o local
    $lugar = $vars['mapa'];
    foreach ($lugar as $key) {
      ?>
    <div class="modal-body">
      <h6 class="texto-modal-negro">Lugar: <?php echo $key['nombre']?></h6>
      <iframe
          width="100%" height="336px" frameborder="5" style="border:0"  maptype="satellite"
          src="https://www.google.com/maps/embed/v1/place?key=AIzaSyDR2WyVnnd9GsSTKys5OEkowPu41kMpEUs
          &q=Chile  + Chillan + <?php echo $key['direccion'];?>" allowfullscreen>
      </iframe>
    </div>
    <?php
    }
    ?>
    <div class="modal-footer">
      <button type="button" class="btn btn-primary volver">Volver <i class="fa fa-arrow-circle-left" aria-hidden="true"></i></button>
    </div>
  </div>
</div>

<script type="text/javascript">
  
     $('.volver').click(function (e){
      e.preventDefault();
      $('#modal2').modal('hide');

  });    
</script>

 