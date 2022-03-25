

export default class PaidAmount{

    constructor() {

        $('#payment_amount').keyup(function (){
            var total_amount =   $('#total_amount').val();
            var payment_amount =this.value;
            $('#remaining_amount').val((total_amount - payment_amount))

        });
    }
}


