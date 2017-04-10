<?php

if(!isset($_SESSION)){
	session_start();
}
 require_once('controllers/JSON.php');?>






		<meta charset=utf-8>
		<meta name=description content="">
		<meta name=viewport content="width=device-width, initial-scale=1">
		<!-- Styles -->
		<link rel="stylesheet" type="text/css" href="assets/css/jquery-comments.css">
		<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

		<!-- Data -->
	

		<!-- Libraries -->
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
		<script type="text/javascript" src="assets/js/jquery-comments.js"></script>

		<style type="text/css">
			.textarea {
				color: #000;
			};
			li.active {
				color: #ccc;
			}
		</style>

		<!-- Init jquery-comments -->
		<script type="text/javascript">


			$(function() {
				$('#comments-container<?php echo $vars['idRecinto'];?>').comments({
					profilePictureURL: 'assets/images/usuarios/<?php echo $_SESSION['login_user_id'];?>.jpg',
					roundProfilePictures: true,
					textareaRows: 1,
					spinnerIconURL: '',
					noCommentsIconURL: '',
					replyText: '',
					textareaPlaceholderText: 'Deja tu comentario',
					newestText: 'Nuevos',
					oldestText: 'Antiguos',
					popularText: '',
					noCommentsText: 'Este recinto no tiene comentarios',
					enableReplying: false,
					enableEditing: false,
					postCommentOnEnter: true,
					enableUpvoting: false,
					sendText: 'Comentar',




					youText: '<?php echo $_SESSION['login_user_name']." ".$_SESSION['login_user_apellido']?>',



    				fieldMappings: {
				  	    	id: 'idComentario',
						    created: 'fecha',
						    content: 'contenido',
						    fullname: 'nombre',
						    profilePictureURL: 'fotografia',
						},

					getComments: function(success, error) {
				        $.ajax({
				            type: 'get',
				            url: '?controlador=Comentario&accion=getComentariosRecinto&idRecinto=<?php echo $vars['idRecinto']?>',
				            success: function(commentsArray1){
				            	var commentsArray =$.parseJSON(commentsArray1);
				                success(commentsArray);
				            },
				            error: error
				        });

					},
				    postComment: function(commentJSON, success, error) {
				        $.ajax({
				            type: 'post',
				            url: '?controlador=Comentario&accion=setComentario&idRecinto=<?php echo $vars['idRecinto']?>',
				            data: commentJSON,
				            success: function(comment1) {
				            	
				                success(commentJSON);
				            },
				            error: error
				        });

				    },


				});
			});
		</script>

	
		<div id="comments-container<?php echo $vars['idRecinto'];?>"></div>
	
