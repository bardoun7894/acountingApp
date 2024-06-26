import getSelectorBasedInOther from "./selectBasedInOtherSelect.js";
//get the language path
let urlPath = window.location.href; // raw javascript
const lang = urlPath.split("/")[3];
//get tableName
const tableName = urlPath.split("/")[4];
const editUrl = urlPath.split(lang)[1];
const tableid = urlPath.split("/")[5];
//get dynamic row for search in table

export default class PurchaseReturns {
    constructor() {
        this.initializeEvents();
    }


    initializeEvents() {
        this.findInvoiceBtn()
        this.onQtyChange() ;
    }
      onQtyChange(){
         //todo select in item validator
        $(document).on("change", "#returnPurchasesQty",function () {
            // var errorMessage = document.getElementById('error-message');
                var quantity = $(this).val();
                var id = $(this).attr("name").split("return_quantities")[1].trim();
                var idReturnDetails = $(this).attr("idReturnDetails").split("idReturnDetails")[1].trim();
                var errorMessage = document.getElementById('error-message'+ id);
                var purchase_quantity = $("#purchase_quantity" + id).text();
                var unitPrice = $("#unit_price" + id).text(); // Assuming unit price is in a <td> or similar
                // alert("unitPrice"+unitPrice + "quantity" + quantity + "id" + id);
                var invoiceNumber = $('#invoice_number').val();
                getSelectorBasedInOther(
                    { purchase_qty: quantity, idReturnDetails: idReturnDetails, invoice_number: invoiceNumber },
                        "return_purchases_on_qty_change"
                ).then((data) => {
                    console.log(data);
                    console.log("data");
                        $("#sub_total_returned").text(data);
                    });
            if( parseInt(purchase_quantity)< quantity){
                    // make border if the quantity is greater
                    $(this).css("border", "1px solid red");
                    errorMessage.textContent = 'Return quantity should not be greater than Purchase quantity';
                }else{
                    $(this).css("border", "1px solid green");
                    errorMessage.textContent = '';
                }
                $("#total_amount_purchases_returned" + id).text((quantity * unitPrice));

            });

            // getSelectorBasedInOther(
            //     { purchase_qty: quantity, id: id },
            //   "post_products_on_qty_change_to_purchaseCart"
            // ).then((data) => {
            //     if (data.status) {
            //     }else{
            //         alert(data.msg);
            //     }
            // });
    }

    findInvoiceBtn(){
        $('#findInvoiceBtn').on('click',function() {
            var invoiceNumber = $('#invoice_number').val();
            console.log(invoiceNumber);
            getSelectorBasedInOther({'invoice_number': invoiceNumber }, "find-invoice-purchase"
            ).then((data ) => {
                $('#appendPurchaseReturnLevel').html(data);
            });

        });
    }

    // Bind event listener to dynamically calculate totals when return quantities change

    calculateTotals() {

        $('#subtotal').text(subtotal);
        const tax = subtotal * 0.10; // Example 10% tax
        $('#tax').text(tax.toFixed(2));

        const discount = 0; // Apply any discounts here
        $('#discount').text(discount.toFixed(2));

        const total = subtotal + tax - discount;
        $('#total').text(total);


        let subTotalReturned = 0;
        // Select all elements with the class 'total-amount-returned' and sum their contents

        document.querySelectorAll('.total_amount_returned').forEach(element => {
            subTotalReturned += parseFloat(element.textContent) || 0;
        });

        // Update the display element with the calculated subtotal
        document.getElementById('sub_total_returned').textContent = subTotalReturned;

    }
}

$(document).ready(function () {
    new PurchaseReturns();
});

