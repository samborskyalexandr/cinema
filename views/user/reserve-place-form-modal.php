<div class="modal fade" id="reserve-place-modal" tabindex="-1" role="dialog"
     aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Enter your phone number or email</h5>
                <button type="button" class="close"
                        data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="reservePlace">
                    <div class="form-group m-3 d-none">
                        <div class="row">
                            <input type="text" name="movieId" id="movieId" class="form-control" hidden>
                        </div>
                    </div>

                    <div class="form-group m-3 d-none">
                        <div class="row">
                            <input type="text" name="sessionDate" id="sessionDate" class="form-control" hidden>
                        </div>
                    </div>

                    <div class="form-group m-3 d-none">
                        <div class="row">
                            <input type="text" name="sessionTime" id="sessionTime" class="form-control" hidden>
                        </div>
                    </div>

                    <div class="form-group m-3 d-none">
                        <div class="row">
                            <input type="text" name="place" id="place" class="form-control" hidden>
                        </div>
                    </div>

                    <div class="form-group m-3">
                        <div class="row">
                            <label>Phone Number</label>
                            <input type="text" name="phone" id="phone" class="form-control" placeholder="123-456-7890">
                        </div>
                    </div>

                    <div class="form-group m-3">
                        <div class="row">
                            <label>Email</label>
                            <input type="email" name="email" id="email" class="form-control">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="reserve-place-btn">Reserve Place</button>
            </div>
        </div>
    </div>
</div>