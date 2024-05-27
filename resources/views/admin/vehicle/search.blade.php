<table class="table table-striped">
    @include('layouts.partials.messages')
    <!-- Table Header -->
    <thead>
        <tr>
            <th>Download</th>
            <th>Registration</th>
            <th>Model</th>
            <th>FuelType</th>
            <th>Client</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <!-- Table Body -->
    <tbody>
        @foreach ($vehicles as $vehicle)
            <tr id="row{{ $vehicle->id }}">
                <td><i class="fa fa-download download-btn"
                        href="{{ route('vehicles.download-pdf', ['vehicle' => $vehicle->id]) }}"
                        data-vehicle-id="{{ $vehicle->id }}" style="font-size:30px; cursor: pointer;"></i></td>
                <td>{{ $vehicle->registration }}</td>
                <td>{{ $vehicle->model }}</td>
                <td>{{ $vehicle->fuelType }}</td>
                <td>{{ $vehicle->user->phoneNumber }}</td>
                <td><a class="btn btn-secondary edit-btn" data-vehicleid="{{ $vehicle->id }}">edit</a></td>
                <td>
                    <a class="btn btn-success btn-show" data-registration="{{ $vehicle->registration }}"
                        data-model="{{ $vehicle->model }}" data-fueltype="{{ $vehicle->fuelType }}"
                        data-make="{{ $vehicle->make }}" data-clientphonenumber="{{ $vehicle->user->phoneNumber }}"
                        data-images='@json($vehicle->images)' data-vehicleid="{{ $vehicle->id }}">show</a>
                </td>
                <td>
                    <button type="submit" onclick="confirmDelete({{ $vehicle->id }})"
                        class="btn btn-danger delete-btn">delete</button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
{!! $vehicles->links() !!}

@include('modals.vehicle.delete')
@include('modals.vehicle.show')
@include('modals.vehicle.edit')

<style>
    .image-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        margin-bottom: 20px;
    }

    .vehicle-image {
        flex: 1 0 30%;
        max-width: 100px;
        margin: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 5px;
        transition: transform 0.2s;
        cursor: pointer;
    }

    .vehicle-image:hover {
        transform: scale(1.1);
    }

    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(88, 86, 86, 0.9);
    }

    .modal-content {
        margin: auto;
        display: block;
        width: 80%;
        max-width: 700px;
    }

    .modal-content img {
        width: 100%;
        height: auto;
    }

    .close {
        position: absolute;
        top: 20px;
        right: 35px;
        color: #f1f1f1;
        font-size: 40px;
        font-weight: bold;
        transition: 0.3s;
    }

    .close:hover,
    .close:focus {
        color: #bbb;
        text-decoration: none;
        cursor: pointer;
    }
</style>
@section('scripts')
    <script>
        $(document).ready(function() {
            $(".btn-show").click(function() {
                var registration = $(this).data('registration');
                var model = $(this).data('model');
                var fuelType = $(this).data('fueltype');
                var make = $(this).data('make');
                var clientPhoneNumber = $(this).data('clientphonenumber');
                var images = $(this).data('images');
                var vehicleId = $(this).data('vehicleid');

                $("#modalId").text(vehicleId);
                $("#modalRegistration").text(registration);
                $("#modalModel").text(model);
                $("#modalFuelType").text(fuelType);
                $("#modalMake").text(make);
                $("#modalClientPhoneNumber").text(clientPhoneNumber);

                $("#imageContainer").empty();
                if (images && images.length > 0) {
                    images.forEach(function(imageName) {
                        var imageElement = $("<img>")
                            .attr("src", "/storage/images/" + imageName)
                            .addClass("vehicle-image")
                            .attr("alt", "Vehicle Image");
                        $("#imageContainer").append(imageElement);
                    });
                } else {
                    $("#imageContainer").html("No images available.");
                }

                $("#showModal").show();
            });

            $(".close").click(function() {
                $(".modal").hide();
            });

            $(document).on('click', '.vehicle-image', function() {
                var src = $(this).attr('src');
                $('#largeImage').attr('src', src);
                $('#imageModal').show();
            });

            $(".close").click(function() {
                $('#imageModal').hide();
            });

            $(window).on("click", function(event) {
                if (event.target.id === "imageModal") {
                    $('#imageModal').hide();
                }
            });
        });

        function confirmDelete(id) {
            $("#deleteId").val(id);
            $("#myModal").show();
        }

        $(window).on("click", function(event) {
            if (event.target.id === "myModal") {
                $("#myModal").hide();
            }
        });

        $(document).ready(function() {
            $('.download-btn').click(function() {
                var vehicleId = $(this).data('vehicle-id');
                window.location.href = '/vehicles/' + vehicleId + '/download-pdf';
            });
        });

        $(document).ready(function() {
            $(".edit-btn").click(function() {
                var vehicleId = $(this).data('vehicleid');
                var registration = $(this).closest('tr').find('td:eq(1)').text().trim();
                var model = $(this).closest('tr').find('td:eq(2)').text().trim();
                var fuelType = $(this).closest('tr').find('td:eq(3)').text().trim();
                var clientPhoneNumber = $(this).closest('tr').find('td:eq(4)').text().trim();

                $("#editForm").attr("action", "/vehicles/" + vehicleId);
                $("#editVehicleId").val(vehicleId);
                $("#editRegistration").val(registration);
                $("#editModel").val(model);
                $("#editFuelType").val(fuelType);
                $("#editClientPhoneNumber").val(clientPhoneNumber);
                $("#editModal").show();
            });

            $(".close, .cancel-modal-button").click(function() {
                $(".modal").hide();
            });
        });
    </script>
@endsection
