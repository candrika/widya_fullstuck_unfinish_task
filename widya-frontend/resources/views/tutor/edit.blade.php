<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Quick Example <small>jQuery Validation</small></h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool remove" data-widget="remove"><i class="fas fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <form role="form" id="form-save">
                            {{csrf_field()}}
                            <div class="card-body">
                                <input type="hidden" name="tutor_id" valeu="{{$data['tutor_id']}}" class="form-control" id="tutor_id" placeholder="Nama Tutor">
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input name="nama" class="form-control" id="nama" valeu="{{$data['tutor_name']}}" placeholder="Nama Tutor" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" class="form-control" id="email" valeu="{{$data['tutor_name']}}" placeholder="Email Tutor" required>
                                </div>
                                <div class="form-group">
                                    <label for="roles">Tipe User</label>
                                    <select class="select2" style="width: 100%;" name="roles" id="roles">
                                        <option value="{{$data['roles_id']}}">{{$data['roles_name']}}</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <textarea name="alamat" class="form-control" id="alamat" placeholder="Alamat Tutor" required>{{$data['tutor_email']}}</textarea>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary save">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-6">
</div>
</div>
<script>
    var back = function loopBack(
        $.get('tutor/setting').done(function(response) {
            $('#contents').html("");
            $('#contents').html(response);
        }).fail(function() {
            alert('gagal mengambil konten');
        })
    );

    $("#roles").prop('disabled', true);
    $('.select2').select2();

    $(".remove").on("click", function() {
        back();
    })

    $("#form-save").submit(function(e) {
        e.preventDefault();
        var data = $(this).serialize();
        $.post('tutor/add', data, function(data) {
            console.log(data);
            var obj = JSON.parse(data);
            console.log(obj);
            if (obj.status == "true") {
                alert(obj.message);
                back();
            } else {
                alert('Opps terjadi kesalahan');
            }
        });
    })

</script>
