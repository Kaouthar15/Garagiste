<div id="editModal" class="modal">
    <div class="modal-content edit-modal-content">
        <span class="close">&times;</span>
        <h2 class="edit-modal-title">Edit Vehicle</h2>
        <form action="" method="POST" id="editForm">
            @csrf
            @method('PUT')
            <input type="hidden" name="vehicle_id" id="editVehicleId">
            <div class="form-group">
                <label for="editRegistration">Registration:</label>
                <input type="text" id="editRegistration" name="editRegistration" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="editModel">Model:</label>
                <input type="text" id="editModel" name="editModel" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="editFuelType">Fuel Type:</label>
                <input type="text" id="editFuelType" name="editFuelType" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="editClientPhoneNumber">Client Phone Number:</label>
                <input type="text" id="editClientPhoneNumber" name="editClientPhoneNumber" class="form-control" required>
            </div>
            
            <button type="submit" class="btn btn-primary edit-modal-button">Save</button>
            <button type="button" class="btn btn-light cancel-modal-button">Cancel</button>
        </form>
    </div>
</div>
