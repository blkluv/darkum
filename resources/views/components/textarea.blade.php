<div class="mt-3">
    <label class="form-label" for="description">
        {{ $title }}
    </label>
    <textarea required class="form-control" name="{{ $name }}" id="{{ $name }}" cols="{{ $cols }}" rows="{{ $rows }}" placeholder="{{ $placeholder }}">
        {{ $value }}
    </textarea>
</div>