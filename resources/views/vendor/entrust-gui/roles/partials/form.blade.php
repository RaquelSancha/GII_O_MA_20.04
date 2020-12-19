<input type="hidden" name="_token" value="{{ csrf_token() }}">
<div class="form-group">
    <label for="name">{{ trans('adminlte_lang::message.name') }}</label>
    <input type="input" class="form-control" id="name" placeholder="Name" name="name" value="{{ (Session::has('errors')) ? old('name', '') : $model->name }}">
</div>
<div class="form-group">
    <label for="display_name">{{ trans('adminlte_lang::message.displayname') }}</label>
    <input type="input" class="form-control" id="display_name" placeholder="Display Name" name="display_name" value="{{ (Session::has('errors')) ? old('display_name', '') : $model->display_name }}">
</div>
<div class="form-group">
    <label for="description">{{ trans('adminlte_lang::message.description') }}</label>
    <input type="input" class="form-control" id="description" placeholder="Description" name="description" value="{{ (Session::has('errors')) ? old('description', '') : $model->description }}">
</div>
<div class="form-group">
    <label for="permissions">{{ trans('adminlte_lang::message.permissions') }}</label>
    <select name="permissions[]" multiple class="form-control">
      @foreach($relations as $index => $relation)
        <select>
            <option value="volvo">$index</option>
        </select>

      @endforeach
    </select>
</div>
