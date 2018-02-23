<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Learn PHP CodeIgniter Framework with AJAX and Bootstrap</title>
    <!--
    <link href="<?php echo base_url('assests/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assests/datatables/css/dataTables.bootstrap.css')?>" rel="stylesheet">
    -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.css"/>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>


  <div class="container">
    <h1>Listado de Libros de Biblioteca</h1>
</center>
    <h3>Libros</h3>
    <br />
    <button class="btn btn-success" onclick="add_book()"><i class="glyphicon glyphicon-plus"></i> Agregar Libro</button>
    <br />
    <br />
    <table id="tabla_libros" class="table table-striped table-bordered" cellspacing="0" width="100%">
      <thead>
        <tr>
			<th>ID</th>
			<th>ISBN</th>
			<th>Titulo</th>
			<th>Autor</th>
			<th>Categoria</th>
            <th style="width:125px;">Acciones</th>
        </tr>
      </thead>
      <tbody>
    	<?php foreach($books as $book) :?>
	     <tr>
	        <td><?php echo $book->book_id;?></td>
	        <td><?php echo $book->book_isbn;?></td>
			<td><?php echo $book->book_title;?></td>
			<td><?php echo $book->book_author;?></td>
			<td><?php echo $book->name_category;?></td>
			<td>
				<button class="btn btn-warning" onclick="edit_book(<?= $book->book_id;?>)"><i class="glyphicon glyphicon-pencil"></i></button>
				<button class="btn btn-danger" onclick="delete_book(<?= $book->book_id;?>)"><i class="glyphicon glyphicon-remove"></i></button>
			</td>
	      </tr>
    	<?php endforeach; ?>
      </tbody>
      <tfoot>
        <tr>
          <th>ID</th>
            <th>ISBN</th>
            <th>Titulo</th>
            <th>Autor</th>
            <th>Categoria</th>
            <th>Acciones</th>
        </tr>
      </tfoot>
    </table>

  </div>
  <!--
  <script src="<?php echo base_url('assests/<a href="http://www.phpcodify.com/category/jquery/">jquery</a>/jquery-3.1.0.min.js')?>"></script>
  <script src="<?php echo base_url('assests/bootstrap/js/bootstrap.min.js')?>"></script>
  <script src="<?php echo base_url('assests/datatables/js/jquery.dataTables.min.js')?>"></script>
  <script src="<?php echo base_url('assests/datatables/js/dataTables.bootstrap.js')?>"></script>
  -->

  <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.js"></script>


  <script type="text/javascript">
    $(document).ready( function () {
        $('#tabla_libros').DataTable({
            "language": {
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "Ningún dato disponible en esta tabla",
                "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix":    "",
                "sSearch":         "Buscar:",
                "sUrl":            "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "Cargando...",
                "oAria": {
                    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                },
                "search": "_INPUT_", 
                "searchPlaceholder": "Buscar",
                "paginate": {
                    "next": '<i class="glyphicon glyphicon-chevron-right"></i>',
                    "previous": '<i class="glyphicon glyphicon-chevron-left"></i>',
                    "first": '<i class="glyphicon glyphicon-fast-backward"></i>',
                    "last": '<i class="glyphicon glyphicon-fast-forward"></i>'
                }
            },
            "ordering": true,   //esta ordenado
            "paging": true,     //usa paginacion
            "pagingType": "full_numbers",
            "pageLength": 5,     //numero de filas por pagina
            "iDisplayLength": 5,
            "aLengthMenu": [[3, 5, 10, 25, 50,-1], [3, 5, 10, 25, 50,"Todos"]]
        });
    } );
    var accion; //por si se va a guardar o se va actualizar
    var table;
    var controlador = "<?php echo base_url('books'); ?>";


    function add_book()
    {
      accion = 'agregar';
      $('#formulario_libros')[0].reset(); // limpia de datos el formulario modal 
      $('#formulario_modal_libros').modal('show'); // muestra bootstrap modal
    }

    function edit_book(id)
    {
      accion = 'actualizar';
      $('#formulario_libros')[0].reset(); // limpia de datos el formulario moda

      // Carga los datos por Ayax
      $.ajax({
        url: controlador + '/ajax_edit',
        data: {id:id},
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="book_id"]').val(data.book_id);
            $('[name="book_isbn"]').val(data.book_isbn);
            $('[name="book_title"]').val(data.book_title);
            $('[name="book_author"]').val(data.book_author);
            $('[name="book_category"]').val(data.category_id);

            $('.modal-title').text('Editar Libro'); // cambia el titulo del modal
            $('#formulario_modal_libros').modal('show'); // muestra el modal completamente cargado

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error obteniendo datos de ajax');
        }
    });
    }

    function save()
    {
      var url;
      if(accion == 'agregar')
      {
          url = controlador + '/book_add';
      }
      else
      {
        url = controlador + '/book_update';
      }

       // ajax adding data to database
          $.ajax({
            url : url,
            type: "POST",
            data: $('#formulario_libros').serialize(),
            dataType: "JSON",
            success: function(data)
            {
               //if success close modal and reload ajax table
               $('#formulario_modal_libros').modal('hide');
              location.reload();// for reload a page
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error agregando / actualizando datos');
            }
        });
    }

    function delete_book(id)
    {
      if(confirm('Estás seguro de eliminar?'))
      {
        // ajax delete data from database
          $.ajax({
            //url : "<?php echo site_url('books/book_delete')?>/",
            url: controlador + '/book_delete',
            data: {id:id},
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
               
               location.reload();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });

      }
    }

  </script>

    <!-- Bootstrap modal -->
    <div class="modal fade" id="formulario_modal_libros" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title">Formulario Libro</h3>
                </div>
                <div class="modal-body form">
                    <form action="#" id="formulario_libros" class="form-horizontal">

                        <input type="hidden" value="" name="book_id"/>

                        <div class="form-body">
                            <div class="form-group">
                                <label class="control-label col-md-3">ISBN</label>
                                <div class="col-md-9">
                                    <input name="book_isbn" placeholder="ISBN" class="form-control" type="text">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">Titulo</label>
                                <div class="col-md-9">
                                    <input name="book_title" placeholder="Título" class="form-control" type="text">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">Autor</label>
                                <div class="col-md-9">
                            		<input name="book_author" placeholder="Autor" class="form-control" type="text">
                                </div>
                            </div>

                            <div class="form-group">
                            	<label class="control-label col-md-3">Categoria</label>
                            	<div class="col-md-9">
                                <select name="book_category" class="form-control">
                                  <?php foreach ($categorias as $categoria): ?>
                                    <option value="<?php echo $categoria['category_id']; ?>"><?php echo $categoria['name_category']; ?></option>
                                  <?php endforeach ?>
                                </select>
                            	</div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Guardar</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- End Bootstrap modal -->

  </body>
</html>