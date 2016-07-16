<?php
/**
 * Created by PhpStorm.
 * User: arsen
 * Date: 11.07.16
 * Time: 5:02
 */

$content = $this->content;
?>
<?php if (!$content['success']):?><p style="color: red">Wrong creditionals</p><?php endif?>
<form action="/login/"  method="post">
Login: <input type = "text" name="login"><br>
Password: <input type = "text" name="password"><br>
<input type="submit" value="go" name = "auth">

</form>
