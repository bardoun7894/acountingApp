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

export default class SalePage {
    constructor() {
        fetchSaleData();
        getSaleCategoryBasedInbranch();
        $(document).on("change", "#customer_id", function () {
            getCustomerItem();
        });
    }
}

function getCustomerItem() {
    var customer_id = $("#customer_id").val();
    getSelectorBasedInOther(
        { customer_id: customer_id },
        "getCustomerItembyId"
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
            document.getElementById("customer_phone").value =
                data.contact_number;
            document.getElementById("customer_address").value = data.address_en;
            // $("#dtd").find("tbody").append(htmlo);
        } else {
            document.getElementById("customer_phone").value = "";
            document.getElementById("customer_address").value = "";
        }
    });
}

function fetchSaleData() {
    //ajax call for get data
    $.ajax({
        url: "fetch_sale_data",
        type: "GET",
        dataType: "json",
        success: function (data) {
            var html = "";
            var i = 1;
            $.each(data, function (key, value) {
                var total_p = value.sale_unit_price * value.sale_qty;
                console.log(total_p);
                html += `<tr id="td-sale-${value.stock.id}"> 
                                <td  >${
                                    lang == "en"
                                        ? value.stock.product_name_en
                                        : value.stock.product_name_ar
                                }</td>
                                <td ><input type="number" ${
                                    value.sale_qty == 0
                                        ? "style='border: 1px solid #FF0000;'"
                                        : ""
                                } id="sale_qty" current_id="${
                    value.id
                }"  value="${value.sale_qty}"></td> 
                                <td>${value.sale_unit_price}</td> 
                                <td>${total_p}</td> 
                                <td>
                                    <a href="${editUrl}/${
                    value.id
                }/edit">  <em class="la la-edit" style="color: green;font-size: 25px"></em></a></a>
                                </td>
                                <td>
                                <a class="confirmDelete" record="Sale" recordId="${
                                    value.id
                                }"> 
                                <em class="la la-trash" style="color: red;font-size: 25px"></em>
                                    </a>
                                </td>
                            </tr>`;
                i++;
            });
            $("#sales-dynamicRow").html(html);
        },
    });
}

$(document).on("keyup", "#sale_qty", function () {
    var quantity = $(this).val();
    var id = $(this).attr("current_id");
    getSelectorBasedInOther(
        { sale_qty: quantity, id: id },
        "post_products_on_qty_change_to_saleCart"
    ).then((data) => {
        if (data !== "") {
            fetchSaleData();
            totalPayment();
        }
    });
});

function getSaleCategoryBasedInbranch() {
    if (
        editUrl === "/sales/" + tableid + "/edit" ||
        editUrl === "/sales/create"
    ) {
        $(document).ready(function () {
            //getSaleCategoryBasedInBranch
            getCategoryBasedInBranch();
            $(document).on("change", "#branchId", function () {
                getCategoryBasedInBranch();
            });
        });
    }
    $(document).ready(function () {
        if (editUrl === "/sales") {
            getStoreBasedInBranch();
            // getCustomerBasedInBranch();
            getCustomerItem();
            $(document).on("change", "#branchId", function () {
                getStoreBasedInBranch();
                getCustomerBasedInBranch();
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

function getProductP() {
    var stock_id = $("#stock_id").val();
    getSelectorBasedInOther(
        { stock_id: stock_id },
        "fetch_products_to_saleCart"
    ).then((data) => {
        if (data !== "") {
            // addRow(data);
            fetchSaleData();
        } else {
            var elem = document.getElementById("td-sale-" + stock_id);
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
    //         getCustomerItem();
    //     });
}

function getCategoryBasedInBranch() {
    var branch_id = $("#branchId").val();
    var input_category_id = $("#input_sale_category_id").val();

    getSelectorBasedInOther(
        {
            branch_id: branch_id,
            tableid: tableid,
            tableName: tableName,
            input_category_id: input_category_id,
        },
        "get_selected_sale_branch"
    )
        .then((data) => {
            $("#appendSaleCategoryLevel").html(data);
        })
        .then(() => {
            //get product based in Category
            $(document).on("change", ".selectCategory", function () {
                getSaleProductBasedInCategory();
            });
            getSaleProductBasedInCategory();
        })
        .then(() => {
            setTimeout(function () {
                $(document).on("change", "#stockId", function () {
                    getProductItem();
                });
                getProductItem();
            }, 300);
        });
}

// function getCustomerBasedInBranch() {
//     var branch_id = $("#branchId").val();
//     getSelectorBasedInOther(
//         { branch_id: branch_id },
//         "get_selected_sale_customer_based_branch"
//     )
//         .then((data) => {
//             $("#appendCustomerLevel").html(data);
//         })
//         .then(() => {
//             getCustomerItem();
//         });
// }

function getProductItem() {
    var stock_id = $("#stockId").val();

    getSelectorBasedInOther(
        {
            stock_id: stock_id,
        },
        "getProductItembyId"
    ).then((data) => {
        document.getElementById("saleUnitPrice").value = data.sale_unit_price;
        document.getElementById("saleUnitPrice").value =
            data.current_purchase_unit_price;
        document.getElementById("sale_quantity").max = data.quantity;
    });
}
// function getCustomerItem(){
//     var customer_id = $("#customer_id").val();
//     getSelectorBasedInOther({   'customer_id':customer_id }, 'getCustomerItembyId').then((data)=>{
//       if(data!==""){
//           document.getElementById("customer_phone").value = data.contact_number;
//           document.getElementById("area").value = data.area;
//       }else{
//           document.getElementById("customer_phone").value = ""   ;
//           document.getElementById("area").value = "" ;
//       }

//     });

// }
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
    getSelectorBasedInOther({}, "getSumTotalSaleItem")
        .then((data) => {
            document.getElementById("sub_total").value = data.sub_total;
        })
        .then(() => {
            getTotalOrder();
        });
}

function getSaleProductBasedInCategory() {
    var category_id = $("#purchase_category_id").val();
    var input_category_id = $("#input_sale_category_id").val();
    var input_stock_id = $("#input_stock_id").val();

    getSelectorBasedInOther(
        {
            category_id: category_id,
            input_category_id: input_category_id,
            input_stock_id: input_stock_id,
            tableid: tableid,
            tableName: tableName,
        },
        "get_selected_sale_product"
    ).then((data) => {
        $("#appendSaleProductLevel").html(data);
    });
}
