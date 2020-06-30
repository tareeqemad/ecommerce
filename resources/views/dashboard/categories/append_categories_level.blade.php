<div class="form-group">
    <label>اختيار مستوى الصنف</label>
    <select class="form-control select2"  name="parent_id" style="width: 100%;text-align: right">
        <option value="0">مستوى أساسي</option>
        @if(!empty($getCategories))
            @foreach($getCategories as $category)
                    <option value="{{$category['id']}}">{{$category['category_name']}}</option>
                @if(!empty($category['subcategories']))
                    @foreach($category['subcategories'] as $subcategory )
                        <option value="{{$subcategory['id']}}">&nbsp; &raquo;&nbsp;{{$subcategory['category_name']}}</option>
                    @endforeach
                @endif
                @endforeach
            @endif
    </select>
</div>
