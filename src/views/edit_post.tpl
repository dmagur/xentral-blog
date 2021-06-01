<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <form method="post">
            <input type="hidden" name="data[id]" value="{if isset($data['request']['data']['id'])}{$data['request']['data']['id']}{/if}">
            <div class="form-group">
                <label for="data[post_date]">Date*</label>
                <input type="text" name="data[post_date]" class="form-control" value="{if isset($data['request']['data']['post_date'])}{$data['request']['data']['post_date']}{else}{$smarty.now|date_format:"d.m.Y"}{/if}">
                {if isset($data['errors']['post_date'])}<small class="error">Field required</small>'{/if}
            </div>
            <div class="form-group">
                <label for="data[title]">Title*</label>
                <input type="text" name="data[title]" class="form-control" value="{if isset($data['request']['data']['title'])}{$data['request']['data']['title']}{/if}">
                {if isset($data['errors']['title'])}<small class="error">Field required</small>{/if}
            </div>
            <div class="form-group">
                <label for="data[content]">Content*</label>
                <textarea name="data[content]" class="form-control" rows="12">{if isset($data['request']['data']['content'])}{$data['request']['data']['content']}{/if}</textarea>
                {if isset($data['errors']['content'])}<small class="error">Field required</small>{/if}
            </div>
            <button type="submit" class="btn btn-default" name="submit" value="1">Submit</button>
        </form>
    </div>
</div>
