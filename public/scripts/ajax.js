var id_pieza=0;
function AgregarServicio(e){
	var servicio = $("#cbxServicio option:selected").html();

		$("#containerMedidaPieza").append(

		'<div class="box">'
		+'<div class="box-header" >'
		+'Medidas de la pieza de: '+' '+servicio+''
		+'</div>'
		+'<div class="box-body">'
		+'<div class="row">'
		+'<div class="col-xs-3">'
		+'<input class="form-control" id="txtCant-'+id_pieza+'" placeholder="Cantidad" type="number" value="">'
		+	'</div>'
		+'<div class=" col-xs-4">'
		+'<select class="form-control c-select" name="servicio" id="selectUnidadMedida-'+id_pieza+'" value="">'
		+'<option value="MM">MM</option>'
		+'<option value="CM">CM</option>'
		+'</select>'
		+'</div>'
		+'<div class="col-xs-3">'
		+'<select class="form-control c-select" name="servicio" id="selectDimension-'+id_pieza+'" value="">'
		+'<option value="ALTO">ALTO</option>'
		+'<option value="LARGO">LARGO</option>'
		+'<option value="ANCHO">ANCHO</option>'
		+'<option value="RADIO">RADIO</option>'
		+'</select>'
		+'</div>'
		+'<div>'
		+'<div class="col-xs-1">'
		+'<button id="'+id_pieza+'-btn" title="Adicionar" value="'+id_pieza+'" onclick="AgregarMedidaPieza(this);" class="btn btn-icon white" type="button">'
		+'<i class="fa fa-plus" href="#"></i>'
		+'</button>'
		+'</div>'
		+'</div>'
		+'<div class="box-divider m-a-0"></div>'

		+'</div>'
		+'<div style = "padding-top: 2%;">'
		+'<table class="table table-striped b-t">'
		+'<thead>'
		+'<tr>'
		+'<th>Cantidad</th>'
		+'<th>Dimensión</th>'
		+'<th>Unidad de medida</th>'
		+'<th>Opción</th>'
		+'</tr>'
		+'</thead>'
		+'<tbody id="'+id_pieza+'">'
		+'</tbody>'
		+'</table>'
		+'</div>'
		+'</div>'

		+'</div>'
	);
	id_pieza++;
}
var contador=0;
function AgregarMedidaPieza(e){

	var id=$(e).val();
	// alert(id);
	var idTabla=id.split('-');
	var cantidad=($("#txtCant-"+idTabla[0]).val());
	var unidad=($("#selectUnidadMedida-"+idTabla[0]).val());
	var dimension=($("#selectDimension-"+idTabla[0]).val());
	// 	var oID = $(this).attr("tbody");
	$('#'+idTabla[0]).append(
		'<tr id="'+contador+'-'+idTabla[0]+'">'
		+'<td>'+cantidad+'</td>'
		+'<td>'+unidad+'</td>'
		+'<td>'+dimension+'</td>'
		+'<td>'
		+'<button class="btn btn-icon white" title="Eliminar" value="'+contador+'-'+idTabla[0]+'" onclick="eliminar(this);" id="'+contador+'-'+idTabla[0]+'" type="button">'
		+'<i class="fa fa-trash" href="#"></i>'
		+'</button>'
		+'</td>'
		+'</tr>')
		// alert(id);
		contador++;
	}
	function eliminar(e){
		var id=$(e).val();
		var idTabla=id.split('-');
		// alert(id);
		$('#'+id).remove(

		);
	}

	// $('#tabla > tbody:last').append('<tr id="ultima"><td>Ultima fila</td></tr>');
	//  $('#tabla > tbody:last').append('<tr id="ultima"><td>Ultima fila</td></tr>');
	function cambiar_valor_servicio(e){
		var id = $(e).val();
		$.ajax({
			url:'/pedido/traer/valor/'+id,
			dataType:'json',
			type:'get'
		}).done(function(r){
			$("#valor").val(r.valor);
		})
	}


	(function ($) {
		'use strict';


		$('[ui-jp], [data-ui-jp]').uiJp();
		$('body').uiInclude();
		$('[data-toggle="tooltip"]').tooltip();

		init();
		function init(){
			$('[data-toggle="tooltip"]').tooltip();
		}

		// pjax
		$(document).on('pjaxStart', function() {
			$('#aside').modal('hide');
			$('body').removeClass('modal-open').find('.modal-backdrop').remove();
			$('.navbar-toggleable-sm').collapse('hide');
		});

		if ($.support.pjax) {
			$.pjax.defaults.maxCacheLength = 0;
			var container = $('.pjax-container');
			$(document).on('click', 'a[data-pjax], [data-pjax] a, #aside a, .item a', function(event) {
				if($(".pjax-container").length == 0 || $(this).hasClass('no-ajax')){
					return;
				}
				$.pjax.click(event, {container: container, timeout: 6000, fragment: '.pjax-container'});
			});

			$(document).on('pjax:start', function() {
				$( document ).trigger( "pjaxStart" );
			});
			// fix js
			$(document).on('pjax:end', function(event) {

				$(event.target).find('[ui-jp], [data-ui-jp]').uiJp();
				$(event.target).uiInclude();

				$( document ).trigger( "pjaxEnd" );

				init();
			});
		}

		// blockui
		if ($.blockUI) {
			$(document).on('click', '#subnav .navside a, #subnav .item-title', function() {
				$('#list').block({
					message: '<i class="fa fa-lg fa-refresh fa-spin"></i>' ,
					css: {
						border: 'none',
						backgroundColor: 'transparent',
						color: '#fff',
						padding: '30px',
						width: '100%'
					},
					timeout: 1000
				});
			});

			$(document).on('click', '#list .item-title', function() {
				$('#detail').block({
					message: '<i class="fa fa-lg fa-refresh fa-spin"></i>' ,
					css: {
						border: 'none',
						backgroundColor: 'transparent',
						color: '#fff',
						padding: '30px',
						width: '100%'
					},
					timeout: 1000
				});
			});
		}



	})(jQuery);
