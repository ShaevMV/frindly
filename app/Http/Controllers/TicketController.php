<?php

namespace App\Http\Controllers;

use App\Mail\OrderShipped;
use App\Models\FriendlyTicket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Throwable;

class TicketController extends Controller
{
    public function view()
    {
        return view('tickets/form');
    }

    public function add(Request $request)
    {
        $price = $request->post('price') / $request->post('count');
        DB::beginTransaction();
        try {
            $ids = [];
            foreach ($request->post('fio') as $value) {
                $model = new FriendlyTicket();
                $model->fio_friendly = $value;
                $model->fio = $request->post('fio_seller');
                $model->seller = $request->post('seller');
                $model->email = $request->post('email');
                $model->price = $price;
                $model->saveOrFail();
                $ids['f' . $model->id] =  $value;
            }
/*            mail(
                $request->post('email'),
                'Билеты на Full Moon Systo Togathering 2022',
                view('emails.orders.shipped',['ids' => $ids])
            );*/

            Mail::to($request->post('email'))->send(new OrderShipped($ids));
            
            $massage = 'Билеты добавлены';
            DB::commit();
        } catch (Throwable $e) {
            DB::rollback();
            $massage = $e->getMessage();
        }

        return redirect('/')
            ->with('status', $massage);
    }
}
