<html>
 <head>
  <title>99Dashboard</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>  
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <style>
   body
   {
    margin:0;
    padding:0;
    background-color:#f1f1f1;
   }
   .box
   {
    width:1270px;
    padding:20px;
    background-color:#fff;
    border:1px solid #ccc;
    border-radius:5px;
    margin-top:25px;
   }
  </style>
 </head>
 <body>
  <div class="container box">
   <h1 align="center"> </h1>
   <br />
    <div>
      
      <input id="add_picture"   placeholder=" url da image"/>
      <input id="add_title"   placeholder="titulo"/>
      <input id="add_subtitle"  placeholder="subtitulo"/>
      <input id="add_description"   placeholder="descrição"/>
      <input id="add_episodio"  placeholder=" episodio"/>
      <input id="add_temporada"   placeholder="temporada"/>
      <input id="add_url"   placeholder="url do video "/>
      <input id="add_extra"   placeholder="extras (categorias extras) "/>
      <input id="add_status"   placeholder=" status"/>
      <input id="is_tv"   placeholder="isTV 0 ou 1"/> 
        <button type="button" id="add_save_all" class="btn btn-success"  >Salvar</button>
      
    </div>
    <br />
    
   <div class="table-responsive">
    <br /> 
    <br /><br />
    <table id="user_data" class="table table-bordered table-striped">
     <thead>
      <tr>
       <th width="10%">Picture</th>
       <th width="20%">Title</th>
       <th width="25%">URL</th>
       <th width="25%">Picture</th>
       <th width="10%">Categoria</th>
       <th width="10%"> </th>
      </tr>
     </thead>
    </table>
    
   </div>
  </div>
 </body>
</html>

<div id="userModal" class="modal fade">
 <div class="modal-dialog">
  <form method="post" id="user_form" enctype="multipart/form-data">
   <div class="modal-content">
    <div class="modal-header">
     <button type="button" class="close" data-dismiss="modal">&times;</button>
     <h4 class="modal-title">Add User</h4>
    </div>
    <div class="modal-body">
     <label>Enter First Name</label>
     <input type="text" name="title" id="title" class="form-control" />
     <br />
     <label>Enter Last Name</label>
     <input type="text" name="url" id="url" class="form-control" />
     <br />
     <label>Select User Image</label>
     <input type="file" name="user_picture" id="user_picture" />
     <span id="user_uploaded_picture"></span>
    </div>
    <div class="modal-footer">
     <input type="hidden" name="user_id" id="user_id" />
     <input type="hidden" name="operation" id="operation" />
     <input type="submit" name="action" id="action" class="btn btn-success" value="Add" />
     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
   </div>
  </form>
 </div>
</div>

<script type="text/javascript" language="javascript" >
$(document).ready(function(){ 
  
   $(document).on('click', '#add_save_all', function(){
  
     //JSON.stringify(params)
     var params = {
       picture: $('#add_picture').val(), 
       title: $('#add_title').val(), 
       subtitle: $('#add_subtitle').val(), 
       description: $('#add_description').val(), 
       episodio: $('#add_episodio').val(), 
       temporada: $('#add_temporada').val(), 
       url: $('#add_url').val(), 
       extra: $('#add_extra').val(), 
       status: $('#add_status').val(), 
       is_tv: $('#is_tv').val()
     };
     
     console.log(JSON.stringify(params));
     
    $.ajax({
   url:"insert_new.php",
   method:"POST",
  data: JSON.stringify(params),
   dataType:"json",
   success:function(data) { 
       dataTable.ajax.reload();
   },
  error: function(xhr, status, error) {
 
  alert(error);
    
}
    
  })
 });
  
   
  
  
  
 $('#add_button').click(function(){
  $('#user_form')[0].reset();
  $('.modal-title').text("Add User");
  $('#action').val("Add");
  $('#operation').val("Add");
  $('#user_uploaded_picture').html('');
 });
 
 var dataTable = $('#user_data').DataTable({
  "processing":true,
  "serverSide":true,
  "order":[],
  "ajax":{
   url:"fetch.php",
   type:"POST" 
  },
  "columnDefs":[
   {
    "targets":[0, 3, 4],
    "orderable":false,
   },
  ],

 });
  
  
  

 $(document).on('submit', '#user_form', function(event){
  event.preventDefault();
  var firstName = $('#title').val();
  var lastName = $('#url').val();
  var extension = $('#user_picture').val().split('.').pop().toLowerCase();
  if(extension != '')
  {
   if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)
   {
    alert("Invalid Image File");
    $('#user_picture').val('');
    return false;
   }
  } 
  if(firstName != '' && lastName != '')
  {
   $.ajax({
    url:"insert.php",
    method:'POST',
    data:new FormData(this),
    contentType:false,
    processData:false,
    success:function(data)
    {
     alert(data);
     $('#user_form')[0].reset();
     $('#userModal').modal('hide');
     dataTable.ajax.reload();
    }
   });
  }
  else
  {
   alert("Both Fields are Required");
  }
 });
 
 $(document).on('click', '.update', function(){
  var user_id = $(this).attr("id");
  $.ajax({
   url:"fetch_single.php",
   method:"POST",
   data:{user_id:user_id},
   dataType:"json",
   success:function(data)
   {
    $('#userModal').modal('show');
    $('#title').val(data.title);
    $('#url').val(data.url);
    $('.modal-title').text("Edit User");
    $('#user_id').val(user_id);
    $('#user_uploaded_picture').html(data.user_picture);
    $('#action').val("Edit");
    $('#operation').val("Edit");
   }
  })
 });
 
 $(document).on('click', '.Salvar', function(){
  var user_id = $(this).attr("id");
  var title = $("#"+user_id+"_title").val();
  var url = $("#"+user_id+"_url").val();
  var picture = $("#"+user_id+"_picture").val();
     
    $.ajax({
    url:"salvar.php",
    method:"POST",
    data:{user_id:user_id, title:title, url:url,picture:picture },
    success:function(data)
    {
     //alert(data);
     //dataTable.ajax.reload();
      $("#"+user_id+"_title").css("background-color", "#5fba7d");
    }
   }); 
 });
 
 
});
</script>