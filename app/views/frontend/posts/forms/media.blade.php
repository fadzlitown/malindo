{{ Form::open(array('url' => 'listing/photo/submit', 'class' => 'form-horizontal photoForm', 'files' => true)) }}
<h2>Edit Profile</h2>
<hr/>
<div class="form-group {{$var = $errors->first('images')}} {{ ($var !== '') ? 'has-error' : ''}}">
    <label for="name" class="col-sm-2 control-label">Image 1</label>
    <div class="col-sm-4">
        <?php echo Form::file('images[]', array('class' => 'form-control')); ?>
    </div>
    <span class="help-block"></span>
</div>

<div class="form-group {{$var = $errors->first('images')}} {{ ($var !== '') ? 'has-error' : ''}}">
    <label for="name" class="col-sm-2 control-label">Image 2</label>
    <div class="col-sm-4">
        <?php echo Form::file('images[]', array('class' => 'form-control')); ?>
    </div>
    <span class="help-block"></span>
</div>


<div class="form-group">
    <div class="col-sm-offset-2 col-sm-4">
        {{ Form::hidden('post_id', $post->id) }}
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
{{ Form::close() }}
