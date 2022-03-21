import getSelectorBasedInOther from './selectBasedInOtherSelect.js'

//get the language path
let urlPath = window.location.href; // raw javascript
const lang = urlPath.split("/")[3];
//get tableName
const tableName = urlPath.split("/")[4];
const editUrl = urlPath.split(lang)[1];
const tableid = urlPath.split("/")[5];
//get dynamic row for search in table



export default class CategoryPage{

    constructor() {
        getCategoryBasedInbranch()
     }

}

  function getCategoryBasedInbranch(){
    if(editUrl==="/categories/"+tableid+"/edit" || editUrl==="/categories/create"){
        getCategoryBasedInBranch();
        $(document).on('change','#branchId', function() {
            getCategoryBasedInBranch();
        });
    }

    function getCategoryBasedInBranch(){
        //getCategoryBasedInbranch
        var branch_id= $("#branchId").val();
        getSelectorBasedInOther({ 'branch_id':branch_id,'tableid':tableid,'tableName':tableName},'get_selected_branch').then((data)=>{
            $('#appendCategoryLevel').html(data)

        });
    }



}
