import getSelectorBasedInOther from "./selectBasedInOtherSelect.js";
import getStoreBasedInBranch from "./storePage.js";

//get the language path
let urlPath = window.location.href; // raw javascript
const lang = urlPath.split("/")[3];
//get tableName
const tableName = urlPath.split("/")[4];
const editUrl = urlPath.split(lang)[1];
const tableid = urlPath.split("/")[5];
//get dynamic row for search in table

export default class PurchasePage {
    constructor() {
        fetchData();
        getPurchaseCategoryBasedInbranch();
        $(document).on("change", "#supplier_id", function () {
            getSupplierItem();
        });
    }
}

function fetchData() {
    //ajax call for get data
    $.ajax({
        url: "fetch_data_purchase",
        type: "GET",
        dataType: "json",
        success: function (data) {
            var html = "";
            var i = 1;
            $.each(data, function (key, value) {
                var total_p = value.purchase_unit_price * value.purchase_qty;
                console.log(total_p);
                html += `<tr id="td-${value.stock.id}">
                                <td  >${
                                    lang == "en"
                                        ? value.stock.product_name_en
                                        : value.stock.product_name_ar
                                }</td>
                                <td ><input type="number" ${
                                    value.purchase_qty == 0
                                        ? "style='border: 1px solid #FF0000;'"
                                        : ""
                                } id="purchase_qty" current_id="${
                    value.id
                }"  value="${value.purchase_qty}"></td>
                                <td >${value.purchase_unit_price}</td>
                                <td>${value.sale_unit_price}</td>
                                <td>${total_p}</td>
                                <td>
                                    <a href="${editUrl}/${
                    value.id
                }/edit">  <em class="la la-edit" style="color: green;font-size: 25px"></em></a></a>
                                </td>
                                <td>
                                <a class="confirmDelete" record="Purchase" recordId="${
                                    value.id
                                }">
                                <em class="la la-trash" style="color: red;font-size: 25px"></em>
                                    </a>
                                </td>
                            </tr>`;
                i++;
            });
            $("#purchases-dynamicRow").html(html);
        },
    });
}

$(document).on("change", "#purchase_qty", function () {
    var quantity = $(this).val();
    var id = $(this).attr("current_id");
    getSelectorBasedInOther(
        { purchase_qty: quantity, id: id },
      "post_products_on_qty_change_to_purchaseCart"
    ).then((data) => {
        if (data !== "") {
            fetchData();
            totalPayment();
        }
    });
});

function getPurchaseCategoryBasedInbranch() {
    if (
        editUrl === "/purchases/" + tableid + "/edit" ||
        editUrl === "/purchases/create"
    ) {
        $(document).on("ready", function () {
            getCategoryBasedInBranch();
            $(document).on("change", "#branchId", function () {
                getCategoryBasedInBranch();
            });
        });
    }
    $(document).on("ready", function () {
        if (editUrl === "/purchases") {
            getStoreBasedInBranch();
            // getSupplierBasedInBranch();
            getSupplierItem();

            $(document).on("change", "#branchId", function () {
                getStoreBasedInBranch();
                // getSupplierBasedInBranch();
            });

            $(document).on("change", "#stock_id", function () {
                getProductP();
            });
            $("#discountId").keyup((e) => {
                console.log(e.currentTarget.value);
                getTotalOrder();
            });
            $("#taxId").keyup((e) => {
                console.log(e.currentTarget.value);
                getTotalOrder();
            });

            totalPayment();
        }
    });
}

function getCategoryBasedInBranch() {
    var branch_id = $("#branchId").val();
    var input_category_id = $("#input_purchase_category_id").val();

    getSelectorBasedInOther(
        {
            branch_id: branch_id,
            tableid: tableid,
            tableName: tableName,
            input_category_id: input_category_id,
        },
        "get_selected_purchase_branch"
    )
        .then((data) => {
            $("#appendPurchaseCategoryLevel").html(data);
        })
        .then(() => {
            //get product based in Category
            $(document).on("change", ".selectCategory", function () {
                getPurchaseProductBasedInCategory();
            });
            getPurchaseProductBasedInCategory();
        });
}

function getProductP() {
    var stock_id = $("#stock_id").val();
    console.log(stock_id);
    getSelectorBasedInOther(
        { stock_id: stock_id },
        "fetch_products_to_purchase_cart"
    ).then((data) => {
        if (data !== "") {
            // addRow(data);
            fetchData();
        } else {
            var elem = document.getElementById("td-" + stock_id);
            elem.style.borderStyle = "solid";
            elem.style.borderColor = "red";
            setTimeout(() => {
                elem.style.borderStyle = "none";
            }, 500);
            // elem.style.border = "1px solid red";
            if (lang == "en") {
                alert("this Product is already added to Cart");
            } else {
                alert("هذا المنتج تم إضافته بالفعل");
            }
        }
    });
    //     .then(() => {
    //         getSupplierItem();
    //     });
}

function getProductItem() {
    var stock_id = $("#stockId").val();
    getSelectorBasedInOther(
        {
            stock_id: stock_id,
        },
        "getProductItembyId"
    ).then((data) => {
        document.getElementById("saleUnitPrice").value = data.sale_unit_price;
        document.getElementById("purchaseUnitPrice").value =
            data.current_purchase_unit_price;
    });
}
function getSupplierItem() {
    var supplier_id = $("#supplier_id").val();
    getSelectorBasedInOther(
        { supplier_id: supplier_id },
        "getSupplierItembyId"
    ).then((data) => {
        if (data !== "") {
            // var htmlo = `<tr>
            // <td></td>
            // <td  id="purchase_qty" ><input type="number" value="${data.phone}"></td>
            // <td  id="purchase_unit_price"  ><input type="number"  value="${data.phone}"></td>
            // <td></td>
            // <td></td>
            // <td></td>
            // <td>

            // </td>
            // <td>
            //   <a href="/edit_purchase/" class="btn btn-danger btn-sm">Add</a>
            // </td>
            // </tr>`;
            document.getElementById("supplier_phone").value = data.phone;
            document.getElementById("supplier_address").value = data.address_en;
            // $("#dtd").find("tbody").append(htmlo);
        } else {
            document.getElementById("supplier_phone").value = "";
            document.getElementById("supplier_address").value = "";
        }
    });
}
function getTotalOrder() {
    let sub_total = 0;
    let tax = 0;
    let discount = 0;
    sub_total = parseFloat(document.getElementById("sub_total").value);
    tax = parseFloat(document.getElementById("taxId").value);
    discount = parseFloat(document.getElementById("discountId").value);

    // let totalPayment = sub_total+(tax * 100)/sub_total+(discount * 100)/sub_total;
    document.getElementById("order_total").value =
        sub_total + (tax * sub_total) / 100 - (discount * sub_total) / 100;
}

function totalPayment() {
    getSelectorBasedInOther({}, "getSumTotalItem")
        .then((data) => {
            document.getElementById("sub_total").value = data.sub_total;
        })
        .then(() => {
            getTotalOrder();
        });
}

function getPurchaseProductBasedInCategory() {
    var category_id = $("#purchase_category_id").val();
    var input_category_id = $("#input_purchase_category_id").val();
    var input_stock_id = $("#input_stock_id").val();

    getSelectorBasedInOther(
        {
            category_id: category_id,
            input_category_id: input_category_id,
            input_stock_id: input_stock_id,
            tableid: tableid,
            tableName: tableName,
        },
        "get_selected_purchase_product"
    )
        .then((data) => {
            $("#appendPurchaseProductLevel").html(data);
        })
        .then(() => {
            $(document).on("change", "#stockId", function () {
                getProductItem();
            });
            getProductItem();
        });

}
