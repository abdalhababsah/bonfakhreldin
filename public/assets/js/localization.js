const lang = document.documentElement.lang;

let sentence = {
    ar: {
        "error_loading": "خطأ في التحميل",
        "not_found": "لم يتم العثور على منتجات",
        "validation_error": "خطأ في التحقق",
        "please_fill_required": "يرجى ملء جميع الحقول المطلوبة.",
        "confirm_order": "تأكيد الطلب",
        "thank_you_order": "شكراً لطلبك"
    },
    en: {
        "error_loading": "error while loading",
        "not_found": "no products found",
        "validation_error": "Validation Error",
        "please_fill_required": "Please fill in all required fields.",
        "confirm_order": "Confirm Order",
        "thank_you_order": "Thank You for Your Order"
    },
};

let localSentence = sentence[lang ?? 'en'];