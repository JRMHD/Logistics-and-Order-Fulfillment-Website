<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class AdminSubscriberController extends Controller
{
    public function index()
    {
        $subscribers = Subscriber::latest()->paginate(20); // Updated to 20 per page
        return view('admin.subscribers.index', compact('subscribers'));
    }

    public function exportCsv()
    {
        $subscribers = Subscriber::all();
        $filename = "subscribers.csv";

        $headers = [
            "Content-Type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
        ];

        $callback = function () use ($subscribers) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ["ID", "Email", "Subscribed At"]); // Column headers

            foreach ($subscribers as $subscriber) {
                fputcsv($file, [$subscriber->id, $subscriber->email, $subscriber->created_at]);
            }

            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }
}
