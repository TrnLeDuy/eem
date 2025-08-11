<?php

return [
    'contact'=>'contact',
    'list resource' => 'List contacts',
    'create resource' => 'Create contact',
    'edit resource' => 'Edit contact',
    'destroy resource' => 'Delete contact',
    'title' => [
        'contacts' => 'Contacts',
        'create contact' => 'Create a contact',
        'edit contact' => 'Edit contact',
    ],
    'button' => [
        'create contact' => 'Create a contact',
    ],
    'table' => [
        'contact_code' => 'Contact code',
        'contact_name' => 'Contact name',
        'contact_title' => 'Title',
        'phone_number' => 'Phone number',
        'categories title' => 'Categories title',
        'email' => 'Email',
        'status' => 'Status',
        'pending' => 'Pending',
        'PENDING' => 'Pending',
        'approved' => 'Approved',
        'APPROVED' => 'Approved',
    ],
    'form' => [
        'contact_code' => 'Contact code',
        'contact_name' => 'Contact name',
        'contact_title' => 'Title',
        'phone_number' => 'Phone number',
        'email' => 'Email',
        'note' => 'Note',
        'status' => 'Status',
        'categories' => 'Categories',
        'product' => 'Product',
        'messages' => 'Messages',
        'monthly_consumption_kwh' => 'Monthly consumption (kWh)',
        'avg_monthly_cost_vnd' => 'Average monthly cost (VND)',
        'financial_capacity_kw' => 'Financial capacity (kW)',
        'avl_roof_area_m2' => 'Available roof area (m²)',
        'assembly_address' => 'Assembly address',
    ],
    'messages' => [
    ],
    'validation' => [
        'contact_name' => [
            'required' => 'Please enter contact name',
        ],
        'phone_number' => [
            'required' => 'Please enter phone number',
        ],
        'email' => [
            'required' => 'Please enter email address',
            'email' => 'Invalid email address',
        ],
        'type_id' => [
            'required' => 'Please select contact type',
            'in' => 'Invalid contact type',
        ],
        'product_contact_title' => [
            'required' => 'Please enter contact title',
        ],
        'product_messages' => [
            'required' => 'Please enter message content',
        ],
        'product_id' => [
            'required' => 'Please select a product',
        ],
        'service_contact_title' => [
            'required' => 'Please enter contact title',
        ],
        'assembly_address' => [
            'required' => 'Please enter assembly address',
        ],
        'monthly_consumption_kwh' => [
            'required' => 'Please enter monthly consumption',
            'numeric' => 'Monthly consumption must be a number',
        ],
        'avg_monthly_cost_vnd' => [
            'required' => 'Please enter average monthly cost',
            'numeric' => 'Average monthly cost must be a number',
        ],
        'support_contact_title' => [
            'required' => 'Please enter contact title',
        ],
        'support_messages' => [
            'required' => 'Please enter message content',
        ],
        'financial_capacity_kw' => [
            'required' => 'Please enter financial capacity',
            'numeric' => 'Financial capacity must be a number',
        ],
        'avl_roof_area_m2' => [
            'required' => 'Please enter available roof area',
            'numeric' => 'Available roof area must be a number',
        ],
        'power_phase_count' => [
            'required' => 'Please enter power phase count',
            'numeric' => 'Power phase count must be a number',
        ],
    ],
];
