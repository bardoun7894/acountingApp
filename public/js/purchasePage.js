import getSelectorBasedInOther from './selectBasedInOtherSelect.js'

//get the language path
let urlPath = window.location.href; // raw javascript
const lang = urlPath.split("/")[3];
//get tableName
const tableName = urlPath.split("/")[4];
const editUrl = urlPath.split("en")[1];
const tableid = urlPath.split("/")[5];
//get dynamic row for search in table



export default class  PurchasePage{

     constructor() {
         getPurchaseCategoryBasedInbranch()
         $(document).on('change','#supplier_id', function() {
             getSupplierItem()
         });
         getSupplierItem()
         totalPayment();
     }

}

function getPurchaseCategoryBasedInbranch() {

    $(document).ready(function () {
        if (editUrl === "/purchases/" + tableid + "/edit" || editUrl === "/purchases/create") {
            //getPurchaseCategoryBasedInBranch
            getCategoryBasedInBranch()
            $(document).on('change', '#branchId', function () {
                getCategoryBasedInBranch()

            });
        }
    });

}


function getCategoryBasedInBranch(){
    var branch_id = $("#branchId").val();
   var input_category_id = $("#input_purchase_category_id").val();

    getSelectorBasedInOther({
        'branch_id': branch_id,
        'tableid': tableid,
        'tableName': tableName,
        'input_category_id':input_category_id
    }, 'get_selected_purchase_branch').then((data)=>{
        $('#appendPurchaseCategoryLevel').html(data);
    } ).then(()=>{
        //get product based in Category
        $(document).on('change', '.selectCategory', function () {
            getPurchaseProductBasedInCategory()
        });
        getPurchaseProductBasedInCategory()
    }).then(()=>{
        $(document).on('change','#stockId', function() {
            getProductItem()
        });
        getProductItem();

    });
}

function getProductItem(){
    var stock_id = $("#stockId").val();
    getSelectorBasedInOther({
        'stock_id':stock_id,
    }, 'getProductItembyId').then((data)=>{
        document.getElementById("saleUnitPrice").value = data.sale_unit_price;
     document.getElementById("purchaseUnitPrice").value = data.current_purchase_unit_price;

    });

}
function getSupplierItem(){
    var supplier_id = $("#supplier_id").val();
    getSelectorBasedInOther({   'supplier_id':supplier_id }, 'getSupplierItembyId').then((data)=>{
        document.getElementById("supplier_phone").value = data.phone;
       document.getElementById("supplier_address").value = data.address_en;

    });

}

function totalPayment(){
    getSelectorBasedInOther({},'getSumTotalItem').then((data)=>{

        document.getElementById("sub_total").value = data.sub_total ;

    })

}

    function getPurchaseProductBasedInCategory() {

        var category_id = $("#purchase_category_id").val()
        var input_category_id = $("#input_purchase_category_id").val();
        var input_stock_id = $("#input_stock_id").val();

        getSelectorBasedInOther({
            'category_id': category_id,
            'input_category_id': input_category_id,
            'input_stock_id': input_stock_id,
            'tableid': tableid,
            'tableName': tableName
        }, 'get_selected_purchase_product').then((data)=>{
            $('#appendPurchaseProductLevel').html(data);

        });


        // //getPurchaseProductBasedInCategory
        //  var category_id = $("#purchase_category_id").val()
        //
        // var input_category_id = $("#input_category_id").val();
        // var input_stock_id = $("#input_stock_id").val();
        // getSelectorBasedInOther({
        //     'category_id': category_id,
        //     'input_category_id': input_category_id,
        //     'input_stock_id': input_stock_id,
        //     'tableid': tableid,
        //     'tableName': tableName
        // }, 'get_selected_purchase_product', '#appendPurchaseProductLevel');
        // // // if(editUrl.includes('create')){
        // //     var stock_id = $("#stockId").val();
        // //     getProductItem(stock_id)
        // // }
    }
