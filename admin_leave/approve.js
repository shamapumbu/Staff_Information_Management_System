function confirmApprove(self) {
    var id = self.getAttribute("data-id");

    document.getElementById("form-delete-user").leave_id.value = id;
    $("#approveModal").modal("show");
}
