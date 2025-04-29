<?php

return 
[
   
    'validation' => [
        'type_required' => 'نوع الفاتورة مطلوب',
        'type_in' => 'نوع الفاتورة غير صالح',
        'payment_method_required' => 'طريقة الدفع مطلوبة',
        'payment_method_in' => 'طريقة الدفع غير صالحة',
        'original_invoice_number_required_if' => 'رقم الفاتورة الأصلي مطلوب للمرتجعات والتبديلات',
        'original_invoice_number_exists' => 'رقم الفاتورة الأصلي غير موجود',
        'total_required' => 'المبلغ الإجمالي مطلوب',
        'total_numeric' => 'يجب أن يكون المبلغ الإجمالي رقمًا',
        'total_min' => 'لا يمكن أن يكون المبلغ الإجمالي سالبًا',
        'discount_required' => 'مبلغ الخصم مطلوب',
        'discount_numeric' => 'يجب أن يكون مبلغ الخصم رقمًا',
        'discount_min' => 'لا يمكن أن يكون مبلغ الخصم سالبًا',
        'tax_table_required' => 'مبلغ ضريبة الجدول مطلوب',
        'tax_table_numeric' => 'يجب أن يكون مبلغ ضريبة الجدول رقمًا',
        'tax_table_min' => 'لا يمكن أن يكون مبلغ ضريبة الجدول سالبًا',
        'tax_additional_required' => 'مبلغ الضريبة الإضافية مطلوب',
        'tax_additional_numeric' => 'يجب أن يكون مبلغ الضريبة الإضافية رقمًا',
        'tax_additional_min' => 'لا يمكن أن يكون مبلغ الضريبة الإضافية سالبًا',
        'net_amount_required' => 'المبلغ الصافي مطلوب',
        'net_amount_numeric' => 'يجب أن يكون المبلغ الصافي رقمًا',
        'net_amount_min' => 'لا يمكن أن يكون المبلغ الصافي سالبًا',
        'items_required' => 'مطلوب عنصر فاتورة واحد على الأقل',
        'items_array' => 'يجب أن تكون عناصر الفاتورة مصفوفة',
        'items_min' => 'مطلوب عنصر فاتورة واحد على الأقل',
        'items_product_id_required' => 'معرف المنتج مطلوب لجميع العناصر',
        'items_product_id_exists' => 'المنتج غير موجود',
        'items_category_id_required' => 'معرف الفئة مطلوب لجميع العناصر',
        'items_category_id_exists' => 'الفئة غير موجودة',
        'items_quantity_required' => 'الكمية مطلوبة لجميع العناصر',
        'items_quantity_integer' => 'يجب أن تكون الكمية عددًا صحيحًا',
        'items_quantity_min' => 'يجب أن تكون الكمية 1 على الأقل',
        'items_selling_unit_price_required' => 'سعر بيع الوحدة مطلوب لجميع العناصر',
        'items_selling_unit_price_numeric' => 'يجب أن يكون سعر بيع الوحدة رقمًا',
        'items_selling_unit_price_min' => 'لا يمكن أن يكون سعر بيع الوحدة سالبًا',
        'items_discount_required' => 'الخصم مطلوب لجميع العناصر',
        'items_discount_numeric' => 'يجب أن يكون الخصم رقمًا',
        'items_discount_min' => 'لا يمكن أن يكون الخصم سالبًا',
        'items_tax_required' => 'الضريبة مطلوبة لجميع العناصر',
        'items_tax_numeric' => 'يجب أن تكون الضريبة رقمًا',
        'items_tax_min' => 'لا يمكن أن تكون الضريبة سالبة',
        'items_total_required' => 'المبلغ الإجمالي مطلوب لجميع العناصر',
        'items_total_numeric' => 'يجب أن يكون المبلغ الإجمالي رقمًا',
        'items_total_min' => 'لا يمكن أن يكون المبلغ الإجمالي سالبًا',
    ],

   "product" =>
    [
        "get_all" => "تم استرجاع المهام بنجاح",
        "get_failed" => "فشل في استرجاع المهام",
    ],
    "category"=>
    [
        "get_all" => "تم استرجاع الفئات بنجاح",
        "get_failed"=>"فشل في استرجاع الفئات",
    ],
    "invoice"=>
    [
        "get_all" => "تم استرجاع الفواتير بنجاح",
        "get_failed" => "فشل في استرجاع الفواتير",
        "get" => "تم استرجاع الفاتورة بنجاح",
    ]

];
