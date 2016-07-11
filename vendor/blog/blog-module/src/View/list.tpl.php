<?php
/**
 * Created by PhpStorm.
 * User: arsen
 * Date: 11.07.16
 * Time: 3:57
 */

$content = $this->content;

foreach ($content['result'] as $post) {
?>

    <div>
        <h3><a href="/post/?id=<?=$post['id']?>"><?=$post['title']?></a></h3>
        <small><p><i><?=$post['post_date']?><i></p></small>
        <small><i><?=$post['user']['full_name']?></i></small>
    <div>

<?php
}
?>