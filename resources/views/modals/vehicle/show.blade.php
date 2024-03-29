<div id="showModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Vehicle Information</h2>
        <p><strong>Registration:</strong> <span id="modalRegistration"></span></p>
        <p><strong>Model:</strong> <span id="modalModel"></span></p>
        <p><strong>Fuel Type:</strong> <span id="modalFuelType"></span></p>
        <p><strong>Make:</strong> <span id="modalMake"></span></p>
        <p><strong>Client Phone Number:</strong> <span id="modalClientPhoneNumber"></span></p>
        @if ($vehicle->images)
            @foreach (json_decode($vehicle->images) as $imageName)
                <img src="{{ asset('storage/images/' . $imageName) }}"
                    class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}"
                    style="width: 150px; height: auto;" alt="Vehicle Image">
            @endforeach
        @endif  
    </div>
</div>
