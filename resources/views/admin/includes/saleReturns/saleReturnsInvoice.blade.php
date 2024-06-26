 
  <!-- Form Start -->
  <form method="POST" id="saleReturnForm"
  @csrf

<div  class="card" > 
       
  <div class="container mt-5">
    <div class="invoice-header">
        <h2>Invoice</h2>
        <p><strong>Invoice Number:</strong> {{$customerInvoice->invoice_number}}</p>
        <p><strong>Customer Name:</strong> {{$customerInvoice->customer->$customer_name}}</p>
        <p><strong>Email:</strong> {{$customerInvoice->customer->email}}</p>
        <p><strong>Phone:</strong> {{$customerInvoice->customer->contact_number}}</p>
    </div>

    <div class="invoice-details">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>{{ __('messages.product_name') }}</th>
                    <th>{{ __('messages.customer_name') }}</th>
                    <th> {{__('messages.unit_price')}}</th>
                    <th>{{ __('messages.quantity')}}</th>
                    <th>{{ __('messages.return_quantity')}}</th>
                    <th>{{__('messages.total_amount_returned')}}</th>

                </tr>
            </thead>
            <tbody>

                @foreach ($customerInvoice->customerInvoiceDetails as $key => $item)
                <tr>

                    <td>{{ $item->stock->product_name_en }}</td>
                    <td>{{ $customerInvoice->customer->customer_name_en }}</td>
                    <td id="unit_price{{ $item->id }}" >{{ $item->sale_unit_price }}</td>
                    <td  id="sale_quantity{{ $item->id }}" >{{ $item->sale_quantity }}</td>
                    <td>
                        <input type="number"
 idReturnDetails="idReturnDetails{{$customerInvoice->customerReturnInvoiceDetails[$key]->id }}"
                               name="return_quantities{{ $item->id }}"
                               id="returnSaleQty" class="form-control"
                               min="0" max="{{ $item->quantity }}"
                               value="{{$customerInvoice->customerReturnInvoiceDetails[$key]->sale_return_quantity}}" required >

                               
                            <span class="error" id="error-message{{ $item->id }}" style="color: red"></span>
                    </td>
                    <td class="total-amount-sale-returned" id="total_amount_sales_returned{{ $item->id }}">{{$customerInvoice->customerReturnInvoiceDetails[$key]->total_price}}</td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="invoice-summary float-right">
        <table class="table">
            <tbody>
                <tr>
                    <td class="text-right"><strong>Subtotal:</strong></td>
                    <td class="text-right" id="subtotal"> {{$subtotal}}</td>
                </tr>
                <tr>
                    <td class="text-right"><strong>Subtotal Returned:</strong></td>
                    <td class="text-right" id="sub_total_sale_returned">{{$subtotalReturned}} </td>
                </tr>
                <tr>
                    <td class="text-right"><strong>Tax (10%):</strong></td>
                    <td class="text-right" id="tax">{{$customerInvoice->tax}} </td>
                </tr>
                <tr>
                    <td class="text-right"><strong>Discount:</strong></td>
                    <td class="text-right" id="discount">{{$customerInvoice->discount}}</td>
                </tr>
                <tr>
                    <td class="text-right"><strong>Total:</strong></td>
                    <td class="text-right" id="total">{{$customerInvoice->total_amount}}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="form-group">
        <input type="checkbox" id="isPaid" name="is_paid">
        <label for="isPaid">Invoice is Paid</label>
    </div>

</div>

</div>
  {{-- complete screen --}}
  <div class="form-group float-right">
    <button class="btn btn-secondary  btn-lg" type="submit">Process Return</button>
</div>
</form>

<style>
    .invoice-header {
    margin-bottom: 20px;
    padding-bottom: 10px;
    border-bottom: 1px solid #eeeeee;
}
.invoice-details, .invoice-summary {
    margin-bottom: 20px;
}
.invoice-summary > tbody > tr > td {
    border-top: none;
}
.text-right {
    text-align: right;
}
</style>
