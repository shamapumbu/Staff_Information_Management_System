function confirmDeny(self) {
    var id = self.getAttribute("data-id");

    document.getElementById("form-deny-user").leave_id.value = id;
    $("#denyModal").modal("show");

}