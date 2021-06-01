<nav aria-label="...">
    <ul class="pager">
        {if $data['request']['page']>1}
            <li><a href="{$url}&page={$data['request']['page']-1}">Newer posts</a></li>
        {/if}
        {if $data['request']['page']<$data['total_pages']}
            <li><a href="{$url}&page={$data['request']['page']+1}">Older posts</a></li>
        {/if}
    </ul>
</nav>