<script>
//url = /adminpanelcall master call maybe??

function adminUpdateUser(id) {
    $('#loading').toggleClass('show');
    $.post(
        '/adminpanelcall', 
        { adminupdateuser: true, userid: id, firstname: allusers.firstname.value, prefix: allusers.prefix.value,lastname: allusers.lastname.value, email: allusers.email.value, currentemployer: allusers.currentemployer.value,role: allusers.role.value},
            function(output) {
                $('#loading').toggleClass('show');
    });
}

function adminDeleteUser(id) {
    if(confirm("are you sure if you press yes data is gone forever!")) {
        if(confirm("are you sure sure? you are deleting entrys from people!")) {
        $('#loading').toggleClass('show');
        console.log('this is true');
        $.post(
            '/adminpanelcall', 
            { admindeleteuser: true, userid: id},
                function(output) {
                    $('#loading').toggleClass('show');
        });
        $("table").on('click', '.remove', function (e) {
            e.preventDefault();
            $(this).closest('tr').remove();
        });
    }}
}

</script>

