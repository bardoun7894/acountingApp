
   //get the language path
      var urlPath = window.location.href; // raw javascript

    const lang = urlPath.split("/")[3];
    //get tableName
    const tableName = urlPath.split("/")[4];
   //get dynamic row for search in table
   var dynamicRowId ="#"+tableName+"-dynamicRow";

    //search in  account sub control
    accountSubControlSearch();
   //search in  account  control
   accountControlSearch();
   financialYearSearch();
   supplierSearch();
   userSearch();
   customerSearch();


function accountSubControlSearch(){
    $(document).on('keyup','#search-account-sub-control',function (params) {
        var searchQuery =$(this).val();
        var url ="/"+lang+"/searchAccountSubControl"
        $.ajax({
            method:'post',
            url:url,
            dataType:'json',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data:{
                'searchQuery':searchQuery,
            },
            success:function (result) {
                var table_raw ="";
                $('#accountSubControl-dynamicRow').html("") ;
                $.each(result,function (index,value) {
                    // console.log(getRowName(value.account_control.account_control_name_en,value.account_control.account_control_name_ar)+"this is me")
                    var head_name=lang==="en"? value.account_head.account_head_name_en:value.account_head.account_head_name_ar;
                    var account_control_name=lang==="en"? value.account_control.account_control_name_en:value.account_control.account_control_name_ar;
                    var account_sub_control=lang==="en"? value.account_sub_control_name_en:value.account_sub_control_name_ar;
                    var user =value.user.user_type_id===1?'admin':'user';
                    table_raw+='<tr><td class="text-truncate"> '+value.id+'</td>';
                    table_raw+='    <td class="text-truncate">  '+head_name+'</td>';
                    table_raw+='    <td class="text-truncate"> '+ account_control_name+'</td>';
                    table_raw+='    <td class="text-truncate"> '+ account_sub_control +'</td>' ;
                    table_raw+='    <td class="text-truncate">'+user+'</td>';
                    table_raw+='    <td class="text-truncate"><a href="/accountSubControls/'+value.id+'/edit"><i class="la la-edit" style="color: green;font-size: 25px"></i></a> </td>';
                    table_raw+='    <td class="text-truncate">' +
                        '<a href="javascript:void(0)"  class="confirmDelete"   record="AccountSubControl"  recordId="'+value.id+'">' +
                        '  <i class="la la-trash" style="color: red;font-size: 25px"></i>  ' +
                        '</a></td></tr>';
                });
                $('#accountSubControl-dynamicRow').append(table_raw);
            }
        })

    })

}
function accountControlSearch(){
    $(document).on('keyup','#search-account-control',function (params) {
        var searchQuery = $(this).val();
        var url = "/"+lang+"/searchAccountControl"
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
                    var head_name=lang==="en"? value.account_head.account_head_name_en:value.account_head.account_head_name_ar;
                    var account_control_name=lang==="en"? value.account_control_name_en:value.account_control_name_ar;
                    table_raw+='<tr><td class="text-truncate"> '+value.id+'</td>';
                    table_raw+='    <td class="text-truncate"> '+ account_control_name+'</td>';
                    table_raw+='    <td class="text-truncate">  '+head_name+'</td>';
                    table_raw+='    <td class="text-truncate"><a href="/accountControls/'+value.id+'/edit"><i class="la la-edit" style="color: green;font-size: 25px"></i></a> </td>';
                    table_raw+='    <td class="text-truncate">' +
                        '<a href="javascript:void(0)"  class="confirmDelete"   record="AccountControl"  recordId="'+value.id+'">' +
                        '  <i class="la la-trash" style="color: red;font-size: 25px"></i>  ' +
                        '</a></td></tr>';
                });
                $(dynamicRowId).append(table_raw);
            }
        })

    });

}
function supplierSearch(){
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


   //get the accountHead and accountControl path
   $("#isActive").on('click',function (p) {
       console.log(this.value);
   });
   $(document).ready(function(){

   getAccountControlBasedInAccountHead();

    });

    //get the accountHead and accountControl path
    $("#accountHeadId").on('change', function() {
          getAccountControlBasedInAccountHead();
    });


    //get the accountHead and accountControl path
  function  getAccountControlBasedInAccountHead() {
      //clear the select AccountControl
      $("#accountControlOptGroup").html("");
      var account_head_id=$("#accountHeadId").val();
      var account_sub_control_id = $("#accountSubControlId").val();

      var url = "/"+lang+"/get_selected_account_control" ;
      $.ajax({
          type: "POST",
          url: url,
          data: {'account_head_id':account_head_id,'account_sub_control_id':account_sub_control_id,},
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          success: function(data) {

              if(account_sub_control_id!=""){
                  // alert("this is update");
                  $.each([data],function (key,item){
                     $.each(item[0],function (k, i) {
                         console.log(i)
                         if( getAccountControlName(i)===getAccountControlName(item[1])){
                             // console.log("yes is equal");
                             // var option = document.createElement("option");
                             // option.text = getAccountControlName(i)
                             // option.value = item[1].id;
                             // option.selected=true
                             // var groupOption = document.getElementById("accountControlOptGroup");
                             // var select =document.getElementById("accountControlId")
                             // select.appendChild(groupOption).appendChild(option);

                         makeOptionElementForAccountControlName(getAccountControlName(i),item[1].id,true)

                         }else{
                             // console.log("no equal")
                             // var option = document.createElement("option");
                             // option.text = getAccountControlName(i)
                             // option.value = i.id;
                             // option.selected=false
                             // var groupOption = document.getElementById("accountControlOptGroup");
                             // var select =document.getElementById("accountControlId")
                             // select.appendChild(groupOption).appendChild(option);

                             makeOptionElementForAccountControlName(getAccountControlName(i),i.id,false)

                         }

                     })
                  })


              }else{
                 $.each(data[0],function (key,item){
                      // console.log(item);
                    makeOptionElementForAccountControlName(getAccountControlName(item),item.id,false)
                 })

                        }


          },
          error:function (error) {
              console.log(error+"llllll");
          }
      });

  }
  function makeOptionElementForAccountControlName(text,value,selected){
      var option = document.createElement("option");
      option.text = text
      option.value = value;
      option.selected=selected
      var groupOption = document.getElementById("accountControlOptGroup");
      var select =document.getElementById("accountControlId")

      select.appendChild(groupOption).appendChild(option);
  }
  function getAccountControlName(item){
      return lang==="en"?item.account_control_name_en:item.account_control_name_ar
  }

  $(dynamicRowId).on('click','.confirmDelete',function (p){
     var record =$(this).attr('record');
     var recordId =$(this).attr('recordId');
      // Swal.fire({
      //     title: 'هل تريد الاستمرار؟',
      //     icon: 'question',
      //     iconHtml: '؟',
      //     confirmButtonText: 'نعم',
      //     cancelButtonText: 'لا',
      //     showCancelButton: true,
      //     showCloseButton: true
      // })
           Swal.fire({
             title: 'Are you sure?',
             text: "You want to remove "+record+" ?",
             icon: 'warning',
             showCancelButton: true,
             confirmButtonColor: '#3085d6',
             cancelButtonColor: '#d33',
             confirmButtonText: 'Yes, delete it!'
         }).then((result) => {
             if (result.isConfirmed) {
                 Swal.fire(
                     'Deleted!',
                     'Your file has been deleted.',
                     'success'
                 )
                 window.location.href="/"+lang+"/delete-"+record+"/"+recordId
             }
         })
  });
  //print Invoice
  document.getElementById('btnPrintInvoice').addEventListener('click',function (p) {
  this.style.display="none";
      print();
      location.reload()
  })

   // $('#btnPrintInvoice').addEventListener('click',function (p) {
 //     alert(p.id)
 // })
