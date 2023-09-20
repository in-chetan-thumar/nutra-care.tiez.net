
@foreach ($subcategories as $sub)

    <option value="{{ $sub->id }}">{{$prefix }} {{ $sub->title }}</option>
    @if (count($sub->child) > 0)
        @php
            // Creating parents list separated by ->.
            $parents =  $sub->title;
        @endphp
        @include('admin.category.sub_category', ['subcategories' => $sub->child, 'parent' => $parents,'prefix' => $prefix . ' - '])
    @endif
@endforeach
