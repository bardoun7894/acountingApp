
import CategoryPage from "./categoryPage.js";
import PurchasePage  from "./purchasePage.js";
import SalePage  from "./salePage.js";
import StorePage  from "./storePage.js";
import UserPage  from "./userPage.js";
import Accounts from "./accounts.js";
import PaidAmount from "./paidAmountPage.js";


//get the language path
    let urlPath = window.location.href; // raw javascript

    const lang = urlPath.split("/")[3];
    //get tableName
    const tableName = urlPath.split("/")[4];
    const editUrl = urlPath.split(lang)[1];
    const tableid = urlPath.split("/")[5];
   //get dynamic row for search in table
   let dynamicRowId ="#"+tableName+"-dynamicRow";

  //category function
    new CategoryPage();
    new PaidAmount();
 //Purchase function
  new PurchasePage();
  //Purchase function
  new SalePage();

  //user page
  new UserPage();
//account page
  new Accounts()

   $(document).ready(function(){
       if(urlPath.split('/').length===5){
           $('#datatableBootstrap').DataTable({
                 responsive:true,
               dom: 'Bfrtip',
               buttons: [
                   'copy', 'csv', 'excel', 'pdf', 'print'
               ],
               language: {
                   "url":lang==="en"?"//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/English.json":"//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Arabic.json"
               }
           });
       }
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

      Swal.fire({
             title: lang==='ar'?'هل تريد الاستمرار؟':'Are you sure?',
             text:lang==='ar'?" هل تريد حذف هذه البيانات": "You want to remove "+record+" ?",
             icon: 'warning',
             showCancelButton: true,
             confirmButtonColor: '#3085d6',
             cancelButtonColor: '#d33',
             confirmButtonText: lang==='ar'?'نعم':'Yes, delete it!'   ,
             cancelButtonText: lang==='ar'?'لا':'no',
         }).then((result) => {
             if (result.isConfirmed) {
                 swal.fire(
                     lang==='ar'?'تم الحذف':'Deleted!',
                     lang==='ar'?'تم حذف البيانات':'Your data has been deleted.',
                     lang==='ar'? 'نجاح':'success'
                 )
                 window.location.href="/"+lang+"/delete-"+record+"/"+recordId
             }
         })
  });
