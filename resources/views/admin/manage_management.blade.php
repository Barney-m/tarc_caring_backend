@extends('layouts.adminapp')

@section('content')

<table class="table" id="table">
    <thead>
        <tr>
            <th class="text-center">#</th>
            <th class="text-center">Management ID</th>
            <th class="text-center">Name</th>
            <th class="text-center">Email</th>
            <th class="text-center">Phone No.</th>
            <th class="text-center">Status</th>
        </tr>
    </thead>
    <tbody>
    <?php $index = 0;?>
    @foreach($datas as $data)
        <tr class="{{ $index + 1 }}">
            <td>{{ $index + 1 }}</td>
            <td>{{ $data->user_id }}</td>
            <td>{{ $data->name }}</td>
            <td>{{ $data->email }}</td>
            <td>{{ $data->mobile_no }}</td>
            <td>{{ $data->status }}</td>
            <td><button class="edit-modal btn btn-info" href>
                    <span class="glyphicon glyphicon-edit"></span> Edit
                </button>
                <button class="delete-modal btn btn-danger" data-info="{{$index}},{{$data->user_id}},{{$data->name}},{{$data->email}},{{$data->mobile_no}},{{$data->status}}">
                    <span class="glyphicon glyphicon-trash"></span> Delete
                </button></td>
        </tr>
    @endforeach
    </tbody>
</table>
<script>
    $(document).on('click', '.edit-modal', function() {
        $('#footer_action_button').text(" Update");
        $('#footer_action_button').addClass('glyphicon-check');
        $('#footer_action_button').removeClass('glyphicon-trash');
        $('.actionBtn').addClass('btn-success');
        $('.actionBtn').removeClass('btn-danger');
        $('.actionBtn').removeClass('delete');
        $('.actionBtn').addClass('edit');
        $('.modal-title').text('Edit');
        $('.deleteContent').hide();
        $('.form-horizontal').show();
        var stuff = $(this).data('info').split(',');
        fillmodalData(stuff)
        $('#myModal').modal('show');
    });

    function fillmodalData(details){
        $('#index').val(details[0]);
        $('#user_id').val(details[1]);
        $('#name').val(details[2]);
        $('#email').val(details[3]);
        $('#mobile_no').val(details[4]);
        $('#status').val(details[5]);
    }

    $('.modal-footer').on('click', '.edit', function() {
        $.ajax({
            type: 'post',
            url: '/edit',
            data: {
                '_token': $('input[name=_token]').val(),
                'index': $("#index").val(),
                'user_id': $('#user_id').val(),
                'name': $('#name').val(),
                'email': $('#email').val(),
                'mobile_no': $('#mobile_no').val(),
                'status': $('#status').val()
            },
            success: function(data) {
                if (data.errors){
                    $('#myModal').modal('show');
                    if(data.errors.user_id) {
                        $('.user_error').removeClass('hidden');
                        $('.user_error').text("First name can't be empty !");
                    }
                    if(data.errors.name) {
                        $('.name_error').removeClass('hidden');
                        $('.name_error').text("Last name can't be empty !");
                    }
                    if(data.errors.email) {
                        $('.email_error').removeClass('hidden');
                        $('.email_error').text("Email must be a valid one !");
                    }
                    if(data.errors.mobile_no) {
                        $('.mobileNo_error').removeClass('hidden');
                        $('.mobileNo_error').text("Country must be a valid one !");
                    }
                }
                 else {

                //      $('.error').addClass('hidden');
                // $('.item' + data.id).replaceWith("<tr class='item" + data.id + "'><td>" +
                //         data.id + "</td><td>" + data.first_name +
                //         "</td><td>" + data.last_name + "</td><td>" + data.email + "</td><td>" +
                //          data.gender + "</td><td>" + data.country + "</td><td>" + data.salary +
                //           "</td><td><button class='edit-modal btn btn-info' data-info='" + data.id+","+data.first_name+","+data.last_name+","+data.email+","+data.gender+","+data.country+","+data.salary+"'><span class='glyphicon glyphicon-edit'></span> Edit</button> <button class='delete-modal btn btn-danger' data-info='" + data.id+","+data.first_name+","+data.last_name+","+data.email+","+data.gender+","+data.country+","+data.salary+"' ><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");
                }}
                        });
                    });
</script>
@endsection
