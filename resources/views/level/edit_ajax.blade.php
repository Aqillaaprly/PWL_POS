@empty ($level)
<div id="modal-master" class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Error</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="alert alert-danger">
                <h5><i class="fa fa-ban"></i> Error!!</h5>
                The data you are looking for is not found
            </div>
            <a href="{{ url('/level') }}" class="btn btn-warning">Return</a>
        </div>
    </div>
</div>
@else
<form action="{{ url('/level/' . $level->level_id . '/update_ajax') }}" method="POST" id="form-edit">
    @csrf
    @method('PUT')
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Level</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Level Code</label>
                    <input value="{{ $level->level_code }}" type="text" name="level_code" id="level_code" class="form-control" required>
                    <small id="error-level_code" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Level Name</label>
                    <input value="{{ $level->level_code }}" type="text" name="level_code" id="level_code" class="form-control" required>
                    <small id="error-level_code" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea name="level_name" id="level_name" class="form-control" required>{{ $level->level_name }}</textarea>
                    <small id="error-level_name" class="error-text form-text text-danger"></small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-warning">Cancel</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</form>

<script>
$(document).ready(function() {
    $("#form-edit").validate({
        rules: {
            level_code: { required: true, minlength: 2, maxlength: 20 },
            level_name: { required: true, minlength: 3, maxlength: 50 },
                    },
        submitHandler: function(form) {
            $.ajax({
                url: form.action,
                type: form.method,
                data: $(form).serialize(),
                success: function(response) {
                    if(response.status) {
                        $('#myModal').modal('hide');
                        Swal.fire({
                            icon: 'success',
                            title: 'Succeed',
                            text: response.message
                        });
                        dataLevel.ajax.reload();
                    } else {
                        $('.error-text').text('');
                        $.each(response.msgField, function(prefix, val) {
                            $('#error-' + prefix).text(val[0]);
                        });
                        Swal.fire({
                            icon: 'error',
                            title: 'Something Went Wrong',
                            text: response.message
                        });
                    }
                }
            });
            return false;
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element) {
            $(element).removeClass('is-invalid');
        }
    });
});
</script>
@endempty