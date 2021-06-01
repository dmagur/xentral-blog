{foreach from=$data['posts'] item="post"}
    {include file="includes/post.tpl" post=$post type='short'}
{foreachelse}
    <p>No posts yet</p>
{/foreach}
{include file="includes/navigation.tpl" data=$data url="/?action=home"}
