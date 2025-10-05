
@extends('backend.layouts.master')

@section('title')
Form Field - Admin Panel
@endsection

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

<style>
    .form-check-label {
        text-transform: capitalize;
    }
</style>
@endsection


@section('admin-content')

<!-- page title area start -->
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Form Field</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li><a href="{{ route('admin.exam_forms.index') }}">All Form Field</a></li>
                    <li><span>{{ isset($formField) ? 'Edit' : 'Create'}}  Form Field</span></li>
                </ul>
            </div>
        </div>
        <div class="col-sm-6 clearfix">
            @include('backend.layouts.partials.logout')
        </div>
    </div>
</div>
<!-- page title area end -->

<div class="main-content-inner">
    <div class="row">
        <!-- data table start -->
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">{{ isset($formField) ? 'Edit' : 'Create New'}} Form Field</h4>
                    @include('backend.layouts.partials.messages')
                    
                    <form action="{{ isset($formField) ? route('admin.form_fields.update', [$examForm->id, $formField->id]) : route('admin.form_fields.store',$examForm->id) }}" method="POST">
                        @csrf
                        @if(isset($formField))
                        @method('PUT')
                        @endif
                        <div class="form-row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="field_key">Field Key</label>
                                <input type="text" class="form-control" id="field_key" name="field_key" placeholder="Enter Key" value="{{old('field_key',isset($formField) ? $formField->field_key : '')}}">
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="label">Label</label>
                               <input type="text" class="form-control" id="label" name="label" placeholder="Enter Label" value="{{old('label',isset($formField) ? $formField->label : '')}}">
                            </div>

                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="type">Type</label>
                                <select class="select2 form-control"  name="type">
                                    <option value="">Select Type</option>
                                    <option value="text" {{ old('type',isset($formField) ? $formField->type : '') == 'text' ? 'selected' : '' }}>Text</option>
                                    <option value="textarea" {{ old('type',isset($formField) ? $formField->type : '') == 'textarea' ? 'selected' : '' }}>Textarea</option>
                                    <option value="select" {{ old('type',isset($formField) ? $formField->type : '') == 'select' ? 'selected' : '' }}>Select</option>
                                    <option value="file" {{ old('type',isset($formField) ? $formField->type : '') == 'file' ? 'selected' : '' }}>File</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="options">Options (for select)</label>
                                <textarea name="options" class="form-control">{{old('options',isset($formField) ? $formField->options : '')}}</textarea>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="order">Order</label>
                                <input type="text" name="order" class="form-control" value="{{old('order',isset($formField) ? $formField->order : '')}}" placeholder="Enter order" />
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Save</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- data table end -->
        
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2();
    })
</script>
@endsection