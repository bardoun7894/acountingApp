
//get the language path
var urlPath = window.location.href; // raw javascript
const lang = urlPath.split("/")[3];
//get tableName
const tableName = urlPath.split("/")[4];
const editUrl = urlPath.split(lang)[1];
const tableid = urlPath.split("/")[5];
//get dynamic row for search in table
var dynamicRowId ="#"+tableName+"-dynamicRow";

//search in  account sub control

export function getAccountHead_AccountControlPathWhenChange(){
    //get the accountHead and accountControl path
    $("#accountHeadId").on('change', function() {
        getAccountControlBasedInAccountHead();
    });

}
function getAccountControlName(item){
    return lang==="en"?item.account_control_name_en:item.account_control_name_ar
}

export  function accountSubControlSearch(){

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
                $(dynamicRowId).html("") ;
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
                $(dynamicRowId).append(table_raw);
            }
        })

    })

}

export function accountControlSearch(){
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
                            makeOptionElement(getAccountControlName(i),item[1].id,true,"accountControlOptGroup","accountControlId")
                        }else{

                            makeOptionElement(getAccountControlName(i),i.id,false,"accountControlOptGroup","accountControlId")

                        }

                    })
                })

            }else{
                $.each(data[0],function (key,item){
                    // console.log(item);
                    makeOptionElement(getAccountControlName(item),item.id,false,"accountControlOptGroup","accountControlId")
                })

            }


        },
        error:function (error) {
            console.log(error+"llllll");
        }
    });

}

function makeOptionElement(text,value,selected,optGroup,ModelId){
    var option = document.createElement("option");
    option.text = text
    option.value = value;
    option.selected=selected
    var groupOption = document.getElementById(optGroup);
    var select =document.getElementById(ModelId)
    select.appendChild(groupOption).appendChild(option)
}


export  function getSelectedAccountHeadINSubControl(){

        if(editUrl==="/accountSubControls/"+tableid+"/edit" || editUrl==="/accountSubControls/create"){
            getAccountControlBasedInAccountHead();
        }

}

