// Import the necessary module
import getSelectorBasedInOther from "../selectBasedInOtherSelect.js";

// Get the language path
let urlPath = window.location.href; // raw javascript
const lang = urlPath.split("/")[3];
// Get tableName
const tableName = urlPath.split("/")[4];
const editUrl = urlPath.split(lang)[1];
const tableid = urlPath.split("/")[5];

// Define the UsersPage class
class UsersPage {
    constructor() {
        this.initialize();
    }

    initialize() {
        // Ensure this method is only called once
        if (!UsersPage.initialized) {
            $(document).on("click", ".changeStatus", function () {
                let id = $(this).attr("recordId");
                getSelectorBasedInOther(
                    { id: id },
                    "changeStatusUser"
                ).then((data) => {
                    if (data.status == 200) {
                        // Change status
                        if (data.isActive == 1) {
                            $("#status" + id).replaceWith('<i id="status' + id + '" class="ft-toggle-right" style="color: green; font-size: 25px"></i>');
                        } else {
                            $("#status" + id).replaceWith('<i id="status' + id + '" class="ft-toggle-left" style="color: red; font-size: 25px"></i>');
                        }
                    } else {
                        toastr.error(data.message);
                    }
                }, (error) => {
                    console.log(error);
                });
            });

            UsersPage.initialized = true; // Mark as initialized
        }
    }
}

// Instantiate the UsersPage class
let usersPage = new UsersPage();
