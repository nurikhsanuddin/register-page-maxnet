<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/x-icon" href="{{ asset('storage/logo.png') }}">
  <style>
    * {
      font-family: Verdana, Arial, sans-serif;
    }

    .header {
      overflow-x: auto;
      padding: 1rem;
      border-radius: 0.375rem;
      width: 100%;
      background-color: #ffffff;
      border-bottom: 3px solid #C4B5FD;
      margin-bottom: 1rem;
    }

    .header .main-header {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
      border-bottom-width: 4px;
      border-color: #C4B5FD;
      position: relative;
    }

    .header .main-header .self-center {
      align-self: center;
    }

    .header .main-header .info2 {
      position: absolute;
      right: 0;
      top: -20px;
      text-align: right;
    }

    .header .main-header .info2 .inv-no {
      font-size: 1.25rem;
      line-height: 1.75rem;
      text-align: right;
      padding: 0.25rem 0.5rem;
      background-color: #C4B5FD;
      border-radius: 0.25rem;
      border: 1px solid #8b5cf6;
    }

    .header .main-header .info2 .address {
      margin: 0;
    }

    .header .self-center img {
      height: 60px;
    }

    .main1 {
      position: relative;
    }

    .main1 .main1-content1 .main1-table2 {
      float: right;
      margin-top: -75px;
    }

    .paid-status b {
      padding-top: 0.25rem;
      padding-bottom: 0.25rem;
      padding-left: 1rem;
      padding-right: 1rem;
      margin-right: 0.5rem;
      margin-left: 0.5rem;
      border: 1px solid #34D399;
      font-size: 0.75rem;
      line-height: 1rem;
      color: #10B981;
      background-color: #D1FAE5;
      border-radius: 0.25rem;
    }

    .overdue-status b {
      padding-top: 0.25rem;
      padding-bottom: 0.25rem;
      padding-left: 1rem;
      padding-right: 1rem;
      margin-right: 0.5rem;
      border-radius: 0.25rem;
      border: 1px solid #F87171;
      font-size: 0.75rem;
      line-height: 1rem;
      color: #EF4444;
      background-color: #FEE2E2;
    }

    .unpaid-status b {
      padding-top: 0.25rem;
      padding-bottom: 0.25rem;
      padding-left: 1rem;
      padding-right: 1rem;
      margin-right: 0.5rem;
      border-radius: 0.25rem;
      border: 1px solid #fde047;
      font-size: 0.75rem;
      line-height: 1rem;
      color: #eab308;
      background-color: #fef9c3;
    }

    .main2 {
      font-family: Arial, Helvetica, sans-serif;
      margin-top: 1rem;
      width: 100%;
    }

    .main2 .main2-table-2 {
      width: 100%;
      font-size: 0.875rem;
      line-height: 1.25rem;
      text-align: left;
      color: #6B7280;
    }

    .main2 .main2-table-2 thead {
      font-size: 0.75rem;
      line-height: 1rem;
      color: #374151;
      background-color: #d9d0ff;
    }

    .main2 .main2-table-2 thead th {
      padding-top: 0.5rem;
      padding-bottom: 0.5rem;
      padding-left: 0.75rem;
      padding-right: 0.75rem;
      text-align: left;
      border-radius: 0.25rem;
    }

    .main2 .main2-table-2 tbody tr {
      margin: 0;
      padding-left: 0.75rem;
    }

    .main2 .main2-table-2 tbody {
      border-bottom: 3px solid #d9d0ff;
    }

    .main2 .main2-table-2 tbody td {
      margin: 0;
      padding-left: 0.75rem;
    }

    .main2 .main2-table-2 tbody td:nth-child(2) {
      color: #000;
    }

    .main2 .main2-table-2 tbody td p {
      margin: 0;
      padding: 0;
    }

    .main2 .main2-table-2 tbody td p.main {
      color: #000;
    }

    .main2 .main2-table-2 tbody td p.desc {
      padding-left: 0.75rem;
    }

    .main2 .main2-table-2 tfoot td {
      margin-top: 0.50rem;
    }

    .main2 .main2-table-2 tfoot {
      padding-top: 0.5rem;
    }

    .main2 .main2-table-2 tfoot td {
      margin: 0;
      padding-left: 0.75rem;
    }

    .main2 .main2-table-2 tfoot td:nth-child(1) {
      text-align: right;
      color: #000;
    }

    .main2 .main2-table-2 tfoot td:nth-child(2) {
      color: #000;
    }

    .main3 {
      margin-top: 50px;
      font-size: 11px;
    }

    .main3 .content2 {
      padding: -1rem 1rem 1rem 1rem;
    }

    .main3 img {
      width: 240px;
      float: right;
      border: 1px solid #C4B5FD;
      border-radius: 0.25rem;
    }

    .footer {
      border-top: 3px solid #C4B5FD;
      width: 100%;
      position: absolute;
      left: 0;
      text-align: center;
      bottom: 0;
      color: #374151;
    }
  </style>
  <title>Maxnet+</title>
</head>

<body>
  <div class="header">
    <span class="main-header">
      @if ($group == 4)
      <div class="self-center">
        <img src="{{ asset('storage/icon.png') }}" alt="icon maxnet">
      </div>
      <div class="info2">
        <b>PT KAWAN INFORMATIKA TEKNOLOGI ABADI</b>
        <p class="address">Jl Gondosuli Selatan No 659 Pajang, Surakarta<br>
          <b>info@spasi.id</b> | <b>0838-9485-6262</b>
        </p>
        <b class="inv-no">No. {{ $billing->invoice_no }}
        </b>
      </div>
      @else
      <div class="self-center">
        <img src="{{ asset('storage/icon.png') }}" alt="icon maxnet">
      </div>
      <div class="info2">
        @if ($group == 1)
        <b>PT LINGKAR KABEL TELEKOMUNIKASI</b>
        @else
        <b class="text-xl font-bold text-slate-800 md:text-right">PT KAWAN INFORMATIKA TEKNOLOGI ABADI</b>
        @endif
        <p class="address">Ruko Perum Puri Indrastra No. 1 <br>Jl.
          Mangesti Raya, Gentan, Solo</p>
        <b class="inv-no">No. {{ $billing->invoice_no }}
        </b>
      </div>
      @endif
    </span>
  </div>

  <div class="main1">
    <span class="main1-content1">
      <h1 class="uppercase font-bold text-slate-800 md:text-2xl">Tagihan Pembayaran</h1>
      <table class="main1-table2">
        <tbody>
          <tr>
            <td>Dibuat Pada</td>
            <td>: {{ Carbon\Carbon::parse($billing->created_at)->format('d F Y') }}</td>
          </tr>
          <tr>
            <td>Jatuh Tempo</td>
            <td>: {{ $due_date }}</td>
          </tr>
          <tr>
            <td>Status</td>
            <td>: <span class="paid-status">
                @if ($billing->status == 'PAID')
                <b>PAID</b>
                @elseif ($billing->status == 'OVERDUE')
                <b class="overdue-status">OVERDUE</b>
                @else
                <b class="unpaid-status">UNPAID</b>
                @endif
              </span>
            </td>
          </tr>
        </tbody>
      </table>
    </span>
  </div>

  <div class="main2">
    <table class="main2-table-2">
      <thead>
        <tr>
          <th>No</th>
          <th>Deskripsi</th>
          <th>Jumlah</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($billingDetail as $index => $detail)
        <tr>
          <td>{{ $index + 1 }}</td>
          <td>{{ $detail->description }}</td>
          <td>{{ $detail->amount }}</td>
        </tr>
        @endforeach
      </tbody>
      <tfoot>
        <tr>
          <td colspan="2" class="text-right">Total:</td>
          <td>{{ $billing->total_amount }}</td>
        </tr>
      </tfoot>
    </table>
  </div>

  <div class="main3">
    <div class="content2">
      <p>Unused Subscriptions:</p>
      <ul>
        @foreach ($unusedSubs as $subscription)
        <li>{{ $subscription->name }}</li>
        @endforeach
      </ul>
    </div>
  </div>

  <div class="footer">
    <p>&copy; {{ date('Y') }} Maxnet+</p>
  </div>
</body>

</html>