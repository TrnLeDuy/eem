<?php

return [
    'contact'=>'lien-he',
    'list resource' => 'Danh sách liên hệ',
    'create resource' => 'Tạo liên hệ',
    'edit resource' => 'Chỉnh sửa liên hệ',
    'destroy resource' => 'Xóa liên hệ',
    'title' => [
        'contacts' => 'Liên hệ',
        'create contact' => 'Tạo một liên hệ',
        'edit contact' => 'Chỉnh sửa liên hệ',
    ],
    'button' => [
        'create contact' => 'Tạo một liên hệ',
    ],
    'table' => [
        'contact_code' => 'Mã liên hệ',
        'contact_name' => 'Tên liên hệ',
        'contact_title' => 'Tiêu đề',
        'phone_number' => 'Số điện thoại',
        'categories title' => 'Tiêu đề danh mục',
        'email' => 'Email',
        'status' => 'Trạng thái',
        'pending' => 'Chờ xử lý',
        'PENDING' => 'Chờ xử lý',
        'approved' => 'Đã xử lý',
        'APPROVED' => 'Đã xử lý',
    ],
    'form' => [
        'contact_code' => 'Mã liên hệ',
        'contact_name' => 'Tên liên hệ',
        'contact_title' => 'Tiêu đề',
        'phone_number' => 'Số điện thoại',
        'email' => 'Email',
        'note' => 'Ghi chú',
        'status' => 'Trạng thái',
        'categories' => 'Danh mục',
        'product' => 'Sản phẩm',
        'messages' => 'Tin nhắn',
        'monthly_consumption_kwh' => 'Tiêu thụ hàng tháng (kWh)',
        'avg_monthly_cost_vnd' => 'Chi phí trung bình hàng tháng (VND)',
        'financial_capacity_kw' => 'Khả năng tài chính (kW)',
        'avl_roof_area_m2' => 'Diện tích mái khả dụng (m²)',
        'assembly_address' => 'Địa chỉ lắp đặt',
    ],
    'messages' => [
    ],
    'validation' => [
        'contact_name' => [
            'required' => 'Vui lòng nhập tên liên hệ',
        ],
        'phone_number' => [
            'required' => 'Vui lòng nhập số điện thoại',
        ],
        'email' => [
            'required' => 'Vui lòng nhập địa chỉ email',
            'email' => 'Địa chỉ email không hợp lệ',
        ],
        'type_id' => [
            'required' => 'Vui lòng chọn loại liên hệ',
            'in' => 'Loại liên hệ không hợp lệ',
        ],
        'product_contact_title' => [
            'required' => 'Vui lòng nhập tiêu đề liên hệ',
        ],
        'product_messages' => [
            'required' => 'Vui lòng nhập nội dung tin nhắn',
        ],
        'product_id' => [
            'required' => 'Vui lòng chọn sản phẩm',
        ],
        'service_contact_title' => [
            'required' => 'Vui lòng nhập tiêu đề liên hệ',
        ],
        'assembly_address' => [
            'required' => 'Vui lòng nhập địa chỉ lắp đặt',
        ],
        'monthly_consumption_kwh' => [
            'required' => 'Vui lòng nhập tiêu thụ hàng tháng',
            'numeric' => 'Tiêu thụ hàng tháng phải là số',
        ],
        'avg_monthly_cost_vnd' => [
            'required' => 'Vui lòng nhập chi phí trung bình hàng tháng',
            'numeric' => 'Chi phí trung bình hàng tháng phải là số',
        ],
        'support_contact_title' => [
            'required' => 'Vui lòng nhập tiêu đề liên hệ',
        ],
        'support_messages' => [
            'required' => 'Vui lòng nhập nội dung tin nhắn',
        ],
        'financial_capacity_kw' => [
            'required' => 'Vui lòng nhập công suất tài chính',
            'numeric' => 'Công suất tài chính phải là số',
        ],
        'avl_roof_area_m2' => [
            'required' => 'Vui lòng nhập diện tích mái khả dụng',
            'numeric' => 'Diện tích mái khả dụng phải là số',
        ],
        'power_phase_count' => [
            'required' => 'Vui lòng nhập số pha điện',
            'numeric' => 'Số pha điện phải là số',
        ],
    ],
];
