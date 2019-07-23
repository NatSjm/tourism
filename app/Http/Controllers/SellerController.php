<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\Models\User;
use App\Models\Tour;
use App\Models\TourType;


class SellerController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, User $user)
    {

        $sellerTours = Tour::where('seller_id', $user->id);

        $sellerHasTours = $sellerTours? true : false;
        $tourType = ($request->input('tour_type'));

        if($request->filled('tour_type')){

            $sellerTours->whereHas('tourType',function(Builder $query) use($tourType){
                $query->where('name', $tourType);
            });
        }
         $sellerTours = $sellerTours->paginate(12);
//         $categories =  ['ind' => 'Индустриальный', 'luxury' => 'Luxury', 'all-inclus' => 'Все включено',
//            'fam' => 'Семейный отдых', 'gastro' => 'Гастрономический', 'keep-calm' => 'Спокойный отдых',
//            'intertainment' => 'Программа развлечений', 'shop' => 'Шоппинг', 'extreem' => 'Экстрим',
//            'beach' => 'Пляжный', 'sp' => 'SPA'];


        return view('pages.seller.seller', [
            'sellerTours' => $sellerTours,
            'body_class' => 'seller-page',
           'sellerHasTours' => $sellerHasTours,
            'crumb_level2' => $user->fullName,
            'crumb_level3' => ['Предложения продавца'],
            'filterType' => 'tour_type',
            'tourTypes' => TourType::pluck('name'),

        ]);
    }

}
