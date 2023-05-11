@extends('layouts.userLayout')
@section('title', 'comments')
@section('content')

    <section style="background-color: #fff;" class="comments">
        <div class="container my-5 py-5">
        <div class="row w-100">
            <div class="col">
            <div class="card w-100">
                
                @isset($comments)
                @foreach ($comments as $item)
                    <div class="card-body w-100 mb-2">
                    <div class="d-flex flex-start align-items-center w-100">
                        <div>
                        <h6 class="fw-bold text-primary"> {{ Auth()->user()->name }} </h6>
                        </div>
                    </div>
        
                    <p class="mt-1 mb-4 pb-2">
                        {{ $item->comment }}
                    </p>
                    </div>
                @endforeach
                @endisset

            </div>
            </div>
        </div>
        </div>
    </section>

@endsection