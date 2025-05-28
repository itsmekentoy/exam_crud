 <div class="modal fade" id="AddModal" tabindex="-1" aria-labelledby="AddModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="AddModalLabel">Add Sales</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('addSalesData') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="salesperson" class="form-label">Sales Person</label>
                            <input type="text" class="form-control" id="salesperson" name="salesperson" required>
                        </div>

                        <div class="form-group mt-1">
                            <label for="itemA" class="form-label">Item A</label>
                            <input type="number" class="form-control" id="itemA" name="itemA" required>
                        </div>

                        <div class="form-group mt-1">
                            <label for="itemB" class="form-label">Item B</label>
                            <input type="number" class="form-control" id="itemB" name="itemB" required>
                        </div>

                        <div class="form-group mt-1">
                            <label for="itemC" class="form-label">Item C</label>
                            <input type="number" class="form-control" id="itemC" name="itemC" required>
                        </div>

                        <div class="form-group mt-1">
                            <label for="itemD" class="form-label">Item D</label>
                            <input type="number" class="form-control" id="itemD" name="itemD" required>
                        </div>
                    
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save data</button></form>
                </div>
            </div>
        </div>
    </div>