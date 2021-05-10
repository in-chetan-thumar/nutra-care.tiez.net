@extends('admin.layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="dashbordreoirt">
                    <p><i class="m-menu__link-icon fas fa-cogs"></i>Setting</p>
                </div>
            </div>
        </div>
        <div id="data-list-page">
            @if(session()->has('success'))
                @if(session()->get('success'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @else
                    <div class="alert alert-danger">
                        {{ session()->get('message') }}
                    </div>
                @endif
            @endif
            <div class="table-responsive">
                {{ Form::open(array('url' =>route('settings.store'),'name' => 'form-settings', 'id'=>'form-settings','enctype'=>'multipart/form-data')) }}
                @csrf

                <table class="table usertable table-striped">
                    <tbody>
                    @php
                        $index = 0;
                    @endphp
                    @foreach($records as $value)
                        <thead>
                        <tr>
                            <th>{{$value['section_title']}}</th>
                        </tr>
                        <thead>
                        @forelse($value['section_data'] as $list)
                            <tr>
                                <td>{{$list->field_title}}</td>
                                <td>
                                    <div class="form-group col-md-12">
                                        @if($list->input_type == 'textarea')
                                            <textarea class="form-control" name="{{strtolower($list->column)}}"
                                            >{{$list->value}}</textarea>

                                        @else
                                            <input class="form-control" name="{{strtolower($list->column)}}"
                                                   type="{{$list->input_type}}"
                                                   value="{{$list->value}}">

                                        @endif
                                        @error(strtolower($list->column))
                                            <span style="color:red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" align="center">Record not found.</td>
                            </tr>
                        @endforelse
                        @endforeach
                        </tbody>
                </table>
                <button class="btn theme-btn">Submit</button>
                {{ Form::close() }}
            </div>


        </div>
    </div>

@endsection
