<div class="row">
    <div class="col-md-12">
        <h3>
            <a href="/post/{$post['slug']}">{$post['post_date']}: {$post['title']}</a>
            {if $post['user_id'] == $uid}
                <a href="/edit-post/{$post['id']}" class="btn btn-info btn-sm" >edit</a>
                <a href="/delete-post/{$post['id']}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?');">delete</a>
            {/if}
        </h3>
        <p>
            {$post['content']|escape|nl2br|truncate:1000:"..."}
        </p>
        <p>Author: {$post['author']}</p>
    </div>
</div>
