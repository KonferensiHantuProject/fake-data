@extends('layout.main')

@section('container')

    <div class="mb-5 text-white p-3" style="background: linear-gradient(to right, #28313B, #485461)">
        <div class="row h-100 w-100 mt-5 mb-5">
            <div class="col-md-12">
                <div class="d-flex flex-column">
                    <h1 class="display-1 text-center mb-2">FREE API</h1>
                    <p class="h4 text-center mb-2">Feel Free to Use It</p>
                    <p class="h6 text-center mb-2">Do Practices with It</p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="mb-5 p-3">
        <div class="row h-100 w-100">
            <div class="col-md-12 mb-5">
                <div class="d-flex flex-column">
                    <h1 class="display-2 text-center mb-2">WHAT FOR?</h1>
                    <p class="h6 text-center mb-2">Whenever you actually want to try to build a portofolio or for practices that need a dummy data</p>
                </div>
            </div>
            <div class="col-md-12">
                <div class="d-flex flex-column">
                    <h1 class="display-2 text-center mb-2">TRY IT</h1>
                    <a href="/users" target="_blank" class="text-center">/users</a>
                    <a href="/posts" target="_blank" class="text-center">/posts</a>
                </div>
            </div>
        </div>
    </div>

@endsection