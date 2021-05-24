 <div class="row">

     <div class="col-12">
         <div class="card">
             <div class="card-header">
             </div>
             <div class="card-body">
                 <button class="btn btn-black btn-primary mb-2" id="add">Tambah</button>

                 <table id="table" class="table table-hover">
                     <thead>
                         <tr>
                             <th>Nama Tutor</th>
                             <th>Alamat</th>
                             <th>Email</th>
                             <th>Aksi</th>
                         </tr>
                     </thead>
                     <tbody>
                         @foreach($data as $key => $d)
                         <tr>
                             <td>{{$d['tutor_name']}}</td>
                             <td>{{$d['tutor_address']}}</td>
                             <td>{{$d['tutor_email']}}</td>
                             <td><button class="btn btn-xl btn-warning edit" data-id="{{$d['tutor_id']}}"><i class="fas fa-pencil-alt"></i></button>&nbsp;&nbsp;&nbsp;<button class="btn btn-xl btn-danger delete" data-id={{$d['tutor_id']}}><i class="fas fa-trash-alt"></i></button></td>
                         </tr>
                         @endforeach
                     </tbody>
                 </table>
             </div>
         </div>
     </div>
 </div>
 <script>
     $('#add').on('click', function(e) {
         e.preventDefault(e);
         $.get(`tutor/add`).done(function(response) {
             $('#contents').html("");
             //console.log(response);
             $('#contents').html(response);
         }).fail();
     })

     $('#table').on('click', '.edit', function(e) {
         e.preventDefault(e);
         var id = $(this).data('id');
         console.log(id)
         $.get('/tutor/edit', {
             'id': id
         }).done(function(response) {
             $('#contents').html("");
             //console.log(response);
             $('#contents').html(response);
         }).fail(function() {

         })
     })


     /*$('.delete').on('click', function(e) {
          if (confirm("Apa anda yakin ingin menghapus data ini?")) {
         $.get(`tutor/add`).done(function(response) {
             $('#contents').html("");
             //console.log(response);
             $('#contents').html(response);
         }).fail();
         }else{
      false;
    }
     })*/

     $('#table').DataTable({
         "paging": true
         , "lengthChange": false
         , "searching": true
         , "ordering": true
         , "autoWidth": true
         , "responsive": true
     , });

 </script>
