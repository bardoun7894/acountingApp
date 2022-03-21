import getSelectorBasedInOther from './selectBasedInOtherSelect.js'
import getStoreBasedInBranch from   './storePage.js'

//get the language path
let urlPath = window.location.href; // raw javascript
const lang = urlPath.split("/")[3];
//get tableName
const tableName = urlPath.split("/")[4];
const editUrl = urlPath.split(lang)[1];
const tableid = urlPath.split("/")[5];
//get dynamic row for search in table

export default class  PurchasePage{
     constructor() {
         getPurchaseCategoryBasedInbranch()
         $(document).on('change','#supplier_id', function() {
             getSupplierItem()
         });


     }

}

function getPurchaseCategoryBasedInbranch() {
    if (editUrl === "/purchases/" + tableid + "/edit" || editUrl === "/purchases/create") {

    $(document).ready(function () {
            //getPurchaseCategoryBasedInBranch
            getCategoryBasedInBranch()
            $(document).on('change', '#branchId', function () {
                getCategoryBasedInBranch()

            });







    });
}
    $(document).ready(function () {
        if(editUrl==='/purchases')
        {
            getStoreBasedInBranch()
            getSupplierBasedInBranch()
            getSupplierItem()
            $(document).on('change', '#branchId', function () {
                getStoreBasedInBranch()
                getSupplierBasedInBranch()
        });
            $('#discountId').keyup((e) => {
                console.log(e.currentTarget.value);
                getTotalOrder()
            });
            $('#taxId').keyup((e) => {
                console.log(e.currentTarget.value);
                getTotalOrder()
            });

            totalPayment();
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
    })
}


function getSupplierBasedInBranch(){
    var branch_id = $("#branchId").val();
    getSelectorBasedInOther({ 'branch_id': branch_id },
      'get_selected_purchase_supplier_based_branch').then((data)=>{
        $('#appendSupplierLevel').html(data);
    } ).then(()=>{
        getSupplierItem()
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
      if(data!==""){
          document.getElementById("supplier_phone").value = data.phone;
          document.getElementById("supplier_address").value = data.address_en;
      }else{
          document.getElementById("supplier_phone").value = ""   ;
          document.getElementById("supplier_address").value = "" ;
      }

    });

}
function getTotalOrder() {
    let sub_total= 0;
    let tax= 0;
    let discount= 0;
     sub_total = parseFloat(document.getElementById("sub_total").value)
     tax =     parseFloat(document.getElementById("taxId").value)
     discount=  parseFloat(document.getElementById("discountId").value)

    // let totalPayment = sub_total+(tax * 100)/sub_total+(discount * 100)/sub_total;
    document.getElementById("order_total").value =  sub_total+( (tax * sub_total)/100)-((discount * sub_total)/100);


}

function totalPayment(){
    getSelectorBasedInOther({},'getSumTotalItem').then((data)=>{

        document.getElementById("sub_total").value = data.sub_total  ;
    }).then(()=>{
        getTotalOrder()
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

        }).then(()=>{
            $(document).on('change','#stockId', function() {
                getProductItem()
            });
            getProductItem();

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
