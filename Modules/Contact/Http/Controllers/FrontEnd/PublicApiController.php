<?php

namespace Modules\Contact\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use Modules\Contact\Entities\Contact;
use Modules\Contact\Entities\ContactDetail;
use Modules\Contact\Http\Requests\CreateContactRequest;
use Modules\Contact\Repositories\ContactRepository;
use Modules\Contact\Repositories\CategoryRepository;
use Modules\Core\Http\Controllers\Api\BaseApiController;

class PublicApiController extends BaseApiController
{
    /**
     * @var ContactRepository
     */
    private $contactRepository;
    private $categoryRepository;

    public function __construct(ContactRepository $contactRepository, CategoryRepository $categoryRepository)
    {
        parent::__construct();
        $this->contactRepository = $contactRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function store(Request $request)
    {
        try {
            $messages = [
                'contact_name.required' => trans('contact::contacts.validation.contact_name.required'),
                'phone_number.required' => trans('contact::contacts.validation.phone_number.required'),
                'type_id.required' => trans('contact::contacts.validation.type_id.required'),
                'type_id.in' => trans('contact::contacts.validation.type_id.in'),
                'email.required' => trans('contact::contacts.validation.email.required'),
                'email.email' => trans('contact::contacts.validation.email.email'),
            ];

            $validator = \Validator::make($request->all(), [
                'contact_name' => 'required',
                'phone_number' => 'required',
                'type_id' => 'required|in:1,2,3',
                'email' => 'required|email',
            ], $messages);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 0,
                    'msg' => $validator->errors()->first()
                ]);
            }

            $typeId = $request->type_id;
            $type = $this->categoryRepository->find($typeId);
            $typeTitle = $type->title;

            $contactTitle = null;
            $messages = null;

            switch ($typeTitle) {
                case 'Sản phẩm': // case 1
                    $contactTitle = $request->product_contact_title;
                    $messages = $request->product_messages;
                    // Validate product specific fields
                    $productValidator = \Validator::make($request->all(), [
                        'product_id' => 'required',
                        'product_messages' => 'required',
                    ], [
                        'product_id.required' => trans('contact::contacts.validation.product_id.required'),
                        'product_messages.required' => trans('contact::contacts.validation.product_messages.required')
                    ]);
                    if ($productValidator->fails()) {
                        return response()->json([
                            'status' => 0,
                            'msg' => $productValidator->errors()->first()
                        ]);
                    }
                    break;
                case 'Dịch vụ': // case 2
                    $contactTitle = $request->service_contact_title;
                    // Validate service specific fields
                    $serviceValidator = \Validator::make($request->all(), [
                        'service_contact_title' => 'required',
                        'assembly_address' => 'required',
                        'monthly_consumption_kwh' => 'required|numeric',
                        'avg_monthly_cost_vnd' => 'required|numeric',
                        'financial_capacity_kw' => 'required|numeric',
                        'avl_roof_area_m2' => 'required|numeric',
                        'power_phase_count' => 'required|numeric'
                    ], [
                        'service_contact_title.required' => trans('contact::contacts.validation.service_contact_title.required'),
                        'assembly_address.required' => trans('contact::contacts.validation.assembly_address.required'),
                        'monthly_consumption_kwh.required' => trans('contact::contacts.validation.monthly_consumption_kwh.required'),
                        'monthly_consumption_kwh.numeric' => trans('contact::contacts.validation.monthly_consumption_kwh.numeric'),
                        'avg_monthly_cost_vnd.required' => trans('contact::contacts.validation.avg_monthly_cost_vnd.required'),
                        'avg_monthly_cost_vnd.numeric' => trans('contact::contacts.validation.avg_monthly_cost_vnd.numeric'),
                        'financial_capacity_kw.required' => trans('contact::contacts.validation.financial_capacity_kw.required'),
                        'financial_capacity_kw.numeric' => trans('contact::contacts.validation.financial_capacity_kw.numeric'),
                        'avl_roof_area_m2.required' => trans('contact::contacts.validation.avl_roof_area_m2.required'),
                        'avl_roof_area_m2.numeric' => trans('contact::contacts.validation.avl_roof_area_m2.numeric'),
                        'power_phase_count.required' => trans('contact::contacts.validation.power_phase_count.required'),
                        'power_phase_count.numeric' => trans('contact::contacts.validation.power_phase_count.numeric')
                    ]);
                    if ($serviceValidator->fails()) {
                        return response()->json([
                            'status' => 0,
                            'msg' => $serviceValidator->errors()->first()
                        ]);
                    }
                    break;
                case 'Hỗ trợ': // case 3
                    $contactTitle = $request->support_contact_title;
                    $messages = $request->support_messages;
                    // Validate support specific fields
                    $supportValidator = \Validator::make($request->all(), [
                        'support_contact_title' => 'required',
                        'support_messages' => 'required'
                    ], [
                        'support_contact_title.required' => trans('contact::contacts.validation.support_contact_title.required'),
                        'support_messages.required' => trans('contact::contacts.validation.support_messages.required')
                    ]);
                    if ($supportValidator->fails()) {
                        return response()->json([
                            'status' => 0,
                            'msg' => $supportValidator->errors()->first()
                        ]);
                    }
                    break;
            }

            $contactCode = strtoupper(substr(uniqid(sha1(time())), 0, 10));
            $contact = [
                'contact_code' => $contactCode,
                'contact_name' => $request->contact_name,
                'contact_title' => $contactTitle,
                'phone_number' => $request->phone_number,
                'email' => $request->email,
                'type_id' => $request->type_id,
                'status' => 'PENDING',
                'note' => null,
            ];

            $contact = $this->contactRepository->create($contact);

            $contactDetailData = [];

            switch ($typeTitle) {
                case 'Sản phẩm': // Product
                    $contactDetailData = [
                        'messages' => $messages,
                        'product_id' => $request->product_id,
                        'contact_id' => $contact->id
                    ];
                    break;

                case 'Dịch vụ': // Service
                    $contactDetailData = [
                        'assembly_address' => $request->assembly_address,
                        'monthly_consumption_kwh' => $request->monthly_consumption_kwh,
                        'avg_monthly_cost_vnd' => $request->avg_monthly_cost_vnd,
                        'financial_capacity_kw' => $request->financial_capacity_kw,
                        'avl_roof_area_m2' => $request->avl_roof_area_m2,
                        'power_phase_count' => $request->power_phase_count,
                        'contact_id' => $contact->id
                    ];
                    break;

                case 'Hỗ trợ': // Support
                    $contactDetailData = [
                        'messages' => $messages,
                        'contact_id' => $contact->id
                    ];
                    break;
            }

            ContactDetail::create($contactDetailData);

            return response()->json([
                'status' => 1,
                'msg' => trans('contact::messages.message sent successfully')
            ]);

        } catch (\Exception $e) {
            \Log::error('Contact form error: ' . $e->getMessage());

            return response()->json([
                'status' => 0,
                'msg' => 'Có lỗi xảy ra: ' . $e->getMessage()
            ]);
        }
    }
}
