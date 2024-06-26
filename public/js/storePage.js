import getSelectorBasedInOther from "./selectBasedInOtherSelect.js";


class StorePage {
    constructor() {
        getStoreBasedInBranch()
    }
}





export default function getStoreBasedInBranch(){
    var branch_id = $("#branchId").val();
    getSelectorBasedInOther({ 'branch_id': branch_id },
        'get_selected_purchase_store_based_branch').then((data)=>{
        $('#appendStoreLevel').html(data);
    } )
}

