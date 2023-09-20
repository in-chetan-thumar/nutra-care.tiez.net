
@foreach ($subcategories as $sub)

    <option value="{{ $sub->id }}">{{$prefix }} {{ $sub->title }}</option>
    @if (count($sub->childs) > 0)
        @php
            // Creating parents list separated by ->.
            $parents =  $sub->title;
        @endphp
        @include('admin.category.sub_category', ['subcategories' => $sub->childs, 'parent' => $parents,'prefix' => $prefix . ' - '])
    @endif
@endforeach
