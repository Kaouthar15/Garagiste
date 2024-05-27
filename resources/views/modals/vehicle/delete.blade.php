<style>
    /* Existing styles */
    body .blur-background {
        backdrop-filter: blur(5px);
        /* Blur the entire page */
    }

    .modal-content {
        background-color: #fefefe;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
        max-width: 600px;
        /* Limit the maximum width of the modal */
        border-radius: 10px;
        /* Rounded corners */
        box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.5);
        /* Box shadow for depth */
    }

    .modal-header,
    .modal-footer {
        padding: 10px 16px;
        background-color: #f5f5f5;
        border-top-left-radius: 10px;
        /* Match modal content border-radius */
        border-top-right-radius: 10px;
        /* Match modal content border-radius */
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }
</style>

<div id="myModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <span id="close" class="close">&times;</span>
        </div>
        <div class="modal-body">
            <form id="deleteForm" method="post">
                @csrf
                <input type="hidden" id="deleteId" name="deleteId" value="" />
            </form>
            <p>Are you sure you want to delete this vehicle?</p>
        </div>
        <div class="modal-footer">
            <button id="btnDelete" class="btn btn-primary">Delete</button>
            <button id="btnCancel" class="btn btn-light">Cancel</button>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $("#close, #btnCancel").on('click', function() {
            $("#myModal").hide();
        });

        $("#btnDelete").on('click', function(e) {
            e.preventDefault(); 

            var formData = $('#deleteForm').serialize(); 

            if (typeof axios === 'undefined') {
                console.error('Axios is not loaded.');
                return;
            }

            axios.post('{{ route('vehicle.delete') }}', formData)
                .then(function(response) {
                    if (response.data === "ok") {
                        var deleteId = $("#deleteId").val();
                        $("#row" + deleteId).remove(); 
                        $("#myModal").hide(); 
                    } else {
                        console.error('Failed to delete the vehicle');
                    }
                })
                .catch(function(error) {
                    console.error('Error:', error);
                });
        });

        $(window).on("click", function(event) {
            if (event.target.id === "myModal") {
                $("#myModal").hide();
            }
        });
    });

    function confirmDelete(id) {
        $("#deleteId").val(id);
        $("#myModal").show();
    }
</script>
