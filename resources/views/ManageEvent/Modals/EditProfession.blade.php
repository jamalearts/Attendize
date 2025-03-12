{{-- Edit Profession Modal --}}
<div class="modal fade" id="editProfessionModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Profession</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="edit-profession-name">Profession Name</label>
                    <input type="text" class="form-control" id="edit-profession-name">
                    <input type="hidden" id="edit-profession-original">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="save-profession-edit">Save</button>
            </div>
        </div>
    </div>
</div>
