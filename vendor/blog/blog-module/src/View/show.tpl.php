<?php
/**
 * Created by PhpStorm.
 * User: arsen
 * Date: 11.07.16
 * Time: 3:57
 */

$content = $this->content;
?>

<h2><?=$content['title']?></h2>
<p><?=$content['content']?></p>
<small><i><?=$content['user']['full_name']?>/<?=$content['post_date']?></i></small>
        <br>
        <br>
        <b>Comments:</b>
        <div></div>
