
  <!-- Form Start -->
  <form method="POST" id="purchaseReturnForm"
  @csrf

<div  class="card" > 
       
  <div class="container mt-5">
    <div class="invoice-header">
        <h2>Invoice</h2>
        <p><strong>Invoice Number:</strong> {{$supplierInvoice->invoice}}</p>
        <p><strong>Supplier Name:</strong> {{$supplierInvoice->supplier->supplier_name}}</p>
        <p><strong>Email:</strong> {{$supplierInvoice->supplier->email}}</p>
        <p><strong>Phone:</strong> {{$supplierInvoice->supplier->phone}}</p>
    </div>

    <div class="invoice-details">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>{{ __('messages.product_name') }}</th>
                    <th>{{ __('messages.supplier_name') }}</th>
                    <th> {{__('messages.unit_price')}}</th>
                    <th>{{ __('messages.quantity')}}</th>
                    <th>{{ __('messages.return_quantity')}}</th>
                    <th>{{__('messages.total_amount_returned')}}</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($supplierInvoice->supplierInvoiceDetails as $key => $item)
                <tr>

                    <td>{{ $item->stock->product_name_en }}</td>
                    <td>{{ $supplierInvoice->supplier->supplier_name_en }}</td>
                    <td id="unit_price{{ $item->id }}" >{{ $item->purchase_unit_price }}</td>
                    <td  id="purchase_quantity{{ $item->id }}" >{{ $item->purchase_quantity }}</td>
                    <td>
                        <input type="number"
 idReturnDetails="idReturnDetails{{$supplierInvoice->supplierReturnInvoiceDetails[$key]->id}}"
                               name="return_quantities{{ $item->id }}"
                               id="returnPurchasesQty" class="form-control"
                               min="0" max="{{ $item->quantity }}"
                               value="{{$supplierInvoice->supplierReturnInvoiceDetails[$key]->purchase_return_quantity}}" required >
                            <span class="error" id="error-message{{ $item->id }}" style="color: red"></span>
                    </td>
                    <td class="total-amount-purchases-returned" id="total_amount_purchases_returned{{ $item->id }}">{{$supplierInvoice->supplierReturnInvoiceDetails[$key]->total_price}}</td>

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
                    <td class="text-right" id="sub_total_returned">{{$subtotalReturned}} </td>
                </tr>
                <tr>
                    <td class="text-right"><strong>Tax (10%):</strong></td>
                    <td class="text-right" id="tax">{{$supplierInvoice->tax}} </td>
                </tr>
                <tr>
                    <td class="text-right"><strong>Discount:</strong></td>
                    <td class="text-right" id="discount">{{$supplierInvoice->discount}}</td>
                </tr>
                <tr>
                    <td class="text-right"><strong>Total:</strong></td>
                    <td class="text-right" id="total">{{$supplierInvoice->total_amount}}</td>
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
