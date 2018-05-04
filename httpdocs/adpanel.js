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
        $('#loading').toggleClass('show');
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
    }
}

function adminDeleteVisitor(visitorid) {
    if(confirm("visitor gone?")) {
        $('#loading').toggleClass('show');
        $.post(
            '/adminpanelcall',
            { admindeletevisitor: true, visitorid: visitorid},
                function(output) {
                    $('#loading').toggleClass('show');
        });
        $("table").on('click', '.remove', function (e) {
            e.preventDefault();
            $(this).closest('tr').remove();
        });
    }
}

function adminCreatePDF() {
        $('#loading').toggleClass('show');
        $.post(
            '/adminpanelcall',
            { createPDF: true, name: pdfform.name.value },
                function(output) {
                    $('#loading').toggleClass('show');
        });
        $("table").on('click', '.remove', function (e) {
            e.preventDefault();
            $(this).closest('tr').remove();
        });
}

</script>

