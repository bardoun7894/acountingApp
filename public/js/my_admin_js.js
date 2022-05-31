// import CategoryPage from "./categoryPage.js";
import PurchasePage from "./purchasePage.js";
import SalePage from "./salePage.js";
import UserPage from "./userPage.js";
import Accounts from "./accounts.js";
import PaidAmount from "./paidAmountPage.js";

//get the language path
let urlPath = window.location.href; // raw javascript

const lang = urlPath.split("/")[3];
//get tableName
const tableName = urlPath.split("/")[4];
const editUrl = urlPath.split(lang)[1];
const tableid = urlPath.split("/")[5];
//get dynamic row for search in table
let dynamicRowId = "#" + tableName + "-dynamicRow";

//category function
// const categoryPage = new CategoryPage();r
var paid_amount = new PaidAmount();
//Purchase function
var purchasePage = new PurchasePage();
//Purchase function
var salepage = new SalePage();

//user page
var user__page = new UserPage();
//account page
var account = new Accounts();

function supplierbasedBranchSelect() {
    $(".supplierselect2").select2({
        placeholder: lang == "en" ? "Search a supplier..." : "... ابحث عن مورد",
        language: {
            noResults: function () {
                return $(
                    "<a href='/stocks/create'> no result found please Add a supplier <i class='la la-plus'></i></a>"
                );
            },
        },
        ajax: {
            type: "Get",
            url: "/" + lang + "/" + "get_supplier_select2",
            delay: 250,
            cache: true,
            allowClear: true,

            data: function (data) {
                return { search: data.term };
            },
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text:
                                lang == "en"
                                    ? item.supplier_name_en
                                    : item.supplier_name_ar,
                            id: item.id,
                        };
                    }),
                };
            },
        },
    });
}

function searchproductSelect2() {
    var selector = $(".searchproductSelect2");

    selector.select2({
        placeholder: lang == "en" ? "Search a product..." : "... ابحث عن منتج",
        language: {
            noResults: function () {
                return $(
                    "<a href='/stocks/create'> no result found please Add a Product <i class='la la-plus'></i></a>"
                );
            },
        },
        ajax: {
            type: "Get",
            url: "/" + lang + "/" + "product_select2/",
            delay: 250,
            cache: true,
            allowClear: true,
            data: function (data) {
                return { search: data.term };
            },
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text:
                                lang == "en"
                                    ? item.barcode +
                                      " (" +
                                      item.product_name_en +
                                      ")"
                                    : " (" +
                                      item.product_name_ar +
                                      ") " +
                                      item.barcode,
                            id: item.id,
                        };
                    }),
                };
            },
        },
    });
}
$(document).on("ready", function () {
    loginRegisterForm();
    toggleStatus();
    var branch_id = $("#branchId").val();
    supplierbasedBranchSelect(branch_id);
    searchproductSelect2();

    $("#branchId").on("change", function () {
        $(".exampleSample").val(null).trigger("change");
        branch_id = $("#branchId").val();
        supplierbasedBranchSelect(branch_id);
    });
    // $("#stock_id").on("change", function () {
    //     // branch_id = $("#branchId").val();
    //     // supplierbasedBranchSelect(branch_id);
    //     // searchproductSelect2();
    // });
    if (urlPath.split("/").length === 5) {
        $("#datatableBootstrap").DataTable({
            responsive: true,
            columnDefs: [{ width: "20%", targets: 0 }],
            language: {
                url:
                    lang === "en"
                        ? "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/English.json"
                        : "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Arabic.json",
            },
        });
    }
    if (editUrl.includes("Invoice")) {
        //print Invoice
        document
            .getElementById("btnPrintInvoice")
            .addEventListener("click", function (p) {
                this.style.display = "none";
                print();
                location.reload();
            });
    }
});

function loginRegisterForm() {
    var current_fs, next_fs, previous_fs; //fieldsets
    var opacity;

    $(".next").on("click", function () {
        current_fs = $(this).parent();
        next_fs = $(this).parent().next();

        //show the required input field
        var inputs = current_fs.find(":input");
        for (var i = 0; i < inputs.length; i++) {
            var element = inputs[i];
            // validate elements..
            // for example for required:
            if (element.hasAttribute("required")) {
                if ($(element).val() == "") {
                    $(element).addClass("invalid");
                    $(element).focus();
                    $(element).attr(required, true);

                    return false;
                } else {
                    $(element).removeClass("invalid");
                }
            }
        }
        //Add Class Active
        $("#progressbar li")
            .eq($("fieldset").index(next_fs))
            .addClass("active");

        //show the next fieldset
        next_fs.show();
        //hide the current fieldset with style
        current_fs.animate(
            { opacity: 0 },
            {
                step: function (now) {
                    // for making fielset appear animation
                    opacity = 1 - now;

                    current_fs.css({
                        display: "none",
                        position: "relative",
                    });
                    next_fs.css({ opacity: opacity });
                },
                duration: 600,
            }
        );
    });

    $(".previous").click(function () {
        current_fs = $(this).parent();
        previous_fs = $(this).parent().prev();

        //Remove class active
        $("#progressbar li")
            .eq($("fieldset").index(current_fs))
            .removeClass("active");

        //show the previous fieldset
        previous_fs.show();

        //hide the current fieldset with style
        current_fs.animate(
            { opacity: 0 },
            {
                step: function (now) {
                    // for making fielset appear animation
                    opacity = 1 - now;
                    current_fs.css({
                        display: "none",
                        position: "relative",
                    });
                    previous_fs.css({ opacity: opacity });
                },
                duration: 600,
            }
        );
    });
}

function toggleStatus() {
    // var btns = document.querySelectorAll("#user_approve_id");

    // Array.prototype.forEach.call(btns, function addClickListener(btn) {
    //     btn.addEventListener("click", function (event) {
    //         alert("hello");
    //     });
    // });

    $(".approveUserCompany").on("click", function () {
        var user_approve_id = $(this).attr("user_id");

        var url = "/" + lang + "/" + tableName + "/approve_user";
        $.ajax({
            url: url,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: {
                user_approve_id: user_approve_id,
            },
            type: "post",
            success: function (data) {
                if (data.approve === true) {
                    console.log(data.approve);
                    $("#user_approve_id_" + user_approve_id).removeClass();
                    $("#user_approve_id_" + user_approve_id).addClass(
                        "approveUserCompany btn-danger rounded-pill"
                    );
                    document.getElementById(
                        "status-user_" + user_approve_id + ""
                    ).innerHTML = data.status;
                    $("#status-user_" + user_approve_id + "").val(data.status);
                    document.getElementById(
                        "user_approve_id_" + user_approve_id
                    ).innerHTML = data.action;
                } else {
                    console.log(data.approve);
                    $("#user_approve_id_" + user_approve_id).removeClass();
                    $("#user_approve_id_" + user_approve_id).addClass(
                        "approveUserCompany btn-success rounded-pill"
                    );
                    document.getElementById(
                        "status-user_" + user_approve_id + ""
                    ).innerHTML = data.status;
                    $("#status-user_" + user_approve_id + "").val(data.status);
                    document.getElementById(
                        "user_approve_id_" + user_approve_id
                    ).innerHTML = data.action;
                }
            },
        });
    });
}
$(dynamicRowId).on("click", ".confirmDelete", function (p) {
    var record = $(this).attr("record");
    var recordId = $(this).attr("recordId");
    Swal.fire({
        title: lang === "ar" ? "هل تريد الاستمرار؟" : "Are you sure?",
        text:
            lang === "ar"
                ? " هل تريد حذف هذه البيانات"
                : "You want to remove " + record + " ?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: lang === "ar" ? "نعم" : "Yes, delete it!",
        cancelButtonText: lang === "ar" ? "لا" : "no",
    }).then((result) => {
        if (result.isConfirmed) {
            swal.fire(
                lang === "ar" ? "تم الحذف" : "Deleted!",
                lang === "ar"
                    ? "تم حذف البيانات"
                    : "Your data has been deleted.",
                lang === "ar" ? "نجاح" : "success"
            );
            window.location.href =
                "/" + lang + "/delete-" + record + "/" + recordId;
        }
    });
});
