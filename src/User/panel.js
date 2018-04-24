<script>
// this needs alot of fine tuning!!!!!! and its not working....
    function updateUser() {
        console.log('?');
        $.post('../src/User/userpanel.php', { blarps: formtest.name.value },
            function(output) {
                $('#test').html(output).show();
            });
    }

</script>
