import SearchTable from "./searchTable.js";
import CategoryPage from "./categoryPage.js";
import PurchasePage  from "./purchasePage.js";



//get the language path
    let urlPath = window.location.href; // raw javascript
    const lang = urlPath.split("/")[3];
    //get tableName
    const tableName = urlPath.split("/")[4];
    const editUrl = urlPath.split("en")[1];
    const tableid = urlPath.split("/")[5];
   //get dynamic row for search in table
   let dynamicRowId ="#"+tableName+"-dynamicRow";

  //category function
    new CategoryPage();
 //Purchase function
  new PurchasePage();

   //search in table

   new SearchTable();

   $(document).ready(function(){
       if(editUrl.includes('Invoice')){
      //print Invoice
      document.getElementById('btnPrintInvoice').addEventListener('click',function (p) {
          this.style.display="none";
          print();
          location.reload()
      })
  }


    });


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
