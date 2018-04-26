<script>
// this needs alot of fine tuning!!!!!! and its not working....
    function updateUser() {
        $.post(
            '/updateuser', 
            { updateuser: true, firstname: user.firstname.value, prefix:user.prefix.value, lastname: user.lastname.value, currentemployer: user.currentemployer.value, id: user.id.value },
            function(output) {
                console.log(output);
                $('#succes').html(output).show();
            });
    }
</script>

