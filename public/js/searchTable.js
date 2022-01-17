import * as account  from './accounts.js';

var urlPath = window.location.href; // raw javascript
const lang = urlPath.split("/")[3];



//get tableName
const tableName = urlPath.split("/")[4];
var dynamicRowId ="#"+tableName+"-dynamicRow";


export default class SearchTable {

    constructor() {
        financialYearSearch();
        supplierSearch();
        userSearch();
        customerSearch();
        // search in  account sub control
        account.accountSubControlSearch(dynamicRowId);
        //search in  account  control
        account.accountControlSearch();
    }
}

function  supplierSearch(){
    $(document).on('keyup','#search-supplier',function (params) {
        var searchQuery = $(this).val();
        var url = "/"+lang+"/searchSupplier"
        $.ajax({
            method:'post',
            url:url ,
            dataType:'json',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data:{
                'searchQuery':searchQuery,
            },
            success:function (result) {
                console.log(result)
                var table_raw ="";
                $(dynamicRowId).html("");
                $.each(result,function (index,value) {
                    var supplier_name=lang==="en"? value.supplier_name_en:value.supplier_name_ar;
                    var address= lang==="en"? value.address_en:value.address_ar;
                    var description= lang==="en"? value.description_en:value.description_ar;
                    table_raw+='<tr><td class="text-truncate"> '+value.id+'</td>';
                    table_raw+='    <td class="text-truncate"> '+ supplier_name+'</td>';
                    table_raw+='    <td class="text-truncate"> '+address+'</td>';
                    table_raw+='    <td class="text-truncate"> '+ description+'</td>';
                    table_raw+='    <td class="text-truncate"> '+ value.email+'</td>';
                    table_raw+='    <td class="text-truncate"> '+ value.phone+'</td>';
                    table_raw+='    <td class="text-truncate"><a href="/suppliers/'+value.id+'/edit"><i class="la la-edit" style="color: green;font-size: 25px"></i></a> </td>';
                    table_raw+='    <td class="text-truncate">' +
                        '<a href="javascript:void(0)"  class="confirmDelete"   record="Supplier"  recordId="'+value.id+'">' +
                        '  <i class="la la-trash" style="color: red;font-size: 25px"></i>  ' +
                        '</a></td></tr>';
                });
                $(dynamicRowId).append(table_raw);
            }
        })

    });

}
function customerSearch(){
    $(document).on('keyup','#search-customer',function (params) {
        var searchQuery = $(this).val();
        var url = "/"+lang+"/searchCustomer"
        $.ajax({
            method:'post',
            url:url ,
            dataType:'json',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data:{
                'searchQuery':searchQuery,
            },
            success:function (result) {
                console.log(result)
                var table_raw ="";
                $(dynamicRowId).html("");
                $.each(result,function (index,value) {
                    var customer_name=lang==="en"? value.customer_name_en:value.customer_name_ar;
                    var address= lang==="en"? value.address_en:value.address_ar;
                    var description= lang==="en"? value.description_en:value.description_ar;
                    table_raw+='<tr><td class="text-truncate"> '+value.id+'</td>';
                    table_raw+='    <td class="text-truncate"> '+ customer_name+'</td>';
                    table_raw+='    <td class="text-truncate"> '+ value.contact_number+'</td>';
                    table_raw+='    <td class="text-truncate"> '+address+'</td>';
                    table_raw+='    <td class="text-truncate"> '+ description+'</td>';
                    table_raw+='    <td class="text-truncate"> '+ value.area+'</td>';
                    table_raw+='    <td class="text-truncate"><a href="/customers/'+value.id+'/edit"><i class="la la-edit" style="color: green;font-size: 25px"></i></a> </td>';
                    table_raw+='    <td class="text-truncate">' +
                        '<a href="javascript:void(0)"  class="confirmDelete"   record="Customer"  recordId="'+value.id+'">' +
                        '  <i class="la la-trash" style="color: red;font-size: 25px"></i>  ' +
                        '</a></td></tr>';
                });
                $(dynamicRowId).append(table_raw);
            }
        })

    });

}
function userSearch(){
    $(document).on('keyup','#search-user',function (params) {
        var searchQuery = $(this).val();
        var url = "/"+lang+"/searchUser"
        $.ajax({
            method:'post',
            url:url ,
            dataType:'json',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data:{
                'searchQuery':searchQuery,
            },
            success:function (result) {
                console.log(result)
                var table_raw ="";
                $(dynamicRowId).html("");
                $.each(result,function (index,value) {
                    var full_name=lang==="en"? value.full_name_en:value.full_name_ar;
                    table_raw+='<tr><td class="text-truncate"> '+value.id+'</td>';
                    table_raw+='    <td class="text-truncate"> '+ value.user_type_id+'</td>';
                    table_raw+='    <td class="text-truncate"> '+ full_name+'</td>';
                    table_raw+='    <td class="text-truncate"> '+ value.username+'</td>';
                    table_raw+='    <td class="text-truncate"> '+ value.email+'</td>';
                    table_raw+='    <td class="text-truncate"> '+ value.contact_number+'</td>';
                    table_raw+='    <td class="text-truncate"><a href="/users/'+value.id+'/edit"><i class="la la-edit" style="color: green;font-size: 25px"></i></a> </td>';
                    table_raw+='    <td class="text-truncate">' +
                        '<a href="javascript:void(0)"  class="confirmDelete"   record="User"  recordId="'+value.id+'">' +
                        '  <i class="la la-trash" style="color: red;font-size: 25px"></i>  ' +
                        '</a></td></tr>';
                });
                $(dynamicRowId).append(table_raw);
            }
        })

    });

}
function financialYearSearch(){
    $(document).on('keyup','#search-finance-year',function (params) {
        var searchQuery = $(this).val();
        var url = "/"+lang+"/searchFinanceYear"
        $.ajax({
            method:'post',
            url:url ,
            dataType:'json',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data:{
                'searchQuery':searchQuery,
            },
            success:function (result) {
                console.log(result)
                var table_raw ="";
                $(dynamicRowId).html("");
                $.each(result,function (index,value) {
                    table_raw+='<tr><td class="text-truncate"> '+value.id+'</td>';
                    table_raw+='    <td class="text-truncate"> '+ value.financial_year +'</td>';
                    table_raw+='    <td class="text-truncate">  '+value.startDate+'</td>';
                    table_raw+='    <td class="text-truncate">  '+value.endDate+'</td>';
                    table_raw+='    <td class="text-truncate">  '+value.isActive+'</td>';
                    table_raw+='    <td class="text-truncate"><a href="/accountControls/'+value.id+'/edit"><i class="la la-edit" style="color: green;font-size: 25px"></i></a> </td>';
                    table_raw+='    <td class="text-truncate">' +
                        '<a href="javascript:void(0)"  class="confirmDelete"   record="FinanceYear"  recordId="'+value.id+'">' +
                        '  <i class="la la-trash" style="color: red;font-size: 25px"></i>  ' +
                        '</a></td></tr>';
                });
                $(dynamicRowId).append(table_raw);
            }
        })

    });

}
// function purchaseSearch(urlAjaxPath,idSelector,searchID){
//     $(document).on('keyup',searchID,function (params) {
//         var searchQuery = $(this).val();
//         // searchFinanceYear=urlAjaxPath
//         // dynamicRowId=idselector
//         // searchID=#search-finance-year
//         var url = "/"+lang+"/"+urlAjaxPath
//         $.ajax({
//             method:'post',
//             url:url ,
//             dataType:'json',
//             headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
//             data:{  'searchQuery':searchQuery},
//             success:function (data) {
//                 // dynamicRowId=idselector
//                 $(idSelector).html(data);
//                 // var table_raw ="";
//                 // $(dynamicRowId).html("");
//                 // $.each(result,function (index,value) {
//                 //   table_raw+='<tr><td class="text-truncate"> '+value.id+'</td>';
//                 //     table_raw+='    <td class="text-truncate"> '+ value.financial_year +'</td>';
//                 //     table_raw+='    <td class="text-truncate">  '+value.startDate+'</td>';
//                 //     table_raw+='    <td class="text-truncate">  '+value.endDate+'</td>';
//                 //     table_raw+='    <td class="text-truncate">  '+value.isActive+'</td>';
//                 //     table_raw+='    <td class="text-truncate"><a href="/accountControls/'+value.id+'/edit"><i class="la la-edit" style="color: green;font-size: 25px"></i></a> </td>';
//                 //     table_raw+='    <td class="text-truncate">' +
//                 //         '<a href="javascript:void(0)"  class="confirmDelete"   record="FinanceYear"  recordId="'+value.id+'">' +
//                 //         '  <i class="la la-trash" style="color: red;font-size: 25px"></i>  ' +
//                 //         '</a></td></tr>';
//                 // });
//                 // $(dynamicRowId).append(table_raw);
//             }
//         })
//     });
// }
//

