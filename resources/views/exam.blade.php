
@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<div class="container">
                <div class="row mt-n5">

                    @foreach ($forms as $form)

                    <div class="col-md-6 col-lg-4 mt-5 wow fadeInUp" data-wow-delay=".2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                        <div class="blog-grid">
                            <div class="blog-grid-text p-4">
                                <h3 class="h5 mb-3"><a href="{{route('forms.show',$form->slug)}}">{{$form->title}}</a></h3>
                                <p class="display-30">{{ \Illuminate\Support\Str::limit($form->description,120) }}</p>
                                <div class="meta meta-style2">
                                    <ul>
                                        <li><a href="{{route('forms.show',$form->slug)}}"><i class="fas fa-calendar-alt"></i> {{ \Carbon\Carbon::parse($form->created_at)->diffForHumans() }}</a></li>
                                        
                                        <li>Fees :  {{$form->fees}}</li>
                                    </ul>
                                </div>

                            </div>
                        </div>
                    </div>
                    @endforeach
                    
                </div>
                <div class="row mt-6 wow fadeInUp" data-wow-delay=".6s" style="visibility: visible; animation-delay: 0.6s; animation-name: fadeInUp;">
                    <div class="col-12">
                        {{ $forms->links() }}
                        <!-- <div class="pagination text-small text-uppercase text-extra-dark-gray">
                             <ul>
                                <li><a href="#!"><i class="fas fa-long-arrow-alt-left me-1 d-none d-sm-inline-block"></i> Prev</a></li>
                                <li class="active"><a href="#!">1</a></li>
                                <li><a href="#!">2</a></li>
                                <li><a href="#!">3</a></li>
                                <li><a href="#!">Next <i class="fas fa-long-arrow-alt-right ms-1 d-none d-sm-inline-block"></i></a></li>
                            </ul>
                        </div> -->
                    </div>
                </div>

            </div>

@endsection