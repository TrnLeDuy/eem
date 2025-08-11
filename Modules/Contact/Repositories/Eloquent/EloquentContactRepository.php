<?php

namespace Modules\Contact\Repositories\Eloquent;

use Illuminate\Http\Request;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Modules\Contact\Repositories\ContactRepository;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;

class EloquentContactRepository extends EloquentBaseRepository implements ContactRepository
{
    public function serverPaginationFilteringFor(Request $request): LengthAwarePaginator
    {
        $contacts = $this->allWithBuilder();
        
        if ($request->get('search') !== null) {
            $term = $request->get('search');
            $contacts->where('contact_code', 'LIKE', $term)
                ->orWhere('contact_name', 'LIKE', "%{$term}%")
                ->orWhere('email', 'LIKE', "%{$term}%")
                ->orWhere('id', $term);
        }

        if ($request->get('type_id') !== null) {
            $contacts->where('type_id', $request->get('type_id'));
        }

        if ($request->get('order_by') !== null && $request->get('order') !== 'null') {
            $order = $request->get('order') === 'ascending' ? 'asc' : 'desc';
            $contacts->orderBy($request->get('order_by'), $order);
        } else {
            $contacts->orderBy('created_at', 'desc');
        }

        return $contacts->paginate($request->get('per_page', 10));
    }
}
