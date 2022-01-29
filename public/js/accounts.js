
//get the language path
import getSelectorBasedInOther from "./selectBasedInOtherSelect.js";

var urlPath = window.location.href; // raw javascript
const lang = urlPath.split("/")[3];
//get tableName
const tableName = urlPath.split("/")[4];
const editUrl = urlPath.split(lang)[1];
const tableid = urlPath.split("/")[5];
//get dynamic row for search in table
var dynamicRowId ="#"+tableName+"-dynamicRow";

//search in  account sub control


export default class Accounts{

    constructor() {
        f();
    }
}

function f() {
    if(typeof tableid !== 'undefined'){
        if(tableName==='accountSubControls' || tableName==='accountSettings' ) {
            getAccountControlBasedInAccountHead();
            $(document).on('change','#accountHeadId',function () {
                getAccountControlBasedInAccountHead()
            })
        }
    }
}
function getAccountControlBasedInAccountHead() {
    var account_head_id = $('#accountHeadId').val();
    getSelectorBasedInOther({
        'account_head_id': account_head_id,
        'table_id': tableid,
        'tableName': tableName,
    }, 'get_selected_account_head').then((data)=>{
        $('#appendAccountControlLevel').html(data);
    }).then(()=>{
        getAccountSubControlBasedInAccountControl()
        $(document).on('change','#accountControlId',function () {
            getAccountSubControlBasedInAccountControl()
        })
    });
}

function getAccountSubControlBasedInAccountControl() {
        var account_head_id = $('#accountHeadId').val();
        var account_control_id = $('#accountControlId').val();
        getSelectorBasedInOther({
            'account_control_id': account_control_id,
            'account_head_id': account_head_id,
            'table_id': tableid,
            'tableName': tableName,
        }, 'get_selected_account_control').then((data)=>{
            $('#appendAccountSubControlLevel').html(data);
        });


}

