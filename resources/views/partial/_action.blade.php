<a href="{{$url_show}}" class="btn-show" title="Details: {{ $model->name }}">
    <i class="fa fa-eye text-primary"></i>
</a>
|
<a href="javascript:void(0)" class="modal-show editCat" data-id="{{ $model->id }}"  title="Edit {{ $model->name }}">
    <i class="fa fa-edit text-info"></i>
</a> |

<a href="{{$url_destroy}}" class="btn-delete" data-id="{{ $model->id }}" title="{{ $model->name }}">
    <i class="fa fa-trash text-danger"></i>
</a>
