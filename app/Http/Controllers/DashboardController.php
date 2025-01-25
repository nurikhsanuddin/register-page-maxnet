<?php

namespace App\Http\Controllers;

use App\Utilities\IsActiveUserX86;
use App\Http\Controllers\Controller;
use App\Models\Billing;
use App\Models\BillingDetail;
use App\Models\Subscription;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;




use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function home()
    {
        $customer_id = Auth::user()->customer_id;

        if (Auth::user()->password_reset) {
            return redirect()->route('editPassword');
        }

        $count_subs = Subscription::where('customer_id', $customer_id)->count();
        return view('index', compact('count_subs'));
    }
    public function edit()
    {

        return view('users.editPassword');
    }


    public function update(Request $request)
    {
        // Validasi input
        $request->validate([
            'new_password' => ['required', 'confirmed', 'min:4'],
        ]);

        // Ambil user yang sedang login
        $user = Auth::user();

        // Periksa apakah password saat ini cocok dengan yang tersimpan di database
        // if (Hash::check($request->current_password, $user->customer_password)) {
        // Jika cocok, update password dan set password_reset menjadi 0
        $user->customer_password = Hash::make($request->new_password);
        $user->password_reset = 0;
        $user->save();

        // Redirect dengan pesan sukses
        return redirect()->route('home')->with('success', 'Password updated successfully.');
        // } else {
        // Jika tidak cocok, kembalikan dengan pesan error
        //     return back()->withErrors(['error' => 'Current password is incorrect.'])->withInput();
        // }
    }


    public function subscriptions()
    {
        $customer_id = Auth::user()->customer_id;
        $subscriptions = Subscription::where('customer_id', $customer_id)->orderBy('subscription_status')->get();
        return view('subscriptions', compact('subscriptions'));
    }

    public function invoices()
    {
        $customer = Auth::user();

        // Ambil semua billing dengan status UNPAID dan PAID, urutkan berdasarkan status dan created_at
        $billing = Billing::where('billings.customer_id', $customer->customer_id)
            ->leftJoin('subscriptions', 'billings.customer_id', '=', 'subscriptions.customer_id')
            ->leftJoin('services', 'subscriptions.serv_id', '=', 'services.serv_id')
            ->select('billings.*', 'subscriptions.serv_id', 'services.service_description') // Menambahkan kolom yang ingin dipilih, bisa disesuaikan sesuai kebutuhan
            ->orderByRaw("FIELD(status, 'UNPAID', 'OVERDUE' ,'PAID')")
            ->orderBy('billings.created_at', 'DESC')
            ->get();

        return view('invoices', compact('billing'));
    }

    public function invoice($id)
    {
        $billing = Billing::where('invoice_no', $id)->first();
        $billing_detail = BillingDetail::leftJoin('billings', 'billings.invoice_no', '=', 'billing_details.invoice_no')->where('billings.invoice_no', $id)->get();
        $due_date = Carbon::parse($billing->created_at)->copy()->addDays(7)->format('d F Y');
        return view('detail-invoice', compact('billing', 'billing_detail', 'due_date'));
    }

    public function downloadInvoicePDF($invoiceNo)
    {
        $billing = Billing::where('invoice_no', $invoiceNo)->first();
        $billingDetail = BillingDetail::where('invoice_no', $invoiceNo)->get();
        $unusedSubs = Subscription::where('customer_id', $billing->customer_id)->where('subscription_status', 'ACTIVE')->get();
        $due_date = Carbon::parse($billing->created_at)->copy()->addDays(7)->format('d F Y');
        $subsInv = $billing->billingDetails->where('subscription_id', '!=', null)->first();
        $group = $billing->group;
        $pdf = Pdf::loadView('billing.pdfInvoice', compact('billing', 'billingDetail', 'unusedSubs', 'due_date', 'group'));
        if ($billing->status == 'PAID') {
            $canvas = $pdf->getDomPDF()->getCanvas();
            $width = $canvas->get_width();
            $height = $canvas->get_height();
            $imgWidth = 350;
            $imgHeight = 200;
            $x = ($width - $imgWidth) / 2;
            $y = ($height - $imgHeight) / 3.5;
            $canvas->set_opacity(0.1);
            $canvas->image('storage/paidstamp.png', $x, $y, $imgWidth, $imgHeight);
        }
        return $pdf->download('invoice-' . $invoiceNo . '-' . $billing->date . '.pdf');
    }


    public function showInv($invoiceNo)
    {
        $billing = Billing::where('invoice_no', $invoiceNo)->first();
        $billingDetail = BillingDetail::leftJoin('billings', 'billings.invoice_no', '=', 'billing_details.invoice_no')
            ->where('billing_details.invoice_no', $invoiceNo)->get();
        $unusedSubs = Subscription::where('customer_id', $billing->customer_id)->where('subscription_status', 'ACTIVE')->get();
        $due_date = Carbon::parse($billing->created_at)->copy()->addDays(7)->format('d F Y');
        $subsInv = $billing->billingDetails->where('subscription_id', '!=', null)->first();
        $group = $billing->group;
        // dd($billingDetail);
        return view('billing.showInv', compact('billing', 'unusedSubs', 'due_date', 'group', 'billingDetail'));
    }

    public function invoiceCustomer($invoiceNo)
    {
        if (env('PAYMENT_MODE') == 'COMMON') {
            return $this->downloadInvoicePDF($invoiceNo);
        } elseif (env('PAYMENT_MODE') == 'PG') {
            $inv = Billing::where('invoice_no', $invoiceNo)->first();
            return redirect()->route('streamPaymentInvoice', $inv->uuid);
        }
    }


    public function checkActive($id)
    {
        $response = IsActiveUserX86::check($id);

        return [
            'status' => count($response) != 0 ? 1 : 0,
            'ip' => $response[0]['address'] ?? '8.8.8.8'
        ];
    }
}
