
@extends('backend.layouts.master')

@section('title')
Exam form - Admin Panel
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
                <h4 class="page-title pull-left">Exam form</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li><a href="{{ route('admin.exam_forms.index') }}">All Exam form</a></li>
                    <li><span>{{ isset($examForm) ? 'Edit' : 'Create'}}  Exam form</span></li>
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
                    <h4 class="header-title">{{ isset($examForm) ? 'Edit' : 'Create New'}} Exam form</h4>
                    @include('backend.layouts.partials.messages')
                    
                    <form action="{{ isset($examForm) ? route('admin.exam_forms.update',$examForm->id) : route('admin.exam_forms.store') }}" method="POST">
                        @csrf
                        @if(isset($examForm))
                        @method('PUT')
                        @endif
                        <div class="form-row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="name">Title</label>
                                <input type="text" class="form-control" id="title" name="title" placeholder="Enter title" value="{{old('title',isset($examForm) ? $examForm->title : '')}}">
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="email">Description</label>
                                <textarea name="description" class="form-control">{{ old('description',isset($examForm) ? $examForm->description : '') }}</textarea>
                            </div>

                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="is_active">Status</label>
                                <select class="select2 form-control"  name="is_active">
                                    <option value="1" {{ old('is_active',isset($examForm) ? $examForm->is_active : '') == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ old('is_active',isset($examForm) ? $examForm->is_active : '') == 0 ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="email">Description</label>
                                <input type="number" step="0.01" min="0" class="form-control" id="fees" name="fees" placeholder="Enter fees" value="{{old('fees',isset($examForm) ? $examForm->fees : '')}}">
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Save User</button>
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