@extends('layouts.app')

@section('content')

<link href="{{ asset('css/detail.css') }}" rel="stylesheet">
<div class="blog-single gray-bg">
        <div class="container"> 
            <h2>{{ $examForm->title }}</h2> 
            <p>{!! nl2br(e($examForm->description)) !!}</p> 
            <form action="{{ route('submissions.store',$examForm->id) }}" method="POST" enctype="multipart/form-data"> 
                @csrf 
                <input type="hidden" name="exam_form_id" value="{{ $examForm->id }}"> 
                @foreach($examForm->fields as $field) 
                <div class="mb-3"> 
                    <label class="form-label">{{ $field->label }}</label> 
                    @php $name = $field->field_key; @endphp 
                    @switch($field->type) 
                    @case('text') 
                    <input type="text" name="data[{{ $name }}]" class="form-control" value="{{ old('data.'.$name) }}"> 
                    @break 
                    @case('textarea') 
                    <textarea name="data[{{ $name }}]" class="form-control">{{ old('data.'.$name) }}</textarea> @break 
                    @case('select') 
                    <select name="data[{{ $name }}]" class="form-control"> 
                        <option value="">Select</option> 
                        @foreach($field->options ?? [] as $opt) 
                        <option value="{{ is_array($opt)?$opt['value']:$opt }}">{{ is_array($opt)?$opt['label']:$opt }}</option> 
                    @endforeach 
                </select> 
                @break 
                @case('date') 
                <input type="date" name="data[{{ $name }}]" class="form-control" value="{{ old('data.'.$name) }}"> @break 
                @case('file') 
                <input type="file" name="{{ $name }}" class="form-control"> 
                @break 
                @default 
                <input type="text" name="data[{{ $name }}]" class="form-control"> 
            @endswitch 
        </div> 
        @endforeach 
        <div class="mb-3"> 
            <label>Amount (INR)</label><br> 
            <span>₹{{$examForm->fees}}</span>
        </div> 
        <input type="hidden" name="gateway" value="razorpay">
        <button class="btn btn-primary">Proceed to Pay</button> 
    </form> 
  </div>
</div>
@endsection