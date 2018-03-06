<?php

$controller = new UsersController();

if (isset($_POST))
{
    $redirect = $controller->create($_POST);
    header($redirect);
}
else
{
    $user = $controller->create(); ?>

<!DOCTYPE HTML>
<html>
    ...
    <body>
        <form method="post" action="./create.php">
            <input name="username" type="text" value="<?= $user->get_username() ?>">
            <input name="email" type="text" value="<?= $user->get_username() ?>">
            <input name="password" type="password" value="<?= $user->get_username() ?>">
            <button type="submit">Submit</button>
        </form>
    </body>
</html>

<?php } ?>

