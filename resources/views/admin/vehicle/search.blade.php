<table class="table table-striped">
    @include('layouts.partials.messages')
    <!-- Table Header -->
    <thead>
        <tr>
            <th>Registration</th>
            <th>Model</th>
            <th>Fuel Type</th>
            <th>Make</th>
            <th>Client</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <!-- Table Body -->
    <tbody>
        @foreach ($vehicles as $vehicle)
            <tr>
                <td class="py-1">{{ $vehicle->registration }}</td>
                <td>{{ $vehicle->model }}</td>
                <td>{{ $vehicle->fuelType }}</td>
                <td>{{ $vehicle->make }}</td>
                <td>{{ $vehicle->user->phoneNumber }}</td>
                <td><a class="btn btn-secondary edit-btn" data-vehicleid="{{ $vehicle->id }}">edit</a></td>
                <td>
                    <a class="btn btn-success btn-show" data-registration="{{ $vehicle->registration }}"
                        data-model="{{ $vehicle->model }}" data-fueltype="{{ $vehicle->fuelType }}"
                        data-make="{{ $vehicle->make }}" data-clientphonenumber="{{ $vehicle->user->phoneNumber }}"
                        data-vehicleid="{{ $vehicle->id }}">show</a>
                </td>
                <td>
                    <button type="submit" onclick="confirmDelete({{ $vehicle->id }})"
                        class="btn btn-danger delete-btn">delete</button>
                </td>


            </tr>
            <div id="showModal" class="modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <h2>Vehicle Information</h2>
                    <p><strong>Id:</strong>{{ $vehicle->id }}</p>
                    <p><strong>Registration:</strong><span id="modalRegistration"></span></p>
                    <p><strong>Model:</strong> <span id="modalModel"></span></p>
                    <p><strong>Fuel Type:</strong> <span id="modalFuelType"></span></p>
                    <p><strong>Make:</strong> <span id="modalMake"></span></p>
                    <p><strong>Client Phone Number:</strong> <span id="modalClientPhoneNumber"></span></p>

                    @if ($vehicle->images)
                        <div class="image-container">
                            @foreach (json_decode($vehicle->images) as $imageName)
                                <img src="{{ asset('storage/images/' . $imageName) }}" class="vehicle-image"
                                    alt="Vehicle Image">
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    </tbody>
</table>
{!! $vehicles->links() !!}

<style>
    .image-container {
        display: flex;
        flex-wrap: wrap;
    }

    .vehicle-image {
        width: 150px;
        height: auto;
        margin-right: 10px;
        /* Espacement entre les images */
        margin-bottom: 10px;
        /* Espacement entre les lignes */
    }
</style>


@include('modals.vehicle.delete')
@include('modals.vehicle.edit')
@section('scripts')
    <script>
        $(document).ready(function() {
            $(".btn-show").click(function() {
            var registration = $(this).data('registration');
            var model = $(this).data('model');
            var fuelType = $(this).data('fueltype');
            var make = $(this).data('make');
            var clientPhoneNumber = $(this).data('clientphonenumber');
            var vehicleId = $(this).data('vehicleid');

            $("#modalId").text(vehicleId);
            $("#modalRegistration").text(registration);
            $("#modalModel").text(model);
            $("#modalFuelType").text(fuelType);
            $("#modalMake").text(make);
            $("#modalClientPhoneNumber").text(clientPhoneNumber);

            $("#imageContainer").empty();
            $.ajax({
                url: "/getVehicleImages/" + vehicleId,
                type: "GET",
                success: function(response) {
                    if (response.success) {
                        var images = response.images;
                        if (images.length > 0) {
                            images.forEach(function(imageName) {
                                var imageElement = $("<img>").attr("src", "/storage/images/" + imageName).addClass("vehicle-image").attr("alt", "Vehicle Image");
                                $("#imageContainer").append(imageElement);
                            });
                        } else {
                            $("#imageContainer").html("No images available.");
                        }
                    } else {
                        $("#imageContainer").html("Failed to load images.");
                    }
                },
                error: function() {
                    $("#imageContainer").html("Failed to load images.");
                }
            });

            $("#showModal").show();
        });

            $(".edit-btn").click(function() {
                var vehicleId = $(this).data('vehicleid');
                var registration = $(this).closest('tr').find('td:nth-child(1)').text();
                var model = $(this).closest('tr').find('td:nth-child(2)').text();
                var fuelType = $(this).closest('tr').find('td:nth-child(3)').text();
                var make = $(this).closest('tr').find('td:nth-child(4)').text();
                var clientPhoneNumber = $(this).closest('tr').find('td:nth-child(5)').text();

                $("#editVehicleId").val(vehicleId);
                $("#editRegistration").val(registration);
                $("#editModel").val(model);
                $("#editFuelType").val(fuelType);
                $("#editMake").val(make);
                $("#editClientPhoneNumber").val(clientPhoneNumber);

                $("#editModal").show();
            });

            $(".close").click(function() {
                $(".modal").hide();
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
        })
    </script>
@endsection
