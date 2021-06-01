<div class="row">
    <div class="col-md-12">
        <h3>
            {$data['post']['post_date']}: {$data['post']['title']}
            {if $data['post']['user_id'] == $uid}
                <a href="/edit-post/{$data['post']['id']}" class="btn btn-info btn-sm">edit</a>
                <a href="/delete-post/{$data['post']['id']}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?');">delete</a>
            {/if}
        </h3>
        <p>
            {$data['post']['content']|escape|nl2br}
        </p>
        <p>Author: {$data['post']['author']}</p>
    </div>
</div>
