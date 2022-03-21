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

export default class  SalePage{
     constructor() {
         getSaleCategoryBasedInbranch()
         $(document).on('change','#customer_id', function() {
             getCustomerItem()
         });


     }

}

function getSaleCategoryBasedInbranch() {
    if (editUrl === "/sales/" + tableid + "/edit" || editUrl === "/sales/create") {

    $(document).ready(function () {
            //getSaleCategoryBasedInBranch
            getCategoryBasedInBranch()
            $(document).on('change', '#branchId', function () {
                getCategoryBasedInBranch()

            });





    });
}
    $(document).ready(function () {
        if(editUrl==='/sales')
        {
            getStoreBasedInBranch()
            getCustomerBasedInBranch()
            getCustomerItem()
            $(document).on('change', '#branchId', function () {
                getStoreBasedInBranch()
                getCustomerBasedInBranch()

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
   var input_category_id = $("#input_sale_category_id").val();

    getSelectorBasedInOther({
        'branch_id': branch_id,
        'tableid': tableid,
        'tableName': tableName,
        'input_category_id':input_category_id
    }, 'get_selected_sale_branch').then((data)=>{
        $('#appendSaleCategoryLevel').html(data);
    } ).then(()=>{
        //get product based in Category
        $(document).on('change', '.selectCategory', function () {
            getSaleProductBasedInCategory()
        });
        getSaleProductBasedInCategory()
    }).then(()=>{
        setTimeout(function () {
            $(document).on('change','#stockId', function() {
                getProductItem()
            });
            getProductItem();
        },300)

        });



}

function getCustomerBasedInBranch(){
    var branch_id = $("#branchId").val();
    getSelectorBasedInOther({ 'branch_id': branch_id },
      'get_selected_sale_customer_based_branch').then((data)=>{

        $('#appendCustomerLevel').html(data);
    } ).then(()=>{
        getCustomerItem()
    });
}

function getProductItem(){
    var stock_id = $("#stockId").val();

    getSelectorBasedInOther({
        'stock_id':stock_id,
    }, 'getProductItembyId').then((data)=>{

     document.getElementById("saleUnitPrice").value = data.sale_unit_price;
     document.getElementById("purchaseUnitPrice").value = data.current_purchase_unit_price;
     document.getElementById("sale_quantity").max = data.quantity;

    });
}
function getCustomerItem(){
    var customer_id = $("#customer_id").val();
    getSelectorBasedInOther({   'customer_id':customer_id }, 'getCustomerItembyId').then((data)=>{
      if(data!==""){
          document.getElementById("customer_phone").value = data.contact_number;
          document.getElementById("area").value = data.area;
      }else{
          document.getElementById("customer_phone").value = ""   ;
          document.getElementById("area").value = "" ;
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
    getSelectorBasedInOther({},'getSumTotalSaleItem').then((data)=>{
        document.getElementById("sub_total").value = data.sub_total  ;
    }).then(()=>{
        getTotalOrder()
    })

}

function getSaleProductBasedInCategory() {

        var category_id = $("#purchase_category_id").val()
        var input_category_id = $("#input_sale_category_id").val();
        var input_stock_id = $("#input_stock_id").val();

        getSelectorBasedInOther({
            'category_id': category_id,
            'input_category_id': input_category_id,
            'input_stock_id': input_stock_id,
            'tableid': tableid,
            'tableName': tableName
        }, 'get_selected_sale_product').then((data)=>{
            $('#appendSaleProductLevel').html(data);

        });
    }
