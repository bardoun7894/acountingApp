<div class="card">
    <div class="card-header">
        <h3 class="card-title">Invoice Search Result</h3>
    </div>
    <div class="card-body text-center">
        <div class="icon-container mb-3">
            <svg xmlns="http://www.w3.org/2000/svg" width="72" height="72" fill="currentColor" class="bi bi-file-earmark-exclamation" viewBox="0 0 16 16">
                <path d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5L14 4.5zM9.5 0v3.5a1.5 1.5 0 0 0 1.5 1.5H14l-4.5-4.5zM1 2a1 1 0 0 1 1-1h5.5v3a.5.5 0 0 0 .5.5H13v8a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2z"/>
                <path d="M6.002 11a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm-.938-2.49c-.458 0-.67.362-.743.732-.073.371.168.758.635.758.457 0 .668-.362.741-.732.073-.371-.168-.758-.633-.758zM4.999 5.5a.5.5 0 0 0-1 0v1a.5.5 0 0 0 1 0v-1z"/>
            </svg>
        </div>
        <h4 class="text-danger">Invoice Not Found</h4>
        <p>The invoice number <strong>{{ $invoice_number }}</strong> could not be found.</p>
    </div>
</div>