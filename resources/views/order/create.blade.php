@extends('app')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $title }}</h5>
                <form action="{{ route('order.store') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="" class="form-label">Order Code</label>
                                <input type="text" name="order_code" class="form-control" value="{{ $code }}" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Customer</label>
                                <select name="id_customer" id="" class="form-control">
                                    <option value="">Choose Customer</option>
                                    @foreach ($customers as $customer)
                                    <option value="{{ $customer->id }}">{{ $customer->customer_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="id_service" class="form-label">Packet Service</label>
                                <select id="id_service" class="form-control">
                                    <option value="">Choose Service</option>
                                    @foreach ($services as $service)
                                    <option data-price="{{ $service->price }}" value="{{ $service->id }}">{{ $service->service_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">End Order</label>
                                <input type="date" name="order_end_date" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Note</label>
                                <textarea cols="30" rows="10" name="note" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-sm-6"></div>
                    </div>

                    <div class="mb-3">
                        <div class="mb-3" align="right">
                            <button type="button" class="btn btn-primary" id="addRow">Add Row</button>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="myTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Packet</th>
                                        <th>Qty</th>
                                        <th>Subtotal</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                    <p><strong>Total: Rp. <span id="totalText"></span></strong></p>
                    <input type="hidden" name="total" id="total" value="0">

                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    const addRow = document.querySelector('#addRow');
    const tbody = document.querySelector('#myTable tbody');
    const selectService = document.querySelector('#id_service');

    addRow.addEventListener('click', function(){
        const optionsService = selectService.options[selectService.selectedIndex];
        const nameService = optionsService.textContent;
        const priceService = parseInt(optionsService.dataset.price);
        if (!selectService.value) {
            alert('Tolong Pilih Paket Servicenya');
            return;
        }

        const tr = document.createElement('tr');

        let no = 1;
        tr.innerHTML = `
            <td>${no}</td>
            <td><input type="hidden" class="id_services" name="id_service[]" value="${selectService.value}">${nameService}</td>
            <td>
                <input type="number" step="any" min="1" class="form-control qtys" name="qty[]" value="1">
                <input type="hidden" class="prices" value="${priceService}">
            </td>
            <td><input type="hidden" class="subtotals" name="subtotal[]" value="${priceService}">Rp. <span class="textSubtotals">${priceService.toLocaleString('id-ID')}</span></td>
            <td><button type="button" class="btn btn-danger btn-sm delRow">Delete</button></td>
        `;

        tbody.appendChild(tr);
        no++;

        updateTotal();
        selectService.value = "";
    });

    tbody.addEventListener('click', function(e){
        if (e.target.classList.contains('delRow')) {
            const row = e.target.closest('tr');
            row.remove();
            updateNo();
            updateTotal();
        }
    });

    tbody.addEventListener('input', function(e){
        if (e.target.classList.contains('qtys')) {
            const row = e.target.closest('tr');
            const qty = parseFloat(e.target.value) || 0;
            const price = parseInt(row.querySelector('.prices').value) || 0;
            const subtotal = qty * price;
            row.querySelector('.subtotals').value = subtotal;
            row.querySelector('.textSubtotals').textContent = subtotal.toLocaleString('id-ID');

            updateTotal();
        }
    });

    function updateNo() {
        const rows = tbody.querySelectorAll('tr');
        rows.forEach(function(row, index){
            row.cells[0].textContent = index + 1;
        });

        no = rows.length + 1;
    }

    function updateTotal() {
        const rows = tbody.querySelectorAll('tr');
        let sum = 0;
        rows.forEach(function(row, index){
            sum += parseInt(row.querySelector('.subtotals').value);
        });

        document.querySelector('#total').value = sum;
        document.querySelector('#totalText').textContent = sum.toLocaleString('id-ID');
    }

</script>
@endsection