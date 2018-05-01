<script>
// this needs alot of fine tuning!!!!!! and its not working....
$(document).ajaxStart(function(){ $('#loading').show(); }).ajaxStop(function(){ $('#loading').hide(); });

    function updateUser() {
        $.post(
            '/updateuser', 
            { updateuser: true, firstname: user.firstname.value, prefix:user.prefix.value, lastname: user.lastname.value, currentemployer: user.currentemployer.value, id: user.id.value },
            function(output) {
                $('#succes').html(output).show();
            });
    }

    function addVis() {
        $.post(
            '/addvisitor',
            { addvisitor: true, inviterid: user.id.value, firstname: updatevisitor.firstname.value, lastname: updatevisitor.lastname.value, email: updatevisitor.email.value },
            function(output) {
                $('#visitors').append(output);
                $('.inputfield').val('');
            });
    }
    function deleteVisit(id) {
        $.post(
            '/deleteVisitor',
            { deletevisitor: true, deleteid: id },
            function(output) {
                $('#succes').html(output).show();
            }
        );
        $("table").on('click', '.remove', function (e) {
                    e.preventDefault();
                    $(this).closest('tr').remove();
                });
    }
</script>

