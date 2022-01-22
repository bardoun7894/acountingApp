
import getStoreBasedInBranch from "./storePage.js";

//get the language path
let urlPath = window.location.href; // raw javascript
const lang = urlPath.split("/")[3];

//get tableName
// const tableName = urlPath.split("/")[4];
const editUrl = urlPath.split(lang)[1];
const tableid = urlPath.split("/")[5];
//get dynamic row for search in table

export default class  UserPage{
    constructor() {
        $(document).ready(function () {
            if(editUrl==='/users/create'||editUrl==='/users/'+ tableid + "/edit")
            {

         $('#branchDivSelect').removeClass('col-md-6').addClass('col-md-12');


                getStoreBasedInBranch()
                $(document).on('change', '#branchId', function () {
                    getStoreBasedInBranch()
                });
                changePassword()
            }
        });

    }

}
  function changePassword(){

       $(document).on('dblclick', '.updateUserPassword', function (d) {

           $('.updateUserPassword').attr('readonly',false).attr('placeholder','new Password')


    })
}
