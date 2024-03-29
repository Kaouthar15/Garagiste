@extends('layouts.app-master')
@section('content')
    <style>
        .mt-4 {
            width: 50px;
            height: 50px;

        }
    </style>
    <div class="row justify-content-center">

        <div class="col-md-8">
            <div class="card">
                <div class="mt-4"></div>
                <div class="card-body">
                    <div class='max-w-md mx-auto'>
                        <!-- search bar -->

                    </div>
                    <p class="card-description"></p>
                    <div class="table-responsive">
                        <div class='max-w-md mx-auto'>
                            <div
                                class="relative flex items-center w-full h-12 rounded-lg focus-within:shadow-lg bg-white overflow-hidden">
                                <div class="grid place-items-center h-full w-12 text-gray-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </div>

                                <form id="searchForm" onsubmit="return submitForm(event)"
                                    action="{{ route('vehicle.search') }}" method="post"> 
                                    @csrf
                                    <input class="peer h-full w-full outline-none text-sm text-gray-700 pr-2" type="text"
                                        id="search" name="search" placeholder="Search something.." />
                                </form>     
                            </div>
                        </div>
                        <div id="searchResult">
                            @include('admin.vehicle.search')
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {


        })

        function submitForm(event) {
            event.preventDefault();
            var formData = $('#searchForm').serialize();

            $.ajax({
                type: 'POST',
                url: $('#searchForm').attr("action"),
                data: formData,
                success: function(data) {
                    $('#searchResult').html(data);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            })

        }
    </script>
@endsection
