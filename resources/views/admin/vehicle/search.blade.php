<table class="table table-striped">
    @include('layouts.partials.messages')
    <!-- Table Header -->
    <thead>
        <tr>
            <th>Download</th>
            <th>Registration</th>
            <th>Model</th>
            <th>Fuel Type</th>
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

                <td><i class="fa fa-download download-btn" href="{{ route('vehicles.download-pdf', ['vehicle' => $vehicle->id]) }}"  data-vehicle-id="{{ $vehicle->id }}" style="font-size:30px; cursor: pointer;"></i></td>

                <td>{{ $vehicle->registration }}</td>
                <td>{{ $vehicle->model }}</td>
                <td>{{ $vehicle->fuelType }}</td>
                <td>{{ $vehicle->user->phoneNumber }}</td>
                <td><a class="btn btn-secondary edit-btn" data-vehicleid="{{ $vehicle->id }}">edit</a></td>
                <td>
                    <a class="btn btn-success btn-show" data-registration="{{ $vehicle->registration }}"
                        data-model="{{ $vehicle->model }}" data-fueltype="{{ $vehicle->fuelType }}"
                        data-make="{{ $vehicle->make }}" data-clientphonenumber="{{ $vehicle->user->phoneNumber }}"
                        data-vehicleid="{{ $vehicle->id }}"
                        v="{{ $vehicle->id }}">show</a>
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

<style>
    .image-container {
        display: flex;
        flex-wrap: wrap;
    }

    .vehicle-image {
        width: 150px;
        height: auto;
        margin-right: 10px;
        margin-bottom: 10px;
    }
</style>


@include('modals.vehicle.delete')
@include('modals.vehicle.show')
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

        $(document).ready(function() {
        $('.download-btn').click(function() {
            var vehicleId = $(this).data('vehicle-id');
            window.location.href = '/vehicles/' + vehicleId + '/download-pdf';
        });
    });
    </script>
@endsection
